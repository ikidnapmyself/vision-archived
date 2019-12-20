<template>
    <div>
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">
                {{ $t('components.task.assignees.Assignees') }}
            </h6>
            <div v-for="assignee in assignees" v-if="assignee.id" v-bind:key="assignee.id" class="media text-muted pt-3">
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
        /*
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
        */
    }
</script>
