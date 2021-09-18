<template>
	<div class="post-options">
		<i class="fas fa-ellipsis-h" @click="postOptions = !postOptions" style="cursor:pointer;"></i>
		<div class="post-options-dropdown" v-if="postOptions">
			<a v-if="post.user.id == _User.id" @click="postDelete" class="post-option-item text-decoration-none text-black" style="cursor:pointer;">Delete post</a>
			<router-link v-if="$route.name == 'Index'" :to="{name:'PostArticle',params:{url:post.url}}" class="post-option-item text-decoration-none text-black" style="cursor:pointer;">Go To Post</router-link>
			<a v-if="post.user.id != _User.id" class="post-option-item text-decoration-none text-black" style="cursor:pointer;">Report</a>
		</div>	
	</div>
</template>
<script>
	import {mapGetters,mapActions} from 'vuex'
	export default {
		props:['post'],
		data(){
			return {
				postOptions:false,
			}
		},
		computed:{
			...mapGetters(['_User'])
		},
		methods:{
			...mapActions(['deletePost']),
			postDelete(){
				this.deletePost({postId:this.post.id})
				if (this.$route.name == 'Index') {
					this.$emit('deleted', true)
				}
			},
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