<template>
	<div class="suggestions d-flex flex-column">
		<div class="suggestion-header d-flex justify-content-between m-3">
			<strong class="text-muted">Suggestions For You</strong>
			<span class="text-black">See All</span>
		</div>
		<div v-if="_SuggestedAccs">
			<SuggestedAccountItem v-for="acc in _SuggestedAccs" :key="acc.id" :user="acc" class="my-1"/>
		</div>
	</div>
</template>
<script>
	import SuggestedAccountItem from '@/components/Index/SuggestedAccountItem.vue'
	import { mapGetters,mapActions } from 'vuex'
	export default {
		components:{
			SuggestedAccountItem
		},
		computed:{
			...mapGetters(['_User','_SuggestedAccs'])
		},
		created(){
			this.getSuggestedAccs();
		},
		methods:{
			...mapActions(['getSuggestedAccs'])
		}
	}
</script>