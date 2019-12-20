<template>
    <div>
        <h5 class="card-title">
            <b-link :href="'task/' + task.id">
                {{ name }}
            </b-link>
        </h5>
        <p class="card-text">{{ body }}</p>
    </div>
</template>
<script>
    export default {
        props: ['task'],
        data() {
            return {
                name: this.task.name,
                body: this.task.body,
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
        }
    }
</script>
