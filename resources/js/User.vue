<template>
    <h2>User</h2>
    <ul>
        <li><strong>ID:</strong> {{user.id}}</li>
        <li><strong>Name:</strong> {{user.name}}</li>
        <li><strong>Email:</strong> {{user.email}}</li>
        <li><strong>Phone number:</strong> {{user.phone_number}}</li>
        <li><strong>Subscribed:</strong>
            <ul>
                <li v-for="cat in user.categories">
                    {{cat.name}}
                </li>
            </ul>
        </li>
        <li><strong>Channels:</strong>
            <ul>
                <li v-for="chn in user.channels">
                    {{chn.name}}
                </li>
            </ul>
        </li>

    </ul>
    <h2>Notification</h2>
    <form @submit="sendForm">
        <label for="">Category</label>
        <br>
        <select v-model="notification.category_id" required>
            <option v-for="c in user.categories"
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
        <div v-for="c in user.channels">
            <input type="radio"
                   v-model="notification.channel_id"
                   name="channel_id"
                   :key="c.id"
                   :value="c.id"
                   required> {{c.name}}
        </div>
        <br>
        <input type="submit" value="Send">
    </form>
    <Log v-bind:messages="user.messages"/>
</template>

<script>
import Log from "./Log.vue";
export default {
    components: {Log},
    data(){
        return {
            userId: 0,
            controller: 'http://127.0.0.1:8000/api/user/' + window.userId ,
            user: [],
            notification: {
                category_id: '',
                channel_id: '',
                message: ''
            }
        };
    },
    methods: {
        sendForm(e){
            //e.preventDefault();
            const formData = new FormData();
            formData.append('message', this.notification.message);
            formData.append('channel_id', this.notification.channel_id);
            formData.append('category_id', this.notification.category_id);
            formData.append('user_id', this.user.id);
            this.sendNotification(formData)
        },
        sendNotification(formData){
            let url = 'http://127.0.0.1:8000/api/notification/' + formData.get('channel_id');
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
            .then((res) => this.user = res.data);
    }
}

</script>
