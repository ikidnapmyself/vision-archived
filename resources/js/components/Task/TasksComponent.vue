<template>
    <div class="overflow-auto">
        <connection-error-component :show="connectionError"></connection-error-component>
        <b-pagination
            v-model="currentPage"
            :total-rows="tasks.total"
            :per-page="tasks.per_page"
            aria-controls="tasks-table"
            align="center"
            @change="onChange"
        ></b-pagination>

        <task-component
            id="tasks-table"
            v-for="task in items"
            :key="task.id"
            :task="task">
        </task-component>

        <b-pagination
            v-model="currentPage"
            :total-rows="tasks.total"
            :per-page="tasks.per_page"
            aria-controls="tasks-table"
            align="center"
            @change="onChange"
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
                connectionError: false,
                currentPage: this.tasks.current_page,
                items: this.tasks.data,
            }
        },
        mounted(){
            this.load(1)
        },
        methods: {
            load(page) {
                this.connectionError = ! this.connectionError;
                if(typeof page === undefined)
                    page = 1;
                let object = this;

                console.log(page)
                console.log('task/list?page=' + page)

                this.$axios.get('task/list?page=' + page)
                       .then(function (response) {
                        console.log(response)
                        console.log('current page: '+response.data.current_page)
                        object.currentPage = response.data.current_page;
                        object.items = response.data.data;
                    })
                    .catch(function (error) {
                        object.toaster('components.task.tasks.Could not load', 'danger');
                    });
            },
            onChange(page) {
                this.load(page)
            }
        }
    }
</script>
