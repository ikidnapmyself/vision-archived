<template>
    <div>
        <b-button-group>
            <b-button v-on:click="toggleStar" :variant="(starred ? '' : 'outline-') + colors[status]">
                <i class="fa fa-star"></i>
            </b-button>
            <b-button v-on:click="toggleFlag" :variant="(flagged ? '' : 'outline-') + colors[status]">
                <i class="fa fa-flag"></i>
            </b-button>
            <b-button v-b-tooltip.hover :variant="colors[status]" v-if="current.reason" :title="current.reason">
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
                icons: this.$Application.statuses.icons,
                colors: this.$Application.statuses.colors,
                status: this.current.name,
                task: this.model.id,
                starred: this.model.starred,
                flagged: this.model.flagged
            }
        },
        mounted() {
            //
        },
        methods: {
            setStatus: function (status) {
                this.status = status;
                this.$axios.put('task/' + this.task + '/status/' + status, {})
                    .then(function (response) {
                        //
                    })
                    .catch(function (error) {
                        alert('Status can not be updated!');
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
        }
    }
</script>
;
