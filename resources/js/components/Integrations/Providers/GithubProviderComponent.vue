<template>
    <div>
        <b-list-group>
            <b-list-group-item v-for="(key, item) in requestScopes" class="border-0 flex-column align-items-start" :key="key">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 font-weight-bold">
                        <i class="fa fa-lock"></i>
                        {{ item }}
                    </h5>
                </div>
                <p class="mb-1">
                    {{ $t('integration.github.scopes.' + key) }}
                </p>
            </b-list-group-item>
        </b-list-group>
        <hr>
        <b-link
            class="text-secondary"
            href="https://developer.github.com/apps/building-oauth-apps/understanding-scopes-for-oauth-apps/#available-scopes"
        >
            <i class="fa fa-arrow-right"></i>
            {{ $t('integration.' + index + '.read more') }}
        </b-link>
        <br>
        <b-button
            class="mt-3"
            href="integrate/github"
            size="lg"
            variant="success"
        >
            <i :class="model.icon"></i>
            {{ $t('integration.integrate') }}
        </b-button>
    </div>
</template>

<script>
    export default {
        props: ['index', 'model'],
        data: function() {
            return {
                requestScopes: {
                    'public_repo': 'public_repo',
                    'read:user': 'read-user',
                    'read:org': 'read-org'
                },
            }
        },
        mounted() {
            //
        },
        methods: {
            //
        },
    }
</script>
