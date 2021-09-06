<template>
	<a class="mx-2 text-decoration-none text-black" type="button" @click="getFollows({id:_GetUser.id}) && showModal()">
		<strong>{{count}}</strong> Following
	</a>
	<Modal v-model="isShow" :close="closeModal">
		<div class="modal-container">
			<div class="modal-dialog" role="document">
				<div class="modal-content">	
					<div class="modal-header d-flex justify-content-center justify-content-between">
						<h5></h5>
						<h5 class="">Following</h5>
						<i @click="closeModal" style="cursor: pointer; font-size: 20px;" class="fas fa-times"></i>
					</div>
					<div class="modal-body">
						<div class="list">
							<div class="list-content m-1">
								<div class="user-items d-flex flex-column" v-if="_User.id == _GetUser.id">
									<MyFollowItem v-for="follow in follows" :key="follow.id" :follow="follow" class="py-1 my-1 follower-item"/>
								</div>
								<div class="user-items d-flex flex-column" v-else>
									<FollowItem v-for="follow in follows" :key="follow.id" :follow="follow" class="py-1 my-1 follower-item"/>
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
	import FollowItem from '@/components/User/followItem.vue'
	import MyFollowItem from '@/components/User/myFollowItem.vue'
	export default {
		components:{
			FollowItem,
			MyFollowItem
		},
		props:['follows','count'],
		data(){
			return {
				isShow:false,
			}
		},
		computed:{
			...mapGetters(['_GetUser','_User'])
		},
		methods:{
			...mapActions(['removeFollow','getFollows','getFollowers']),
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
.follower-item{
	transition: all 0.3s;
}
.follower-item:hover{
	background-color: #e6e6e6;
	border-radius: 5px;
}
</style>
