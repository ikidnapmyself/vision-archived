<template>
    <b-card no-body class="mb-3">
        <b-tabs card vertical pills end
                active-nav-item-class="font-weight-bold">
            <b-tab  v-b-tooltip.hover :title="$t('components.task.Overview')" active>
                <b-card-text>
                    <task-overview-component :task="task"></task-overview-component>
                </b-card-text>
            </b-tab>
            <b-tab  v-b-tooltip.hover :title="$t('components.task.Update')">
                <b-card-text>
                    <task-tab-edit-component :task="task"></task-tab-edit-component>
                </b-card-text>
            </b-tab>
            <b-tab  v-b-tooltip.hover :title="$t('components.task.Assignees')">
                <b-card-text>
                    <task-assignees-component :assignees="task.assignees"></task-assignees-component>
                </b-card-text>
            </b-tab>
            <b-tab v-b-tooltip.hover :title="$t('components.task.Assign')" lazy>
                <b-card-text>
                    <task-assign-component></task-assign-component>
                </b-card-text>
            </b-tab>
        </b-tabs>
        <b-card-footer>
            <div class="row">
                <div class="col col-xs-12">
                    <task-manager-component :model="task" :current="task.status" :statuses="task.availableStatuses"></task-manager-component>
                </div>
                <div class="col col-xs-12 text-right">
                    <task-date-component :task="task"></task-date-component>
                </div>
            </div>
        </b-card-footer>
    </b-card>
</template>
<script>
    export default {
        props: ['task']
    }
</script>
