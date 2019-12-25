<template>
    <b-card-body>
        <b-card-title>
            <b-button v-clipboard="task.url" variant="muted" v-b-tooltip.hover :title="$t('components.task.overview.Copy')">
                <i class="fa fa-link"></i>
            </b-button>
            <b-link :href="'task/' + task.id">
                {{ name }}
            </b-link>
        </b-card-title>
        <b-card-text v-if="toggle_body">{{ body }}</b-card-text>
    </b-card-body>
</template>
<script>
    export default {
        props: ['task', 'hide'],
        data() {
            return {
                name: this.task.name,
                body: this.task.body,
                switch_icon: 'on',
                toggle_body: true,
            }
        },
        mounted() {
            const object = this;
            this.$root.$on('task-updated', (response) => {
                if(object.id === response.data.id)
                {
                    object.name = response.data.name;
                }
            })
        },
        methods: {
            toggleBody()
            {
                this.toggle_body = ! this.toggle_body;
                this.toggleIcon();
            },
            toggleIcon()
            {
                if(this.switch_icon === 'on')
                    this.switch_icon = 'off';
                else
                    this.switch_icon = 'on';
            }
        },
    }
</script>
