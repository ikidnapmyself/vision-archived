<template>
    <div>
        <connection-error-component :times="connectionErrorRetry" :url="url"></connection-error-component>
        <b-pagination
            v-model="currentPage"
            :total-rows="items.total"
            :per-page="items.per_page"
            aria-controls="tasks-list"
            align="center"
            @change="onChange"
        ></b-pagination>

        <div id="tasks-list">
            <task-sketelon-component v-if="preload" v-for="index in 15" :key="index"></task-sketelon-component>

            <task-component
                v-if="!preload"
                v-for="task in items.data"
                :key="task.id"
                :collapse="true"
                :task="task">
            </task-component>
        </div>

        <b-pagination
            v-model="currentPage"
            :total-rows="items.total"
            :per-page="items.per_page"
            aria-controls="tasks-list"
            align="center"
            @change="onChange"
        ></b-pagination>
    </div>
</template>
<script>
    export default {
        created() {
            this.$root.$on('refresh-tasks', (response) => {
                this.load(this.currentPage)
            })
        },
        data: function() {
            return {
                connectionErrorRetry: 0,
                currentPage: 1,
                items: [],
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
                this.$axios.get(this.url)
                       .then((response) => {
                        this.currentPage = response.data.current_page;
                        this.items = response.data;
                        this.preload = false;
                    })
                    .catch((error) => {
                        this.connectionErrorRetry++;
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
