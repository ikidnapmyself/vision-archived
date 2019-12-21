<template>
    <div class="card mb-3">
        <task-card-header-component :task="task"></task-card-header-component>
        <div class="card-body tab-content" :id="'task-' + task.id">
            <div class="tab-pane fade show active" :id="'task-' + task.id + '-overview'" role="tabpanel" :aria-labelledby="'task-' + task.id + '-overview-tab'">
                <task-overview-component :task="task"></task-overview-component>
            </div>
            <div class="tab-pane fade" :id="'task-' + task.id + '-edit'" role="tabpanel" :aria-labelledby="'task-' + task.id + '-edit-tab'">
                <task-tab-edit-component :task="task"></task-tab-edit-component>
            </div>
            <div class="tab-pane fade" :id="'task-' + task.id + '-assign'" role="tabpanel" :aria-labelledby="'task-' + task.id + '-assign-tab'">
                <task-assignees-component :assignees="task.assignees">
                </task-assignees-component>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col col-xs-12">
                    <task-manager-component
                        :model="task"
                        :current="task.status"
                        :statuses="task.availableStatuses">
                    </task-manager-component>
                </div>
                <div class="col col-xs-12 text-right">
                    <task-date-component
                        :task="task"></task-date-component>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['task'],
        data() {
            return {
                //
            }
        },
        mounted() {
            //
        }
    }
</script>
