<template>
	<loader v-if="_GetUserLoading" object="#fff" color1="#ffffff" color2="#17fd3d" size="4" speed="5" bg="#343a40" objectbg="#999793" opacity="80" name="spinning"></loader>
	<Navbar />
	<div class="profile">
		<ProfileHeader/>
		<div v-if="_GetUser.acctype == 0 || _GetUser.isFollowing || _GetUser.id == _User.id">
			<ProfileNavbar/>
			<div v-if="_GetUser.post_count > 0">
				<Posts />
			</div>
			<div v-else class="text-center mt-4">
				<h3>No posts</h3>
			</div>
		</div>
		<div v-else class="text-center mt-4">
			<h3>This account is private</h3>
			<span class="text-muted">Follow to see their posts.</span>
		</div>
	</div>
</template>
<script>
	import ProfileHeader from '@/components/User/profileheader.vue' 
	import ProfileNavbar from '@/components/User/profilenavbar.vue' 
	import Posts from '@/components/User/posts.vue' 
	import {mapGetters,mapActions} from 'vuex'
	export default {
		components:{
			ProfileHeader,
			ProfileNavbar,
			Posts,
		},
		data(){
			return {
			}
		},
		mounted(){
			this.getProfileUser(this.$route.params.username);
		},
		computed:{
			...mapGetters(['_GetUserLoading','_User','_GetUser'])
		},
		methods:{
			...mapActions(['getProfileUser'])
		}
	}
</script>