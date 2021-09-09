import { createStore } from 'vuex'
import Register from './modules/register';
import Login from './modules/login';
import EditProfile from './modules/editProfile';
import Profile from './modules/profile';
import Index from './modules/Index';
const store = createStore({
	modules:{
		Register,
		Login,
		EditProfile,
		Profile,
		Index,
	}
});

export default store;