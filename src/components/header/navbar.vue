<template>
	<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
		<div class="container-fluid">
			<router-link class="navbar-brand" :to="{name:'Index'}">Navbar</router-link>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse df-le" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					
				</ul>
				
				<ul class="navbar-nav mb-2 mb-lg-0 align-items-center">
					<router-link :to="{name:'Index'}" class="router-link mx-2" style="font-size: 23px;"><i class="fas fa-home"></i></router-link>
					<User v-if="_isAuth"/>
				</ul>
			</div>
		</div>
	</nav>
</template>
<script>
	import User from './user.vue'
	import {mapGetters} from 'vuex'
	export default {
		components:{
			User
		},
		computed:{
			...mapGetters(['_isAuth'])
		}
	}
</script>
<style>
.router-link {
	color: #999999;
	transition: all 0.3s;
}
.router-link:hover{
	color: black;
}
.router-link-active{
	color: black;
}
</style>