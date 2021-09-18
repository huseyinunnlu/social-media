import { createRouter, createWebHistory } from 'vue-router'
//import store from '../store/index.js'

const routes = [
{
	path:'/404',
	name:'404',
	component: () => import( '../views/404.vue' )
},
{
	path: '/index',
	name: 'Index',
	component: () => import( '../views/Index/Index.vue')
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
	path: '/u/:username',
	name: 'Profile',
	component: () => import( '../views/User/Profile.vue')
},
{
	path: '/u/:username/saved',
	name: 'ProfileSaved',
	component: () => import( '../views/User/ProfileSaved.vue')
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

/*Post Routes*/
{
	path: '/p/:url',
	name: 'PostArticle',
	component: () => import( '../views/Index/PostArticle.vue'),
	beforeRouteEnter: () => {
		console.log(router.currentRoute.value)
       //store.dispatch('getPostArticle')
    }
},

]

const router = createRouter({
	history: createWebHistory(process.env.BASE_URL),
	duplicateNavigationPolicy: 'reject',
	routes
})

router.beforeEach((to, _, next) => {
	const authRequiredRoutes = ['Index','MyProfile','AccountEdit','VerifyEmail','ChangePassword'];
	//const authNotRequiredRoutes  = ['Register','Welcome'];
	const emailActivationRoutes = ['VerifyEmail'];
	const token = localStorage.getItem('token')
	if(authRequiredRoutes.indexOf(to.name) > -1 && !token){
		router.push({name:'Welcome'})
	}else if(emailActivationRoutes.indexOf(to.name) > -1 && token && to.params.code.length != 55){	
		router.push({name:'Index'})
	}else{
		next()
	}
	
	
});
router.beforeEach((to,_,next)=>{
	const authNotRequiredRoutes  = ['Register','Welcome'];
	const token = localStorage.getItem('token')

	if (authNotRequiredRoutes.indexOf(to.name) > -1 && token) {
		router.push({name:'Index'})
	}else{
		next()
	}
});
export default router
