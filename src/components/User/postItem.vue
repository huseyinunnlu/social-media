<template>
	<div class="post-item-banner">
		<router-link :to="{name:'PostArticle',params:{url:post.url}}">
			<img :src="post.galleries[0].file_url" style="width:100%; height:100%;">
		</router-link>
	</div>
</template>
<script>
	export default {
		props:['post']
	}
</script>