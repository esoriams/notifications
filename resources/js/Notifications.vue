<template>
    <h2>Notification</h2>
    <form @submit="sendForm">
        <label for="">Category</label>
        <br>
        <select v-model="notification.category_id" required>
            <option v-for="c in categories"
                    :key="c.id"
                    :value="c.id">
                {{c.name}}
            </option>
        </select>
        <br>
        <label>Message</label>
        <br>
        <textarea v-model="notification.message" required></textarea>
        <br>
        <input type="submit" value="Send">
    </form>
    <Log/>
</template>

<script>
import Log from "./Log.vue";
export default {
    components: {Log},
    data(){
        return {
            controller: '/api/categories',
            categories: [],
            notification: {
                category_id: '',
                message: ''
            }
        };
    },
    methods: {
        sendForm(e){
            //e.preventDefault();
            const formData = new FormData();
            formData.append('message', this.notification.message);
            formData.append('category_id', this.notification.category_id);
            this.sendNotification(formData)
        },
        sendNotification(formData){
            let url = '/api/notification/';
            fetch(url, {
                method: 'POST',
                body: formData
            })
                .then((res) => res.json())
                .then((res) => console.log(res))
        },
    },
    mounted() {
        fetch(this.controller)
            .then((res) => res.json())
            .then((res) => this.categories = res.data);
    }
}
</script>

