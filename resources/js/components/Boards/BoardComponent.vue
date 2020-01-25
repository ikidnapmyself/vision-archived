<template>
    <div>
        <b-card no-body>
            <b-tabs
                v-model="tabIndex"
                pills card vertical end
            >
                <b-tab
                    no-body
                    lazy
                    v-for="(status, index) in statuses"
                    :key="status"
                >
                    <template v-slot:title>
                        <i :class="icons[status]"></i>
                        {{ $t('status.' + status) }}
                    </template>
                    <b-card-header :class="'rounded-0 border-0 bg-' + currentColor(status) + ' text-' + currentTitleColor(status)">
                        <h3 class="p-2 m-0">
                            <i :class="icons[status]"></i>
                            {{ $t('status.' + status) }}
                        </h3>
                    </b-card-header>

                </b-tab>
            </b-tabs>
        </b-card>
    </div>
</template>
<script>
    export default {
        data: function() {
            return {
                colors: this.$Application.statuses.colors,
                connectionErrorRetry: 0,
                icons: this.$Application.statuses.icons,
                items: [],
                preload: true,
                statuses: this.$Application.statuses.list,
                tabIndex: 0,
                tabs: [],
                url: 'task/list',
            }
        },
        mounted(){
            //this.load();
        },
        methods: {
            closeTab(x) {
                for (let i = 0; i < this.tabs.length; i++) {
                    if (this.tabs[i] === x) {
                        this.tabs.splice(i, 1)
                    }
                }
            },
            currentColor: function (status) {
                return this.colors[status];
            },
            currentTitleColor: function (status) {
                if(this.colors[status] === 'warning' || this.colors[status] === 'muted')
                    return 'dark';
                else
                    return 'light';
            },
            load() {
                this.preload = true;
                this.$axios.get(this.url)
                    .then((response) => {
                        this.items = response.data;
                        this.preload = false;
                    })
                    .catch((error) => {
                        this.connectionErrorRetry++;
                    });
            }
        },
    }
</script>
