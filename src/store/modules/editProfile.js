import { appAxios } from "@/utils/appAxios";
import CryptoJs from "crypto-js";
import { notify } from "@kyvg/vue3-notification";
import router from '../../router'
export default ({
	state: {
		isLoading:false,
		editError:[],
		passwordError:[],
		form:{
			currentPassword:{
				value:null,
				error:[],
			},
			password:{
				value:null,
				error:[],
			},
			password_confirmation:{
				value:null,
				error:[],
			},
		}
	},

	getters:{
		_EditLoading : (state) => state.isLoading,
		_EditError : (state) => state.editError,
		_PasswordError : (state) => state.passwordError,
		_PasswordForm : (state) => state.form,
	},
	
	actions: {
		editProfile(commit,form){
			commit.state.isLoading = true
			appAxios.post('/account/edit', form)
			.then(()=>{
				notify({
					type:'success',
					title:'Successfully Updated.'
				})
				location.reload();
			})
			.catch(err=>{
				notify({
					type:'error',
					title:"Didn't updated."
				})
				commit.state.editError = err.response.data.errors
				console.log(err.response.data.errors)
			})
			.finally(()=>{
				commit.state.isLoading = false
			})
		},
		updateImage(commit,image){
			commit.state.isLoading = true
			const formData = new FormData();
			formData.append('image', image)
			appAxios.post('/account/edit/updateimage',formData)
			.then(()=>{
				commit.getters._User.image = URL.createObjectURL(image)
			})
			.catch(err=>{
				commit.state.editError = err.response.data.errors
			})
			.finally(()=>{
				commit.state.isLoading = false
			})
		},
		sendEmailCode(commit,form){
			commit.state.isLoading = true
			appAxios.post('/sendmailcode',{
				email:form.email
			})
			.then(()=>{
				notify({
					type:'success',
					title:'Verification link successfully sent.'
				})
			})
			.catch(()=>{
				notify({
					type:'error',
					title:"Verification link didn't sent."
				})
			})
			.finally(()=>{
				commit.state.isLoading = false
			})
		},
		verifyEmail(commit,code){
			appAxios.post('/verifyemail', {
				code:code,
			})
			.then(()=>{
				notify({
					type:'success',
					title:"Email successfully verified redirecting..."
				})
				router.push({
					name:'AccountEdit',
				})
				commit.getters._User.isEmailVerified = true
			})
			.catch(()=>{
				notify({
					type:'error',
					title:"Verification code is wrong."
				})
				router.push({
					name:'AccountEdit'
				})
			})
		},
		changePassword(commit,form){
			commit.state.isLoading = true
			appAxios.post('/account/password/change',{
				currentPassword:CryptoJs.SHA256(form.currentPassword).toString(),
				password:CryptoJs.SHA256(form.password).toString(),
				password_confirmation:CryptoJs.SHA256(form.password_confirmation).toString(),
			})
			.then(()=>{
				
				notify({
					type:'success',
					title:'Password successfully updated.',
				})

				commit.state.form.currentPassword.value=null
				commit.state.form.password.value=null
				commit.state.form.password_confirmation.value=null
				commit.state.form.currentPassword.error=[]
				commit.state.form.password.error=[]
				commit.state.form.password_confirmation.error=[]
			})
			.catch(err=>{
				commit.state.form.currentPassword.value=null
				commit.state.form.password.value=null
				commit.state.form.password_confirmation.value=null
				commit.state.form.currentPassword.error=[]
				commit.state.form.password.error=[]
				commit.state.form.password_confirmation.error=[]
				commit.state.passwordError = err.response.data.errors

				notify({
					type:'error',
					title:"Password didn't updated.",
				})

			})
			.finally(()=>{
				commit.state.isLoading = false
			})
		}
	},
	
	mutations:{

	},
})