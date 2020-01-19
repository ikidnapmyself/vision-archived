<template>
    <skeleton class="mb-3" theme="opacity" style="width:100%" shape="radius" bg-color="#dcdcdc">
        <row>
            <i-col :span="1">
                <tb-skeleton :aspect-ratio="1" duration="1">
                </tb-skeleton>
            </i-col>
            <i-col :span="10" class="ml-4">
                <tb-skeleton :aspect-ratio=".1" duration="1">
                </tb-skeleton>
            </i-col>
            <i-col :span="1" class="ml-4">
                <tb-skeleton :aspect-ratio="1" duration="1">
                </tb-skeleton>
            </i-col>
            <i-col :span="1" class="ml-4">
                <tb-skeleton :aspect-ratio="1" duration="1">
                </tb-skeleton>
            </i-col>
        </row>
    </skeleton>
</template>
<script>

</script>
