<template>
    <div role="tablist">
        <b-card
            class="mb-1"
            no-body
            v-for="(integration, index) in integrations"
            :key="index"
        >
            <b-card-header
                class="d-flex align-items-center p-3 my-0 bg-light rounded shadow-sm"
                header-tag="header"
                role="tab"
                v-b-toggle="'accordion-' + index"
            >
                <i :class="integration.icon + ' fa-3x mr-3'"></i>
                <div class="lh-100">
                    <h5 class="mb-0 lh-100">
                        {{ $t('integration.' + index + '.name') }}
                        <b-badge v-if="index !== 'github'">soon</b-badge>
                    </h5>
                <i :id="'toggle-' + index" class="fa fa-toggle-off"></i>
            </div>
            </b-card-header>
            <b-collapse
                :id="'accordion-' + index"
                accordion="my-accordion"
                role="tabpanel"
            >
                <b-card-body>
                <component
                    v-bind:is="index + '-provider-component'"
                    :index="index"
                    :model="integration"
                >
                </component>
                </b-card-body>
            </b-collapse>
        </b-card>
    </div>
</template>
<script>
    export default {
        data: function() {
            return {
                integrations: {
                    discord: {icon: 'fab fa-discord'},
                    github: {icon: 'fab fa-github'},
                    medium: {icon: 'fab fa-medium'},
                    linkedin: {icon: 'fab fa-linkedin'},
                    hue: {icon: 'fa fa-lightbulb'},
                    slack: {icon: 'fab fa-slack'},
                    spotify: {icon: 'fab fa-spotify'},
                },
                url: '/integration/list'
            }
        },
        mounted(){
            this.load();
        },
        methods: {
            async load() {
                this.$axios.get(this.url)
                    .then((response) => {
                        response.data.map((item) => {
                            document.getElementById('accordion-' + item.provider_name).remove();
                            let provider  = document.getElementById('toggle-' + item.provider_name);
                            provider.classList.remove('fa-toggle-off');
                            provider.classList.add('fa-toggle-on');
                            provider.classList.add('text-success');
                        });
                    })
                    .catch((error) => {

                    });
            },
        },
    }
</script>
