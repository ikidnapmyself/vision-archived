<template>
    <div>
        <b-navbar toggleable="sm"  type="light" variant="muted">
            <b-navbar-brand class="d-none d-sm-inline" :href="assignee.user.url">
                <avatar-component :user="assignee.user"></avatar-component>
            </b-navbar-brand>
            <b-navbar-nav @click="toggleAssignee">
                <b-nav-item>
                    <span :class="form.blocker ? 'text-danger font-weight-bold' : '' + parent.completed_by === assignee.id ? 'text-success font-weight-bold' : '' ">
                        {{ assignee.user.full_name }}
                    </span>
                    <b-badge
                        v-b-tooltip.hover
                        v-if="form.difficulty"
                        :title="$t('components.task.assignees.Difficulty')"
                        :variant="difficultyColor(form.difficulty)"
                    >
                        {{ form.difficulty }}
                        <span class="sr-only">{{ $t('components.task.assignees.Difficulty') }}</span>
                    </b-badge>
                </b-nav-item>
            </b-navbar-nav>
            <b-navbar-toggle :target="'nav-text-collapse-' + assignee.id" class="border-0"></b-navbar-toggle>
            <b-collapse :id="'nav-text-collapse-' + assignee.id" is-nav>
                <b-navbar-nav>
                    <b-nav-item
                        v-b-tooltip
                        v-if="parent.completed_by === null"
                        @click="runComplete"
                        :title="$t('components.task.assignees.Complete')"
                    >
                        <i class="fa fa-user-check text-success"></i>
                        <span class="d-inline d-sm-none">
                            {{ $t('components.task.assignees.Complete') }}
                        </span>
                    </b-nav-item>
                    <b-nav-item
                        v-else-if="parent.completed_by === assignee.id"
                    >
                        <i class="fa fa-check text-success"></i>
                    </b-nav-item>
                    <b-nav-item
                        v-b-tooltip
                        v-if="parent.completed_by !== assignee.id"
                        @click="runUnassign"
                        :title="$t('components.task.assignees.Unassign')"
                    >
                        <i class="fa fa-user-minus text-dark"></i>
                        <span class="d-inline d-sm-none">
                            {{ $t('components.task.assignees.Unassign') }}
                        </span>
                    </b-nav-item>
                    <b-nav-text
                        v-b-tooltip.hover
                        class="mr-sm-3"
                        v-if="form.blocker"
                        :title="$t('components.task.assignees.Blocker')"
                    >
                        <i class="fa fa-ban text-danger"></i>
                        <span class="d-inline d-sm-none">
                            {{ $t('components.task.assignees.Blocker') }}
                        </span>
                    </b-nav-text>
                    <b-nav-text
                        v-b-tooltip.hover
                        class="mr-sm-3"
                        v-if="form.due"
                        :title="$t('components.task.assignees.Due')"
                    >
                        <template v-slot:title>
                            {{ form.due }} asd
                        </template>
                        <i class="fa fa-calendar-o"></i>
                        <span class="d-inline d-sm-none">
                            <date-time-component :date="form.due"></date-time-component>
                        </span>
                    </b-nav-text>
                    <b-nav-text
                        v-b-tooltip.hover
                        class="mr-sm-3"
                        v-if="form.defer"
                    >
                        <template v-slot:title>
                            {{ form.defer }}
                        </template>
                        <i class="fa fa-eye-slash"></i>
                        <span class="d-inline d-sm-none">
                            <date-time-component :date="form.defer"></date-time-component>
                        </span>
                    </b-nav-text>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
        <b-collapse
            :id="'collapse-' + task.id"
            class="mt-2"
            :visible="show"
        >
            <b-card
                class="mt-2"
                header-bg-variant="transparent"
                no-body
            >
                <b-card-body class="border-bottom border-muted">
                    <b-form @submit="runUpdate" @reset="onReset" ref="form">
                        <input type="hidden" name="assignee_id" :value="assignee.id">
                        <b-card-title>
                            {{ $t('components.task.assignees.Difficulty') }}
                        </b-card-title>
                        <b-card-sub-title class="mb-2">
                            {{ $t('components.task.assignees.Difficulty Sub Title') }}
                            <developers-note-component :note="$t('components.task.assignees.Difficulty DevNote')">
                            </developers-note-component>
                        </b-card-sub-title>
                        <b-card-text>
                            <b-progress :max="10" :min="-10" height="0.1rem">
                                <b-progress-bar :value="-7" :max="-7" :min="-10" variant="danger"></b-progress-bar>
                                <b-progress-bar :value="-5" :min="-6" :max="-5" variant="warning"></b-progress-bar>
                                <b-progress-bar :value="-2" :min="-4" :max="-2" variant="success"></b-progress-bar>
                                <b-progress-bar :value="1" :min="-1" :max="1" variant="secondary"></b-progress-bar>
                                <b-progress-bar :value="4" :min="2" :max="4" variant="success"></b-progress-bar>
                                <b-progress-bar :value="6" :min="5" :max="6" variant="warning"></b-progress-bar>
                                <b-progress-bar :value="10" :min="7" :max="10" variant="danger"></b-progress-bar>
                            </b-progress>
                            <b-form-input v-model="form.difficulty" type="range" min="-10" max="10" name="difficulty">
                            </b-form-input>
                        </b-card-text>
                        <b-card-title>
                            {{ $t('components.task.assignees.Blocker') }}
                        </b-card-title>
                        <b-card-sub-title class="mb-2">
                            {{ $t('components.task.assignees.Blocker Sub Title') }}
                        </b-card-sub-title>
                        <b-card-text>
                            <b-form-radio-group
                                v-model="form.blocker"
                                :options="blockerOptions"
                                buttons
                                :button-variant="form.blocker ? 'outline-danger' : 'outline-secondary'"
                                name="blocker"
                            ></b-form-radio-group>
                        </b-card-text>

                        <b-card-title>
                            {{ $t('components.task.assignees.Due') }}
                        </b-card-title>
                        <b-card-sub-title class="mb-2">
                            {{ $t('components.task.assignees.Due Sub Title') }}
                        </b-card-sub-title>
                        <b-card-text>
                            <datetime-component
                                v-model="form.due"
                            ></datetime-component>
                        </b-card-text>

                        <b-card-title>
                            {{ $t('components.task.assignees.Defer') }}
                        </b-card-title>
                        <b-card-sub-title class="mb-2">
                            {{ $t('components.task.assignees.Defer Sub Title') }}
                        </b-card-sub-title>
                        <b-card-text>
                            <datetime-component
                                v-model="form.defer"
                            ></datetime-component>
                        </b-card-text>

                        <b-card-title>
                            {{ $t('components.task.assignees.Estimated Time') }}
                        </b-card-title>
                        <b-card-sub-title class="mb-2">
                            {{ $t('components.task.assignees.Estimated Time Sub Title') }}
                        </b-card-sub-title>
                        <b-card-text>
                            <b-input-group
                                :append="$t('components.task.assignees.Estimated Time Unit')"
                                size="lg"
                            >
                                <b-form-input
                                    v-model="form.estimated_time"
                                    name="estimated_time"
                                    type="number"
                                ></b-form-input>
                            </b-input-group>
                        </b-card-text>
                        <b-card-text>
                            <b-button type="submit" variant="primary">
                                {{ $t('components.task.assignees.Update') }}
                            </b-button>
                            <b-button type="reset" variant="danger">
                                {{ $t('components.task.assignees.Reset') }}
                            </b-button>
                        </b-card-text>
                    </b-form>
                </b-card-body>

                <b-list-group v-if="show" flush>
                    <b-list-group-item>
                        <b-link
                            v-clipboard="assignee.user.url"
                            v-b-tooltip.hover
                            :title="assignee.user.full_name"
                            class="card-link"
                        >
                            <i class="fa fa-user"></i>
                        </b-link>
                        <b-link
                            v-clipboard="assignee.user.email"
                            v-b-tooltip.hover
                            :title="$t('components.task.assignees.Copy')"
                            class="card-link"
                        >
                            <i class="fa fa-copy"></i>
                        </b-link>
                        <b-link
                            v-b-tooltip.hover
                            :href="'mailto:' + assignee.user.email"
                            :title="$t('components.task.assignees.Mail To')"
                            class="card-link ml-3"
                        >
                            <i class="fa fa-envelope"></i>
                            <span class="d-none d-sm-inline">{{ assignee.user.email }}</span>
                        </b-link>
                    </b-list-group-item>
                    <b-list-group-item v-if="form.completed_at" variant="success">
                        <i class="fa fa-check"
                           v-b-tooltip.hover
                           :title="$t('components.task.assignees.Completed At')"
                        ></i>
                        <span class="font-weight-bold d-none d-sm-inline">{{ $t('components.task.assignees.Completed At') }} :</span>
                        <date-time-component :date="form.completed_at"></date-time-component>
                    </b-list-group-item>
                    <b-list-group-item
                        v-if="form.created_at !== form.updated_at" variant="info">
                        <i class="fa fa-edit"
                           v-b-tooltip.hover
                           :title="$t('components.task.assignees.Updated At')"
                        ></i>
                        <span class="font-weight-bold d-none d-sm-inline">{{ $t('components.task.assignees.Updated At') }} :</span>
                        <date-time-component :date="form.updated_at"></date-time-component>
                    </b-list-group-item>
                    <b-list-group-item>
                        <i class="fa fa-plus"
                           v-b-tooltip.hover
                           :title="$t('components.task.assignees.Created At')"
                        ></i>
                        <span class="font-weight-bold d-none d-sm-inline">{{ $t('components.task.assignees.Created At') }} :</span>
                        <date-time-component :date="form.created_at"></date-time-component>
                    </b-list-group-item>
                    <b-list-group-item
                        v-if="form.deleted_at" variant="danger">
                        <i class="fa fa-trash-o"
                           v-b-tooltip.hover
                           :title="$t('components.task.assignees.Deleted At')"
                        ></i>
                        <span class="font-weight-bold d-none d-sm-inline">{{ $t('components.task.assignees.Deleted At') }} :</span>
                        <date-time-component :date="form.deleted_at"></date-time-component>
                    </b-list-group-item>
                </b-list-group>
            </b-card>
        </b-collapse>
    </div>
</template>
<script>
    export default {
        props: ['assignee', 'task'],
        data: function () {
            return {
                blockerOptions: [
                    { text: this.$t('components.task.assignees.No'), value: 0 },
                    { text: this.$t('components.task.assignees.Yes'), value: 1 }
                ],
                completedBy: true,
                form: this.assignee,
                friends: [],
                friendSearch: '',
                parent: this.task,
                self: true,
                show: false,
                user: this.$Application.user,
            }
        },
        mounted() {
            if(typeof this.difficulty === 'undefined'){
                this.difficulty = false;
            }
            this.events();
        },
        methods: {
            events() {
                this.$root.$on('assignee-' + this.assignee.id, (response) => {
                    this.form = response;
                });
                this.$root.$on('assignees-' + this.task.id, (response) => {
                    //
                });
                this.$root.$on('task-' + this.task.id, (response) => {
                    this.parent = response;
                });
            },
            difficultyColor(score) {
                score = Math.abs(score);

                if (score < 2) {
                    return 'secondary';
                } else if (score<= 4) {
                    return 'success';
                } else if (score < 7) {
                    return 'warning';
                } else if (score <= 10) {
                    return 'danger';
                }
            },
            onReset(evt) {
                evt.preventDefault()
                this.form = this.assignee;
                this.$nextTick(() => {
                    this.show = false
                })
            },
            // @todo Fix runComplete
            runComplete(event) {
                event.preventDefault();
                // @todo Reason must be settable.
                this.$axios.put('/task/' + this.assignee.task_id + '/status', {status: 'completed', assignee: this.assignee.id, reason: null})
                    .then((response) => {
                        this.$root.$emit('assignee-' + this.assignee.id, response.data.completed_by);
                        this.$root.$emit('task-' + this.assignee.task_id, response.data);
                        this.toaster('components.task.assignees.Completed', 'success', {task_name: this.parent.name, user_name: this.assignee.user.full_name});
                    })
                    .catch(error => {
                        this.toaster('components.task.assignees.Complete Failed', 'danger');
                    });

            },
            runUnassign(event) {
                event.preventDefault();

                this.$axios.delete('/assignee/' + this.assignee.id)
                    .then(response => {
                        this.form = response.data;

                        this.$root.$emit('unassigned-' + this.assignee.task_id, this.form);
                        this.toaster('components.task.assignees.Unassigned', 'success', {user_name: this.assignee.user.full_name});
                    })
                    .catch(error => {
                        this.toaster('components.task.assignees.Unassign Failed', 'danger');
                    });

            },
            runUpdate(event) {
                event.preventDefault();

                this.$axios.put('/assignee/' + this.assignee.id, this.form)
                    .then(response => {
                        this.$root.$emit('assignee-' + this.assignee.id, response.data);
                        this.toaster('components.task.assignees.Updated', 'success');
                    })
                    .catch(error => {
                        this.toaster('components.task.assignees.Update Failed', 'danger');
                    });

            },
            toaster(message, variant = null, vars = null, title = null) {
                this.$bvToast.toast(this.$t(message, vars), {
                    title: this.$t(`components.toaster.${variant || 'default'}`),
                    variant: variant,
                    solid: true
                })
            },
            toggleAssignee() {
                this.show = !this.show;
            },
        },
    }
</script>
