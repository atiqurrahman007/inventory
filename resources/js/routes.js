import Login from './components/auth/login.vue';
import Register from './components/auth/register.vue';
import Logout from './components/auth/logout.vue';

//Dashboard
import Dashboard from './components/Dashboard/dashboard.vue';

//Employee 
import Employee from './components/Employee/index.vue';
import EmployeeAdd from './components/Employee/create.vue';






export let routes = [

    {
    	path: '/',
    	component: Login
    },
    {
    	path: '/register',
    	component: Register,
    	name:'register'
    },
    {
    	path: '/logout',
    	component: Logout,
    	name:'logout'
    },
    {
    	path: '/dashboard',
    	component: Dashboard,
    	name:'dashboard'
    },
    //Employee
    {path: '/employee', component: Employee, name:'employee'},
    {path: '/add-employee', component: EmployeeAdd, name:'add-employee'},
    



]