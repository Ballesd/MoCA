<template>
    <div class="m-4 p-4 bg-white shadow-md rounded-lg">
      <div class="mb-4">
        <p class="text-lg font-semibold">1. Fase de Alternancia Conceptual</p>
        <p>
          Por favor, conecte los nodos en el orden correcto: 1 – A – 2 – B – 3 – C – 4 – D – 5 – E.
        </p>
      </div>
  
      <!-- Área de dibujo -->
      <div ref="stage" class="border border-gray-400 mx-auto"></div>
  
      <!-- Botón para finalizar el test -->
      <button @click="finishTest" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Finalizar Test
      </button>
    </div>
</template>
  
<script>
  /*
  export default {
    data() {
      return {
        stage: null,
        layer: null,
        nodes: ["1", "A", "2", "B", "3", "C", "4", "D", "5", "E"],
        nodePositions: [], // Posiciones de los nodos
        connections: [],
        currentNodeIndex: 0,
      };
    },
    mounted() {
      // Crear el escenario (stage) de Konva
      t/*his.stage = new Konva.Stage({
        container: this.$refs.stage,
        width: 600,
        height: 400,
      });*/
  
      // Crear una capa (layer) para el dibujo
      //this.layer = new Konva.Layer();
      //this.stage.add(this.layer);
  
      // Calcular posiciones de nodos de manera aleatoria
  /*    this.nodePositions = this.shuffleArray(this.calculateNodePositions());
  
      // Dibujar los nodos iniciales
      this.drawNodes();
    },
    methods: {
      calculateNodePositions() {
        // Calcular posiciones de los nodos de manera uniforme en el lienzo
        const positions = [];
        const totalNodes = this.nodes.length;
        for (let i = 0; i < totalNodes; i++) {
          const x = Math.random() * (this.stage.width() - 40) + 20;
          const y = Math.random() * (this.stage.height() - 40) + 20;
          positions.push({ x, y });
        }
        return positions;
      },
      shuffleArray(array) {
        // Función para mezclar un array aleatoriamente
        const shuffledArray = [...array];
        for (let i = shuffledArray.length - 1; i > 0; i--) {
          const j = Math.floor(Math.random() * (i + 1));
          [shuffledArray[i], shuffledArray[j]] = [shuffledArray[j], shuffledArray[i]];
        }
        return shuffledArray;
      },
      drawNodes() {
        const nodeRadius = 20;
  
        /*this.nodes.forEach((node, index) => {
          const circle = new Konva.Circle({
            x: this.nodePositions[index].x,
            y: this.nodePositions[index].y,
            radius: nodeRadius,
            fill: 'lightgray',
            stroke: 'black',
            strokeWidth: 2,
          });*/
  
          /*const text = new Konva.Text({
            x: this.nodePositions[index].x - 8,
            y: this.nodePositions[index].y - 8,
            text: node,
            fontSize: 20,
            fill: 'black',
          });
  
          this.layer.add(circle, text);
        });
        */
       /*
        this.stage.draw();
      },
      
      checkConnection() {
        // Verificar si la conexión es correcta
        if (this.currentNodeIndex < this.nodes.length - 1) {
          const currentNodeX = this.nodePositions[this.currentNodeIndex].x;
          const currentNodeY = this.nodePositions[this.currentNodeIndex].y;
          const nextNodeX = this.nodePositions[this.currentNodeIndex + 1].x;
          const nextNodeY = this.nodePositions[this.currentNodeIndex + 1].y;
  
          /*const line = new Konva.Line({
            points: [currentNodeX, currentNodeY, nextNodeX, nextNodeY],
            stroke: 'black',
            strokeWidth: 2,
          });*/
  /*
          this.layer.add(line);
          this.stage.draw();
  
          this.connections.push(line);
          this.currentNodeIndex++;
  
          // Verificar si se completó la secuencia
          if (this.currentNodeIndex === this.nodes.length - 1) {
            this.finishTest();
          }
        }
      },
      finishTest() {
        // Comprobar si la secuencia de conexiones es correcta
        const expectedSequence = ["1A", "2B", "3C", "4D", "5E"];
        const drawnSequence = this.connections.map(line => {
          const nodes = line.points();
          const startNode = this.getNodeAt(nodes[0], nodes[1]);
          const endNode = this.getNodeAt(nodes[2], nodes[3]);
          return startNode + endNode;
        });
  
        const isCorrect = JSON.stringify(drawnSequence) === JSON.stringify(expectedSequence);
        console.log("Test de Alternancia Conceptual finalizado");
        console.log("Secuencia dibujada:", drawnSequence);
        console.log("Puntuación:", isCorrect ? 1 : 0);
      },
      getNodeAt(x, y) {
        // Encontrar el nodo en las coordenadas proporcionadas
        const nodeIndex = this.nodePositions.findIndex(position => position.x === x && position.y === y);
        return this.nodes[nodeIndex];
      },
    },
  };
*/
</script>
  
  <style scoped>
  /* Estilos personalizados para el componente */
  </style>
  