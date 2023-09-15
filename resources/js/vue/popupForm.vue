<template>
  <div id="popup" class="popup" v-if="popupVisible">
    <div class="popup-content">
        <h2>Completed Items</h2>
        <ul>
            <li v-for="item in data.completed_item" :key="item._id">{{ item.name }}</li>
        </ul>
        <h2>Incomplete Items</h2>
        <ul>
            <li v-for="item in data.incomplete_item" :key="item._id">{{ item.name }}</li>
        </ul>
        <button @click="closePopup">Close</button>
    </div>
</div>
</template>

<script>
export default {
  props: ['showModal'],
  methods: {
    closeModal() {
      this.$emit('close'); // Memancarkan event untuk menutup modal
    },
  },
};
</script>

<style scoped>

</style>