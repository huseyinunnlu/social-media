import { createStore } from 'vuex'
import Register from './modules/register';
import Login from './modules/login';
import EditProfile from './modules/editProfile';
import Profile from './modules/profile';
const store = createStore({
	modules:{
		Register,
		Login,
		EditProfile,
		Profile
	}
});

export default store;