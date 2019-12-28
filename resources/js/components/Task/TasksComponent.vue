<template>
    <div class="overflow-auto">
        <connection-error-component :times="connectionErrorRetry" :url="url"></connection-error-component>
        <b-pagination
            v-model="currentPage"
            :total-rows="tasks.total"
            :per-page="tasks.per_page"
            aria-controls="tasks-list"
            align="center"
            @change="onChange"
        ></b-pagination>

        <div id="tasks-list">
            <task-sketelon-component v-if="preload" v-for="index in 15" :key="index"></task-sketelon-component>

            <task-component
                v-if="!preload"
                v-for="task in items"
                :key="task.id"
                :collapse="true"
                :task="task">
            </task-component>
        </div>

        <b-pagination
            v-model="currentPage"
            :total-rows="tasks.total"
            :per-page="tasks.per_page"
            aria-controls="tasks-list"
            align="center"
            @change="onChange"
        ></b-pagination>
    </div>
</template>
<script>
    export default {
        props: ['tasks'],
        created() {
            this.$root.$on('refresh-tasks', (response) => {
                this.load(this.currentPage)
            })
        },
        data: function() {
            return {
                connectionErrorRetry: 0,
                currentPage: this.tasks.current_page,
                items: this.tasks.data,
                preload: true,
                url: '',
            }
        },
        mounted(){
            this.load()
        },
        methods: {
            pagination(page) {
                if('undefined' !== typeof page)
                    this.currentPage = parseInt(page);
                else
                    this.currentPage = 1;

                return this.currentPage;
            },
            load(page) {
                this.getUrl(page);
                this.preload = true;
                let object = this;
                this.$axios.get(this.url)
                       .then(function (response) {
                        object.currentPage = response.data.current_page;
                        object.items = response.data.data;
                        object.preload = false;
                    })
                    .catch(function (error) {
                        object.connectionErrorRetry++;
                    });
            },
            onChange(page) {
                this.load(page)
            },
            getUrl(page) {
                let currentUrl = this.pagination(page);

                this.url = 'task/list?page=' + currentUrl;
            },
        },
    }
</script>
