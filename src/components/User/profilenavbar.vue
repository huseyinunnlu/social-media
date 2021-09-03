<template>
	<div class="profile-navbar">
		<nav>
			<ul class="navbar d-flex justify-content-center align-items-center">
				<li class="nav-item"><a href="#" class="text-decoration-none"><i class="fas fa-th"></i> Posts</a></li>
				<li class="nav-item"><a href="#" class="text-decoration-none">Posts</a></li>
				<li class="nav-item"><a href="#" class="text-decoration-none">Posts</a></li>
				<li class="nav-item"><a href="#" class="text-decoration-none">Posts</a></li>
				<li class="nav-item"><a href="#" class="text-decoration-none">Posts</a></li>
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
	.nav-item a{
		color: #999999;
	}
	.nav-item a:hover {
		color: black;
	}

	.active {
		color: #000;
	}
</style>