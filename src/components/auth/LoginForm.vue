<template>
	<div>
		<form @submit.prevent="login(this.form)">
			<div class="form-group">
				<small for="email" class="text-muted">Email</small>
				<input type="text" class="form-control form-control-sm" placeholder="Enter Email" v-model="form.email">
				<small v-if="_LoginError.email" class="text-danger" v-text="_LoginError.email[0]"></small>
			</div>

			<div class="form-group">
				<small for="password" class="text-muted">Password</small>
				<input type="password" class="form-control form-control-sm" placeholder="Enter Password" id="password" v-model="form.password">
				<small v-if="_LoginError.password" class="text-danger" v-text="_LoginError.password[0]"></small>
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-sm my-2" style="width: 100%;" :disabled="!form.email || !form.password">Login</button>
			</div>
		</form>
		<div class="forgot password d-flex justify-content-between">
			<small></small>
			<small class="text-muted"><a href="#" class="text-primary text-decoration-none">Forgot Password?</a></small>
		</div>
	</div>
</template>

<script>
	import { mapActions,mapGetters } from 'vuex'
	export default {
		data() {
			return {
				form:{
					email:null,
					password:null,
				},
			}
		},
		computed:{
			...mapGetters(['_LoginError'])
		},
		methods:{
			...mapActions(['login']),
			
		}
	}
</script>

<style lang="css" scoped>
.form-group{
	margin: 10px 0;
}
</style>
