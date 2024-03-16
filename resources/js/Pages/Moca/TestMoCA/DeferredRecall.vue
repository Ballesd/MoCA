<template>
    <div class="m-4 p-4 bg-white shadow-md rounded-lg">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-semibold">10. Recuerdo diferido</h2>
            <p class="text-gray-600">“Antes le he leído una
                serie de palabras y le he pedido que las recordase. Dígame ahora todas las palabras de
                las que se acuerde”. El examinador marca con una cruz las palabras que el paciente
                recuerde sin necesidad de pistas en el espacio reservado a dicho efecto.
            </p>
        </div>
        <div class="p-4">
            <!-- Realizar el intento -->
            <div v-if="! this.track && ! this.selectTest">
                <h2 class="text-2xl font-semibold mb-4">Intento sin pistas</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div v-for="(word, index) in words" :key="index">
                        <input
                        v-model="rememberedWords[index]"
                        @input="removeSpaces(index)"
                        class="border rounded p-2 w-full"
                        />
                    </div>
                </div>
                <div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 my-2 mx-2 rounded" @click="recordAttempt">
                        Registrar Intento
                    </button>
                    <button class="bg-blue-500 hover-bg-blue-700 text-white font-bold py-2 px-4 my-2 mx-2 rounded" @click="this.track = true">
                        Necesito pistas
                    </button>
                </div>
                <!--Muestro boton de pistas-->
            </div>
            <!--Intento con pistas -->
            <div v-else-if=" this.track && !this.selectTest">
                <h2 class="text-2xl font-semibold mb-4">Intento con pistas</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div v-for="(word, index) in words" :key="index">
                        <!--Label con la pista-->
                        <label class="block text-sm font-semibold">{{ this.trakwords[word] }}</label>
                        <!--Input con las palabras a recordar-->
                        <input
                        v-model="rememberedWords[index]"
                        @input="removeSpaces(index)"
                        class="border rounded p-2 w-full"
                        />
                    </div>
                </div>
                <div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-4 rounded" @click="recordAttemptTrack">
                        Registrar Intento
                    </button>
                    <button class="bg-blue-500 hover-bg-blue-700 text-white font-bold py-2 px-4 my-2 mx-2 rounded" @click="this.selectTest = true">
                        Necesito seleccionar
                    </button>
                </div>
            </div>
            <!--Intento con selección multimple-->
            <div v-else-if=" this.track && this.selectTest && !this.endTest">
                <h2 class="text-2xl font-semibold mb-4">Intento con selección múltiple</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div v-for="(word, index) in words" :key="index">
                        <!--Label con la pista-->
                        <label class="block text-sm font-semibold">{{ this.trakwords[word] }}</label>
                        <!--Input con las palabras a recordar-->
                        <select v-model="rememberedWords[index]" class="border rounded p-2 w-full">
                            <option v-for="(option, index) in multiSelection[word]" :key="index" :value="option">
                                {{ option }}
                            </option>
                        </select>
                    </div>
                </div>
                <div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-4 rounded" @click="recordAttemptSelect">
                        Intento Final
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import axios from "axios";
    export default {
        data() {
            return {
                words: ["ROSTRO", "SEDA", "IGLESIA", "CLAVEL", "ROJO"],
                trakwords: {
                    "ROSTRO": "parte del cuerpo",
                    "SEDA": "tipo de tela",
                    "IGLESIA": "tipo de edificio",
                    "CLAVEL": "tipo de flor",
                    "ROJO": "color"
                },
                multiSelection: {
                    "ROSTRO": ["NARIZ","ROSTRO", "MANO" ,"HOMBRO"],
                    "SEDA": ["TELA", "VAQUERA", "SEDA", "ALGODÓN"],
                    "IGLESIA": ["IGLESIA", "ESCUELA", "HOSPITAL"],
                    "CLAVEL": ["ROSA", "CLAVEL", "TULIPÁN", "GIRASOL"],
                    "ROJO": ["ROJO", "AZUL", "VERDE", "AMARILLO"]      
                },
                goodanswer1: [],
                goodanswer2: [],
                endTest: false,
                track: false,
                selectTest: false,
                rememberedWords: [],
                score: 0, // puntuación del tercer intento
                score_permanent: 0,
                comulative_answer: [],
                answer: ["ROSTRO", "SEDA", "IGLESIA", "CLAVEL", "ROJO"], // Respuesta predefinida
            };
        },
        mounted() {
            this.speachIntroduction();
        },
        methods: {
            speachIntroduction() {
                const text1 = "Antes le he leído una serie de palabras y le he pedido que las recordase. Ahora escriba todas las palabras de las que se acuerde"
                const synthesis = window.speechSynthesis;
                const utterance = new SpeechSynthesisUtterance(text1);
                utterance.rate = 0.6; // Ajusta este valor para cambiar la velocidad
                synthesis.speak(utterance);
            },
            startAttempt() {
                // Limpiamos los valores de rememberedWords para el siguiente intento
                this.rememberedWords = [];
            },
            vectorAnswer(saveAnswer){
                let correctCount = 0;
                // Mantén un registro temporal de respuestas correctas para este intento
                let tempCorrectAnswers = [];
                for (let i = 0; i < this.rememberedWords.length; i++) {
                    if(this.answer.includes(this.rememberedWords[i])){
                        correctCount++;
                        tempCorrectAnswers.push(this.rememberedWords[i]);
                    }
                }

                // Actualiza los arrays y estados solo con respuestas correctas
                saveAnswer.push(...tempCorrectAnswers);
                return correctCount;
            },

            Deletetrakwords(){
                for (let i = 0; i < this.goodanswer1.length; i++) {
                    delete this.trakwords[this.goodanswer1[i]];
                    delete this.multiSelection[this.goodanswer1[i]];
                    this.words.splice(this.words.indexOf(this.goodanswer1[i]), 1);
                }
            },
            DeleteMultiSelection(){
                for (let i = 0; i < this.goodanswer2.length; i++) {
                    delete this.multiSelection[this.goodanswer2[i]];
                    this.words.splice(this.words.indexOf(this.goodanswer2[i]), 1);
                }
            },
            recordAttempt() {
                this.comulative_answer.push(...this.rememberedWords);
                if( !this.track && !this.selectTest){
                    const goodanswer = this.vectorAnswer(this.goodanswer1);
                    this.score = goodanswer * 3;
                    this.score_permanent = goodanswer;
                    if( (this.goodanswer1.length) < 5){
                        this.Deletetrakwords();
                        this.track = true;
                        this.startAttempt();
                    }
                    else{
                        this.sendAnswer();
                    }
                    
                }
            },
            recordAttemptTrack(){
                this.comulative_answer.push(...this.rememberedWords);
                const goodanswer = (this.vectorAnswer(this.goodanswer2));
                this.score += goodanswer * 2;
                this.score_permanent += goodanswer;
                if((this.goodanswer1.length) < 5){
                    this.DeleteMultiSelection();
                    this.selectTest = true;
                    this.startAttempt();
                }
                else{
                    this.sendAnswer();
                }
            },
            recordAttemptSelect(){
                this.comulative_answer.push(...this.rememberedWords);
                const goodanswer = (this.vectorAnswer(this.goodanswer2));
                this.score += goodanswer;
                this.score_permanent += goodanswer;
                this.endTest = true;
                this.sendAnswer(); 
            },
            removeSpaces(index) {
                // Elimina espacios en blanco de la palabra recordada y se pasa a maysuculas
                this.rememberedWords[index] = this.rememberedWords[index].trim();
                this.rememberedWords[index] = this.rememberedWords[index].toUpperCase();
            },

            async sendAnswer() {
                const response = await axios.post('/moca/savemis', {
                    mis: this.score
                }, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

                const wordsString = this.comulative_answer.join(',');
                const answer = {
                    deferred_recall_answer: wordsString
                };

                //'/moca/uploadDelayedRecall'
                await axios.post('/moca/uploadDelayedRecall', answer)
                .catch(error => {
                    console.log(error);
                });

                console.log("respuesta deferred call para la prueba",response);
                this.$emit("answer-score", this.score_permanent);
            },
    },
};
</script>
