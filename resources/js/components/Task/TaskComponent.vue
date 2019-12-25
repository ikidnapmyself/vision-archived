<template>
    <div :class="'mb-1 border-right border-' + colors[status]">
        <b-link v-b-toggle="'collapse-' + task.id" variant="muted" @click="toggleBody" class="d-md-block d-lg-none">
            <b-badge>New</b-badge>
            {{ task.name }}
        </b-link>
        <b-navbar toggleable="lg" type="light" variant="muted">
                <b-navbar-brand :href="task.created_by.url">
                    <b-img :src="task.created_by.avatar_url" :alt="task.created_by.full_name" rounded="circle" thumbnail></b-img>
                </b-navbar-brand>
                <b-navbar-nav>
                    <b-nav-item v-on:click="toggleFlag">
                        <i class="fa fa-flag" :class="'text-' + (flagged ? 'danger' : 'secondary')"></i>
                    </b-nav-item>
                    <b-nav-item v-b-toggle="'collapse-' + task.id" variant="muted" @click="toggleBody">
                        <i :class="'fa fa-toggle-' + switch_icon"></i>
                        <span class="d-none d-lg-inline">
                            <b-badge>New</b-badge>
                            {{ task.name }}
                        </span>
                    </b-nav-item>
                </b-navbar-nav>
                <b-collapse is-nav>
                    <b-navbar-nav class="ml-auto">
                        <b-nav-text class="mr-2" variant="muted" right>
                            <i :class="'fa fa-' + (task.assignees.length < 2 ? 'user' : 'users')"></i>
                        </b-nav-text>
                        <b-nav-text v-b-tooltip.hover variant="muted" v-if="reason" :title="reason" right>
                            <i class="fa fa-info-circle"></i>
                        </b-nav-text>
                        <b-nav-item-dropdown  v-b-tooltip.hover variant="muted"  right>
                            <template v-slot:button-content>
                                <i :class="icons[status] + ' text-' + colors[status]"></i>
                            </template>
                            <b class="px-3">{{ $t('components.task.statuses.Move to') }}</b>
                            <b-dropdown-divider></b-dropdown-divider>
                            <b-dropdown-item :variant="colors[item]" v-for="item in task.available_statuses" v-bind:key="item" v-on:click="setStatus(item)">
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
        <b-collapse :id="'collapse-' + task.id" class="mt-2">
            <b-card no-body class="mb-0 border-0">
                <b-tabs card>
                    <b-tab active>
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
                    <b-tab>
                        <template v-slot:title>
                            <span class="d-md-none d-lg-inline">
                                <i class="fa fa-wrench"></i>
                            </span>
                            <span class="d-none d-md-inline">
                                {{ $t('components.task.Update') }}
                            </span>
                        </template>
                        <b-card-text>
                            <task-tab-edit-component :task="task"></task-tab-edit-component>
                        </b-card-text>
                    </b-tab>
                    <b-tab>
                        <template v-slot:title>
                            <span class="d-md-none d-lg-inline">
                                <i :class="'fa fa-' + (task.assignees.length < 2 ? 'user' : 'users')"></i>
                            </span>
                            <span class="d-none d-md-inline">
                                {{ $t('components.task.Assignees') }}
                            </span>
                            <b-badge variant="light" v-if="task.assignees.length">
                                {{ task.assignees.length }}
                                <span class="sr-only">{{ $t('components.task.Assignees') }}</span>
                            </b-badge>
                        </template>
                        <b-card-text>
                            <task-assignees-component :assignees="task.assignees"></task-assignees-component>
                        </b-card-text>
                    </b-tab>
                    <b-tab lazy>
                        <template v-slot:title>
                            <span class="d-md-none d-lg-inline">
                                <i class="fa fa-user-plus"></i>
                            </span>
                            <span class="d-none d-md-inline">
                                {{ $t('components.task.Assign') }}
                            </span>
                        </template>
                        <b-card-text>
                            <task-assign-component></task-assign-component>
                        </b-card-text>
                    </b-tab>
                    <b-tab lazy>
                        <template v-slot:title>
                            <span class="d-md-none d-lg-inline">
                                <i class="fa fa-history"></i>
                            </span>
                            <span class="d-none d-md-inline">
                                {{ $t('components.task.Timeline') }}
                            </span>
                        </template>
                        <b-card-text>
                            <task-assign-component></task-assign-component>
                        </b-card-text>
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
        props: ['task'],
        data: function() {
            return {
                colors: this.$Application.statuses.colors,
                flagged: this.task.flagged,
                icons: this.$Application.statuses.icons,
                newReason: null,
                newStatus: null,
                reason: this.task.current_status.reason,
                status: this.task.current_status.name,
                switch_icon: 'off',
                user: this.$Application.user,
            }
        },
        mounted(){
            //
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
            setStatus: function (status) {
                this.newStatus = status;
                this.showModal();
            },
            showModal() {
                this.$refs['bv-status-reason-modal'].show()
            },
            toaster(message, variant = null, title = null) {
                this.$bvToast.toast(this.$t(message), {
                    title: this.$t(`components.toaster.${variant || 'default'}`),
                    variant: variant,
                    solid: true
                })
            },
            resetModal() {
                this.newStatus = ''
            },
            toggleBody()
            {
                this.toggle_body = ! this.toggle_body;
                this.toggleIcon();
            },
            toggleIcon()
            {
                if(this.switch_icon === 'on')
                    this.switch_icon = 'off';
                else
                    this.switch_icon = 'on';
            },
            toggleFlag: function () {
                let object = this;
                this.$axios.put('task/' + this.task.id + '/flag', {})
                    .then(function (response) {
                        object.flagged = response.data.flagged;
                    })
                    .catch(function (error) {
                        alert('Flag can not be updated!');
                    });
            },
        }
    }
</script>
