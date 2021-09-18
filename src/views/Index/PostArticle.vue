<template>
	<div class="row">
		<loader v-if="_PostArticleLoading" object="#fff" color1="#ffffff" color2="#17fd3d" size="4" speed="5" bg="#343a40" objectbg="#999793" opacity="80" name="spinning"></loader>
		<header>
			<Navbar />
		</header>
		<div class="index-content row my-5">
			<div v-if="!_PostArticleLoading" class="col-md-10 offset-md-1 p-0 border row d-flex" style="min-height: 650px;">
				<PostArticleImage class="col-md-7"/>
				<PostArticleDesc class="col-md-5"/>
			</div>
		</div>
	</div>
</template>
<script>
	import Navbar from '@/components/header/navbar.vue';
	import PostArticleImage from '@/components/Post/PostArticleImage.vue';
	import PostArticleDesc from '@/components/Post/PostArticleDesc.vue';
	import {mapGetters,mapActions} from 'vuex';
	export default {
		components:{
			Navbar,
			PostArticleImage,
			PostArticleDesc
		},
		created(){
			this.getPostArticle(this.$route.params.url)
		},
		methods:{
			...mapActions(['getPostArticle']),
		},
		computed:{
			...mapGetters(['_PostArticle','_PostArticleLoading']),
		}

	}
</script>
