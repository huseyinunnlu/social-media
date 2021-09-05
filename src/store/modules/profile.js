import { appAxios } from "@/utils/appAxios";
//import CryptoJs from "crypto-js";
//import { notify } from "@kyvg/vue3-notification";
import router from '../../router'

export default ({
	state: {
		getUser:[],
		isLoading:false
	},

	getters:{
		_GetUser : (state) => state.getUser,
		_GetUserLoading : (state) => state.isLoading,
	},

	actions:{
		follow(commit,form){
			appAxios.post('/follow',form)
			.then(()=>{
				commit.state.getUser.isFollowing = true
			})
			.catch(err=>{
				console.log(err)
			})
		},
		unFollow(commit,form){
			appAxios.post('/unfollow',form)
			.then(()=>{
				if(commit.state.getUser.isFollowing == true){
					commit.state.getUser.isFollowing = false
				}
			})
			.catch(()=>{

			})
		},
		getProfileUser(commit,form){
			commit.state.isLoading = true
			appAxios.get('/user/'+form)
			.then(res=>{
				if(res.data.id == commit.getters._User.id){
					router.push({name:'MyProfile'})
				}
				commit.state.getUser = res.data
				if (commit.state.getUser.followers.find(({ follower_id }) => follower_id === commit.getters._User.id.toString())) {
					commit.state.getUser.isFollowing = true
				}
			})
			.catch(()=>{
				router.push({name:'404'});
			})
			.finally(()=>{
				commit.state.isLoading = false
			})
		}
	},

	mutations:{},
});