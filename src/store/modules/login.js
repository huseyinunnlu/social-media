import { appAxios } from "@/utils/appAxios";
import CryptoJs from "crypto-js";
import { notify } from "@kyvg/vue3-notification";
import router from '../../router'

export default ({
	state: {
		loginError:[],
		isLoading:false,
		isAuth:false,
		user:[],
	},

	getters:{
		_LoginError : (state) => state.loginError,
		_LoginLoading : (state) => state.isLoading,
		_LogoutLoading : (state) => state.isLoading,
		_UserLoading : (state) => state.isLoading,
		_isAuth: (state) => state.isAuth,
		_User: (state) => state.user,
	},

	actions:{
		login(commit,form){
			commit.state.isLoading = true
			const hashedpassword = CryptoJs.SHA256(form.password).toString();
			appAxios.post('/login', {
				email:form.email,
				password:hashedpassword,
			})
			.then(res=>{
				commit.state.isAuth = true
				commit.loginError = []
				let token = res.data.token.token;
				localStorage.setItem('token',token)
				notify({
					type:'success',
					title:'Successfully Logged in '
				})
				router.push({
					name:'Index'
				})
				location.reload();
			})
			.catch(err=>{
				commit.state.loginError = err.response.data.errors
				notify({
					type:'error',
					title:"Didn't logged in.",
				})
				localStorage.setItem('token','')
			})
			.finally(()=>{
				commit.state.isLoading = false
			})
		},
		logout(commit){
			commit.state.isLoading = true
			appAxios.post('/logout')
			.then(()=>{
				notify({
					type:'success',
					title:"Successfully logged out.",
				})
				localStorage.setItem('token','')
				location.reload();
			})
			.catch(()=>{
				notify({
					type:'error',
					title:"Didn't logged out.",
				})
			})
			.finally(()=>{
				commit.state.isLoading = false
			})
		},
		getUser(commit){
			commit.state.isLoading = true
			appAxios.get('/user')
			.then(res=>{
				commit.state.isAuth = true
				commit.state.user = res.data
			})
			.catch(()=>{
				commit.state.isAuth = false
				commit.state.user = []
				localStorage.setItem('token','')
				router.push({
					name:'Welcome'
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