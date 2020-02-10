<template>
    <div>
        <b-tabs class="border border-muted bg-light" v-model="tabIndex" pills card>
            <b-tab class="p-0" lazy>
                <template v-slot:title>
                    <span class="d-md-none d-lg-inline">
                        <i :class="'fa fa-' + (friends < 2 ? 'user' : 'users')"></i>
                    </span>
                    <span class="d-none d-md-inline">
                        {{ $t('friend.tabs.Friends') }}
                    </span>
                </template>
                <b-card-text>
                    <friend-list-tab :user="user"></friend-list-tab>
                </b-card-text>
            </b-tab>
            <b-tab class="p-0">
                <template v-slot:title>
                    <span class="d-md-none d-lg-inline">
                        <i class="fa fa-user-clock"></i>
                    </span>
                    <span class="d-none d-md-inline">
                        {{ $t('friend.tabs.Pending') }}
                    </span>
                    <b-badge variant="light">
                        {{ pending }}
                        <span class="sr-only">{{ $t('friend.tabs.Pending') }}</span>
                    </b-badge>
                </template>
                <b-card-text>
                    <friend-pending-tab :user="user"></friend-pending-tab>
                </b-card-text>
            </b-tab>
            <b-tab class="p-0" lazy>
                <template v-slot:title>
                    <span class="d-md-none d-lg-inline">
                        <i class="fa fa-user-slash"></i>
                    </span>
                    <span class="d-none d-md-inline">
                        {{ $t('friend.tabs.Blocked') }}
                    </span>
                </template>
                <b-card-text>
                    <friend-blocked-tab :user="user"></friend-blocked-tab>
                </b-card-text>
            </b-tab>
        </b-tabs>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data: () => {
            return {
                blocked: 0,
                connectionErrorRetry: 0,
                friends: 0,
                pending: 0,
                tabIndex: 0,
            }
        },
        mounted(){
            //
        },
        methods: {
            //
        }
    }
</script>
