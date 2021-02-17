let Login = require('./components/auth/Login.vue').default;
let Register = require('./components/auth/Register.vue').default;
let Forget = require('./components/auth/Forget.vue').default;
let Logout = require('./components/auth/Logout.vue').default;
let Home = require('./components/Home.vue').default;

let NewEmployee = require('./components/employee/Create.vue').default;
let Employee = require('./components/employee/Index.vue').default;
let EditEmployee = require('./components/employee/Edit.vue').default;

let NewSupplier = require('./components/supplier/Create.vue').default;
let Supplier = require('./components/supplier/Index.vue').default;
let EditSupplier = require('./components/supplier/Edit.vue').default;

export const routes = [
    { path: '/', component: Login, name:'/'},
    { path: '/register', component: Register, name:'register'},
    { path: '/forget', component: Forget, name:'forget'},
    { path: '/logout', component: Logout, name:'logout'},
    { path: '/home', component: Home, name:'home'},

    { path: '/new-employee', component: NewEmployee, name:'new-employee'},
    { path: '/employee', component: Employee, name:'employee'},
    { path: '/edit-employee/:id', component: EditEmployee, name:'edit-employee'},

    { path: '/new-supplier', component: NewSupplier, name:'new-supplier'},
    { path: '/supplier', component: Supplier, name:'supplier'},
    { path: '/edit-supplier/:id', component: EditSupplier, name:'edit-supplier'},

]
