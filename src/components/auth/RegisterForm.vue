<template>
	<div>
		<form @submit.prevent="checkRegister">
			<div class="form-group">
				<small for="email" class="text-muted">Email</small>
				<input type="text" class="form-control form-control-sm" :class="_RegisterError.email ? 'is-invalid' : ''" placeholder="Enter Email" v-model="form.email">
				<small v-if="_RegisterError.email" class="text-danger" v-text="_RegisterError.email[0]"></small>
			</div>
			<div class="form-group">
				<small for="fullname" class="text-muted">Full Name</small>
				<input type="text" class="form-control form-control-sm" :class="_RegisterError.fullname ? 'is-invalid' : ''" placeholder="Enter Fullname" id="fullname" v-model="form.fullname">
				<small v-if="_RegisterError.fullname" class="text-danger" v-text="_RegisterError.fullname[0]"></small>
			</div>
			<div class="form-group">
				<small for="username" class="text-muted">Username</small>
				<input type="text" class="form-control form-control-sm" :class="_RegisterError.username ? 'is-invalid' : ''" placeholder="Enter username" id="username" v-model="form.username">
				<small v-if="_RegisterError.username" class="text-danger" v-text="_RegisterError.username[0]"></small>
			</div>
			<div class="form-group">
				<small for="password" class="text-muted">Password</small>
				<input type="password" class="form-control form-control-sm" :class="form.password.errors.length > 0 ? 'is-invalid' : ''" placeholder="Enter Password" id="password" v-model="form.password.value">
				<div class="errors" v-if="form.password.errors.length > 0">
					<small class="text-danger" v-for="(error,index) in form.password.errors" v-text="error" :key="index"></small><br>
				</div>
				<small v-if="_RegisterError.password" class="text-danger" v-text="_RegisterError.password[0]"></small>
			</div>
			<div class="form-group">
				<small for="password_confirmation" class="text-muted">Confirm Password</small>
				<input type="password" class="form-control form-control-sm" id="password_confirmation" placeholder="Re-enter Password" v-model="form.password_confirmation">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-sm my-2" style="width: 100%;" :disabled="!form.email || !form.fullname || !form.username || !form.password || !form.password_confirmation">Register</button>
			</div>
		</form>
		<div class="terms px-3">
			<small class="text-muted">By registering, you agree to our <strong>Terms</strong> , <strong>Data Policy</strong></small>
		</div>
	</div>
</template>

<script>
	import { mapActions,mapGetters } from 'vuex'
	export default {
		data() {
			return {
				isRegister:false,
				form:{
					email:null,
					fullname:null,
					username:null,
					password:{
						value:null,
						errors:[],
					},
					password_confirmation:null,
				},
			}
		},
		computed:{
			...mapGetters(['_RegisterError'])
		},
		methods:{
			...mapActions(['register']),
			checkRegister(){
				let regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/;
				this.form.password.errors = []
				if (this.form.password.value.length <= 25 && this.form.password.value.length >= 8) {
					this.form.password.errors = []
				}else{
					this.form.password.errors.push('Password must be between 8 and 25 characters.')
				}
				if (!regex.test(this.form.password.value)){
					this.form.password.errors.push('Password only must contains letter numbers.')
				}
				if(!this.form.password.errors.length > 0){
					this.form.password.errors = []
					this.register(this.form)
				}
			}
		}
	}
</script>

<style lang="css" scoped>
.form-group{
	margin: 10px 0;
}
</style>
