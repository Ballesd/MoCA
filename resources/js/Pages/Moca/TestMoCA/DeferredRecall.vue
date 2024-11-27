<template>
    <div class="flex items-center justify-center space-x-12 mb-8">
        <div class="w-9/12 flex flex-col gap-4">
            <div class="flex justify-start items-center space-x-3">
                <h2 class="text-primary text-3xl">10. Recuerdo diferido</h2>
                <font-awesome-icon @click="speachIntroduction" :icon="['fas', 'volume-up']" size="2x" class="text-secondary cursor-pointer hover:text-primary" />

            </div>
            <div class="border-2 border-gray-400 rounded-lg p-4 flex items-center">
                <p class="text-gray-500">Ingrese en cada uno de los cuadros de texto las 5 palabras dictadas en la pregunta 5.</p>
            </div>
            <!-- Intento sin pistas -->
            <div v-if="!this.track && !this.selectTest" class="flex flex-col gap-4">
                <div class="w-full">
                    <ButtonCustom class="w-full" @click="">Intento sin pistas</ButtonCustom>
                </div>
                <div class="bg-quinary rounded-md shadow-lg p-5 grid grid-cols-2 gap-4">
                    <div v-for="(word, index) in words" :key="index">
                        <TextInput v-model="rememberedWords[index]" @input="removeSpaces(index)" type="text" class="block w-full" />
                    </div>
                    <div class="flex w-full justify-center items-end">
                        <ButtonCustom class="w-full" mode="button" @click="recordAttempt">REGISTRAR</ButtonCustom>
                    </div>
                    <ButtonCustom mode="button" @click="this.track = true">AYUDA</ButtonCustom>
                </div>
            </div>
            <!-- / Intento sin pistas -->
            <!-- Intento con pistas -->
            <div v-else-if="this.track && !this.selectTest" class="flex flex-col gap-4">
                <div class="w-full">
                    <ButtonCustom class="w-full" @click="">Intento con pistas</ButtonCustom>
                </div>
                <div class="bg-quinary rounded-md shadow-lg p-5 grid grid-cols-2 gap-4">
                    <div v-for="(word, index) in words" :key="index">
                        <InputLabel :value="this.trakwords[word]" />
                        <TextInput v-model="rememberedWords[index]" @input="removeSpaces(index)" type="text" class="block w-full" />
                    </div>
                    <div class="flex w-full justify-center items-end">
                        <ButtonCustom class="w-full" mode="button" @click="recordAttemptTrack">REGISTRAR</ButtonCustom>
                    </div>
                    <ButtonCustom mode="button" @click="this.selectTest = true">SELECCIONAR</ButtonCustom>
                </div>
            </div>
            <!-- / Intento con pistas -->
            <!-- Intento seleccion multiple -->
            <div v-else-if="this.track && this.selectTest && !this.endTest" class="flex flex-col gap-4">
                <div class="w-full">
                    <ButtonCustom class="w-full" @click="">Intento con selección</ButtonCustom>
                </div>
                <div class="bg-quinary rounded-md shadow-lg p-5 grid grid-cols-2 gap-4">
                    <div v-for="(word, index) in words" :key="index">
                        <InputLabel :value="this.trakwords[word]" />
                        <select v-model="rememberedWords[index]" class="border rounded p-2 w-full">
                            <option v-for="(option, index) in multiSelection[word]" :key="index" :value="option">
                                {{ option }}
                            </option>
                        </select>
                    </div>
                    <div class="flex w-full justify-center items-end">
                        <ButtonCustom class="w-full" mode="button" @click="recordAttemptSelect">INTENTO FINAL</ButtonCustom>
                    </div>
                </div>
            </div>
            <!-- / Intento seleccion multiple -->
        </div>
    </div>
</template>

<script>
import ButtonCustom from '@/Components/ButtonCustom.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import axios from 'axios';
export default {
    components: {
        ButtonCustom,
        TextInput,
        InputLabel
    },
    data() {
        return {
            words: ['ROSTRO', 'SEDA', 'IGLESIA', 'CLAVEL', 'ROJO'],
            trakwords: {
                ROSTRO: 'parte del cuerpo',
                SEDA: 'tipo de tela',
                IGLESIA: 'tipo de edificio',
                CLAVEL: 'tipo de flor',
                ROJO: 'color'
            },
            multiSelection: {
                ROSTRO: ['NARIZ', 'ROSTRO', 'MANO', 'HOMBRO'],
                SEDA: ['TELA', 'VAQUERA', 'SEDA', 'ALGODÓN'],
                IGLESIA: ['IGLESIA', 'ESCUELA', 'HOSPITAL'],
                CLAVEL: ['ROSA', 'CLAVEL', 'TULIPÁN', 'GIRASOL'],
                ROJO: ['ROJO', 'AZUL', 'VERDE', 'AMARILLO']
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
            answer: ['ROSTRO', 'SEDA', 'IGLESIA', 'CLAVEL', 'ROJO']
        };
    },
    methods: {
        speachIntroduction() {
            const text1 = 'Antes le he leído una serie de palabras y le he pedido que las recordase. Ahora escriba todas las palabras de las que se acuerde';
            const synthesis = window.speechSynthesis;
            const utterance = new SpeechSynthesisUtterance(text1);
            utterance.rate = 0.6;
            synthesis.speak(utterance);
        },
        startAttempt() {
            this.rememberedWords = [];
        },
        vectorAnswer(saveAnswer) {
            let correctCount = 0;
            // Mantén un registro temporal de respuestas correctas para este intento
            let tempCorrectAnswers = [];
            for (let i = 0; i < this.rememberedWords.length; i++) {
                if (this.answer.includes(this.rememberedWords[i])) {
                    correctCount++;
                    tempCorrectAnswers.push(this.rememberedWords[i]);
                }
            }

            saveAnswer.push(...tempCorrectAnswers);
            return correctCount;
        },

        Deletetrakwords() {
            for (let i = 0; i < this.goodanswer1.length; i++) {
                delete this.trakwords[this.goodanswer1[i]];
                delete this.multiSelection[this.goodanswer1[i]];
                this.words.splice(this.words.indexOf(this.goodanswer1[i]), 1);
            }
        },
        DeleteMultiSelection() {
            for (let i = 0; i < this.goodanswer2.length; i++) {
                delete this.multiSelection[this.goodanswer2[i]];
                this.words.splice(this.words.indexOf(this.goodanswer2[i]), 1);
            }
        },
        recordAttempt() {
            this.comulative_answer.push(...this.rememberedWords);
            if (!this.track && !this.selectTest) {
                const goodanswer = this.vectorAnswer(this.goodanswer1);
                this.score = goodanswer * 3;
                this.score_permanent = goodanswer;
                if (this.goodanswer1.length < 5) {
                    this.Deletetrakwords();
                    this.track = true;
                    this.startAttempt();
                } else {
                    this.sendAnswer();
                }
            }
        },
        recordAttemptTrack() {
            this.comulative_answer.push(...this.rememberedWords);
            const goodanswer = this.vectorAnswer(this.goodanswer2);
            this.score += goodanswer * 2;
            this.score_permanent += goodanswer;
            if (this.goodanswer1.length < 5) {
                this.DeleteMultiSelection();
                this.selectTest = true;
                this.startAttempt();
            } else {
                this.sendAnswer();
            }
        },
        recordAttemptSelect() {
            this.comulative_answer.push(...this.rememberedWords);
            const goodanswer = this.vectorAnswer(this.goodanswer2);
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
            const response = await axios.post(
                '/moca/savemis',
                {
                    mis: this.score
                },
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            );

            const wordsString = this.comulative_answer.join(',');
            const answer = {
                deferred_recall_answer: wordsString
            };

            //'/moca/uploadDelayedRecall'
            await axios.post('/moca/uploadDelayedRecall', answer).catch((error) => {
                console.log(error);
            });

            this.$emit('answer-score', this.score_permanent);
        }
    }
};
</script>
