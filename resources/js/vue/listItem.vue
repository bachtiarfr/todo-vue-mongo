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
export default {
    props: ['item'],
    methods: {
        updateItem() {
            axios.put('api/item/' + this.item._id, {
                item: this.item
            })
            .then(response => {
                if(response.status == 200) {
                    this.$emit('itemchanged');
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
                }
            })
        }
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