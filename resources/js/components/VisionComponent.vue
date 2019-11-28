<template>
    <div class="d-block"></div>
</template>
<script>
    export default {
        mounted() {
            $(this.$el).queryBuilder({
                filters: Filters
            });
        }
    }
</script>
