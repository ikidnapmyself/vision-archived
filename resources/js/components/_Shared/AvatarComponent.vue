<template>
    <b-img :src="user.avatar_url" :alt="user.full_name" rounded="circle" thumbnail></b-img>
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
