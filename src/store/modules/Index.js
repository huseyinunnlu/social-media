import { appAxios } from "@/utils/appAxios";
//import CryptoJs from "crypto-js";
//import { notify } from "@kyvg/vue3-notification";
//import router from '../../router'

export default({
	state:{
		posts:[],
		suggestedAccs:[],
		isLoading:false,
	},

	getters:{
		_SuggestedAccs : (state) => state.suggestedAccs,
		_IndexPosts : (state) => state.posts,
	},

	actions:{
		getSuggestedAccs(commit){
			appAxios.get('/suggestedaccs')
			.then(res=>{
				commit.state.suggestedAccs = res.data
			})
			.catch(()=>{
			})
		},
		getPosts(commit){
			appAxios.get('/getposts')
			.then(res=>{
				commit.state.posts = res.data
			})
			.catch(()=>{
			})
		}
	},

	mutations:{

	},
})