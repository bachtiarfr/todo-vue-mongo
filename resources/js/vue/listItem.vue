<template>
    <div class="item">
        <input 
            type="checkbox" 
            @change="updateItem()"
            v-model="item.completed"
        />
        <span :class="[item.completed ? 'completed' : '', 'item-text']">{{ item.name }}</span>
        <button @click="removeItem()" class="remove-btn">x</button>
    </div>
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
    props: ['item'],
    methods: {
        updateItem() {
            axios.put('api/item/' + this.item._id, {
                item: this.item
            })
            .then(response => {
                if(response.status == 200) {
                    this.$emit('itemchanged');
                    this.fetchSummaryData()
                }
            })
            .catch(error => {
                console.log(error);
            })
        },
        removeItem() {
            axios.delete('api/item/' + this.item._id)
            .then(response => {
                if(response.status == 200) {
                    this.$emit('itemchanged');
                    this.fetchSummaryData()
                }
            })
        },
        fetchSummaryData() {
           axios.get('api/item/summary')
            .then((response) => {
                const summaryData = response.data.data;
                const completedItem = summaryData.completed_item.length;
                const incompleteItem = summaryData.incomplete_item.length;

                this.chartData.datasets[0].data = [completedItem, incompleteItem];
                this.loaded = true
                this.renderChart(completedItem, incompleteItem)
            })
            .catch((error) => {
                console.error('Error fetching data:', error);
            });
        },
        renderChart(completedItem, incompleteItem) {
            this.chartData.datasets[0].data = [completedItem, incompleteItem];
            
            const ctx = document.getElementById('my-chart-id').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: this.chartData,
            });
                
            this.loaded = true
        },
    }
}
</script>

<style scoped>
.completed {
    text-decoration: line-through;
    color: grey;
}
.item-text {
    width: 100%;
    margin-left: 20px;
}
.item {
    display: flex;
    justify-content: center;
    align-items: center;
    background: #fff;
    box-shadow: 0 1.5px 3px 0 #d8e7fd;
    border-radius: 8px;
    cursor: pointer;
    padding: 10px;
}
.remove-btn {
    background: transparent;
    border: none;
    color: grey;
    outline: none;
    border-radius: 2px;
    cursor: pointer;
}
.remove-btn:hover {
    background: #d8e7fd;
    color: white;
}
</style>