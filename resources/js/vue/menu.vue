<template>
  <div class="footer-menu">
    <add-item-form 
        v-on:reloadlist="getItemList()"
    />
  </div>
</template>

<script>
import popupForm from './popupForm.vue';

export default {
    components: {
        popupForm
    },
    data() {
        return {
        activeItem: '',
        isProfileModalOpen: false,
        };
    },
    props: ['activeItem'],
    methods: {
        openProfileModal() {
        this.isProfileModalOpen = true;
        },
        closeProfileModal() {
        this.isProfileModalOpen = false;
        },
    },
};
</script>

<style scoped>
/* Gaya CSS untuk footer menu */
.footer-menu {
    background-color: #333;
    color: white;
    padding: 10px 0;
    background-color: #333;
    color: white;
    width: 100%;
    max-width: 480px;
    z-index: 99;
    bottom: 0;
    overflow: hidden;
    position: fixed;
    text-align: center;
    transition: all .5s ease;
}

.menu-item {
    text-align: center;
    text-decoration: none;
    color: white;
    flex: 1;
}

.menu-item.active {
    font-weight: bold;
}
</style>