<template>
    <div class="m-4 p-4 bg-white shadow-md rounded-lg text-center">
        <div class="flex justify-center items-center space-x-2">
        <h2 class="text-lg font-semibold flex items-center">10. Recuerdo diferido</h2>
        <button class="flex items-center" @click="speachIntroduction">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 512 512" fill="none" stroke="currentColor">
            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                <path d="M3834 4426 c-86 -38 -154 -139 -154 -230 0 -77 19 -122 82 -194 145 -167 187 -220 251 -315 132 -198 250 -480 296 -712 131 -657 -51 -1310 -501 -1802 -105 -115 -122 -149 -123 -238 0 -59 5 -78 29 -123 52 -93 140 -139 247 -129 80 7 131 39 222 139 310 343 525 753 621 1189 75 338 75 760 0 1098 -63 287 -202 614 -362 856 -144 218 -316 414 -396 451 -59 27 -161 32 -212 10z"/>
                <path d="M2219 4336 c-20 -7 -49 -22 -65 -34 -16 -11 -243 -235 -504 -496 l-475 -476 -345 0 c-204 0 -360 -4 -382 -10 -65 -18 -130 -70 -160 -129 l-28 -53 0 -574 c0 -621 -1 -606 54 -679 13 -17 48 -44 77 -60 l54 -30 365 -3 365 -3 490 -488 c270 -269 505 -497 524 -506 52 -26 139 -31 199 -11 58 20 119 73 147 131 20 39 20 70 20 1645 0 1575 0 1606 -20 1645 -57 115 -197 174 -316 131z"/>
                <path d="M3105 3697 c-66 -32 -120 -93 -139 -158 -32 -106 -13 -165 93 -289 154 -180 238 -366 262 -582 16 -146 1 -284 -48 -431 -44 -132 -109 -245 -214 -367 -106 -124 -125 -183 -93 -289 33 -111 144 -188 259 -179 99 8 160 52 282 203 145 179 266 446 310 685 24 131 24 409 0 540 -35 188 -120 403 -225 565 -85 133 -203 264 -267 297 -63 33 -158 35 -220 5z"/>
            </g>
            </svg>
        </button>
        <p class="text-gray-600">“Antes le he leído una
            serie de palabras y le he pedido que las recordase. Dígame ahora todas las palabras de
            las que se acuerde”. 
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
                score: 0,
                score_permanent: 0,
                comulative_answer: [],
                answer: ["ROSTRO", "SEDA", "IGLESIA", "CLAVEL", "ROJO"],
            };
        },
        methods: {
            speachIntroduction() {
                const text1 = "Antes le he leído una serie de palabras y le he pedido que las recordase. Ahora escriba todas las palabras de las que se acuerde"
                const synthesis = window.speechSynthesis;
                const utterance = new SpeechSynthesisUtterance(text1);
                utterance.rate = 0.6;
                synthesis.speak(utterance);
            },
            startAttempt() {
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
