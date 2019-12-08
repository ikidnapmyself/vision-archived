<template>
    <div>
        <b-modal ref="bv-assignee-modal"
                 @hidden="resetModal"
                 @ok="handleOk">
            <template v-slot:modal-title>
                {{ $t('components.assignees.Assign') }}
            </template>
            <div class="d-block">
                <form ref="form" @submit.stop.prevent="handleAssign">
                    <b-form-group
                        :label="$t('components.assignees.Assignee')"
                        label-for="assignee"
                    >
                        <div class="media text-muted pt-3">
                            <img class="mr-3" :src="user.avatar_url" :alt="user.full_name" width="32" height="32">
                            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <strong class="text-gray-dark">{{ user.full_name }}</strong>
                                    <a href="#">Follow</a>
                                </div>
                                <span class="d-block">{{ user.email }}</span>
                            </div>
                        </div>
                    </b-form-group>
                </form>
            </div>
        </b-modal>

        <div class="bg-dark d-flex align-items-center p-3 mb-3 text-white-50 bg-purple rounded shadow-sm">
            <img class="mr-3" :src="user.avatar_url" :alt="user.full_name" width="48" height="48">
            <div class="lh-100">
                <h6 class="mb-0 text-white lh-100">{{ user.full_name }}</h6>
                <b-link v-on:click="showModal('bv-assignee-modal')" size="sm" variant="dark">
                    <i class="fa fa-user-plus"></i>
                    {{ $t('components.assignees.Assign Yourself') }}
                </b-link>
            </div>
        </div>
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">
                {{ $t('components.assignees.Assignees') }}
            </h6>
            <div v-for="assignee in assignees" v-bind:key="assignee.id" class="media text-muted pt-3">
                <img class="mr-3" :src="assignee.user.avatar_url" :alt="assignee.user.full_name" width="32" height="32">
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <strong class="text-gray-dark">{{ assignee.user.full_name }}</strong>
                        <a href="#">Follow</a>
                    </div>
                    <span class="d-block">{{ assignee.user.email }}</span>
                </div>
            </div>
            <small class="d-none text-right mt-3">
                <a href="#">All suggestions</a>
            </small>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['assignees'],
        data: function () {
            return {
                auth: this.$Application.auth,
                user: this.$Application.user,
            }
        },
        mounted() {
            //
        },
        methods: {
            deleteConfirmation() {
                this.boxOne = ''
                this.$bvModal.msgBoxConfirm()
                    .then(value => {
                        this.boxOne = value
                    })
                    .catch(err => {
                        // An error occurred
                    })
            },
            handleOk(bvModalEvt) {
                // Prevent modal from closing
                bvModalEvt.preventDefault()
                // Trigger submit handler
                this.handleSubmit()
            },
            handleAssign() {
                const object = this;
                this.$nextTick(() => {
                    this.$axios.put('task/' + object.task + '/status/' + object.newStatus, {reason: object.newReason})
                        .then(function (response) {
                            object.hideModal();
                            object.reason = object.newReason;
                            object.status = object.newStatus;
                        })
                        .catch(function (error) {
                            alert('Status can not be updated!');
                        });
                })
            },
            hideModal(ref) {
                this.$refs[ref].hide()
            },
            resetModal() {
                this.newStatus = ''
            },
            setStatus: function (status) {
                this.newStatus = status;
                this.showModal();
            },
            showModal(ref) {
                this.$refs[ref].show()
            },
        }
    }
</script>
