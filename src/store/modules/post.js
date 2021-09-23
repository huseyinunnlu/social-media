import { appAxios } from "@/utils/appAxios";
//import CryptoJs from "crypto-js";
import { notify } from "@kyvg/vue3-notification";
import router from '../../router'

export default ({
	state: {
		isLoading:false,
		isLoadingSmall:false,
		postArticle:[],
		postComments:[],
	},

	getters:{
		_PostArticle : (state) => state.postArticle,
		_PostComments : (state) => state.postComments,
		_PostArticleLoading : (state) => state.isLoading,
		_PostCommentsLoading : (state) => state.isLoadingSmall,
	},

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
		},
		addComment(commit,form){
			appAxios.post('/addpostcomment',form)
			.then(res=>{
				notify({
					type:'success',
					title:'Comment successfully added.'
				})
				commit.state.postComments.unshift({
					comment: form.comment,
					created_at: 'Now',
					id: res.data.id,
					like_count: 0,
					post_id: form.postId,
					updated_at: "Now",
					user: commit.getters._User,
					user_id: form.userId,
					reply:[],
				})
				
			})
			.catch(()=>{
				notify({
					type:'error',
					title:"Comment didn't added."
				})
			})
		},
		getPostArticle(commit,form){
			commit.state.isLoading = true
			appAxios.get('/getpostarticle?url='+form+'&count='+15)
			.then(res=>{
				commit.state.postArticle = res.data
			})
			.catch(()=>{
				router.push({name:'404'})
			})
			.finally(()=>{
				commit.state.isLoading = false
			})
			
		},
		getPostComments(commit,form){
			commit.state.isLoadingSmall = true
			appAxios.get('/getpostcomments?postId='+form+'&count='+15)
			.then(res=>{
				commit.state.postComments = res.data
			})
			.catch(()=>{
				commit.state.postComments = []
			})
			.finally(()=>{
				commit.state.isLoadingSmall = false
			})
		},
		likeComment(commit,form){
			appAxios.post('/likecomment',form)
			.then(()=>{
				notify({
					type:'success',
					title:'Successfully liked comment.'
				})
			})
			.catch(()=>{
				notify({
					type:'error',
					title:"Didn't liked comment"
				})
			})
		},
		unLikeComment(commit,form){
			appAxios.post('/unlikecomment',form)
			.then(()=>{
				notify({
					type:'success',
					title:'Successfully unliked comment.'
				})
			})
			.catch(()=>{
				notify({
					type:'error',
					title:"Didn't unliked comment"
				})
			})
		},
		deleteComment(commit,form){
			appAxios.post('/deletecomment',form)
			.then(()=>{
				notify({
					type:'success',
					title:'Successfully deleted comment.'
				})
			})
			.catch(()=>{
				notify({
					type:'error',
					title:"Didn't deleted comment"
				})
			})
		},
		deletePost(commit,form){
			commit.state.isLoading = true
			appAxios.post('/deletepost',form)
			.then(()=>{
				notify({
					type:'success',
					title:'Successfully deleted post.'
				})
				router.push({
					name:'Index',
				})
			})
			.catch(()=>{
				notify({
					type:'error',
					title:"Post didn't deleted"
				})
			})
			.finally(()=>{
				commit.state.isLoading = false
			})
		},
		addReply(commit,form){
			appAxios.post('/addcommentreply', form)
			.then(res=>{
				commit.state.postComments.find(function(comment) {
				if(comment.id == form.commentId) {
					let index = commit.state.postComments.indexOf(comment)
					commit.state.postComments[index].reply.push({
						id:res.data.id,
						user_id:form.userId,
						comment_id:form.commentId,
						post_id:form.postId,
						reply_user_id:form.replyUserId,
						reply:form.reply,
						user:commit.getters._User,
					})
				}
					notify({
						type:'success',
						title:"Reply sent successfully."
					});
				});	
			})
			.catch(()=>{
				notify({
					type:'error',
					title:"Reply didn't sent."
				});
			})
		}

	},

	mutations:{},
})