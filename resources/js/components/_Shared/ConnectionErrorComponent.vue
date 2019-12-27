<template>
    <div>
        <b-alert
            :show="dismissCountDown"
            dismissible
            variant="warning"
            @dismissed="dismissCountDown=0"
            @dismiss-count-down="countDownChanged"
        >
            <p>{{ $t('components.shared.connection-error.message', {second: dismissCountDown}) }}</p>
            <b-progress
                variant="warning"
                :max="percentage"
                :value="dismissCountDown"
                height="4px"
            ></b-progress>
        </b-alert>
    </div>
</template>

<script>
    export default {
        props: ['times'],
        data() {
            return {
                dismissSecs: 10,
                dismissCountDown: 0,
                percentage: this.dismissSecs,
                retry: false,
            }
        },
        mounted() {
            if(this.times)
            {
                this.display();
            }
        },
        methods: {
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown

                if(this.dismissCountDown === 0)
                    this.$root.$emit('refresh-tasks');
            },
            display() {
                this.dismissCountDown = this.dismissSecs * this.times
                this.percentage       = this.dismissSecs * this.times
            }
        },
        watch: {
            times: function() {
                this.display();
            }
        }
    }
</script>
