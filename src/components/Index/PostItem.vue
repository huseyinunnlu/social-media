<template>
	<div class="post-item" v-if="!isDeleted">
		<div class="post-item-header d-flex justify-content-between align-items-center m-4">
			<div class="post-user">
				<router-link class="text-decoration-none text-black" :to="{name:'Profile',params:{username:post.user.username}}">
					<img :src="post.user.image" class="rounded-circle me-3" style="width:40px; height:40px;">
					<strong class="me-2">{{post.user.username}}</strong>
				</router-link>
				<span class="text-primary text-decoration-none" style="cursor: pointer;" @click="follow({followId:post.user.id,followerId:_User.id}),isFollowing = true" v-if="isFollowing == false && post.user.id != _User.id">Follow</span>
				<span class="text-primary text-decoration-none" style="cursor: pointer;" @click="unFollow({followId:post.user.id,followerId:_User.id}),isFollowing = false" v-if="isFollowing == true && post.user.id != _User.id">Unfollow</span>
			</div>
			<div class="post-user-opr">
				<PostOptions @deleted="isDeleted = true" :post="post"/>
			</div>
		</div>
		<div class="post-item-body">
			<img :src="post.galleries[0].file_url" style="width:100%; height:100%;">
		</div>
		<div class="post-item-footer m-4">
			<div class="post-item-footer-header d-flex justify-content-between" style="font-size:25px;">
				<div class="like-comment d-flex align-items-center">
					<div v-if="post.isLikeable == 0">
						<i v-if="!isLiked" @click="isLiked = true,likeCount++,likePost({postId:post.id,userId:_User.id})" class="far fa-heart me-3"></i>
						<i v-else @click="isLiked = false,likeCount--,unLikePost({postId:post.id,userId:_User.id})" class="fas fa-heart me-3 text-danger"></i>
					</div>
					<i class="far fa-comment" v-if="post.isCommentable == 0"></i>
				</div>
				<div class="save">
					<span v-if="!isSaved" @click="isSaved = true,savePost({postId:post.id,userId:_User.id})">
						<i class="far fa-bookmark"></i>
					</span>
					<span v-else @click="isSaved = false,unSavePost({postId:post.id,userId:_User.id})">
						<i class="fas fa-bookmark"></i>
					</span>
				</div>
			</div>
			<div class="post-item-footer-body d-flex flex-column">
				<span v-if="post.isLikeable == 0"><strong>{{likeCount}}</strong> Likes</span>
				<span class="d-flex">
					<router-link :to="{name:'Profile',params:{username:post.user.username}}" class="text-black text-decoration-none" style="font-weight: bold;">{{post.user.username}} </router-link> 
					<p v-html="post.desc"></p>
				</span>
				
				<strong class="text-muted border-bottom pb-4 mb-4" style="font-size:15px;">
					<router-link class="text-muted text-decoration-none" :to="{name:'PostArticle',params:{url:post.url}}">View all comments</router-link>
				</strong>
				
				<AddPostComment :isComment="post.isCommentable" :postId="post.id"/>
			</div>
		</div>
	</div>
</template>
<script>
	import AddPostComment from '@/components/Index/AddPostComment.vue'
	import PostOptions from '@/components/Post/PostOptions.vue'
	import {mapGetters,mapActions} from 'vuex'
	export default {
		props:['post'],
		components:{
			AddPostComment,
			PostOptions,
		},
		data(){
			return {
				isFollowing:false,
				isLiked:false,
				isSaved:false,
				likeCount:0,
				isDeleted:false,
			}
		},
		mounted(){
			this.isFollowing = this.post.user.isFollowing
			this.isLiked = this.post.isLiked
			this.likeCount = this.post.like_count
			this.isSaved = this.post.isSaved
		},
		computed:{
			...mapGetters(['_User'])
		},
		methods:{
			...mapActions(['follow','unFollow','likePost','unLikePost','savePost','unSavePost','addComment']),
		},
	}


</script>