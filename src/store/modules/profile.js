import { appAxios } from "@/utils/appAxios";
//import CryptoJs from "crypto-js";
import { notify } from "@kyvg/vue3-notification";
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
				commit.state.getUser.followers_count++
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
				commit.state.getUser.followers_count--
			})
			.catch(()=>{

			})
		},
		removeFollow(commit,form){
			appAxios.post('/removefollower', form)
			.then(()=>{
				notify({
					type:'success',
					title:'Successfully removed.'
				})
			})
			.catch(err=>{
				console.log(err)
			})
		},
		getProfileUser(commit,form){
			commit.state.getUser = []
			commit.state.isLoading = true
			appAxios.get('/user/'+form)
			.then(res=>{
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