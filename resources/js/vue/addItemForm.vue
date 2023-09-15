<template>
    <div class="addItem">
        <input type="text" v-model="item.name" placeholder="Add new task here..." />
        <button class="addBtn" name="+"
        @click="addItem()"
        :class="[ item.name ? 'active' : 'inactive', 'plus']"
        >+</button>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            item: {
                name: ""
            },
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
                scales: {
                    y: {
                        type: 'linear', // Explicitly specify Y-axis as linear scale
                        beginAtZero: true, // Start Y-axis at 0
                        ticks: {
                            stepSize: 0.5, // Set the step size to 0.5
                        },
                    },
                }
            },
        }
    },
    methods: {
        addItem() {
            if(this.item.name == "") {
                return;
            }

            axios.post('api/item/store', {
                item: this.item
            })
            .then(response => {
                if(response.status == 201) {
                    this.item.name = "";
                    this.$emit('reloadlist')
                    this.fetchSummaryData()
                }
            })
            .catch(error => {
                console.log(error);
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
.addItem {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    width: 100%;
    max-width: 480px;
    z-index: 98;
    bottom: 0;
    overflow: hidden;
    position: fixed;
    background-color: #fff;
    transition: all .5s ease;
    box-shadow: 0 -3px 10px 0 rgba(181,195,224,.55);
}

input {
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 85%;
    color: #1253a4;
}

button {
    cursor: pointer;
}

.plus {
    font-size: 20px;
    border: none;
}

.active {
    background-color: green;
    color: white;
}

.inactive {
    background: #f0f0f0;
    color: white;
}
</style>