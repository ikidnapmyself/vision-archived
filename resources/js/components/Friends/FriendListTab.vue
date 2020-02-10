<template>
    <div>
        <b-jumbotron :lead="$t('friend.no-friends.lead')" class="m-0" v-if="friends.length === 0">
            <template v-slot:header>
                <i class="fa fa-users"></i>
                {{ $t('friend.no-friends.header') }}
            </template>
            <p>
                {{ $t('friend.no-friends.body') }}
            </p>
            <b-button variant="success" href="#">
                <i class="fa fa-user-plus"></i>
                {{ $t('friend.no-friends.invite') }}
            </b-button>
            <b-button variant="primary" href="#">
                <i class="fa fa-search"></i>
                {{ $t('friend.no-friends.find') }}
            </b-button>
        </b-jumbotron>
        <b-list-group v-else>
            <friend-component
                class="border-0"
                v-for="friend in friends"
                :friend="friend"
                :key="friend.id"
                :user="user"
            >
            </friend-component>
        </b-list-group>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data: () => {
            return {
                friends: [],
            }
        },
        mounted(){
            this.load()
        },
        methods: {
            load() {
                this.$axios.get('friendship/' + this.user + '/friend')
                    .then((response) => {
                        this.friends = response.data;
                    })
                    .catch((error) => {
                        this.connectionErrorRetry++;
                    });
            },
        }
    }
</script>

<style>
    .border-5-left { border-left-width: 5px !important;}
    .border-5-right { border-right-width: 5px !important;}
</style>
