import { appAxios } from "@/utils/appAxios";
//import CryptoJs from "crypto-js";
import { notify } from "@kyvg/vue3-notification";
import router from '../../router'

export default ({
	state: {
		getUser:[],
		follower:[],
		follows:[],
		isLoading:false
	},

	getters:{
		_GetUser : (state) => state.getUser,
		_GetUserFollower : (state) => state.follower,
		_GetUserFollow : (state) => state.follows,
		_GetUserLoading : (state) => state.isLoading,
	},

	actions:{
		getFollowers(commit,form){
			appAxios.get('/getfollowers?user='+form.id+'&count='+12)
			.then(res=>{
				commit.state.follower = res.data
			})
			.catch(()=>{
				commit.state.follower = []
			})
		},
		getFollows(commit,form){
			appAxios.get('/getfollows?user='+form.id+'&count='+12)
			.then(res=>{
				commit.state.follows = res.data
			})
			.catch(()=>{
				commit.state.follows = []
			})
		},
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
			appAxios.post('/unfollow',form)
			.then(()=>{
				if(commit.state.getUser.isFollowing == true){
					commit.state.getUser.isFollowing = false
				}
				commit.state.getUser.following_count--
			})
			.catch(()=>{

			})
		},
		removeFollower(commit,form){
			appAxios.post('/removefollower', form)
			.then(()=>{
				notify({
					type:'success',
					title:'Successfully removed.'
				})
				commit.getters._GetUser.followers_count--
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