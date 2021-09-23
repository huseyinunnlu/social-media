<template>
	<div v-if="reply">
		<div class="comment-header">
				<div class="comment-user d-flex flex-wrap justify-content-between align-items-center">
					<router-link class="text-decoration-none text-black" :to="{name:'Profile',params:{username:_User.username}}">
						<img :src="reply.user.image" class="rounded-circle me-3" style="width:35px; height:35px;">
						<strong>{{reply.user.username}}</strong>
					</router-link>
					<!--<PostCommentOptions :commentId=comment.id" :commentUserId="comment.user.id" @deleted="isDeleted = true"/>-->
            </div>
		</div>
		<div class="comment-body mt-2">
			<p v-html="reply.reply"></p>
		</div>
		<div class="comment-footer d-flex" style="margin-top: -15px;">
			<span class="text-muted">2h ago</span>
			<span class="text-muted mx-3">Like</span>
			<span class="text-muted" @click="$emit('toggleInput')" style="cursor:pointer;">Reply</span>
		</div>
	</div>
</template>

<script>
	import {mapGetters} from 'vuex'
	export default {
		data(){
			return {
			}
		},
		props:['reply'],
		computed:{
			...mapGetters(['_User']),
		},
	}
</script>

<style>

</style>