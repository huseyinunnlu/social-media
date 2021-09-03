<template>
	<loader v-if="_UserLoading" object="#fff" color1="#ffffff" color2="#17fd3d" size="4" speed="5" bg="#343a40" objectbg="#999793" opacity="80" name="spinning"></loader>
	<notifications position="top right" class="mt-4 mx-4"/>
	<div class="container">
		<div class="row">
			<router-view/>
		</div>
	</div>
</template>
<script>
	import { mapActions,mapGetters } from 'vuex'
	export default {
		methods:{
			...mapActions(['getUser'])
		},
		computed:{
			...mapGetters(['_UserLoading'])
		},
		created(){
			this.getUser();
		}
	}
</script>
<style>
#app {
	font-family: Avenir, Helvetica, Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}
</style>
