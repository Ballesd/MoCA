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
            words: ["ROSTRO", "SEDA", "TEMPLO", "CLAVEL", "ROJO"],
            trakwords: {
                "ROSTRO": "parte del cuerpo",
                "SEDA": "tipo de tela",
                "TEMPLO": "tipo de edificio",
                "CLAVEL": "tipo de flor",
                "ROJO": "color"
            },
            multiSelection: {
                "ROSTRO": ["NARIZ","ROSTRO", "MANO" ,"HOMBRO"],
                "SEDA": ["TELA", "VAQUERA", "SEDA", "ALGODÓN"],
                "TEMPLO": ["TEMPLO", "ESCUELA", "HOSPITAL"],
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
            answer: ["ROSTRO", "SEDA", "TEMPLO", "CLAVEL", "ROJO"], // Respuesta predefinida
        };
        },
        methods: {
        startAttempt() {
            // Limpiamos los valores de rememberedWords para el siguiente intento
            this.rememberedWords = [];
        },
        vectorAnswer(saveAnswer){
            let correctCount = 0;
            for (let i = 0; i < this.rememberedWords.length; i++) {
                //preguntamos si la palabra se encunetra en el vector de respuestas
                if(this.answer.includes(this.rememberedWords[i])){
                    correctCount++;
                    saveAnswer.push(this.rememberedWords[i]);
                }
            }
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
            if( !this.track && !this.selectTest){
                this.score = (this.vectorAnswer(this.goodanswer1) * 3);
                this.score_permanent = (this.vectorAnswer(this.goodanswer1));
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
            this.score += (this.vectorAnswer(this.goodanswer2) * 2);

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
            this.score += (this.vectorAnswer(this.goodanswer2) * 1);
            this.endTest = true;
            this.sendAnswer();
            
        },
        removeSpaces(index) {
            // Elimina espacios en blanco de la palabra recordada y se pasa a maysuculas
            this.rememberedWords[index] = this.rememberedWords[index].trim();
            this.rememberedWords[index] = this.rememberedWords[index].toUpperCase();
        },

        async sendAnswer() {
            console.log("respuesta final", this.score);
            const response = await axios.post('/moca/savemis', {
                mis: this.score
            }, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });
            console.log("respuesta deferred call",response);
            this.$emit("answer-score", this.score_permanent);
        },
    },
};
</script>
  
<style scoped>
  /* Estilos de Tailwind CSS aquí */
</style>
  