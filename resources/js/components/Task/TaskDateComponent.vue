<template>
    <div>
        <small class="font-weight-bolder mr-2" v-on:click="toggle" v-b-tooltip.hover :title="task.ago">
            {{ is_formatted ? task.date : task.created_at }}
        </small>
        <b-button-group>
            <b-button v-on:click="toggle"  variant="muted" v-b-tooltip.hover :title="$t('components.task.date.Switch')">
                <i :class="'fa fa-toggle-' + switch_icon"></i>
            </b-button>
            <b-button v-clipboard="task.created_at" variant="muted" v-b-tooltip.hover :title="$t('components.task.date.Copy')">
                <i class="fa fa-copy"></i>
            </b-button>
            <b-button variant="muted" v-b-tooltip.hover :title="$t('components.task.date.Update')">
                <i class="fa fa-user-edit"></i>
            </b-button>
            <b-dropdown variant="muted" v-b-tooltip.hover :title="$t('components.task.date.Defer')">
                <template v-slot:button-content>
                    <i class="fa fa-clock-o"></i>
                </template>
                <b class="px-3">{{ $t('components.task.date.Remind me today') }}</b>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-item>
                    <i class="fa fa-stopwatch"></i>
                     in an Hour
                </b-dropdown-item>
                <b-dropdown-item>
                    <i class="fa fa-hourglass-half"></i>
                    This Afternoon
                </b-dropdown-item>
                <b-dropdown-item>
                    <i class="fa fa-lightbulb"></i>
                    This Evening
                </b-dropdown-item>
                <b-dropdown-item>
                    <i class="fa fa-moon-o"></i>
                    This Night
                </b-dropdown-item>
                <b-dropdown-divider></b-dropdown-divider>
                <b class="px-3">{{ $t('components.task.date.Custom') }}</b>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-item>
                    <i class="fa fa-user-tag"></i>
                    Morning Meeting
                </b-dropdown-item>
                <b-dropdown-item>
                    <i class="fa fa-user-tag"></i>
                    at Chill Hours
                </b-dropdown-item>
                <b-dropdown-divider></b-dropdown-divider>
                <b class="px-3">{{ $t('components.task.date.Later') }}</b>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-item>
                    <i class="fa fa-sun"></i>
                    Tomorrow
                </b-dropdown-item>
                <b-dropdown-item>
                    <i class="fa fa-forward"></i>
                    Next Weekend
                </b-dropdown-item>
                <b-dropdown-item>
                    <i class="fa fa-dice"></i>
                    Random
                </b-dropdown-item>
                <b-dropdown-item variant="danger">
                    <i class="fa fa-power-off"></i>
                    Ignore
                </b-dropdown-item>
            </b-dropdown>
        </b-button-group>
    </div>
</template>
<script>
    export default {
        props: ['task'],
        data: function (){
            return {
                is_formatted: false,
                switch_icon: 'on',
            }
        },
        mounted() {
            //
        },
        methods: {
            toggle: function () {
                this.is_formatted = !this.is_formatted;

                if(this.switch_icon === 'on')
                    this.switch_icon = 'off';
                else
                    this.switch_icon = 'on';
            },
        }
    }
</script>
