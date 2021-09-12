import { appAxios } from "@/utils/appAxios";
//import CryptoJs from "crypto-js";
import { notify } from "@kyvg/vue3-notification";
//import router from '../../router'

export default ({
	state: {},

	getters:{},

	actions:{
		likePost(_,form){
			appAxios.post('/like',form)
			.then(()=>{
				notify({
					type:'success',
					title:'Successfully liked.'
				})
			})
		},
		unLikePost(_,form){
			appAxios.post('/unlike',form)
			.then(()=>{
				notify({
					type:'success',
					title:'Successfully unliked.'
				})
			})
		},
		savePost(_,form){
			appAxios.post('/save',form)
			.then(()=>{
				notify({
					type:'success',
					title:'Successfully saved.'
				})
			})
		},
		unSavePost(_,form){
			appAxios.post('/unsave',form)
			.then(()=>{
				notify({
					type:'success',
					title:'Successfully unsaved.'
				})
			})
		}
	},

	mutations:{},
})