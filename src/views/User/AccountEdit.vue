<template>
	<Navbar />
	<div class="container">
		<div class="row">
			<div class="settings d-flex my-4">
				<SettingsNavbar style="width: 25%;"/>
				<div class="settings-main border" style="width:75%;">
					<AccountEditForm />
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import SettingsNavbar from '@/components/User/settingsnavbar.vue'
	import AccountEditForm from '@/components/User/accounteditform.vue'
	export default {
		components:{
			SettingsNavbar,
			AccountEditForm
		}
	}
</script>