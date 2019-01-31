<template>
</template>
<script>
    export default {
        props: {
            type: {
                type: String,
                required: true
            },
            text: {
                type: String,
                required: true
            },
            title: {
                type: String,
                required: true
            }
        },
        mounted: function () {
            this.$notify({
                title: this.title,
                message: this.text,
                type: this.type
            });
        }
    }
</script>
