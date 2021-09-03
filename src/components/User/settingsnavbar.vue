<template>
	<div class="settings-navbar border">
		<ul class="settings-navbar-links d-flex flex-column">
			<router-link class="router-link" :to="{name:'AccountEdit'}"><i class="fas fa-user-cog"></i> Edit Profile</router-link>
			<router-link class="router-link" :to="{name:'ChangePassword'}"><i class="fas fa-lock"></i> Change Password</router-link>	
			<router-link class="router-link" :to="{name:'AccountEdit'}">Edit Profile</router-link>	
			<router-link class="router-link" :to="{name:'AccountEdit'}">Edit Profile</router-link>	
		</ul>
	</div>
</template>
<style scoped>
.settings-navbar-links {
	list-style: none;
	font-size: 16px;
	margin-left: -33px;
}	
.router-link i{
	float: left;
	text-align: center;
	width: 15px;
	margin-right: 15px;
}
.router-link {
	float: left;
	color: #000;
	text-decoration: none;
	padding: 15px 25px;
	transition: color 0.3s,border-left 0.3s;
}
.router-link:hover{
	border-left: 1px solid #999999;
	color: #999999;
}
.router-link-active{
  border-left: 1px solid black;
}
</style>