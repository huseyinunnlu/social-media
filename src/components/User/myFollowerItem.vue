<template>
	<div class="user-item d-flex justify-content-between align-items-center">
		<div class="user-desc d-flex align-items-center">
			<img :src="follower.user.image" class="rounded-circle mx-2" style="width:35px; height:35px;">
			<div class="user-desc-name">
				<router-link class="text-decoration-none text-black" :to="{name:'Profile',params:{username:follower.user.username}}">{{follower.user.username}}</router-link><br>
				<span class="text-muted">{{follower.user.fullname}}</span>
			</div>
		</div>
		<div class="opr">
			<button v-if="!isRemoved" class="btn btn-primary btn-sm" @click="isRemoved = true,removeFollow({id:follower.id})">Remove</button>
			<button v-else class="btn btn-primary btn-sm" disabled>Removed</button>
		</div>
	</div>
</template>
<script>
	import {mapActions} from 'vuex'
	export default {
		props:['follower'],
		data(){
			return {
				isRemoved:false,
			}
		},
		methods:{
			...mapActions(['removeFollow'])
		}
	}
</script>