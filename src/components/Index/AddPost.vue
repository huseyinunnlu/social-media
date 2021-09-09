<template>
	<loader v-if="_AddPostLoading" object="#fff" color1="#ffffff" color2="#17fd3d" size="4" speed="5" bg="#343a40" objectbg="#999793" opacity="80" name="spinning"></loader>
	<div class="post-add m-3">
		<div class="post-add-content d-flex justify-content-between">
			<h4>Posts</h4>

			<span>
				<button @click="showModal()" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add</button>
			</span>

			<Modal v-model="isShow" :close="closeModal">
				<div class="modal-container">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">	
							<div class="modal-header d-flex justify-content-center justify-content-between">
								<h5></h5>
								<h5 class="">Add Post</h5>
								<i @click="closeModal" style="cursor: pointer; font-size: 20px;" class="fas fa-times"></i>
							</div>
							<div class="modal-body m-2">
								<div class="images d-flex flex-wrap justify-content-center" style="width:100%;">
									<div class="image-item border py-2 m-2" style="width:25%;" v-for="(preview,index) in imagePreviews" :key="index">
										<a style="cursor:pointer;" @click="deleteImage(preview)"><i class="fas fa-times text-right"></i></a>
										<img :src="preview" style="width:100%; height: 200px;">
									</div>
								</div>
								<form @submit.prevent="addPost(this.form)">
									<div class="image-upload form-group my-3">
										<input type="file" class="form-control-file" multiple="" @change="isUploaded">
									</div>
									<div class="post-desc">
										<div class="form-group">
											<textarea class="form-control" rows="3" :maxlength="255" placeholder="Add description" v-model="form.desc"></textarea>
											<small :class="form.desc.length == 0 || form.desc.length < 255 ? 'text-success' : 'text-danger'" style="float:right;" v-text="form.desc.length+'/255'"></small>
										</div>
									</div>
									<div class="post-options my-3 row">
										<div class="form-group col-md-4">
											<label>Who can view?</label>
											<select class="form-select" v-model="form.isViewable">
												<option :value="null">Select Option</option>
												<option :value="'0'">Everyone</option>
												<option :value="'1'">Only Me</option>
												<option :value="'2'">Only My Followers</option>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label>Who can like?</label>
											<select class="form-select" v-model="form.isLikeable">
												<option :value="null">Select Option</option>
												<option :value="'0'">Everyone</option>
												<option :value="'1'">Nobody</option>
												<option :value="'2'">Only My Followers</option>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label>Who can comment?</label>
											<select class="form-select" v-model="form.isCommentable">
												<option :value="null">Select Option</option>
												<option :value="'0'">Everyone</option>
												<option :value="'1'">Nobody</option>
												<option :value="'2'">Only My Followers</option>
											</select>
										</div>
									</div>
									<button type="submit" 
									class="btn btn-primary btn-sm"
									:disabled="form.desc.length > 255 || form.images.length == 0 || form.isLikeable == null || form.isCommentable == null || form.isViewable == null"
									>Add Post</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</Modal>
		</div>
	</div>
</template>
<script>
	import {mapGetters,mapActions} from 'vuex'
	export default {
		data(){
			return {
				isShow:false,
				isLoading:false,
				imagePreviews:[],
				form:{
					images:[],
					desc:'',
					isLikeable:null,
					isCommentable:null,
					isViewable:null,
				}
			}
		},
		computed:{
			...mapGetters(['_AddPostLoading'])
		},
		methods:{
			...mapActions(['getPosts']),
			showModal(){
				this.isShow = true
			},
			closeModal(){
				this.isShow = false
			},
			isUploaded(e){
				for(var i = 0; i <= e.target.files.length - 1; i++){
					this.form.images.push(e.target.files[i])
					this.imagePreviews.push(URL.createObjectURL(e.target.files[i]))
				}
			},
			deleteImage(image){
				let index = this.imagePreviews.indexOf(image)
				if (index > -1) {
					this.imagePreviews.splice(index,1)
					this.form.images.splice(index,1)
				}
			},
			addPost(){
				this.isLoading = true
				const formData = new FormData();
				for(var i = 0; i <= this.form.images.length - 1; i++){
					formData.append('image['+i+']',this.form.images[i])
				}
				formData.append('imageCount', this.form.images.length - 1)
				formData.append('desc',this.form.desc)
				formData.append('isLikeable',this.form.isLikeable)
				formData.append('isCommentable',this.form.isCommentable)
				formData.append('isViewable',this.form.isViewable)
				this.$appAxios.post('/addpost',formData)
				.then(()=>{
					this.getPosts()
					this.imagePreviews = []
					this.form.images = []
					this.form.desc = ''
					this.form.isLikeable = null
					this.form.isCommentable = null
					this.form.isViewable = null
					this.closeModal()
				})
				.catch(err=>{
					console.log(err)
				})
				.finally(()=>{
					this.isLoading = false
				})
			}

		}
	}
</script>
<style>
.modal-container{
	width: 100%;
	position: absolute;
	top: 10%;
}
.image-item i {
	position: relative;
	top: -2px;
	right: 5px;
	float: right;
}
</style>