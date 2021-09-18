<template>
	<div class="post-options">
		<i class="fas fa-ellipsis-h" @click="postOptions = !postOptions" style="cursor:pointer;"></i>
		<div class="post-options-dropdown" v-if="postOptions">
			<a v-if="_User.id == commentUserId" @click="delComment()" class="post-option-item text-decoration-none text-black" style="cursor:pointer;">Delete Comment</a>
			<a v-if="_PostArticle.user.id != _User.id" class="post-option-item text-decoration-none text-black" style="cursor:pointer;">Report</a>
		</div>
	</div>
</template>
<script>
	import {mapGetters,mapActions} from 'vuex'
	export default {
		props:['commentId','commentUserId'],
		data(){
			return {
				postOptions:false,
			}
		},
		computed:{
			...mapGetters(['_PostArticle','_User'])
		},
		methods:{
			...mapActions(['deleteComment']),
			delComment(){
				this.$emit('deleted', false)
				this.deleteComment({commentId:this.commentId})
			}
		}
	}
</script>
<style>
	.post-options-dropdown{
		background-color: white;
		border: 1px solid #999;
		width: 200px;
		position: absolute;
	}

	.post-option-item {
		display: flex;
		flex-direction: column;
		justify-content: center;
		text-align: center;
		transition: all 0.3s;
		padding: 10px;
		border-bottom: 1px solid lightgray;
	}

	.post-option-item:hover{
		background-color: #f3f3f3;
	}
</style>