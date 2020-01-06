<template>
    <b-card-body>
        <b-card-title>
            <i :class="'fa fa-' + (assigneesNum < 2 ? 'user' : 'users')"></i>
            {{ $t('components.task.assignees.title') }}
        </b-card-title>

        <b-row>
            <b-col sm="12" md="6" class="mt-2">
                <b-button
                    block
                    size="lg"
                    :disabled="self"
                    :variant="self ? 'success' : 'outline-primary'"
                    @click="assignUser(user)"
                >
                    <span v-if="self">
                        <i class="fa fa-user-check"></i>
                        {{ $t('components.task.assignees.Already Assigned') }}
                    </span>
                    <span v-else>
                        <i class="fa fa-user-plus"></i>
                        {{ $t('components.task.assignees.Assign Yourself') }}
                    </span>
                </b-button>
            </b-col>
            <b-col sm="12" md="6" class="mt-2">
                <b-typeahead
                    input-class="text-center w-100"
                    size="lg"
                    ref="assignFriend"
                    v-if="friends.length"
                    v-model="friendSearch"
                    :data="friends"
                    :serializer="f => f.full_name"
                    :placeholder="$t('components.task.assignees.New Assignee', {friendsLeft: this.friends.length})"
                    @hit="assignUser($event)"
                >
                    <template slot="suggestion" slot-scope="{ data }">
                        <b-img
                            :src="data.avatar_url"
                            :alt="data.full_name"
                            rounded="circle"
                            thumbnail
                            v-bind="{ width: 25, height: 25, class: 'mr-1' }"
                        ></b-img>
                        {{ data.full_name }}
                        <br>
                        <small>{{ data.email }}</small>
                    </template>
                </b-typeahead>
                <b-button v-else variant="outline-danger" size="lg" block disabled>
                    <i class="fa fa-user-friends"></i>
                    {{ $t('components.task.assignees.No Friend') }}
                </b-button>
            </b-col>
        </b-row>
        <hr>
        <div v-if="assignees.length">
            <task-assignee-component v-for="assignee in assignees" v-bind:key="assignee.id" :assignee="assignee" :task="task">
            </task-assignee-component>
        </div>
        <div v-else>
            <b-jumbotron>
                <template v-slot:lead>
                    {{ $t('components.task.assignees.No Assignee Lead') }}
                </template>
                <hr class="my-4">
                <p>
                    {{ $t('components.task.assignees.No Assignee Body') }}
                </p>
                <div class="d-none d-md-block">
                    <b-button
                        variant="secondary"
                        v-if="friends.length"
                        @click="focusFriendSearch">
                        <i class="fa fa-user-friends"></i>
                        {{ $t('components.task.assignees.Assign Your Friends') }}
                    </b-button>
                    <b-button variant="primary" @click="assignUser(user)">
                        <i class="fa fa-user-plus"></i>
                        {{ $t('components.task.assignees.Assign Yourself') }}
                    </b-button>
                </div>
                <div class="d-xs-block d-md-none">
                    <b-button
                        variant="secondary"
                        v-if="friends.length"
                        block @click="focusFriendSearch">
                        <i class="fa fa-user-friends"></i>
                        {{ $t('components.task.assignees.Assign Your Friends') }}
                    </b-button>
                    <b-button variant="primary" block @click="assignUser(user)">
                        <i class="fa fa-user-plus"></i>
                        {{ $t('components.task.assignees.Assign Yourself') }}
                    </b-button>
                </div>
            </b-jumbotron>
        </div>
    </b-card-body>
</template>
<script>
    export default {
        props: ['task'],
        data: function () {
            return {
                assignees: [],
                assigneesNum: 0,
                blockerOptions: [
                    { text: this.$t('components.task.assignees.No'), value: 0 },
                    { text: this.$t('components.task.assignees.Yes'), value: 1 }
                ],
                form: {
                    blocker: null,
                    difficulty: null,
                    defer: null,
                    due: null,
                    estimated_time: null,
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
            this.assignees = this.task.assignees;
            this.getFriends();
            this.onUpdated();
            // Enable / Disable Self Assign
            let getAssignees = this.getAssignees();
            this.self = getAssignees.indexOf(this.user.id) !== -1;
        },
        methods: {
            async assignUser(assigned) {
                this.$axios.post('task/' + this.task.id + '/assign/' + assigned.id)
                .then(response => {
                    let assignee = response.data;
                    assignee.user = assigned;
                    this.assignees.push(assignee);
                    this.$root.$emit('task-assigned-' + this.task.id, this.task.assignees.length);
                    this.friendSearch = '';
                    this.remainingFriends();
                    this.toaster('components.task.assignees.Assigned', 'success', {
                        full_name: assigned.full_name,
                        task_name: this.task.name,
                    });
                })
                .catch(error => {
                    this.toaster('components.task.assignees.Assignee Failed', 'danger');
                });
            },
            focusFriendSearch() {
                this.$refs.assignFriend.$el.getElementsByTagName('input')[0].focus();
            },
            getAssignees() {
                // Pluck assigned user ids as an array.
                return this.assignees.map(function (value) {
                    return value.user_id;
                });
            },
            async getFriends() {
                this.$axios.get('friendship/' + this.user.id + '/list')
                .then(response => {
                    this.friends = response.data;
                    this.remainingFriends();
                })
                .catch(error => {
                    this.toaster('components.task.assignees.Friends Failed', 'danger');
                });
            },
            onAssign() {
                this.$root.$on('task-assigned-' + this.task.id, (count) => {
                    this.assigneesNum = count;
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
                let formData = new FormData(event.target);

                this.form.blocker = formData.get('blocker');
                this.form.difficulty = formData.get('difficulty');
                this.form.defer = formData.get('defer');
                this.form.due = formData.get('due');
                this.form.estimated_time = formData.get('estimated_time');

                this.$axios.put('assignee/' + formData.get('assignee_id'), this.form)
                    .then(response => {
                        this.$root.$emit('task-assignee-updated-' + formData.get('assignee_id'), response);
                        this.toaster('components.task.assignees.Updated', 'success');
                    })
                    .catch(error => {
                        this.toaster('components.task.assignees.Update Failed', 'danger');
                    });

            },
            onUpdated() {
                console.log('hello updated')
            },
            remainingFriends() {
                let assignees = this.getAssignees();

                // Enable / Disable Self Assign
                /** @note repeating line 105 */
                this.self = assignees.indexOf(this.user.id) !== -1;

                // If already assigned, remove from the data object
                // Avoid double assignment.
                this.friends = this.friends.filter(function (value) {
                    return assignees.indexOf(value.id) === -1;
                });

            },
            toaster(message, variant = null, vars = null, title = null) {
                this.$bvToast.toast(this.$t(message, vars), {
                    title: this.$t(`components.toaster.${variant || 'default'}`),
                    variant: variant,
                    solid: true
                })
            },
        },
        watch: {
            assignees: function (val) {
                this.assigneesNum = val.length;
            },
        },
    }
</script>
