<template>
	<div class="post-comments input-group" style="width:80%; font-size:14px; margin-left:30px;">
		<input type="text" id="comment" class="form-control form-control-sm" placeholder="Add Reply" v-model="comment">
		<div class="input-group-prepend">
			<button class="btn btn-success btn-sm" type="button" @click="createReply()" :disabled="!comment">Send</button>
		</div>
	</div>
</template>
<script>
	import {mapGetters,mapActions} from 'vuex'
	export default {
		props:['postId','replyCommentId','replyUserId','replyUsername'],
		data(){
			return{
				comment:null,
                isShowing:false,
				data:[],
			}
		},
		computed:{
			...mapGetters(['_User']),
		},
		created(){
			this.comment = null;
			this.comment = '@'+this.replyUsername+ ' ';
		},
		methods:{
			...mapActions(['addReply']),
			createReply(){
				this.addReply({userId:this._User.id,commentId:this.replyCommentId,postId:this.postId,replyUserId:this.replyUserId,reply:this.comment})
				setTimeout(() => {
					this.comment = null
				}, 1000);
			}
		}
	}
</script>