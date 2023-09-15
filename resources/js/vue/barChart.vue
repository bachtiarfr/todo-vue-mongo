<template>
  <Bar
    id="my-chart-id"
    v-if="loaded"
    :options="chartOptions"
    :data="chartData"
  />
</template>

<script>

import { Bar  } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
  name: 'BarChart',
  components: { Bar  },
  data() {
    return {
        loaded: false,
        chartData: {
            labels: ['Completed Task', 'Incomplete Task'],
            datasets: [
            {
                data: [],
                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            },
            ],
        },
        chartOptions: {
            responsive: true,
            plugins: {
                title: {
                display: false, // Remove the title
                },
            },
            scales: {
                y: {
                    type: 'linear',
                    beginAtZero: true, 
                    ticks: {
                        stepSize: 0.5,
                    },
                },
            }
        },
        };
    },
    mounted() {
        axios.get('api/item/summary')
        .then((response) => {
            const summaryData = response.data.data;
            const completedItem = summaryData.completed_item.length;
            const incompleteItem = summaryData.incomplete_item.length;

            this.loaded = true
            this.renderChart(completedItem, incompleteItem)
        })
        .catch((error) => {
            console.error('Error fetching data:', error);
        });
    },
    methods: {
        renderChart(completedItem, incompleteItem) {
            this.chartData.datasets[0].data = [completedItem, incompleteItem];
            
            const ctx = document.getElementById('my-chart-id').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: this.chartData,
            });
                
            this.loaded = true
        },
    },
};

</script>