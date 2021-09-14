<template>
	<div class="post-comments input-group">
		<input type="text" class="form-control" placeholder="Add Comment" v-model="comment">
		<div class="input-group-prepend">
			<button class="btn btn-success" type="button" @click="addComment({userId:_User.id,postId:postId,comment:comment}),comment = null" :disabled="!comment">Send</button>
		</div>
	</div>
</template>
<script>
	import {mapGetters,mapActions} from 'vuex'
	export default {
		props:['postId'],
		data(){
			return{
				comment:null,
			}
		},
		computed:{
			...mapGetters(['_User']),
		},
		methods:{
			...mapActions(['addComment']),
		}
	}
</script>