<template>
    <b-card-body>
        <b-card-title>
            <b-media>
                <template v-slot:aside>
                    <qriously :value="model.url" :size="100" class="d-none d-lg-inline" />
                </template>
                <h5 class="mt-0">
                    <b-link :href="'task/' + model.id">
                        {{ model.name }}
                    </b-link>
                </h5>
                <p class="mb-0">
                    <b-button v-on:click="toggleFlag" variant="muted">
                        <i class="fa fa-flag" :class="'text-' + (model.flagged ? 'danger' : 'secondary')"></i>
                    </b-button>
                    <b-button :href="model.url" variant="muted" v-b-tooltip.hover :title="model.name">
                        <i class="fa fa-link"></i>
                    </b-button>
                    <b-button v-clipboard="model.url" variant="muted" v-b-tooltip.hover :title="$t('components.task.overview.Copy')">
                        <i class="fa fa-copy"></i>
                    </b-button>
                </p>
                <p class="mt-0">
                    <b-button variant="muted">
                        <date-time-component
                            :date="model.updated_at"
                        >
                        </date-time-component>
                    </b-button>
                </p>
            </b-media>
        </b-card-title>
        <hr v-if="model.body">
        <b-card-text>{{ model.body }}</b-card-text>
    </b-card-body>
</template>
<script>
    export default {
        props: ['task', 'hide'],
        data() {
            return {
                model: this.task,
                switch_icon: 'on',
            }
        },
        mounted() {
            this.events();
        },
        methods: {
            events() {
                this.$root.$on('task-' + this.task.id, (response) => {
                    this.model = response;
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
                this.$axios.put('/task/' + this.task.id, {flagged: !this.model.flagged})
                    .then((response) => {
                        this.model = response.data;
                        let message = this.model.flagged ? 'components.task.No Flag' : 'components.task.Flagged';
                        this.$root.$emit('task-' + this.model.id, this.model);
                        this.toaster(message, 'info', {
                            task_name: this.model.name
                        });
                    })
                    .catch((error) => {
                        this.toaster('components.task.Flag Failed', 'danger');
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
