<template>
	<div class="posts border my-2 rounded">
		<AddPost />
		<div class="posts">
			asdads
		</div>
	</div>
</template>
<script>
	import AddPost from '@/components/Index/AddPost'
	import { mapActions } from 'vuex'
	export default{
		components:{
			AddPost,
		},
		created(){
			this.getPosts()
		},
		methods:{
			...mapActions(['getPosts'])
		}
	}
</script>