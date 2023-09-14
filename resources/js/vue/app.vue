<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">Todo List</h2>
            <span>
                <font-awesome-icon icon="trash" />
                reminder
            </span>
        </div>
        <list-category
            v-on:reloadsummary="getSummaryList()"
            v-on:reloadlist="getItemList()"
         />
        <list-view 
            :items="items"
            v-on:reloadlist="getItemList()"
        />
        <add-item-form 
            v-on:reloadlist="getItemList()"
        />
    </div>
</template>

<script>
import addItemForm from './addItemForm.vue'
import listCategory from './listCategory.vue'
import listView from './listView.vue'
import footerMenu from './menu.vue'

export default {
    components: {
        addItemForm,
        listView,
        listCategory,
        footerMenu
    },
    data: function() {
        return {
            items: []
        }
    },
    methods: {
        getItemList() {
            axios.get('api/items')
            .then(response => {
                console.log(response.data);
                this.items = response.data
            })
            .catch(error => {
                console.log(error);
            })
        },
        getSummaryList() {
            axios.get('api/item/summary')
            .then(response => {
                console.log(response.data);
                this.items = response.data
            })
            .catch(error => {
                console.log(error);
            })
        }
    },
    created() {
        this.getItemList();
    }
}
</script>

<style scoped>
.todoListContainer {
    z-index: 99;
    max-width: 480px;
    width: 480px;
    top: 0;
    left: 0;
    position: fixed;
    background-color: #fff;
    background-color: var(--uiLightPrimary);
    box-shadow: 0 1px 2px rgba(20,20,20,.2);
    left: calc(50vw - 240px)!important;
    box-shadow: var(--token-elevation-container);
}

.heading {
    background: #e6e6e6;
    padding: 10px;
    font-family: 'Open Sans', sans-serif;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

#title {
    text-align: left;
    font-family: 'Open Sans', sans-serif;
    font-size: 20px;
    color: #1253a4;
}
</style>