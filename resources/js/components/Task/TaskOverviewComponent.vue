<template>
    <b-card-body>
        <b-card-title>
            <b-media>
                <template v-slot:aside>
                    <qriously :value="task.url" :size="100" class="d-none d-lg-inline" />
                </template>
                <h5 class="mt-0">
                    <b-link :href="'task/' + task.id">
                        {{ name }}
                    </b-link>
                </h5>
                <p>
                    <b-button v-on:click="toggleFlag" variant="muted">
                        <i class="fa fa-flag" :class="'text-' + (flagged ? 'danger' : 'secondary')"></i>
                    </b-button>
                    <b-button :href="task.url" variant="muted" v-b-tooltip.hover :title="name">
                        <i class="fa fa-link"></i>
                    </b-button>
                    <b-button v-clipboard="task.url" variant="muted" v-b-tooltip.hover :title="$t('components.task.overview.Copy')">
                        <i class="fa fa-copy"></i>
                    </b-button>
                </p>
            </b-media>
        </b-card-title>
        <hr v-if="body">
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
                flagged: this.task.flagged,
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
                        object.flagged = response.data.flagged;
                    }
                })
            },
            toaster(message, variant = null, vars = null, title = null) {
                this.$bvToast.toast(this.$t(message, vars), {
                    title: this.$t(`components.toaster.${variant || 'default'}`),
                    variant: variant,
                    solid: true
                })
            },
            toggleFlag: function () {
                let object = this;
                this.$axios.put('task/' + this.task.id, {flagged: !this.flagged})
                    .then(function (response) {
                        object.flagged = response.data.flagged;
                        let message = object.flagged ? 'components.task.No Flag' : 'components.task.Flagged';
                        object.$root.$emit('task-updated-' + object.task.id, response);
                        object.toaster(message, 'info', {
                            task_name: object.task.name
                        });
                    })
                    .catch(function (error) {
                        object.toaster('components.task.Flag Failed', 'danger');
                    });
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
