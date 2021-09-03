<template>
	<Navbar />
	<div class="profile">
		<ProfileHeader />
		<ProfileNavbar />
	</div>
</template>
<script>
	import ProfileHeader from '@/components/User/myprofileheader.vue' 
	import ProfileNavbar from '@/components/User/profilenavbar.vue' 
	export default {
		components:{
			ProfileHeader,
			ProfileNavbar
		}
	}
</script>