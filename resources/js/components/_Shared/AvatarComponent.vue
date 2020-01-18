<template>
    <span>
        <vue-letter-avatar :name="user.full_name" :size="resize" :rounded="true" :id="'letter-avatar-popover-' + id">
        </vue-letter-avatar>
        <b-popover triggers="hover" :target="'letter-avatar-popover-' + id" :title="user.full_name">
            <b-list-group horizontal>
                <b-list-group-item>
                    <b-link :href="user.url">
                        <i class="fa fa-user"></i>
                    </b-link>
                </b-list-group-item>
                <b-list-group-item>
                    <b-link :href="'mailto:' + user.email">
                        <i class="fa fa-envelope"></i>
                    </b-link>
                </b-list-group-item>
            </b-list-group>
        </b-popover>
    </span>
</template>
<script>
    export default {
        props: ['size', 'user'],
        data: function() {
            return {
                id: this.user.id + '-' + this.random(5),
                resize: '32',
            }
        },
        mounted() {
            if(typeof this.size !== 'undefined')
                this.resize = this.size
        },
        methods: {
            random(length) {
                var result           = '';
                var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var charactersLength = characters.length;
                for ( var i = 0; i < length; i++ ) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                return result;
            }
        }
    }
</script>
