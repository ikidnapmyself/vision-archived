<template>
    <div>
        <b-jumbotron :lead="$t('friend.no-blocked.lead')" class="m-0" v-if="friends.length === 0">
            <template v-slot:header>
                <i class="fa fa-user-slash"></i>
                {{ $t('friend.no-blocked.header') }}
            </template>
            <p>
                {{ $t('friend.no-blocked.body') }}
            </p>
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
                this.$axios.get('friendship/' + this.user + '/blocked')
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
