<template>
	<div>
		<div class="loader" v-if="isLoading">
			<h3 class="text-center my-5">
				Loading
			</h3>
		</div>
		<div class="post-user d-flex flex-wrap flex-start justify-content-center" v-if="!isLoading">
			<PostItem v-for="post in posts" :key="post.id" :post="post" class="m-2 border" style="width:300px; height: 300px;"/>
		</div>
	</div>
</template>
<script>
	import { mapGetters } from 'vuex'
	import PostItem from '@/components/User/postItem.vue'
	export default {
		data(){
			return {
				isLoading:false,
				posts:[],
			}
		},
		components:{
			PostItem,
		},
		created(){
			this.getUserPosts()
		},
		computed:{
			...mapGetters(['_GetUser'])
		},
		methods:{
			getUserPosts(){
				this.isLoading = true
				this.$appAxios.get('/getuserposts?user='+this._GetUser.id+'&count='+12)
				.then(res=>{
					this.posts = res.data
				})
				.catch(()=>{
					this.posts = []
				})
				.finally(()=>{
					this.isLoading = false
				})
			},
		}
	}
</script>