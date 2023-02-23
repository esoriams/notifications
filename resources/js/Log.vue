<template>
    <div v-if="pagination.total">
    <h2>Log history</h2>
    <table class="table stripped bordered log">
        <thead>
        <tr>
            <th>date</th>
            <th>category</th>
            <th>channel</th>
            <th>user</th>
            <th>message</th>
        </tr>
        </thead>
        <tbody>
        <tr class="log-row" v-for="m in messages" :key="m.id">
            <td>{{m.created_at}}</td>
            <td>{{m.category}}</td>
            <td>{{m.channel}}</td>
            <td>
                <ul>
                    <li>{{m.user.name}}</li>
                    <li>{{m.user.email}}</li>
                    <li>{{m.user.phone_number}}</li>
                </ul>
            </td>
            <td>{{m.message}}</td>
        </tr>
        </tbody>
    </table>
    <ul class="pagination" v-if="pagination.last_page > 1">
        <li v-for="p in pagination.links" v-bind:class="{active: p.active == true}" >
            <a @click="nextPage(p.url)"><span v-html="p.label"></span></a>
        </li>
    </ul>
    </div>
    <div v-else>
        <h2>Notifications not found!</h2>
    </div>
</template>

<script>
export default {
    name: "Log",
    data(){
        return {
            url: '/api/notifications/',
            messages: [],
            pagination: []
        };
    },
    mounted() {
        this.nextPage();
    },
    methods: {
        nextPage(url){
            url = url || this.url;
            fetch( url)
                .then((res) => res.json())
                .then((res) => {
                    this.messages = res.data;
                    this.pagination = res.meta;
                });
        }
    }
}
</script>

