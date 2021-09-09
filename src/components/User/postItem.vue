<template>
	<div class="post-item-banner">
		<img :src="post.galleries[0].file_url" style="width:100%; height:100%;">
	</div>
</template>
<script>
	export default {
		props:['post']
	}
</script>