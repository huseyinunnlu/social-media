import { createStore } from 'vuex'
import Register from './modules/register';
import Login from './modules/login';
import EditProfile from './modules/editProfile';
const store = createStore({
	modules:{
		Register,
		Login,
		EditProfile
	}
});

export default store;