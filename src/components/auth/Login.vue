<template>
	<loader v-if="_LoginLoading" object="#fff" color1="#ffffff" color2="#17fd3d" size="4" speed="5" bg="#343a40" objectbg="#999793" opacity="80" name="spinning"></loader>
	<div class="register border shadow m-3 p-4">
		<div class="register-header border-bottom py-3 mb-3">
			<div class="logo text-center font-bold mb-4">
				<h3>LOGO</h3>
			</div>
		</div>
		<div class="register-body">
			<LoginForm />
		</div>
	</div>
	<div class="login-link border shadow m-3 p-3 text-center">
		<small><router-link :to="{name:'Register'}" style="text-decoration: none;">Register</router-link></small>
	</div>
</template>
<script>
	import LoginForm from './LoginForm.vue'
	import { mapGetters } from 'vuex'
	export default {
		components:{
			LoginForm
		},
		computed:{
			...mapGetters(['_LoginLoading'])
		}
	}
</script>