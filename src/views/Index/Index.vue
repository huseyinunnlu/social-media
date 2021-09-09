<template>
	<div class="row">
		<header>
			<Navbar />
		</header>
		<div class="index-content row my-4">
			<div class="posts-stories col-md-8">
				<div class="stories border border-radius rounded">
					Stroies
				</div>
				<Posts />
			</div>
			<div class="right-sidebar col-md-4">
				<div class="my-profile align-items-center p-3 my-2 border-bottom">
					<router-link :to="/u/+_User.username" class="d-flex align-items-center text-decoration-none text-black" style="font-size:16px;">
						<img :src="_User.image" class="rounded-circle me-3" style="width:60px; height:60px;">
						<div>
							<strong>{{_User.username}}</strong><br>
							<span class="text-muted">{{_User.fullname}}</span>
						</div>
					</router-link>
				</div>
				<Suggestions />
			</div>
		</div>
	</div>
</template>

<script>
	import { mapGetters } from 'vuex'
	import Navbar from '@/components/header/navbar.vue'
	import Suggestions from '@/components/Index/Suggestions.vue'
	import Posts from '@/components/Index/Posts.vue'
	export default {
		components:{
			Navbar,
			Suggestions,
			Posts,
		},	
		computed:{
			...mapGetters(['_User']),
		}
	}
</script>
