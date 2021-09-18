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
				this.$store.state.Post.postComments[0].lastCommentId = this.$store.state.Post.postComments[0].lastCommentId + 1
				this.addComment({userId:this._User.id,postId:this.postId,comment:this.comment})
				this.$store.state.Post.postComments.unshift({
					comment: this.comment,
					created_at: 'Now',
					id: this.$store.state.Post.postComments[0].lastCommentId,
					like_count: 0,
					post_id: this._PostArticle.id,
					updated_at: "Nov",
					user: this._User,
					user_id: this._User.id,
				})
				this.comment = null
			}
		}
	}
</script>