<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">Todo List</h2>
            <span @click="showEmailPopup" class="reminder-btn">
                <font-awesome-icon icon="trash" />
                reminder
            </span>
        </div>

        <!-- Modal Email -->
        <div v-if="showPopup" class="modal">
        <div class="modal-content">
            <!-- Konten dalam popup, termasuk input email -->
            <input v-model="email" type="email" placeholder="Masukkan Email">
            <button @click="sendReminderEmail">Simpan</button>
            <span @click="closePopup">x</span>
        </div>
        </div>
        <list-category
            v-on:reloadsummary="getSummaryList()"
            v-on:reloadlist="getItemList()"
        />
        <list-view 
            :items="items"
            v-on:reloadlist="getItemList()"
        />
        <BarChart />
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
import BarChart from './barChart'

export default {
    components: {
        addItemForm,
        listView,
        listCategory,
        footerMenu,
        BarChart 
    },
    data: function() {
        return {
            showPopup: false,
            email: "",
            items: [],
            summary: [],
            completed_item: [],
            incomplete_item: [],
            summaryData: null,
        }
    },
    methods: {
        getItemList() {
            axios.get('api/items')
            .then(response => {
                console.log(response.data.data);
                this.items = response.data.data
            })
            .catch(error => {
                console.log(error);
            })
        },
        getSummaryList() {
            axios.get('api/item/summary')
            .then(response => {
                console.log(response.data.data);
                this.summary = response.data.data
            })
            .catch(error => {
                console.log(error);
            })
        },
        showEmailPopup() {
            this.showPopup = true;
        },
        closePopup() {
            this.showPopup = false;
            this.email = "";
        },
        sendReminderEmail() {
            axios.post('api/reminder', { email: this.email })
            .then(response => {
                console.log(response.data.message);
                this.closePopup();
            })
            .catch(error => {
                console.error(error);
            });
        },
    },
    created() {
        this.getItemList();
    }
}
</script>

<style scoped>

.reminder-btn {
    cursor: pointer;
}

.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 99;
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  position: relative;
  width: 300px;
}
.modal-content input {
    width: 75%;
}

.modal-content span {
    position: absolute;
    top: 0;
    cursor: pointer;
}

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