<template>
    <div>
        <grid-layout
            :class="'text-center border-5-left border-left border-' + colors[status]"
            :col-num="12"
            :is-draggable="true"
            :is-resizable="true"
            :margin="[2, 2]"
            :layout.sync="layout"
            :responsive="true"
            :row-height="70"
            :use-css-transforms="false"
            :vertical-compact="true"
        >
            <grid-item
                v-for="item in layout"
                :x="item.x"
                :y="item.y"
                :w="item.w"
                :h="item.h"
                :i="item.i"
                :key="item.i"
            >
                <b-card border-top-variant="danger" body-class="text-center" class="border-0 h-100">
                    <b-link :href="model.created_by.url" v-if="item.i === 'avatar'">
                        <avatar-component size="35" :user="model.created_by"></avatar-component>
                    </b-link>
                    <b-button-group :href="model.url" class="d-block text-left" v-else-if="item.i === 'task.name'">
                        <b-dropdown block split :text="model.name" menu-class="text-left" variant="muted" right>
                            <b-dropdown-item v-if="isNew()">
                                <b-badge>{{ $t('components.task.New') }}</b-badge>
                            </b-dropdown-item>
                            <b-dropdown-item>
                                <date-time-component
                                    :date="model.updated_at"
                                >
                                </date-time-component>
                            </b-dropdown-item>
                            <b-dropdown-item :href="model.url">
                                <i class="fa fa-link"></i>
                                {{ $t('components.task.Go to task') }}
                            </b-dropdown-item>
                            <b-dropdown-divider></b-dropdown-divider>
                            <b-dropdown-item>...</b-dropdown-item>
                        </b-dropdown>
                    </b-button-group>
                    <b-button-group size="sm" v-else-if="item.i === 'status'">
                        <b-button variant="muted">
                            <i :class="icons[status] + ' text-' + colors[status]"></i>
                        </b-button>
                        <b-dropdown variant="muted" :text="$t('status.' + status)" right>
                            <b class="px-3">{{ $t('components.task.statuses.Move to') }}</b>
                            <b-dropdown-divider></b-dropdown-divider>
                            <b-dropdown-item :variant="colors[available_status]" v-for="available_status in model.available_statuses" v-bind:key="available_status" @click="setStatus(available_status)">
                                <i :class="icons[available_status]"></i>
                                {{ $t('status.' + available_status) }}
                            </b-dropdown-item>
                        </b-dropdown>
                    </b-button-group>
                    <span v-else-if="item.i === 'assignees'">
                        <b-button class="mr-2" variant="muted" right v-if="assignees.length > 0" @click="showAssigneesTab">
                            <b>{{ assignees.length }}</b>
                            <i :class="'fa fa-' + (assignees.length < 2 ? 'user' : 'users')"></i>
                        </b-button>
                        <b-button class="mr-2" variant="muted" right v-else-if="assignees.length === 0" @click="showAssigneesTab">
                            <i class="fa fa-user-plus"></i>
                        </b-button>
                    </span>
                    <b-button v-else-if="item.i === 'flag'" variant="muted">
                        <b-link @click="toggleFlag">
                            <i class="fa fa-flag" :class="'text-' + (model.flagged ? 'danger' : 'secondary')"></i>
                        </b-link>
                    </b-button>
                    <b-button v-else-if="item.i === 'toggle'" v-b-toggle="'collapse-' + model.id" variant="muted">
                        <span class="when-opened">
                            <i class="fa fa-toggle-on"></i>
                        </span>
                        <span class="when-closed">
                            <i class="fa fa-toggle-off"></i>
                        </span>
                    </b-button>
                    <span v-else>
                        {{ item.i }}
                    </span>
                </b-card>
            </grid-item>
        </grid-layout>
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
                relation: { // My relation with this task
                    reporter: false, // @todo If I reported, make it true
                    assignee: false, // @todo If I'm an assignee, make it true
                    assigned: false, // @todo If I assigned this task to a person, make it true
                },
                status: this.task.current_status.name,
                tabIndex: 0,
                user: this.$Application.user,
                layout : [
                    {"x":0,"y":0,"w":1,"h":1,"i":"avatar"},
                    {"x":1,"y":0,"w":1,"h":1,"i":"flag"},
                    {"x":2,"y":0,"w":6,"h":1,"i":"task.name"},
                    {"x":8,"y":0,"w":2,"h":1,"i":"status"},
                    {"x":10,"y":0,"w":1,"h":1,"i":"assignees"},
                    {"x":11,"y":0,"w":1,"h":1,"i":"toggle"},
                ],
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
    .collapsed > .btn > .when-opened,
    :not(.collapsed) > .btn > .when-closed {
        display: none;
    }
    .border-5-left { border-left-width: 5px !important;}
    .border-5-right { border-right-width: 5px !important;}
</style>
