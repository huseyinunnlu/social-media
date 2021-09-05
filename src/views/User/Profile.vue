<template>
	<loader v-if="_GetUserLoading" object="#fff" color1="#ffffff" color2="#17fd3d" size="4" speed="5" bg="#343a40" objectbg="#999793" opacity="80" name="spinning"></loader>
	<Navbar />
	<div class="profile">
		<ProfileHeader/>
		<ProfileNavbar />
	</div>
</template>
<script>
	import ProfileHeader from '@/components/User/profileheader.vue' 
	import ProfileNavbar from '@/components/User/profilenavbar.vue' 
	import {mapGetters,mapActions} from 'vuex'
	export default {
		components:{
			ProfileHeader,
			ProfileNavbar
		},
		data(){
			return {
			}
		},
		created(){
			this.getProfileUser(this.$route.params.username);
		},
		computed:{
			...mapGetters(['_GetUserLoading'])
		},
		methods:{
			...mapActions(['getProfileUser'])
		}
	}
</script>