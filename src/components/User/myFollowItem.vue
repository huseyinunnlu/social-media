<template>
	<div class="user-item d-flex justify-content-between align-items-center">
		<div class="user-desc d-flex align-items-center">
			<img :src="follow.follow_user.image" class="rounded-circle mx-2" style="width:35px; height:35px;">
			<div class="user-desc-name">
				<router-link class="text-decoration-none text-black" :to="{name:'Profile',params:{username:follow.follow_user.username}}">{{follow.follow_user.username}}</router-link><br>
				<span class="text-muted">{{follow.follow_user.fullname}}</span>
			</div>
		</div>
		<div class="opr">
			<button v-if="isFollowing" class="btn btn-primary btn-sm" @click="isFollowing = false,removeFollow({followId: follow.follow_id,followerId:_User.id})">Unfollow</button>
			<button v-else class="btn btn-primary btn-sm">Follow</button>
		</div>
	</div>
</template>
<script>
	import {mapActions,mapGetters} from 'vuex'
	export default {
		props:['follow'],
		data(){
			return {
				isFollowing:true,
			}
		},
		computed:{
			...mapGetters(['_User'])
		},
		methods:{
			...mapActions(['removeFollow'])
		}
	}
</script>