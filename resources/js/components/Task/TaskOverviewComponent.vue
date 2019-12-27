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
        <b-card-text>{{ body }}</b-card-text>
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
            }
        },
        mounted() {
            this.onTaskUpdate();
        },
        methods: {
            onTaskUpdate()
            {
                const object = this;
                this.$root.$on('task-updated-' + this.task.id, (response) => {
                    if(object.task.id === response.data.id)
                    {
                        object.name = response.data.name;
                        object.body = response.data.body;
                    }
                })
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
