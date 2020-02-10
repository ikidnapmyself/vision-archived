<template>
    <div>
        <b-jumbotron :lead="$t('friend.no-pending.lead')" class="m-0" v-if="friends.length === 0">
            <template v-slot:header>
                <i class="fa fa-user-clock"></i>
                {{ $t('friend.no-pending.header') }}
            </template>
            <p>
                {{ $t('friend.no-pending.body') }}
            </p>
            <b-button variant="success" href="#">
                <i class="fa fa-user-plus"></i>
                {{ $t('friend.no-pending.invite') }}
            </b-button>
            <b-button variant="primary" href="#">
                <i class="fa fa-search"></i>
                {{ $t('friend.no-pending.find') }}
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
                this.$axios.get('friendship/' + this.user + '/pending')
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
