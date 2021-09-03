import { createRouter, createWebHistory } from 'vue-router'

const routes = [
{
	path: '/index',
	name: 'Index',
	component: () => import( '../views/Index.vue')
},
{
	path: '/',
	name: 'Welcome',
	component: () => import( '../views/Welcome.vue')
},
{
	path: '/register',
	name: 'Register',
	component: () => import( '../views/Register.vue')
},

/*Index Routes*/

/*Profile Routes*/
{
	path: '/:username',
	name: 'MyProfile',
	component: () => import( '../views/User/MyProfile.vue')
},
{
	path: '/account/edit',
	name: 'AccountEdit',
	component: () => import( '../views/User/AccountEdit.vue')
},
{
	path: '/account/password/change',
	name: 'ChangePassword',
	component: () => import( '../views/User/ChangePassword.vue')
},
{
	path: '/activation/:code',
	name: 'VerifyEmail',
	component: () => import( '../components/User/verifyemail.vue')
},


]

const router = createRouter({
	history: createWebHistory(process.env.BASE_URL),
	routes
})

router.beforeEach((to, _, next) => {
	const authRequiredRoutes = ['Index','MyProfile','AccountEdit','VerifyEmail','ChangePassword'];
	const authNotRequiredRoutes  = ['Register','Welcome'];
	const emailActivationRoutes = ['VerifyEmail'];
	const token = localStorage.getItem('token')
	if(authRequiredRoutes.indexOf(to.name) > -1 && !token){
		router.push({name:'Welcome'})
	}else{
		next()
	}
	if (authNotRequiredRoutes.indexOf(to.name) > -1 && token) {
		router.push({name:'Index'})
	}else{
		next()
	}
	if (emailActivationRoutes.indexOf(to.name) > -1 && token) {
		if(to.params.code.length == 55){
			next()
		}else{
			router.push({name:'Index'})
		}
	}
});

export default router
