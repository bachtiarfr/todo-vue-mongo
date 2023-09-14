<template>
    <div class="categories">
        <div class="item" 
            :class="{ active: activeItem === 'My Tasks' }"
            @click="setActiveItem('My Tasks')">My Tasks
        </div>
        <div class="item" 
            :class="{ active: activeItem === 'Summary' }" 
            @click="setActiveItem('Summary')">Summary
        </div>
    </div>
</template>

<script>
export default {
    data() {
    return {
      activeItem: 'My Tasks',
    };
  },
  methods: {
    setActiveItem(itemName) {
      if (this.activeItem === itemName) {
        this.activeItem = '';
      } else {
        this.activeItem = itemName;
        if(itemName = 'Summary') {
            this.$emit('reloadsummary')
        } else {
            this.$emit('reloadlist')
        }
      }
    }
  },
}
</script>

<style scoped>
.categories {
    display: flex;
    column-gap: 10px;
    padding: 10px 5px;
    background: white;
    font-size: 13px;
    font-family: 'Open Sans', sans-serif;
}
.item {
    padding-bottom: 5px;
    cursor: pointer;
}

.active {
    border-bottom: 3px solid blue;
}
</style>