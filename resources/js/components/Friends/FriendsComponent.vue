<template>
    <div>
        <b-pagination
            v-model="currentPage"
            :total-rows="items.total"
            :per-page="items.per_page"
            aria-controls="tasks-list"
            align="center"
            @change="onChange"
        ></b-pagination>
        <b-list-group>
            <b-list-group-item
                class="flex-column align-items-start"
                href="#"
                v-for="item in items"
            >
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small>3 days ago</small>
                </div>

                <p class="mb-1">
                    Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
                </p>

                <small>Donec id elit non mi porta.</small>
            </b-list-group-item>
        </b-list-group>
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
        data: () => {
            return {
                currentPage: 1,
                items: [],
            }
        },
        mounted(){
            this.load()
        },
        methods: {
            load(page) {
                if('undefined' !== typeof page)
                    this.currentPage = parseInt(page);
                else
                    this.currentPage = 1;

                this.$axios.get('friendship/list?page=' + page)
                    .then((response) => {
                        this.currentPage = response.data.current_page;
                        this.items = response.data;
                    })
                    .catch((error) => {
                        this.connectionErrorRetry++;
                    });
            },
            onChange(page) {
                this.load(page)
            },
        }
    }
</script>

<style scoped>

</style>
