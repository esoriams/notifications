<template>
        <h2>Log history</h2>
        <ul>
            <li class="log-row" v-for="m in messages" :key="m.id">
                <div class="date">{{m.created_at}} </div><div class="message"> {{m.message}}</div>
            </li>
        </ul>
</template>

<script>
export default {
    name: "Log",
    props: ['messages']
}
</script>

