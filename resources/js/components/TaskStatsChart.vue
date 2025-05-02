<script setup lang="ts">
import { onMounted, onBeforeUnmount, ref, watch } from 'vue'
import { Chart, registerables } from 'chart.js'


Chart.register(...registerables)

const props = defineProps({
    stats: {
        type: Object,
        required: true
    }
})

const chartCanvas = ref<HTMLCanvasElement | null>(null)
let chartInstance: Chart | null = null

function getChartData() {
    const pending = props.stats?.pending ?? 0
    const completed = props.stats?.completed ?? 0
    return {
        labels: ['Pendentes', 'Concluídas'],
        datasets: [{
            data: [pending, completed],
            backgroundColor: ['#facc15', '#4ade80']
        }]
    }
}

function renderChart() {
    if (!chartCanvas.value) {
        console.warn('Canvas ainda não está disponível')
        return
    }

    if (chartInstance) {
        chartInstance.destroy()
    }

    const ctx = chartCanvas.value.getContext('2d')
    if (!ctx) {
        console.error('Não foi possível obter contexto 2D do canvas')
        return
    }

    chartInstance = new Chart(ctx, {
        type: 'pie',
        data: getChartData(),
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    })
}

onMounted(() => {
    console.log('Chart loaded, stats:', props.stats)
    renderChart()
})

watch(() => props.stats, () => {
    renderChart()
})

onBeforeUnmount(() => {
    if (chartInstance) {
        chartInstance.destroy()
    }
})
</script>

<template>
    <div class="p-4">
        <h2 class="text-lg font-semibold mb-2">Estatísticas das Tarefas</h2>
        <canvas ref="chartCanvas" class="w-full h-full"></canvas>
    </div>
</template>
