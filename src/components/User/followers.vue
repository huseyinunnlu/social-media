<template>
	<a type="button" @click="getFollowers({id:_GetUser.id}) && showModal()">
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
								<div class="user-items d-flex flex-column" v-if="_User.id == _GetUser.id">
									<MyFollowerItem v-for="follower in followers" :key="follower.id" :follower="follower" class="my-1"/>
								</div>
								<div class="user-items d-flex flex-column" v-else>
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
	import {mapActions,mapGetters} from 'vuex'
	import FollowerItem from '@/components/User/followerItem.vue'
	import MyFollowerItem from '@/components/User/myFollowerItem.vue'
	export default {
		components:{
			FollowerItem,
			MyFollowerItem
		},
		props:['followers','count'],
		data(){
			return {
				isShow:false,
			}
		},
		computed:{
			...mapGetters(['_GetUser','_User'])
		},
		methods:{
			...mapActions(['removeFollow','getFollowers']),
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
