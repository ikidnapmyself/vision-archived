<template>
    <div>
        <div class="d-md-block d-lg-none">
            <b-navbar toggleable="lg" type="dark">

                <b-navbar-nav>
                    <b-nav-item @click="toggleFlag">
                        <i class="fa fa-flag" :class="'text-' + (flagged ? 'danger' : 'secondary')"></i>
                    </b-nav-item>
                    <b-nav-item :href="task.url">
                        <i class="fa fa-link"></i>
                    </b-nav-item>
                    <b-nav-item v-b-toggle="'collapse-' + task.id" variant="muted" v-if="true === collapse">
                        <span class="when-opened">
                            <i class="fa fa-toggle-on"></i>
                        </span>
                        <span class="when-closed">
                            <i class="fa fa-toggle-off"></i>
                        </span>
                        <span class="d-none d-lg-inline">
                            <b-badge>New</b-badge>
                            {{ taskName }}
                        </span>
                    </b-nav-item>
                    <b-nav-text variant="muted" v-if="collapse !== true">
                        {{ taskName }}
                    </b-nav-text>
                </b-navbar-nav>
                <b-collapse is-nav>
                    <b-navbar-nav class="ml-auto">
                        <b-nav-item class="mr-2" variant="muted" right v-if="assigneesNum > 0" @click="showAssigneesTab">
                            <b>{{ assigneesNum }}</b>
                            <i :class="'fa fa-' + (assigneesNum < 2 ? 'user' : 'users')"></i>
                        </b-nav-item>
                        <b-nav-item class="mr-2" variant="muted" right v-else-if="assigneesNum === 0">
                            <i class="fa fa-user-plus"></i>
                        </b-nav-item>
                        <b-nav-text v-b-tooltip.hover variant="muted" v-if="reason" :title="reason" right>
                            <i class="fa fa-info-circle"></i>
                        </b-nav-text>
                        <b-nav-item-dropdown  v-b-tooltip.hover variant="muted"  right>
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
        </div>
        <div class="d-md-none d-lg-block">
            <b-navbar toggleable="lg" type="light" variant="muted">
                <b-navbar-brand :href="task.created_by.url">
                    <avatar-component :user="task.created_by"></avatar-component>
                </b-navbar-brand>
                <b-navbar-nav>
                    <b-nav-item @click="toggleFlag">
                        <i class="fa fa-flag" :class="'text-' + (flagged ? 'danger' : 'secondary')"></i>
                    </b-nav-item>
                    <b-nav-item :href="task.url">
                        <i class="fa fa-link"></i>
                    </b-nav-item>
                    <b-nav-item v-b-toggle="'collapse-' + task.id" variant="muted" v-if="true === collapse">
                    <span class="when-opened">
                        <i class="fa fa-toggle-on"></i>
                    </span>
                        <span class="when-closed">
                        <i class="fa fa-toggle-off"></i>
                    </span>
                        <span class="d-none d-lg-inline">
                        <b-badge>New</b-badge>
                        {{ taskName }}
                    </span>
                    </b-nav-item>
                    <b-nav-text variant="muted" v-if="collapse !== true">
                        {{ taskName }}
                    </b-nav-text>
                </b-navbar-nav>
                <b-collapse is-nav>
                    <b-navbar-nav class="ml-auto">
                        <b-nav-item class="mr-2" variant="muted" right v-if="assigneesNum > 0" @click="showAssigneesTab">
                            <b>{{ assigneesNum }}</b>
                            <i :class="'fa fa-' + (assigneesNum < 2 ? 'user' : 'users')"></i>
                        </b-nav-item>
                        <b-nav-item class="mr-2" variant="muted" right v-else-if="assigneesNum === 0">
                            <i class="fa fa-user-plus"></i>
                        </b-nav-item>
                        <b-nav-text v-b-tooltip.hover variant="muted" v-if="reason" :title="reason" right>
                            <i class="fa fa-info-circle"></i>
                        </b-nav-text>
                        <b-nav-item-dropdown  v-b-tooltip.hover variant="muted"  right>
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
        </div>

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
            :visible="!collapse"
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
                                <i :class="'fa fa-' + (assigneesNum < 2 ? 'user' : 'users')"></i>
                            </span>
                            <span class="d-none d-md-inline">
                                {{ $t('components.task.Assignees') }}
                            </span>
                            <b-badge variant="light" v-if="assigneesNum">
                                {{ assigneesNum }}
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
        <hr :class="'mb-0 d-block d-lg-none bg-' + colors[status]">
    </div>
</template>
<script>
    export default {
        props: ['collapse', 'task'],
        data: function() {
            return {
                assigneesNum: this.task.assignees.length,
                colors: this.$Application.statuses.colors,
                flagged: this.task.flagged,
                icons: this.$Application.statuses.icons,
                newReason: null,
                newStatus: null,
                reason: this.task.current_status.reason,
                status: this.task.current_status.name,
                taskName: this.task.name,
                tabIndex: 1,
                user: this.$Application.user,
            }
        },
        mounted() {
            this.onAssign();
            this.onTaskUpdate();
        },
        methods: {
            handleOk(bvModalEvt) {
                // Prevent modal from closing
                bvModalEvt.preventDefault()
                // Trigger submit handler
                this.handleSubmit()
            },
            handleSubmit() {
                const object = this;
                this.$nextTick(() => {
                    this.$axios.put('task/' + object.task.id + '/status/' + object.newStatus, {reason: object.newReason})
                        .then(function (response) {
                            object.toaster('components.task.statuses.Updated', 'success')
                            object.hideModal();
                            object.reason = object.newReason;
                            object.status = object.newStatus;
                        })
                        .catch(function (error) {
                            object.toaster('components.task.statuses.Failed', 'danger');
                        });
                })
            },
            hideModal() {
                this.$refs['bv-status-reason-modal'].hide()
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
            onAssign() {
                this.$root.$on('task-assigned-' + this.task.id, (count) => {
                    this.assigneesNum = count;
                })
            },
            onTaskUpdate() {
                const object = this;
                this.$root.$on('task-updated-' + this.task.id, (response) => {
                    object.taskName = response.data.name;
                    object.flagged = response.data.flagged;
                })
            },
            resetModal() {
                this.newStatus = ''
            },
            setStatus: function (status) {
                this.newStatus = status;
                this.showModal();
            },
            showAssigneesTab() {
                this.collapse = false;
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
                let object = this;
                this.$axios.put('task/' + this.task.id, {flagged: !this.flagged})
                    .then(function (response) {
                        object.flagged = response.data.flagged;
                        let message = object.flagged ? 'components.task.No Flag' : 'components.task.Flagged';
                        object.$root.$emit('task-updated-' + object.task.id, response);
                        object.toaster(message, 'info', {
                            task_name: object.task.name
                        });
                    })
                    .catch(function (error) {
                        object.toaster('components.task.Flag Failed', 'danger');
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
