<template>
    <div id="echo-test">
        Echo test
    </div>
</template>

<script>
    export default {
        props: [],
        data: () => ({
            tag: "[echo-test]",
        }),
        methods: {
            startListening() {
                Echo.channel('App')
                    .listen('TestEvent', (e) => {
                        console.log(e);
                    });
            },
        },
        mounted() {
            this.startListening();
        },
    }
</script>

<style lang="scss">
    #echo-test {

    }
</style>