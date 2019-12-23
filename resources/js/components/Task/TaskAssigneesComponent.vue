<template>
    <b-card-body>
        <b-card-title>
            {{ $t('components.task.assignees.title') }}
        </b-card-title>
        <b-list-group>
            <b-list-group-item
                v-for="assignee in assignees"
                v-if="assignee.id"
                v-bind:key="assignee.id"
                href="#"
                :class="'flex-column ' + (assignee.user.id === user.id ? 'border border-info' : '')">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">
                        <img class="mr-3" :src="assignee.user.avatar_url" :alt="assignee.user.full_name" width="32" height="32">
                        {{ assignee.user.full_name }}
                        <i class="fa fa-user" v-if="assignee.user.id === user.id"></i>
                        <i class="fa fa-eye" v-if="assignee.assigned_by === user.id"></i>
                    </h5>
                    <small>
                        {{ assignee.ago }}
                    </small>
                </div>
                <small v-if="assignee.date">{{ assignee.date }}</small>
            </b-list-group-item>
        </b-list-group>
    </b-card-body>
</template>
<script>
    export default {
        props: ['assignees'],
        data: function () {
            return {
                user: this.$Application.user,
            }
        }
    }
</script>
