import { appAxios } from "@/utils/appAxios";
import CryptoJs from "crypto-js";
import { notify } from "@kyvg/vue3-notification";
import router from '../../router'
export default ({
	state: {
		registerError:[],
		isLoading:false,
	},

	getters:{
		_RegisterError : (state) => state.registerError,
		_RegisterLoading : (state) => state.isLoading,
	},

	actions:{
		register(commit,form){
			commit.state.isLoading = true
			const hashedpassword = CryptoJs.SHA256(form.password.value).toString();
			const hashedpassword_confirmation = CryptoJs.SHA256(form.password_confirmation).toString();
			appAxios.post('/register', {
				email:form.email,
				username:form.username,
				fullname:form.fullname,
				password:hashedpassword,
				password_confirmation:hashedpassword_confirmation
			})
			.then(()=>{
				commit.registerError = []
				notify({
					type:'success',
					title:'Successfully Registered Redirecting...'
				})
				router.push({
					name:'Welcome'
				})
			})
			.catch(err=>{
				commit.state.registerError = err.response.data.errors
				notify({
					type:'error',
					title:"Didn't registered.",
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