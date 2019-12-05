<template>
    <img :src="user.avatar_url"
         :alt="user.name + ' ' + user.surname"
         :title="user.name + ' ' + user.surname"
         class="rounded-sm" style="max-height: 20px;">

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
