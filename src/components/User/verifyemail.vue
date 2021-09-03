<template>
	<div class="container">
		<div class="row">
			<div class="body text-center my-5">
				<h2 class="text-success">VERIFYING</h2>
				<h4>Please Wait...</h4>
			</div>
		</div>
	</div>
</template>
<script>
	import {mapGetters,mapActions} from 'vuex'
	export default {
		methods:{
			...mapActions(['verifyEmail'])
		},
		computed:{
			...mapGetters([])
		},
		created(){
			this.verifyEmail(this.$route.params.code)
		}
	}
</script>