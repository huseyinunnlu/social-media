<template>
	<div class="profile-header flex-wrap d-flex mx-5 mt-5 pb-4 border-bottom">
		<div class="profile-image px-5">
			<img :src="_GetUser.image" class="rounded-circle" style="width:150px; height: 150px;">
		</div>
		<div class="profile-desc px-5 d-flex flex-column">
			<div class="profile-desc-header d-flex flex-wrap align-items-center">
				<span class="username">{{_GetUser.username}}</span>
				<button v-if="!_GetUser.isFollowing && _User.id != _GetUser.id" class="btn btn-primary btn-sm" @click="follow({followId:_GetUser.id,followerId:this._User.id})">Follow</button>
				<button v-else-if="_User.id != _GetUser.id" class="btn btn-primary btn-sm" @click="unFollow({followId:_GetUser.id,followerId:this._User.id})">Unfollow</button>
				<router-link v-if="_GetUser.id == _User.id" class="btn btn-primary btn-sm" :to="{name:'AccountEdit'}">Edit Profile</router-link>
			</div>
			<div v-if="_GetUser.acctype == 0 || _GetUser.isFollowing || _GetUser.id == _User.id" class="profile-desc-follow d-flex justify-content-between my-3">
				<span><strong>{{_GetUser.post_count}}</strong> Posts</span>
				<Followers :count="_GetUser.followers_count" :followers="_GetUserFollower"/>
				<Follows :count="_GetUser.following_count" :follows="_GetUserFollow"/>
			</div>
			<div v-else class="profile-desc-follow d-flex justify-content-between my-3">
				<span><strong>0</strong> Posts</span>
				<span class="mx-2"><strong>{{_GetUser.followers_count}}</strong> Followers</span>
				<span><strong>{{_GetUser.following_count}}</strong> Following</span>
			</div>

			<div class="profile-desc-fullname">
				<strong>
					{{_GetUser.fullname}}
				</strong>
			</div>
			<div class="profile-desc-bio">
				<p v-html="_GetUser.bio"></p>
			</div>
		</div>
	</div>
</template>
<script>
	import Followers from '@/components/User/followers.vue'
	import Follows from '@/components/User/follows.vue'
	import { mapActions,mapGetters } from 'vuex'
	export default {
		components:{
			Followers,
			Follows,
		},
		computed:{
			...mapGetters(['_User','_GetUser','_GetUserFollow','_GetUserFollower'])
		},
		methods:{
			...mapActions(['follow','unFollow'])
		},
	}
</script>
<style scoped>
.username{
	font-size: 25px;
	font-weight: lighter;
	margin-right: 20px;
}
</style>