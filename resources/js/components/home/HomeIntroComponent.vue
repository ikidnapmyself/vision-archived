<template>
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">{{ $t('home.hello', {Name: user.name}) }}</h1>
            <p>{{ $t('home.Intro') }}</p>
            <p>
                <b-link class="btn btn-primary btn-lg" href="task/create" role="button">
                    <i class="fa fa-thumbtack"></i>
                    {{ $t('home.Create Task') }}
                </b-link>
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data: function() {
            return {
                //task: this.model.id,
            }
        },
        mounted() {
            //
        },
    }
</script>
