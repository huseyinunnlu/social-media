<template>
	<div class="profile-header d-flex mx-5 mt-5 pb-4 border-bottom">
		<div class="profile-image px-5">
			<img :src="_User.image" class="rounded-circle" style="width:150px; height: 150px;">
		</div>
		<div class="profile-desc px-5 d-flex flex-column">
			<div class="profile-desc-header d-flex align-items-center">
				<span class="username">{{_User.username}}</span>
				<router-link v-if="$route.params.username == _User.username" :to="{name:'AccountEdit'}" class="btn btn-primary btn-sm">Edit Profile</router-link>
			</div>
			<div class="profile-desc-follow d-flex justify-content-between my-3">
				<span><strong>0</strong> Posts</span>
				<span><strong>0</strong> Followers</span>
				<span><strong>0</strong> Following</span>
			</div>
			<div class="profile-desc-fullname">
				<strong>
					{{_User.fullname}}
				</strong>
			</div>
			<div class="profile-desc-bio">
				<p v-html="_User.bio"></p>
			</div>
		</div>
	</div>
</template>
<script>
	import {mapGetters} from 'vuex'
	export default {
		computed:{
			...mapGetters(['_User'])
		}
	}
</script>
<style scoped>
	.username{
		font-size: 25px;
		font-weight: lighter;
		margin-right: 20px;
	}
</style>