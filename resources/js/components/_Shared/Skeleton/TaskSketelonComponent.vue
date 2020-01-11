<template>
    <skeleton class="mb-3" theme="opacity" style="width:100%" shape="radius" bg-color="#dcdcdc">
        <row>
            <i-col :span="1">
                <tb-skeleton :aspect-ratio="1" shape="circle" class="ml-3">
                </tb-skeleton>
            </i-col>
            <i-col :span="16">
                <row>
                    <i-col :span="16" class="ml-4" duration=".6">
                        <tb-skeleton :aspect-ratio=".1"></tb-skeleton>
                    </i-col>
                </row>
            </i-col>
        </row>
    </skeleton>
</template>
<script>

</script>
