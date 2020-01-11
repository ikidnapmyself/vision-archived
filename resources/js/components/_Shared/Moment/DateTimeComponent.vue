<template>
    <span @click="toggle">
        {{ display }}
    </span>
</template>

<script>
    import Moment from 'moment';

    export default {
        props: ['date'],
        data: function () {
            return {
                active: 0,
                display: this.date,
                types: [],
            }
        },
        mounted() {
            this.types[0] = Moment(this.date).fromNow();
            this.types[1] = Moment(this.date).format('YYYY-MM-DD');
            this.types[2] = Moment(this.date).format('LL');
            this.types[3] = Moment(this.date).format('LLL');
            this.types[4] = Moment(this.date).format('LLLL');
            this.toggle();
        },
        methods: {
            toggle() {
                if(this.types.length <= this.active)
                    this.active = 0;

                this.display = this.types[this.active];
                this.active++;
            }
        }
    }
</script>
