<template>
    <div class="overflow-auto">
        <connection-error-component :times="connectionErrorRetry" :url="url"></connection-error-component>
        <b-pagination
            v-model="currentPage"
            :total-rows="users.total"
            :per-page="users.per_page"
            aria-controls="users-list"
            align="center"
            @change="onChange"
        ></b-pagination>

        <div id="users-list">
            <user-sketelon-component v-if="preload" v-for="index in 15" :key="index"></user-sketelon-component>

            <user-component
                v-if="!preload"
                v-for="user in items"
                :key="user.id"
                :collapse="true"
                :user="user">
            </user-component>
        </div>

        <b-pagination
            v-model="currentPage"
            :total-rows="users.total"
            :per-page="users.per_page"
            aria-controls="users-list"
            align="center"
            @change="onChange"
        ></b-pagination>
    </div>
</template>
<script>
    export default {
        props: ['users'],
        created() {
            this.$root.$on('refresh-users', (response) => {
                this.load(this.currentPage)
            })
        },
        data: function() {
            return {
                connectionErrorRetry: 0,
                currentPage: this.users.current_page,
                items: this.users.data,
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

                this.url = 'user/list?page=' + currentUrl;
            },
        },
    }
</script>
