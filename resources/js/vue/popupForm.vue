<template>
  <div class="modal" v-if="showModal">
    <div class="modal-content">
      <!-- Konten profil di sini -->
      <button @click="closeModal">Tutup</button>
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
/* Gaya CSS untuk modal */
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-content {
  background-color: white;
  padding: 20px;
}
</style>