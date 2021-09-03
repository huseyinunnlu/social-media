<template>
	<loader v-if="isLoading || _EditLoading" object="#fff" color1="#ffffff" color2="#17fd3d" size="4" speed="5" bg="#343a40" objectbg="#999793" opacity="80" name="spinning"></loader>
	<div class="account-form my-4 mx-5 row col-md-8 offset-md-2 ">
		<div class="form-group row">
			<img v-if="!imagePreview" :src="_User.image" class="rounded-circle col-sm-2 mx-2" style="width: 80px;">
			<img v-else :src="imagePreview" class="rounded-circle col-sm-2 mx-2" style="width: 80px;">
			<div class="col-sm-8">
				<input type="file" class="form-control-file form-control-sm mt-3" @change="isUploaded">	<br>
				<small class="text-danger" v-if="_EditError.image" v-text="_EditError.image[0]"></small>
			</div>
		</div>
		<form @submit.prevent="editProfile(this.form)">
			<div class="form-group row">
				<label class="col-sm-2">Full Name</label>
				<div class="col-sm-8">
					<input type="text" class="form-control form-control-sm" placeholder="Full Name" v-model="form.fullname">
					<small class="text-danger" v-if="_EditError.fullname" v-text="_EditError.fullname[0]"></small>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2">Username</label>
				<div class="col-sm-8">
					<input type="text" class="form-control form-control-sm" placeholder="Username" v-model="form.username">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2">Bio</label>
				<div class="col-sm-8">
					<textarea class="form-control" v-model="form.bio" placeholder="Biography" row="3"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2">Email</label>
				<div class="col-sm-8">
					<input type="text" class="form-control form-control-sm" placeholder="Email" v-model="form.email">
					<div v-if="_User.isEmailVerified == 0 && !isEmailChanged && _User.email" class="verify d-flex justify-content-between mt-1">
						<small class="text-danger"><i class="fas fa-times"></i> Not Verified</small>
						<small><a href="#" class="text-primary"
						@click="sendEmailCode({
							email:form.email,
						})">Verify</a></small>
					</div>
					<div v-if="_User.isEmailVerified == 1 && !isEmailChanged && _User.email" class="verify d-flex justify-content-between mt-1">
						<small class="text-success"><i class="fas fa-check"></i> Verified</small>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2">Phone</label>
				<div class="col-sm-8">
					<input type="text" class="form-control form-control-sm" placeholder="Phone" v-model="form.phone">
					<div v-if="_User.isPhoneVerified == 0 && !isPhoneChanged && _User.phone" class="verify d-flex justify-content-between mt-1">
						<small class="text-danger"><i class="fas fa-times"></i> Not Verified</small>
						<small><a href="#" class="text-primary">Verify</a></small>
					</div>
					<div v-if="_User.isPhoneVerified == 1 && !isPhoneChanged && _User.phone" class="verify d-flex justify-content-between mt-1">
						<small class="text-success"><i class="fas fa-check"></i> Verified</small>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2">Gender</label>
				<div class="col-sm-8">
					<select class="form-select form-select-sm" v-model="form.gender">
						<option :value="null">Select A Gender</option>
						<option :value="'0'">Prefer to not say</option>
						<option :value="'1'">Male</option>
						<option :value="'2'">Female</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2"></label>
				<div class="col-sm-8">
					<button type="submit" class="btn btn-success btn-sm">Update</button>
				</div>
			</div>
		</form>

	</div>
</template>
<script>
	import {mapGetters,mapActions} from 'vuex'
	export default {
		data(){
			return {
				imagePreview:null,
				isLoading:false,	
				form:[],
				isEmailChanged:false,
				isPhoneChanged:false,
			}
		},
		watch: {
			'form.phone'(val){
				if(val == this._User.phone){
					this.isPhoneChanged = false
				}else{
					this.isPhoneChanged = true
				}
			},
			'form.email'(val){
				if(val == this._User.email){
					this.isEmailChanged = false
				}else{
					this.isEmailChanged = true
				}
			},
		},
		computed:{
			...mapGetters(['_User','_UserForm','_EditError','_EditLoading'])
		},
		created(){
			this.getUser()
		},
		methods:{
			...mapActions(['editProfile','sendEmailCode','updateImage']),
			getUser(){
				this.isLoading = true
				this.$appAxios.get('/user')
				.then(res=>{
					this.form = res.data
				})
				.catch(()=>{
					this.form = []
				})
				.finally(()=>{
					this.isLoading = false
				})
			},
			isUploaded(e){
				let image = e.target.files[0]
				this.updateImage(image)
				this.imagePreview = URL.createObjectURL(image)
			},
		}
	}
</script>
<style>
.form-group {
	margin: 20px 0;
}
</style>