<template>
    <b-input-group>
        <b-form-input
            type="date"
            v-model="date"
            v-on:input="updateDate"
        ></b-form-input>
        <b-form-input
            type="time"
            v-model="time"
            v-on:input="updateTime"
        ></b-form-input>
        <b-form-input
            type="date"
            v-model="date"
            v-on:input="updateDate"
        ></b-form-input>
        <b-form-input
            type="time"
            v-model="time"
            v-on:input="updateTime"
        ></b-form-input>
    </b-input-group>
</template>

<script>
    import Moment from 'moment';
    export default {
        props: ['value'],
        data() {
            return {
                date: null,
                time: null,
            }
        },
        computed: {
            display: function () {
                if(this.date !== 'Invalid date' && this.date && this.time !== 'Invalid date' && this.time)
                    return this.date + ' ' + this.time + ':00';

                return null;
            },
        },
        mounted() {
            if(this.value) {
                let parse = Moment(this.value);

                this.date = parse.format('YYYY-MM-DD');
                this.time = parse.format('HH:mm');

                this.$emit('input', this.display);
            }
        },
        methods: {
            updateDate(event) {
                this.date = Moment(event).format('YYYY-MM-DD');
                this.$emit('input', this.display);
            },
            updateTime(event) {
                this.time = Moment(event, 'HH:mm').format('HH:mm');
                this.$emit('input', this.display);
            },
        },
    }
</script>

<style scoped>

</style>
