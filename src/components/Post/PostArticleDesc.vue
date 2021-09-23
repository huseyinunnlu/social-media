<template>
	<div class="post-desc" style="font-size:15px;">
		<div class="post-desc-content m-3">
			<div class="post-item-header d-flex justify-content-between align-items-center border-bottom pb-3">
				<div class="post-user">
					<router-link class="text-decoration-none text-black" :to="{name:'Profile',params:{username:_PostArticle.user.username}}">
						<img :src="_PostArticle.user.image" class="rounded-circle me-3" style="width:40px; height:40px;">
						<strong class="me-2">{{_PostArticle.user.username}}</strong>
					</router-link>
					<span class="text-primary text-decoration-none" style="cursor: pointer;" @click="follow({followId:_PostArticle.user.id,followerId:_User.id}),isFollowing = true" v-if="isFollowing == false && _PostArticle.user.id != _User.id">Follow</span>
					<span class="text-primary text-decoration-none" style="cursor: pointer;" @click="unFollow({followId:_PostArticle.user.id,followerId:_User.id}),isFollowing = false" v-if="isFollowing == true && _PostArticle.user.id != _User.id">Unfollow</span>
				</div>
				<div class="post-user-opr">
					<PostOptions :post="_PostArticle"/>
				</div>
			</div>
			<div class="post-item-body">
				<div class="post-comments d-flex flex-column my-2" style="height:470px; overflow-y: scroll;">
					<div class="text-center" v-if="_PostCommentsLoading">
						<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
							<span class="sr-only"></span>
						</div>
					</div>
					<div v-else-if="_PostArticle.isCommentable == 0">
						<PostCommentItem class="my-3" v-for="comment in _PostComments" :key="comment.id" :comment="comment"/>
					</div>
				</div>
			</div>
			<div class="post-item-footer d-flex flex-column">
				<div class="post-item-footer-header d-flex justify-content-between my-2 mx-2" style="font-size:23px;">
					<div class="like-comment d-flex align-items-center">
						<div v-if="_PostArticle.isLikeable == '0'">
							<i v-if="!isLiked" @click="isLiked = true,likeCount++,likePost({postId:_PostArticle.id,userId:_User.id})" class="far fa-heart me-3"></i>
						<i v-else @click="isLiked = false,likeCount--,unLikePost({postId:_PostArticle.id,userId:_User.id})" class="fas fa-heart me-3 text-danger"></i>
						</div>
						<label for="comment" v-if="_PostArticle.isCommentable == '0'"><i class="far fa-comment"></i></label>
					</div>
					<div class="save">
						<span v-if="!isSaved" @click="isSaved = true,savePost({postId:_PostArticle.id,userId:_User.id})">
							<i class="far fa-bookmark"></i>
						</span>
						<span v-else @click="isSaved = false,unSavePost({postId:_PostArticle.id,userId:_User.id})">
							<i class="fas fa-bookmark"></i>
						</span>
					</div>
				</div>
				<div class="post-item-footer-body d-flex justify-content-between mb-2 mx-2">
					<strong class="text-black">{{likeCount}} Likes</strong>
					<small class="text-muted">2 Days Ago</small>
				</div>
				<AddPostComment :postId="_PostArticle.id"/>
			</div>
		</div>
	</div>
</template>
<script>
	import PostCommentItem from '@/components/Post/PostCommentItem.vue'
	import AddPostComment from '@/components/Index/AddPostComment.vue'
	import PostOptions from '@/components/Post/PostOptions.vue'
	import {mapActions,mapGetters} from 'vuex'
	export default {
		data(){
			return{
				isFollowing:false,
				isLiked:false,
				isSaved:false,
				likeCount:0,
			}
		},
		components:{
			PostCommentItem,
			AddPostComment,
			PostOptions,
		},
		mounted(){
			this.isFollowing = this._PostArticle.user.isFollowing
			this.isLiked = this._PostArticle.isLiked
			this.likeCount = this._PostArticle.like_count
			this.isSaved = this._PostArticle.isSaved
			if(this._PostArticle.isCommentable != 1) {
				this.getPostComments(this._PostArticle.id)
			}
		},
		computed:{
			...mapGetters(['_User','_PostArticle','_PostComments','_PostCommentsLoading'])
		},
		methods:{
			...mapActions(['follow','unFollow','likePost','unLikePost','savePost','unSavePost','getPostComments'])
		}
	}
</script>