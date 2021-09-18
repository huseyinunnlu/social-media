<template>
	<div class="post-content align-middle">
		<img :src="_PostArticle.galleries[0].file_url" style="width:100%; height: 100%;">
	</div>
</template>
<script>
	import {mapActions,mapGetters} from 'vuex'
	export default {
		computed:{
			...mapGetters(['_PostArticle'])
		},
		methods:{
			...mapActions([])
		}
	}
</script>