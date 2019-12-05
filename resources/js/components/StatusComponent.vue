<template>
    <div>
        <b-button-group>
            <b-button v-b-tooltip.hover
                :variant="$Application.statuses.colors[current.name]"
                v-if="current.reason"
                :title="current.reason">
                <i class="fa fa-question-circle"></i>
            </b-button>
            <b-dropdown split :variant="$Application.statuses.colors[current.name]">
                <template v-slot:button-content>
                    <i :class="$Application.statuses.icons[current.name]"></i>
                    {{ $t('status.' + current.name) }}
                </template>
                <b class="px-3">{{ $t('components.statuses.Move to') }}</b>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-item
                    v-for="item in statuses"
                    v-bind:key="item"
                    href="#">
                    <i :class="$Application.statuses.icons[item]"></i>
                    {{ $t('status.' + item) }}
                </b-dropdown-item>
            </b-dropdown>
        </b-button-group>
    </div>
</template>
<script>
    export default {
        props: ['model', 'current', 'statuses'],
        mounted() {
            console.log(this.$Application.statuses, this.model, this.current, this.statuses)
        }
    }
</script>
