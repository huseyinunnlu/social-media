<template>
	<loader v-if="_EditLoading" object="#fff" color1="#ffffff" color2="#17fd3d" size="4" speed="5" bg="#343a40" objectbg="#999793" opacity="80" name="spinning"></loader>
	<div class="account-form my-4 mx-5 row col-md-8 offset-md-2 ">
		<form @submit.prevent="checkChangePassword">
			<div class="form-group row">
				<label class="col-sm-3" for="oldPassword">Current Password</label>
				<div class="col-sm-8">
					<input type="password" id="oldPassword" :class="_PasswordForm.currentPassword.error.length == 0 ? 'isValid' : 'is-invalid'" class="form-control form-control-sm" v-model="_PasswordForm.currentPassword.value">
					<small v-if="_PasswordError.currentPassword" v-text="_PasswordError.currentPassword[0]" class="text-danger"></small>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-3" for="password">New Password</label>
				<div class="col-sm-8">
					<input type="password" id="password" class="form-control form-control-sm" v-model="_PasswordForm.password.value">
					<small v-if="_PasswordForm.password.error.length > 0" v-text="_PasswordForm.password.error[0]" class="text-danger"></small>
					<small v-if="_PasswordError.password" v-text="_PasswordError.password[0]" class="text-danger"></small>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-3" for="password_confirmation">Confirm New Password</label>
				<div class="col-sm-8">
					<input type="password" id="password_confirmation" class="form-control form-control-sm" v-model="_PasswordForm.password_confirmation.value">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-3"></label>
				<div class="col-sm-8">
					<button :disabled="!_PasswordForm.password.value || !_PasswordForm.currentPassword.value || !_PasswordForm.password_confirmation.value" class="btn btn-success btn-sm">Change Password</button>
				</div>
			</div>
		</form>
	</div>
</template>
<script>
	import {mapGetters,mapActions} from 'vuex'
	export default {
		computed:{
			...mapGetters(['_PasswordForm','_EditLoading','_PasswordError'])
		},
		methods:{
			...mapActions(['changePassword']),
			checkChangePassword(){
				const regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/;
				this._PasswordForm.currentPassword.error = []
				this._PasswordForm.password.error = []
				this._PasswordForm.password_confirmation.error = []
				
				if(this._PasswordForm.password.value.length <= 8 || this._PasswordForm.password.value.length >= 25){
					this._PasswordForm.password.error.unshift('New password must be between 8 and 25 characters.')
				}

				if (!regex.test(this._PasswordForm.password.value)){
					this._PasswordForm.password.error.unshift('New password only must contains letter numbers.')
				}

				if (this._PasswordForm.currentPassword.error.length == 0 && this._PasswordForm.password.error.length == 0 && this._PasswordForm.password_confirmation.error.length == 0){
					this.changePassword({
						currentPassword:this._PasswordForm.currentPassword.value,
						password:this._PasswordForm.password.value,
						password_confirmation:this._PasswordForm.password_confirmation.value,
					});
				}
			}
		},
	}
</script>
<style>
.form-group {
	margin: 15px 0;
}
</style>	