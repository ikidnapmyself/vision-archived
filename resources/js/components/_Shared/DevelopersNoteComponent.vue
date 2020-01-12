<template>
    <span>
        <b-link id="popover-3">
            <i class="fa fa-comment-dots"></i>
        </b-link>
        <b-popover target="popover-3" triggers="hover focus" placement="top">
            <template v-slot:title>
                {{ $t('components.task.developers-note.Developers Note') }}
            </template>
            {{ note }}
        </b-popover>
    </span>
</template>

<script>
    export default {
        props: ['note'],
    }
</script>
