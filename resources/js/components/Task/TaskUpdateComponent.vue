<template>
    <b-card-body>
        <b-card-title>
            <i class="fa fa-wrench"></i>
            {{ $t('components.task.tab-edit.title') }}
        </b-card-title>
        <b-form @submit="onSubmit" @reset="onReset">
            <b-form-group
                :label="$t('components.task.tab-edit.Task')"
                label-for="input-1"
                :description="$t('components.task.tab-edit.Task Description')"
            >
                <b-form-input
                    v-model="form.name"
                    type="text"
                    :state="nameState"
                    required
                    :placeholder="$t('components.task.tab-edit.Task')"
                ></b-form-input>
            </b-form-group>

            <b-form-group
                :label="$t('components.task.tab-edit.Body')"
                label-for="input-1"
                :description="$t('components.task.tab-edit.Body Description')"
            >
                <b-form-textarea
                    v-model="form.body"
                    :placeholder="$t('components.task.tab-edit.Body')"
                    rows="3"
                    max-rows="6"
                ></b-form-textarea>
            </b-form-group>
            <b-button type="submit" variant="primary">
                {{ $t('components.task.tab-edit.Update') }}
            </b-button>
            <b-button type="reset" variant="danger">
                {{ $t('components.task.tab-edit.Reset') }}
            </b-button>
        </b-form>
    </b-card-body>
</template>
<script>
    export default {
        props: ['task'],
        data() {
            return {
                form: this.task,
            }
        },
        mounted() {
            this.events();
        },
        methods: {
            events() {
                this.$root.$on('task-' + this.task.id, (response) => {
                    this.form = response;
                });
            },
            toaster(message, variant = null, title = null) {
                this.$bvToast.toast(this.$t(message), {
                    title: this.$t(`components.toaster.${variant || 'default'}`),
                    variant: variant,
                    solid: true
                })
            },
            onSubmit(evt) {
                evt.preventDefault()
                this.$nextTick(() => {
                    this.$axios.put('/task/' + this.task.id, this.form)
                        .then(function (response) {
                            this.form = response.data;
                            this.toaster('components.task.tab-edit.Updated', 'success')
                            this.$root.$emit('task-' + this.task.id, this.form);
                        })
                        .catch(function (error) {
                            this.toaster('components.task.tab-edit.Failed', 'danger')
                        });
                })
            },
            onReset(evt) {
                evt.preventDefault()
                this.form.name = this.task.name
                this.form.body = this.task.body
            }
        },
        computed: {
            nameState() {
                return this.form.name.length >= 6
            }
        },
    }
</script>
