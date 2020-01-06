<template>
    <b-card
        class="mt-2"
        no-body
    >
        <template v-slot:header>
            <h4 class="mb-0">
                <avatar-component :user="assignee.user"></avatar-component>
                <i class="fa fa-ban text-danger" v-if="form.blocker" v-b-tooltip :title="$t('components.task.assignees.Blocker')"></i>
                {{ assignee.user.full_name }}
                <b-badge v-b-tooltip :title="$t('components.task.assignees.Difficulty')" :variant="difficultyColor(form.difficulty)" v-if="form.difficulty">
                    {{ form.difficulty }}
                    <span class="sr-only">{{ $t('components.task.assignees.Difficulty') }}</span>
                </b-badge>
            </h4>
        </template>
        <b-card-body v-if="show">
            <b-form @submit="onUpdate" @reset="onReset" ref="form">
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

        <b-list-group flush>
            <b-list-group-item>
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
                    class="card-link"
                >
                    <i class="fa fa-envelope"></i>
                    {{ assignee.user.email }}
                </b-link>
            </b-list-group-item>
            <b-list-group-item v-if="form.completed_at" variant="success">
                <i class="fa fa-check"></i>
                <date-time-component :date="form.completed_at"></date-time-component>
            </b-list-group-item>
            <b-list-group-item v-if="form.created_at !== form.updated_at" variant="info">
                <i class="fa fa-edit"></i>
                <date-time-component :date="form.updated_at"></date-time-component>
            </b-list-group-item>
            <b-list-group-item>
                <i class="fa fa-plus"></i>
                <date-time-component :date="form.created_at"></date-time-component>
            </b-list-group-item>
            <b-list-group-item v-if="form.deleted_at" variant="danger">
                <i class="fa fa-trash-o"></i>
                <date-time-component :date="form.deleted_at"></date-time-component>
            </b-list-group-item>
        </b-list-group>
    </b-card>
</template>
<script>
    export default {
        props: ['assignee', 'task'],
        data: function () {
            return {
                assignees: [],
                assigneesNum: 0,
                blockerOptions: [
                    { text: this.$t('components.task.assignees.No'), value: 0 },
                    { text: this.$t('components.task.assignees.Yes'), value: 1 }
                ],
                form: {
                    blocker: this.assignee.blocker,
                    defer: this.assignee.defer,
                    difficulty: this.assignee.difficulty,
                    due: this.assignee.due,
                    estimated_time: this.assignee.estimated_time,
                    completed_at: this.assignee.completed_at,
                    updated_at: this.assignee.updated_at,
                    created_at: this.assignee.created_at,
                    deleted_at: this.assignee.deleted_at,
                },
                friends: [],
                friendSearch: '',
                reset: this.task,
                self: true,
                show: true,
                user: this.$Application.user,
            }
        },
        mounted() {
            this.onUpdated();
        },
        methods: {
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
            onAssign() {
                this.$root.$on('task-assigned-' + this.task.id, (count) => {
                    console.log('assigned')
                })
            },
            onReset(evt) {
                evt.preventDefault()
                // Reset our form values
                this.task = this.reset;
                this.$nextTick(() => {
                    this.show = false
                })
            },
            onUpdate(event) {
                event.preventDefault()

                this.$axios.put('assignee/' + this.assignee.id, this.form)
                    .then(response => {
                        this.form = response.data;

                        this.$root.$emit('task-assignee-updated-' + this.assignee.id, response);
                        this.toaster('components.task.assignees.Updated', 'success');
                    })
                    .catch(error => {
                        this.toaster('components.task.assignees.Update Failed', 'danger');
                    });

            },
            onUpdated() {
                console.log('hello updated')
            },
            toaster(message, variant = null, vars = null, title = null) {
                this.$bvToast.toast(this.$t(message, vars), {
                    title: this.$t(`components.toaster.${variant || 'default'}`),
                    variant: variant,
                    solid: true
                })
            },
        },
    }
</script>
