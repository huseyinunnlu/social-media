import { appAxios } from "@/utils/appAxios";
//import CryptoJs from "crypto-js";
//import { notify } from "@kyvg/vue3-notification";
//import router from '../../router'

export default({
	state:{
		suggestedAccs:[],
		isLoading:false,
	},

	getters:{
		_SuggestedAccs : (state) => state.suggestedAccs,
	},

	actions:{
		getSuggestedAccs(commit){
			appAxios.get('/suggestedaccs')
			.then(res=>{
				commit.state.suggestedAccs = res.data
			})
			.catch(err=>{
				console.log(err)
			})
		},
		getPosts(){
			appAxios.get('/getposts')
			.then(res=>{
				console.log(res)
			})
			.catch(err=>{
				console.log(err)
			})
		}
	},

	mutations:{

	},
})