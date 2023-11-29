<template>
    <div class="flex flex-col items-center justify-center h-screen">
        <h1 class="text-4xl font-bold mb-4">Ha finalizado el test!</h1>
        <p class="text-lg text-center mb-4">¡Felicitaciones! Ha completado el test en su totalidad, el Doctor calificará posteriormente las imágenes enviadas.</p>
        <div class="circle">
            <i class="fas fa-check text-green-500 text-8xl animate-pulse"></i>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="128px" height="128px" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g><path style="opacity:0.982" fill="#a4ea77" d="M 121.5,29.5 C 96.0347,54.4651 70.7013,79.6318 45.5,105C 43.5681,106.459 41.5681,107.625 39.5,108.5C 38.7611,108.631 38.0944,108.464 37.5,108C 24.9652,95.298 12.2985,82.798 -0.5,70.5C -0.5,69.5 -0.5,68.5 -0.5,67.5C 6.13149,61.3694 12.6315,55.036 19,48.5C 27.5,57 36,65.5 44.5,74C 46.1667,74.6667 47.8333,74.6667 49.5,74C 69,54.5 88.5,35 108,15.5C 112.703,20.0355 117.203,24.7021 121.5,29.5 Z"/></g>
                <g><path style="opacity:0.986" fill="#95d36c" d="M 121.5,29.5 C 123.5,31.1667 125.5,32.8333 127.5,34.5C 127.5,35.5 127.5,36.5 127.5,37.5C 103.701,60.7984 80.0347,84.2984 56.5,108C 50.7759,112.27 45.1093,112.436 39.5,108.5C 41.5681,107.625 43.5681,106.459 45.5,105C 70.7013,79.6318 96.0347,54.4651 121.5,29.5 Z"/></g>
                </svg>
            </div>

        </div>
    </div>
</template>


<style scoped>
.circle {
    width: 200px;
    height: 200px;
    border-radius: 50%; 
    background-color: white; /* Change the background color here */
    border: 2px solid rgb(144, 219, 114); /* Add border color here */
    display: flex;
    align-items: center;
    justify-content: center;
}

.circle i {
    animation: pulse 1s infinite;
    color: rgb(92, 190, 92); /* Change the color of the check logo here */
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.2);
    }
    100% {
        transform: scale(1);
    }
}
</style>