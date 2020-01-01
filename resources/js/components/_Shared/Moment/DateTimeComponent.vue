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
                active: 1,
                display: this.date,
                type1: this.date,
                type2: this.date,
                type3: this.date,
            }
        },
        mounted() {
            this.type1 = this.date;
            this.type2 =
            this.display = Moment(this.date).format('LL');
            this.type3 = Moment(this.date).fromNow();
        },
        methods: {
            toggle() {
                switch (this.active) {
                    case 1:
                        this.display = this.type1;
                        this.active++;
                        break;
                    case 2:
                        this.display = this.type2;
                        this.active++;
                        break;
                    case 3:
                        this.display = this.type3;
                        this.active = 1;
                        break;
                }
            }
        }
    }
</script>
