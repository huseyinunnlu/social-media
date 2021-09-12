<template>
	<div class="posts border my-2 rounded">
		<AddPost />
		<div class="posts">
			<PostItem v-for="post in _IndexPosts" :key="post.id" :post="post" class="my-5"/>
		</div>
	</div>
</template>
<script>
	import AddPost from '@/components/Index/AddPost'
	import PostItem from '@/components/Index/PostItem'
	import { mapActions,mapGetters } from 'vuex'
	export default{
		components:{
			AddPost,
			PostItem,
		},
		created(){
			this.getPosts()
		},
		computed:{
			...mapGetters(['_IndexPosts'])
		},
		methods:{
			...mapActions(['getPosts'])
		}
	}
</script>