<template>
	<div class="user-item d-flex justify-content-between align-items-center">
		<router-link :to="{name:'Profile',params:{username:follower.user.username}}" style="width: 100%;" class="text-decoration-none user-desc d-flex align-items-center">
			<img :src="follower.user.image" class="rounded-circle mx-2" style="width:35px; height:35px;">
			<div class="user-desc-name">
				<span class="text-black">{{follower.user.username}}</span><br>
				<span class="text-muted">{{follower.user.fullname}}</span>
			</div>
		</router-link>
	</div>
</template>
<script>
	import {mapActions} from 'vuex'
	export default {
		props:['follower'],
		methods:{
			...mapActions(['removeFollow'])
		}
	}
</script>