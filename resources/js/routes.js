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

let NewCategory = require('./components/category/Create.vue').default;
let Category = require('./components/category/Index.vue').default;
let EditCategory = require('./components/category/Edit.vue').default;

let NewProduct = require('./components/product/Create.vue').default;
let Product = require('./components/product/Index.vue').default;
let EditProduct = require('./components/product/Edit.vue').default;

let NewExpense = require('./components/expense/Create.vue').default;
let Expense = require('./components/expense/Index.vue').default;
let EditExpense = require('./components/expense/Edit.vue').default;

let PaySalary = require('./components/salary/PaySalary.vue').default;
let PayNowSalary = require('./components/salary/PayNowSalary.vue').default;
let Salary = require('./components/salary/Index.vue').default;
let DetailsSalary = require('./components/salary/View.vue').default;
let EditSalary = require('./components/salary/Edit.vue').default;

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

    { path: '/new-category', component: NewCategory, name:'new-category'},
    { path: '/category', component: Category, name:'category'},
    { path: '/edit-category/:id', component: EditCategory, name:'edit-category'},

    { path: '/new-product', component: NewProduct, name:'new-product'},
    { path: '/product', component: Product, name:'product'},
    { path: '/edit-product/:id', component: EditProduct, name:'edit-product'},

    { path: '/new-expense', component: NewExpense, name:'new-expense'},
    { path: '/expense', component: Expense, name:'expense'},
    { path: '/edit-expense/:id', component: EditExpense, name:'edit-expense'},

    { path: '/pay-salary', component: PaySalary, name:'pay-salary'},
    { path: '/pay-now-salary/:id', component: PayNowSalary, name:'pay-now-salary'},
    { path: '/salary', component: Salary, name:'salary'},
    { path: '/details-salary', component: DetailsSalary, name:'details-salary'},
    { path: '/edit-salary/:id', component: EditSalary, name:'edit-salary'},

]
