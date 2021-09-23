<template>
	<div class="post-comments input-group">
		<input type="text" id="comment" class="form-control" placeholder="Add Comment" v-model="comment" :disabled="_PostArticle.isCommentable == '1' || isComment == '1'">
		<div class="input-group-prepend">
			<button class="btn btn-success" type="button" @click="createComment()" :disabled="!comment">Send</button>
		</div>
	</div>
</template>
<script>
	import {mapGetters,mapActions} from 'vuex'
	export default {
		props:['postId','isComment'],
		data(){
			return{
				comment:null,
			}
		},
		computed:{
			...mapGetters(['_User','_PostArticle']),
		},
		methods:{
			...mapActions(['addComment']),
			createComment(){
				this.addComment({postId:this.postId,comment:this.comment,userId:this._User.id})
				setTimeout(() => {
					this.comment = null
				}, 1000);
			}
		}
	}
</script>