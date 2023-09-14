<template>
    <div>
        <div v-for="(item, index) in items" :key="index">
            <list-item
                :item="item"
                class="item"
                v-on:itemchanged="$emit('reloadlist')"
                v-on:changetosummary="$emit('reloadsummary')"
            />
        </div>
    </div>
</template>

<script>
import listItem from './listItem.vue'

export default {
    props: ['items'],
    components: {
        listItem
    }
}
</script>

<style scoped>
.item {
    display: flex;
    justify-content: center;
    align-items: center;
    background: #fff;
    box-shadow: 0 1.5px 3px 0 #d8e7fd;
    border-radius: 8px;
    cursor: pointer;
    padding: 10px;
    margin-top: 10px;
    font-family: 'Open Sans', sans-serif;
}
</style>