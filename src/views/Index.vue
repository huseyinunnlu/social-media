<template>
	<div class="container">
		<div class="row">
			<header>
				<Navbar />
			</header>
		</div>
	</div>
</template>

<script>
	import Navbar from '../components/header/navbar.vue'
	import { mapActions } from 'vuex'
	export default {
		components:{
			Navbar
		},	
		methods:{
			...mapActions(['logout']),
		},
	}
</script>
