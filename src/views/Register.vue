<template>
	<loader v-if="_RegisterLoading" object="#fff" color1="#ffffff" color2="#17fd3d" size="4" speed="5" bg="#343a40" objectbg="#999793" opacity="80" name="spinning"></loader>
	<div class="container">
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<div class="register border shadow m-3 p-4">
					<div class="register-header border-bottom py-3 mb-3">
						<div class="logo text-center font-bold mb-4">
							<h3>LOGO</h3>
						</div>
						<strong class="text-muted text-center">
							Register to see photos and videos from your friends.
						</strong>
					</div>
					<div class="register-body">
						<RegisterForm/>
					</div>
				</div>
				<div class="login-link border shadow m-3 p-3 text-center">
					<small>Have an account? <a href="#" style="text-decoration: none;">Log in</a></small>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import { mapGetters } from 'vuex'
	import RegisterForm from '../components/auth/RegisterForm.vue'
	export default{
		components:{
			RegisterForm
		},
		computed:{
			...mapGetters(['_RegisterLoading'])
		}

	}	
</script>