<template>
    <b-card-body>
        <b-card-title>
            {{ $t('components.task.timeline.title') }}
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

                <p class="mb-1">
                </p>

                <small v-if="assignee.date">{{ assignee.date }}</small>
            </b-list-group-item>

            <b-table
                ref="selectableTable"
                :bordered="true"
                selectable
                select-mode="multi"
                :items="items"
                :fields="fields"
                @row-selected="onRowSelected"
                responsive="sm"
                v-if="displayForm"
            >
                <template v-slot:cell(selected)="{ rowSelected }">
                    <template v-if="rowSelected">
                        <span aria-hidden="true">
                            <i class="fa fa-check"></i>
                        </span>
                        <span class="sr-only">Selected</span>
                    </template>
                    <template v-else>
                        <span aria-hidden="true">
                            <i class="fa fa-circle-o"></i>
                        </span>
                        <span class="sr-only">Not selected</span>
                    </template>
                </template>
            </b-table>
        </b-list-group>
    </b-card-body>
</template>
<script>
    export default {
    props: ['assignees'],
        data: function () {
            return {
                auth: this.$Application.auth,
                displayForm: false,
                fields: ['selected', 'name', 'surname', 'email'],
                items: [],
                selected: [],
                user: this.$Application.user,
            }
        },
        mounted() {
            this.newAssignee();
        },
        methods: {
            onRowSelected(items) {
                this.selected = items
            },
            selectAllRows() {
                this.$refs.selectableTable.selectAllRows()
            },
            clearSelected() {
                this.$refs.selectableTable.clearSelected()
            },
            selectThirdRow() {
                // Rows are indexed from 0, so the third row is index 2
                this.$refs.selectableTable.selectRow(2)
            },
            unselectThirdRow() {
                // Rows are indexed from 0, so the third row is index 2
                this.$refs.selectableTable.unselectRow(2)
            },
            async newAssignee() {
                try {
                    this.displayForm = false;
                    const object   = this;
                    const response = await this.$axios.get('friendship/' + this.user.id)
                        .then(function (response) {
                            object.items = response.data;
                            object.toaster('components.task.task-tab-edit.Updated', 'success')
                            object.$root.$emit('task-updated', response);
                        })
                        .catch(function (error) {
                            object.toaster('components.task.task-tab-edit.Failed', 'danger')
                        });
                    this.items = response.data
                } catch (error) {
                    // handle error
                } finally {
                    this.displayForm = true
                }
            },
        }
    }
</script>
