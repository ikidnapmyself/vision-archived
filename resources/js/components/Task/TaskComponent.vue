<template>
    <div>
        <b-navbar type="light" variant="muted">
            <b-navbar-brand class="d-xs-none d-md-inline" :href="task.created_by.url">
                <avatar-component :user="task.created_by"></avatar-component>
            </b-navbar-brand>
            <b-navbar-nav>
                <b-nav-item @click="toggleFlag">
                    <i class="fa fa-flag" :class="'text-' + (model.flagged ? 'danger' : 'secondary')"></i>
                </b-nav-item>
                <b-nav-item :href="model.url">
                    <i class="fa fa-link"></i>
                </b-nav-item>
                <b-nav-item v-b-toggle="'collapse-' + model.id" variant="muted">
                    <span class="when-opened">
                        <i class="fa fa-toggle-on"></i>
                    </span>
                    <span class="when-closed">
                        <i class="fa fa-toggle-off"></i>
                    </span>
                    <span>
                        <b-badge v-if="isNew()">{{ $t('components.task.New') }}</b-badge>
                        {{ model.name }}
                    </span>
                </b-nav-item>
            </b-navbar-nav>
            <b-collapse is-nav>
                <b-navbar-nav class="ml-auto">
                    <b-nav-item :class="'mr-2 ' + assignedToMe ? 'text-success' : ''" variant="muted" right v-if="assignees.length > 0" @click="showAssigneesTab">
                        <b>{{ assignees.length }}</b>
                        <i :class="'fa fa-' + (assignees.length < 2 ? 'user' : 'users')"></i>
                    </b-nav-item>
                    <b-nav-item :class="'mr-2 ' + assignedToMe ? 'text-success' : ''" variant="muted" right v-else-if="assignees.length === 0" @click="showAssigneesTab">
                        <i class="fa fa-user-plus"></i>
                    </b-nav-item>
                    <b-nav-text v-b-tooltip.hover variant="muted" v-if="reason" :title="reason" right>
                        <i class="fa fa-info-circle"></i>
                    </b-nav-text>
                    <b-nav-item-dropdown  v-b-tooltip.hover variant="muted" :title="$t('status.' + status)" right>
                        <template v-slot:button-content>
                            <i :class="icons[status] + ' text-' + colors[status]"></i>
                        </template>
                        <b class="px-3">{{ $t('components.task.statuses.Move to') }}</b>
                        <b-dropdown-divider></b-dropdown-divider>
                        <b-dropdown-item :variant="colors[item]" v-for="item in task.available_statuses" v-bind:key="item" @click="setStatus(item)">
                            <i :class="icons[item]"></i>
                            {{ $t('status.' + item) }}
                        </b-dropdown-item>
                    </b-nav-item-dropdown>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>

        <b-modal ref="bv-status-reason-modal"
                 @hidden="resetModal"
                 @ok="handleOk">
            <template v-slot:modal-title>
                {{ $t('components.task.statuses.Add Your Reason', {From: status, New: newStatus}) }}
            </template>
            <div class="d-block text-center">
                <form ref="form" @submit.stop.prevent="handleSubmit">
                    <b-form-group
                        :label="$t('components.task.statuses.Reason')"
                        label-for="reason-input"
                    >
                        <b-form-input
                            id="reason-input"
                            v-model="newReason"
                            required
                        ></b-form-input>
                    </b-form-group>
                </form>
            </div>
        </b-modal>
        <b-collapse
            :id="'collapse-' + task.id"
            :class="'mt-2 border-top border-' + colors[status]"
            :visible="!collapsed"
        >
            <b-card no-body class="mb-0 border-0">
                <b-tabs v-model="tabIndex" small pills card>
                    <b-tab :title-link-class="linkClass(0)">
                        <template v-slot:title>
                            <span class="d-md-none d-lg-inline">
                                <i class="fa fa-asterisk"></i>
                            </span>
                            <span class="d-none d-md-inline">
                                {{ $t('components.task.Overview') }}
                            </span>
                        </template>
                        <b-card-text>
                            <task-overview-component :task="task"></task-overview-component>
                        </b-card-text>
                    </b-tab>
                    <b-tab :title-link-class="linkClass(1)">
                        <template v-slot:title>
                            <span class="d-md-none d-lg-inline">
                                <i class="fa fa-wrench"></i>
                            </span>
                            <span class="d-none d-md-inline">
                                {{ $t('components.task.Update') }}
                            </span>
                        </template>
                        <b-card-text>
                            <task-update-component :task="task"></task-update-component>
                        </b-card-text>
                    </b-tab>
                    <b-tab :title-link-class="linkClass(2)" lazy>
                        <template v-slot:title>
                            <span class="d-md-none d-lg-inline">
                                <i :class="'fa fa-' + (assignees.length < 2 ? 'user' : 'users')"></i>
                            </span>
                            <span class="d-none d-md-inline">
                                {{ $t('components.task.Assignees') }}
                            </span>
                            <b-badge variant="light" v-if="assignees.length">
                                {{ assignees.length }}
                                <span class="sr-only">{{ $t('components.task.Assignees') }}</span>
                            </b-badge>
                        </template>
                        <b-card-text>
                            <task-assignees-component :task="task"></task-assignees-component>
                        </b-card-text>
                    </b-tab>
                    <b-tab :title-link-class="linkClass(3)" lazy>
                        <template v-slot:title>
                            <span class="d-md-none d-lg-inline">
                                <i class="fa fa-history"></i>
                            </span>
                            <span class="d-none d-md-inline">
                                {{ $t('components.task.Timeline') }}
                            </span>
                        </template>
                    </b-tab>
                    <b-tab :title-link-class="linkClass(4)">
                        <template v-slot:title>
                            <span class="d-md-none d-lg-inline">
                                <i class="fa fa-share-alt"></i>
                            </span>
                            <span class="d-none d-md-inline">
                                {{ $t('components.task.Share') }}
                            </span>
                        </template>
                    </b-tab>
                </b-tabs>
                <b-card-footer>
                    <div class="text-right">
                        <task-date-component :task="task"></task-date-component>
                    </div>
                </b-card-footer>
            </b-card>
        </b-collapse>
    </div>
</template>
<script>
    import Moment from 'moment';
    export default {
        props: ['collapse', 'task'],
        data: function() {
            return {
                assignees: this.task.assignees,
                collapsed: this.collapse,
                colors: this.$Application.statuses.colors,
                flagged: this.task.flagged,
                icons: this.$Application.statuses.icons,
                model: this.task,
                newReason: null,
                newStatus: null,
                reason: this.task.current_status.reason,
                relation: {
                    reportedByMe: false,
                    assignedToMe: false,
                },
                status: this.task.current_status.name,
                tabIndex: 0,
                user: this.$Application.user,
            }
        },
        mounted() {
            this.events();
        },
        methods: {
            handleOk(bvModalEvt) {
                // Prevent modal from closing
                bvModalEvt.preventDefault()
                // Trigger submit handler
                this.handleSubmit()
            },
            handleSubmit() {
                this.$nextTick(() => {
                    this.$axios.put('/task/' + this.task.id + '/status/' + this.newStatus, {reason: this.newReason})
                        .then((response) => {
                            this.model = response.data;
                            this.$root.$emit('task-' + this.model.id, this.model);
                            this.toaster('components.task.statuses.Updated', 'success')
                            this.hideModal();
                            this.reason = this.newReason;
                            this.status = this.newStatus;
                        })
                        .catch(function (error) {
                            this.toaster('components.task.statuses.Failed', 'danger');
                        });
                })
            },
            hideModal() {
                this.$refs['bv-status-reason-modal'].hide()
            },
            isNew() {
                let created_at = Moment(this.model.created_at);
                return Math.abs(created_at.diff(Moment.now(), 'h')) < 5;
            },
            linkClass(idx) {
                let bg = this.colors[this.status];
                let text = this.colors[this.status];

                if(this.tabIndex === idx)
                {
                    if(bg === 'warning')
                        text = 'dark';
                    else
                        text = 'light';
                } else {
                    if(text === 'warning')
                        text = 'dark';
                }

                if (this.tabIndex === idx) {
                    return ['bg-' + bg, 'text-' + text]
                } else {
                    return ['bg-light', 'text-' + text]
                }
            },
            events() {
                this.$root.$on('task-' + this.task.id, (response) => {
                    this.model = response;
                    this.status = response.current_status.name
                });
                this.$root.$on('unassigned-' + this.task.id, (assignee) => {
                    for(var i = this.assignees.length - 1; i >= 0; i--) {
                        if(this.assignees[i].id === assignee.id) {
                            this.assignees.splice(i, 1);
                        }
                    }

                });
                this.$root.$on('assigned-' + this.task.id, (assignee) => {
                    this.assignees.push(assignee);
                });
            },
            resetModal() {
                this.newStatus = ''
            },
            setStatus: function (status) {
                this.newStatus = status;
                this.showModal();
            },
            showAssigneesTab() {
                this.collapsed = false;
                this.tabIndex = 2;
            },
            showModal() {
                this.$refs['bv-status-reason-modal'].show()
            },
            toaster(message, variant = null, vars = null, title = null) {
                this.$bvToast.toast(this.$t(message, vars), {
                    title: this.$t(`components.toaster.${variant || 'default'}`),
                    variant: variant,
                    solid: true
                })
            },
            toggleFlag: function () {
                this.$axios.put('/task/' + this.task.id, {flagged: !this.model.flagged})
                    .then((response) => {
                        this.model = response.data;
                        let message = this.model.flagged ? 'components.task.No Flag' : 'components.task.Flagged';
                        this.$root.$emit('task-' + this.model.id, this.model);
                        this.toaster(message, 'info', {
                            task_name: this.model.name
                        });
                    })
                    .catch((error) => {
                        this.toaster('components.task.Flag Failed', 'danger');
                    });
            },
        }
    }
</script>
<style>
    .collapsed > .nav-link > .when-opened,
    :not(.collapsed) > .nav-link > .when-closed {
        display: none;
    }
</style>
