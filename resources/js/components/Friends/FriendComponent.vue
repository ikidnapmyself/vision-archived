<template>
    <b-list-group-item
        class="flex-column align-items-start"
    >
        <div class="d-flex w-100 justify-content-between">
            <h5>
                <span v-if="current">
                    <avatar-component :user="current"></avatar-component>
                </span>
                <b-link :href="url">
                    {{ name }}
                </b-link>
            </h5>
            <small>
                <b-dropdown
                    no-caret
                    right
                    variant="light"
                >
                    <template v-slot:button-content>
                        <i class="fa fa-ellipsis-h"></i>
                    </template>
                    <b-dropdown-item :href="url">
                        <i class="fa fa-user-tag"></i>
                        {{ $t('friend.actions.Profile') }}
                    </b-dropdown-item>
                    <b-dropdown-item href="#">
                        <i class="fa fa-user-times"></i>
                        {{ $t('friend.actions.Unfriend') }}
                    </b-dropdown-item>
                    <b-dropdown-item href="#" variant="danger">
                        <i class="fa fa-user-slash"></i>
                        {{ $t('friend.actions.Block') }}
                    </b-dropdown-item>
                </b-dropdown>
            </small>
        </div>

        <p class="mb-1">
            Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
        </p>

        <small>
            <date-time-component :date="friend.updated_at"></date-time-component>
        </small>
    </b-list-group-item>
</template>

<script>
    export default {
        props: ['friend', 'user'],
        data: () => {
            return {
                current: false,
                name: '',
                url: '',
            }
        },
        mounted(){
            if(this.friend.recipient_id === this.user)
                this.current = this.friend.sender;
            else
                this.current = this.friend.recipient;

            if(this.current)
            {
                this.name = this.current.full_name;
                this.url = this.current.url;
            }
        },
        methods: {
            //
        }
    }
</script>

<style scoped>
    .border-5-left { border-left-width: 5px !important;}
    .border-5-right { border-right-width: 5px !important;}
</style>

