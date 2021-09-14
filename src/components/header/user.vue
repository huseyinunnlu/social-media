<template>
	<loader v-if="_LogoutLoading" object="#fff" color1="#ffffff" color2="#17fd3d" size="4" speed="5" bg="#343a40" objectbg="#999793" opacity="80" name="spinning"></loader>
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
			<img :src="_User.image" class="rounded-circle" style="width: 35px; height: 35px;">
		</a>
		<ul class="dropdown-menu shadow user-opr" aria-labelledby="navbarDropdown">
			<li>
				<router-link class="dropdown-item" :to="{name:'Profile',params:{username:_User.username}}"><i class="far fa-user-circle"></i><span> Profile</span></router-link>
			</li>
			<li>
				<router-link class="dropdown-item" :to="{name:'ProfileSaved',params:{username:_User.username}}"><i class="far fa-bookmark"></i> Saved</router-link>
			</li>
			<li><router-link class="dropdown-item" :to="{name:'AccountEdit'}"><i class="fas fa-cog"></i> Settings</router-link></li>
			<li><hr class="dropdown-divider"></li>
			<li><a type="button" class="dropdown-item" @click="logout()"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
		</ul>
	</li>
</template>
<script>
	import {mapGetters,mapActions} from 'vuex' 
	export default{
		computed: {
			...mapGetters(['_User','_LogoutLoading'])
		},
		methods:{
			...mapActions(['logout']),
		}
	}
</script>
<style>
.user-opr {
	width: 150px;
}
.user-opr i{
	font-size: 110%;
	text-align: center;
	padding-right: 9px;
	width: 25px;
}
</style>