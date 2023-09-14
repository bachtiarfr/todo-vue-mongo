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
            }
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
                }
            })
            .catch(error => {
                console.log(error);
            })
        }
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
    z-index: 99;
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