<script setup lang="ts">
import { computed, onMounted, onBeforeUnmount, ref, watch } from 'vue'
import { useI18n } from 'vue-i18n'
import { Chart, registerables } from 'chart.js'

Chart.register(...registerables)

const props = defineProps({
    stats: {
        type: Object,
        required: true
    }
})

const { t } = useI18n()

const chartCanvas = ref<HTMLCanvasElement | null>(null)
let chartInstance: Chart | null = null

const chartData = computed(() => {
    const pending = props.stats?.pending ?? 0
    const completed = props.stats?.completed ?? 0

    return {
        labels: [t('chart.labels.pending'), t('chart.labels.completed')],
        datasets: [{
            data: [pending, completed],
            backgroundColor: ['#facc15', '#4ade80']
        }]
    }
})


function renderChart() {
    if (!chartCanvas.value) return

    if (chartInstance) chartInstance.destroy()

    const ctx = chartCanvas.value.getContext('2d')
    if (!ctx) return

    chartInstance = new Chart(ctx, {
        type: 'pie',
        data: chartData.value,
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

watch(() => props.stats, renderChart)
watch(() => t('chart.labels.pending'), renderChart) //força update quando muda idioma
</script>

<template>
    <div class="p-4">
        <h2 class="text-lg font-semibold mb-2">{{ t('chart.title') }}</h2>
        <canvas ref="chartCanvas" class="w-full h-full"></canvas>
    </div>
</template>
