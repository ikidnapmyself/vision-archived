<template>
    <b-img :src="user.avatar_url"
           :alt="user.name + ' ' + user.surname"
           :title="user.name + ' ' + user.surname">
    </b-img>
</template>
<script>
    export default {
        props: ['user'],
        data: function() {
            return {
            }
        },
        mounted() {

        }
    }
</script>
