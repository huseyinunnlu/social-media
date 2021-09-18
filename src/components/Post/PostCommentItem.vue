<template>
	<div v-if="!isDeleted" class="comment" style="width:100%;">
		<div class="comment-content d-flex flex-column">
			<div class="comment-header">
				<div class="comment-user d-flex flex-wrap justify-content-between align-items-center">
					<router-link class="text-decoration-none text-black" :to="{name:'Profile',params:{username:comment.user.username}}">
						<img :src="comment.user.image" class="rounded-circle me-3" style="width:35px; height:35px;">
						<strong class="me-2">{{comment.user.username}}</strong>
					</router-link>
					<PostCommentOptions :commentId="comment.id" :commentUserId="comment.user.id" @deleted="isDeleted = true"/>
				</div>
			</div>
			<div class="comment-body mt-2">
				<p v-html="comment.comment"></p>
			</div>
			<div class="comment-footer d-flex" style="margin-top: -15px;">
				<span class="text-muted">2h ago</span>
				<span class="text-muted mx-3" v-if="!isLiked" @click="likeComment({commentId:comment.id,userId:_User.id,type:'0'}),isLiked = true, likeCount++">Like ({{comment.like_count}})</span>
				<span class="text-primary mx-3" v-if="isLiked" @click="unLikeComment({commentId:comment.id,userId:_User.id,type:'0'}),isLiked = false, likeCount--">Unlike ({{likeCount}})</span>
				<span class="text-muted">Reply</span>
			</div>			
		</div>
	</div>
</template>

<script>
	import PostCommentOptions from '@/components/Post/PostCommentOptions.vue'
	import {mapActions,mapGetters} from 'vuex'
	export default {
		components:{
			PostCommentOptions,
		},
		props:['comment'],
		data() {
			return {
				isLiked:false,
				likeCount:0,
				isDeleted:false
			}
		},
		created(){
			this.likeCount = this.comment.like_count
			this.isLiked = this.comment.isLiked
		},
		computed:{
			...mapGetters(['_User']),
		},
		methods:{
			...mapActions(['likeComment','unLikeComment'])
		}
	}
</script>
