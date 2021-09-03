<template>
	<div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <Login/>   
            </div>
        </div>
    </div>
</template>

<script>
    import Login from '@/components/auth/Login.vue'
    export default {
        components:{
            Login
        },
        data() {
            return {

            }
        },
    };
</script>

<style lang="css" scoped>
</style>
