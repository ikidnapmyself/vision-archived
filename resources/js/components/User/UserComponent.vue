<template>
    <div :class="'mb-1 border-right border-primary'">
        <b-navbar toggleable="lg" type="light" variant="muted">
            <b-navbar-brand :href="user.url">
                <b-img :src="user.avatar_url" :alt="user.full_name" rounded="circle" thumbnail></b-img>
            </b-navbar-brand>
            <b-navbar-nav>
                <b-nav-item v-b-toggle="'collapse-' + user.id" variant="muted" :href="user.url">
                    <b-badge>New</b-badge>
                    {{ user.full_name }}
                </b-nav-item>
            </b-navbar-nav>
            <b-collapse is-nav>
                <b-navbar-nav class="ml-auto">
                    <b-nav-item class="mr-2" variant="muted" right v-if="user.friends.length > 0">
                        <b>{{ user.friends.length }}</b>
                        <i :class="'fa fa-' + (user.friends.length < 2 ? 'user' : 'users')"></i>
                    </b-nav-item>
                    <b-nav-item class="mr-2" variant="muted" right v-else-if="user.friends.length === 0">
                        <i class="fa fa-user-plus"></i>
                    </b-nav-item>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
        <b-modal ref="bv-status-reason-modal"
                 @hidden="resetModal"
                 @ok="handleOk">
            <template v-slot:modal-title>
                {{ $t('components.user.statuses.Add Your Reason') }}
            </template>
            <div class="d-block text-center">
                <form ref="form" @submit.stop.prevent="handleSubmit">
                    <b-form-group
                        :label="$t('components.user.statuses.Reason')"
                        label-for="reason-input"
                    >
                        <b-form-input
                            required
                        ></b-form-input>
                    </b-form-group>
                </form>
            </div>
        </b-modal>
        <hr class="mb-0 d-block d-lg-none">
    </div>
</template>
<script>
    export default {
        props: ['user'],
        data: function() {
            return {
                currentUser: this.$Application.user,
            }
        },
        mounted() {
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
                    this.$axios.put('user/' + object.user.id + '/status/' + object.newStatus, {reason: object.newReason})
                        .then(function (response) {
                            object.toaster('components.user.statuses.Updated', 'success')
                            object.hideModal();
                            object.reason = object.newReason;
                            object.status = object.newStatus;
                        })
                        .catch(function (error) {
                            object.toaster('components.user.statuses.Failed', 'danger');
                        });
                })
            },
            hideModal() {
                this.$refs['bv-status-reason-modal'].hide()
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
            toggleFriendship: function () {
                let object = this;
                this.$axios.put('user/' + this.user.id + '/flag', {})
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
