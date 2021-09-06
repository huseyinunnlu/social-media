<template>
	<a type="button" @click="showModal">
		<strong>{{count}}</strong> Followers
	</a>
	<Modal v-model="isShow" :close="closeModal">
		<div class="modal-container">
			<div class="modal-dialog" role="document">
				<div class="modal-content">	
					<div class="modal-header d-flex justify-content-center justify-content-between">
						<h5></h5>
						<h5 class="">Followers</h5>
						<i @click="closeModal" style="cursor: pointer; font-size: 20px;" class="fas fa-times"></i>
					</div>
					<div class="modal-body">
						<div class="list">
							<div class="list-content m-1">
								<div class="user-items d-flex flex-column">
									

									<FollowerItem v-for="follower in followers" :key="follower.id" :follower="follower" class="my-1"/>


								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</Modal>
</template>

<script>
	import {mapActions} from 'vuex'
	import FollowerItem from '@/components/User/followerItem.vue'
	export default {
		components:{
			FollowerItem
		},
		props:['followers','count'],
		data(){
			return {
				isShow:false,
			}
		},
		methods:{
			...mapActions(['removeFollow']),
			showModal(){
				this.isShow = true
			},
			closeModal(){
				this.isShow = false
			},
		}
	}
</script>
<style>
.modal-container{
	width: 100%;
	position: absolute;
	top: 15%;
}
</style>
