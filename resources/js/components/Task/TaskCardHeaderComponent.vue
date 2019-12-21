<template>
    <div class="card-header">
        <ul class="nav nav-pills" :id="'task-' + task.id" role="tablist">
            <li class="nav-item" v-b-tooltip.hover :title="$t('components.task.card-header.Overview')">
                <a class="nav-link active"
                   :id="'task-' + task.id + '-overview-tab'"
                   ref="navigationItem"
                   data-toggle="tab"
                   :href="'#task-' + task.id + '-overview'"
                   role="tab"
                   aria-controls="overview"
                   aria-selected="true"
                >
                    <i class="fa fa-asterisk"></i>
                </a>
            </li>
            <li class="nav-item" v-b-tooltip.hover :title="$t('components.task.card-header.Update')">
                <a class="nav-link"
                   :id="'task-' + task.id + '-edit-tab'"
                   ref="navigationItem"
                   data-toggle="tab"
                   :href="'#task-' + task.id + '-edit'"
                   role="tab"
                   aria-controls="edit"
                   aria-selected="false"
                >
                    <i class="fa fa-wrench"></i>
                </a>
            </li>
            <li class="nav-item" v-b-tooltip.hover :title="$t('components.task.card-header.Assignee')">
                <a class="nav-link"
                   :id="'task-' + task.id + '-assign-tab'"
                   ref="navigationItem"
                   data-toggle="tab"
                   :href="'#task-' + task.id + '-assign'"
                   role="tab"
                   aria-controls="assign"
                   aria-selected="false"
                >
                    <i class="fa fa-user"></i>
                </a>
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        props: ['task'],
        data() {
            return {
                auth: this.$Application.auth,
                user: this.$Application.user
            }
        },
        mounted() {
            //
        }
    }
</script>
