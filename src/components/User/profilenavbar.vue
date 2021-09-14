<template>
	<div class="profile-navbar">
		<nav>
			<ul class="navbar d-flex justify-content-center align-items-center">
				<li class="nav-item"><router-link :to="{name:'Profile',params:{username:$route.params.username}}" class="router-link text-decoration-none"><i class="fas fa-th"></i> Posts</router-link></li>
				<li v-if="$store.getters._User.id == $store.getters._GetUser.id" class="nav-item"><router-link :to="{name:'ProfileSaved',params:{username:$route.params.username}}" class="router-link text-decoration-none"><i class="fas fa-bookmark"></i> Saved</router-link></li>
			</ul>
		</nav>
	</div>
</template>
<style scoped>
	.navbar .nav-item{
		margin: -9px 10px;
		padding: 10px 10px;
		list-style: none;
		transition: color 0.3s;
	}
	.router-link{
		color: #999999;
	}
	.router-link:hover {
		color: black;
	}

	.router-link-active {
		color: #000;
	}
</style>