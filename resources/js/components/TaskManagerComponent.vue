<template>
    <div>
        <b-modal ref="bv-status-reason-modal"
                 @hidden="resetModal"
                 @ok="handleOk">
            <template v-slot:modal-title>
                {{ $t('components.statuses.Add Your Reason', {From: status, New: newStatus}) }}
            </template>
            <div class="d-block text-center">
                <form ref="form" @submit.stop.prevent="handleSubmit">
                    <b-form-group
                        :label="$t('components.statuses.Reason')"
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

        <b-button-group>
            <b-button v-on:click="toggleStar" :variant="(starred ? '' : 'outline-') + colors[status]">
                <i class="fa fa-star"></i>
            </b-button>
            <b-button v-on:click="toggleFlag" :variant="(flagged ? '' : 'outline-') + colors[status]">
                <i class="fa fa-flag"></i>
            </b-button>
            <b-button v-b-tooltip.hover :variant="colors[status]" v-if="reason" :title="reason">
                <i class="fa fa-question-circle"></i>
            </b-button>
            <b-dropdown v-b-tooltip.hover :title="$t('status.' + status)" :variant="colors[status]">
                <template v-slot:button-content>
                    <i :class="icons[status]"></i>
                </template>
                <b class="px-3">{{ $t('components.statuses.Move to') }}</b>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-item :variant="colors[item]" v-for="item in statuses" v-bind:key="item" v-on:click="setStatus(item)">
                    <i :class="icons[item]"></i>
                    {{ $t('status.' + item) }}
                </b-dropdown-item>
            </b-dropdown>
        </b-button-group>
    </div>
</template>
<script>
    export default {
        props: ['model', 'current', 'statuses'],
        data: function() {
            return {
                colors: this.$Application.statuses.colors,
                flagged: this.model.flagged,
                icons: this.$Application.statuses.icons,
                newReason: null,
                newStatus: null,
                reason: this.current.reason,
                starred: this.model.starred,
                status: this.current.name,
                task: this.model.id,
            }
        },
        mounted() {
            //
        },
        methods: {
            setStatus: function (status) {
                this.newStatus = status;
                this.showModal();
            },
            showModal() {
                this.$refs['bv-status-reason-modal'].show()
            },
            handleOk(bvModalEvt) {
                // Prevent modal from closing
                bvModalEvt.preventDefault()
                // Trigger submit handler
                this.handleSubmit()
            },
            handleSubmit() {
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
            hideModal() {
                this.$refs['bv-status-reason-modal'].hide()
            },
            resetModal() {
                this.newStatus = ''
            },
            toggleFlag: function () {
                let object = this;
                this.$axios.put('task/' + this.task + '/flag', {})
                    .then(function (response) {
                        object.flagged = response.data.flagged;
                    })
                    .catch(function (error) {
                        console.log(error);
                        alert('Flag can not be updated!');
                    });
            },
            toggleStar: function () {
                let object = this;
                this.$axios.put('task/' + this.task + '/star', {})
                    .then(function (response) {
                        object.starred = response.data.starred;
                    })
                    .catch(function (error) {
                        console.log(error);
                        alert('Star can not be updated!');
                    });
            },
        }
    }
</script>
;
