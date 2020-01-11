<template>
    <span @click="toggle" :class="textClass">
        {{ display }}
    </span>
</template>

<script>
    import Moment from 'moment';

    export default {
        props: ['class', 'date'],
        data: function () {
            return {
                active: 1,
                display: this.date,
                textClass: null,
                type1: null,
                type2: null,
                type3: null,
                type4: null,
                type5: null,
            }
        },
        mounted() {
            this.textClass = this.class;
            this.type1 = this.date;
            this.type2 = Moment(this.date).format('L');
            this.type3 = Moment(this.date).format('LL');
            this.type4 = Moment(this.date).format('LLL');
            this.type5 = Moment(this.date).format('LLLL');
            this.display = this.type5;
        },
        methods: {
            toggle() {
                /**
                 * @todo solve it on an elegant way
                 */
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
                        this.active++;
                        break;
                    case 4:
                        this.display = this.type5;
                        this.active++;
                        break;
                    case 5:
                        this.display = this.type5;
                        this.active++;
                        break;
                    default:
                        this.active = 1;
                        this.display = this.type1;
                        break;
                }
            }
        }
    }
</script>
