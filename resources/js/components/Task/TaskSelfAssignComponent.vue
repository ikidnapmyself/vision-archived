<template>
    <div ref="self-assign">
        <div class="bg-dark d-flex align-items-center p-3 mb-3 text-white-50 bg-purple rounded shadow-sm">
            <img class="mr-3" :src="user.avatar_url" :alt="user.full_name" width="48" height="48">
            <div class="lh-100">
                <h6 class="mb-0 text-white lh-100">{{ user.full_name }}</h6>
                <b-link v-on:click="showModal('bv-assignee-modal')" size="sm" variant="dark">
                    <i class="fa fa-user-plus"></i>
                    {{ $t('components.task.assignees.Assign Yourself') }}
                </b-link>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['assignees'],
        data: function () {
            return {
                auth: this.$Application.auth,
                user: this.$Application.user,
            }
        },
        mounted() {
            //
        },
        methods: {
            showModal() {
                this.$refs[ref].show()
            },
        }
    }
</script>
