<template>
    <div class="overflow-auto">
        <b-pagination
            v-model="tasks.current_page"
            :total-rows="tasks.total"
            :per-page="tasks.per_page"
            aria-controls="tasks-table"
            align="center"
        ></b-pagination>

        <task-component
            id="tasks-table"
            v-for="task in items"
            :key="task.id"
            :task="task">
        </task-component>

        <b-pagination
            v-model="tasks.current_page"
            :total-rows="tasks.total"
            :per-page="tasks.per_page"
            aria-controls="tasks-table"
            align="center"
        ></b-pagination>
    </div>
</template>
<script>
    export default {
        props: ['tasks'],
        created() {
            this.$root.$on('bv::pagination::change', this.onChange)
        },
        data: function() {
            return {
                items: this.tasks.data
            }
        },
        mounted(){
            //
        },
        methods: {
            onChange(page) {
                console.log(1321321)
                console.log(page)
            }
        }
    }
</script>
