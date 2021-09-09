<template>
	<div class="user-item d-flex justify-content-between align-items-center">
		<div class="user-desc d-flex align-items-center">
			<img :src="user.image" class="rounded-circle mx-2" style="width:35px; height:35px;">
			<div class="user-desc-name">
				<router-link class="text-decoration-none text-black" :to="/u/+user.username">{{user.username}}</router-link><br>
				<span class="text-muted">{{user.fullname}}</span>
			</div>
		</div>
		<div class="opr">
			<button v-if="isFollowing" class="btn btn-primary btn-sm" @click="isFollowing = false , removeFollow({followId: user.id,followerId:_User.id})">Unfollow</button>
			<button v-else class="btn btn-primary btn-sm" @click="isFollowing = true , follow({followId:user.id,followerId:_User.id})">Follow</button>
		</div>
	</div>
</template>
<script>
	import {mapGetters,mapActions} from 'vuex'
	export default {
		props:['user'],
		data(){
			return {
				isFollowing:false,
			}
		},
		computed:{
			...mapGetters(['_User'])
		},
		mounted(){
			this.isFollowing = this.user.isFollowing
		},
		methods:{
			...mapActions(['removeFollow','follow'])
		}
	}
</script>