<template>
    <div>
        <!-- Control buttons-->
        <div class="text-center" v-if="tabs.length > 1">
            <b-button-group class="mt-2">
                <b-button @click="tabIndex--">Previous</b-button>
                <b-button @click="tabIndex++">Next</b-button>
            </b-button-group>

            <div class="text-muted">Current Tab: {{ tabIndex }}</div>
        </div>
        <b-card no-body>
            <b-tabs v-model="tabIndex" card lazy>
                <!-- Render Tabs, supply a unique `key` to each tab -->
                <b-tab v-for="i in tabs" :key="'dyn-tab-' + i" :title="'Tab ' + i" no-body lazy>
                    <board-component></board-component>
                </b-tab>

                <!-- New Tab Button (Using tabs-end slot) -->
                <template v-slot:tabs-end>
                    <b-nav-item @click.prevent="newTab" href="#">
                        <i class="fa fa-plus"></i>
                    </b-nav-item>
                </template>

                <!-- Render this if no tabs -->
                <template v-slot:empty>
                    <div class="text-center text-muted">
                        There are no open tabs<br>
                        Open a new tab using the <b>+</b> button above.
                    </div>
                </template>
            </b-tabs>
        </b-card>
        <!-- Control buttons-->
        <div class="text-center" v-if="tabs.length > 1">
            <b-button-group class="mt-2">
                <b-button @click="tabIndex--">Previous</b-button>
                <b-button @click="tabIndex++">Next</b-button>
            </b-button-group>

            <div class="text-muted">Current Tab: {{ tabIndex }}</div>
        </div>
    </div>
</template>
<script>
    export default {
        data: function() {
            return {
                tabCounter: 0,
                tabIndex: 1,
                tabs: [],
            }
        },
        mounted(){
            //
        },
        methods: {
            closeTab(x) {
                for (let i = 0; i < this.tabs.length; i++) {
                    if (this.tabs[i] === x) {
                        this.tabs.splice(i, 1)
                    }
                }
            },
            newTab() {
                this.tabs.push(this.tabCounter++)
            }
        },
    }
</script>
