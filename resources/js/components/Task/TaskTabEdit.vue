<template>
    <div class="text-left">
        <b-form @submit="onSubmit" @reset="onReset">
            <b-form-group
                :label="$t('components.task.task-tab-edit.Task')"
                label-for="input-1"
                :description="$t('components.task.task-tab-edit.Task Description')"
            >
                <b-form-input
                    v-model="form.name"
                    type="text"
                    :state="nameState"
                    required
                    :placeholder="$t('components.task.task-tab-edit.Task')"
                ></b-form-input>
            </b-form-group>

            <b-form-group
                :label="$t('components.task.task-tab-edit.Body')"
                label-for="input-1"
                :description="$t('components.task.task-tab-edit.Body Description')"
            >
                <b-form-textarea
                    v-model="form.body"
                    :placeholder="$t('components.task.task-tab-edit.Body')"
                    rows="3"
                    max-rows="6"
                ></b-form-textarea>
            </b-form-group>
            <b-button type="submit" variant="primary">
                {{ $t('components.task.task-tab-edit.Update') }}
            </b-button>
            <b-button type="reset" variant="danger">
                {{ $t('components.task.task-tab-edit.Reset') }}
            </b-button>
        </b-form>
    </div>
</template>
<script>
    export default {
        props: ['task'],
        data() {
            return {
                form: {
                    name: this.task.name,
                    body: this.task.body,
                },
            }
        },
        methods: {
            toaster(message, variant = null, title = null) {
                this.$bvToast.toast(this.$t(message), {
                    title: this.$t(`components.toaster.${variant || 'default'}`),
                    variant: variant,
                    solid: true
                })
            },
            onSubmit(evt) {
                evt.preventDefault()
                const object = this;
                this.$nextTick(() => {
                    object.$axios.put('task/' + object.task.id, this.form)
                        .then(function (response) {
                            object.toaster('components.task.task-tab-edit.Updated', 'success')
                            object.$root.$emit('task-updated', response);
                        })
                        .catch(function (error) {
                            object.toaster('components.task.task-tab-edit.Failed', 'danger')
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
