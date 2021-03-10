<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>

        <div class="row mb-3">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Today Sales</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">RM {{ todaySales }}</div>
<!--                                <div class="mt-2 mb-0 text-muted text-xs">-->
<!--                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>-->
<!--                                    <span>Since last month</span>-->
<!--                                </div>-->
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Today Income</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">RM {{ todayIncome }} </div>
<!--                                <div class="mt-2 mb-0 text-muted text-xs">-->
<!--                                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>-->
<!--                                    <span>Since last years</span>-->
<!--                                </div>-->
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Today Due</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">RM {{ todayDue }} </div>
<!--                                <div class="mt-2 mb-0 text-muted text-xs">-->
<!--                                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>-->
<!--                                    <span>Since last month</span>-->
<!--                                </div>-->
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Today Expense</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">RM {{ todayExpense }} </div>
<!--                                <div class="mt-2 mb-0 text-muted text-xs">-->
<!--                                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>-->
<!--                                    <span>Since yesterday</span>-->
<!--                                </div>-->
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-gray-800 text-center">Product Out Of Stock </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Buying Price</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in products" :key="product.id">
                                    <td><img :src="product.product_image" id="em_photo"></td>
                                    <td> {{ product.product_name }} </td>
                                    <td> {{ product.product_code }} </td>
                                    <td>{{ product.buying_price }}</td>
                                    <td v-if="product.product_quantity  >= 1 "><span class="badge badge-success">Available </span></td>
                                    <td v-else=" "><span class="badge badge-danger">Out Of Stock</span></td>
                                    <td>{{ product.product_quantity }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                sales:'',
                income:'',
                due:'',
                expense:'',
                products:''
            }
        },
        methods:{
            TodaySales(){
                axios.get('/api/dashboard/today-sales')
                    .then(({data}) => (this.sales = data))
                    .catch()
            },
            TodayIncome(){
                axios.get('/api/dashboard/today-income')
                    .then(({data}) => (this.income = data))
                    .catch()
            },
            TodayDue(){
                axios.get('/api/dashboard/today-due')
                    .then(({data}) => (this.due = data))
                    .catch()
            },
            TodayExpense(){
                axios.get('/api/dashboard/today-expense')
                    .then(({data}) => (this.expense = data))
                    .catch()
            },
            StockOut(){
                axios.get('/api/dashboard/stock-out')
                    .then(({data}) => (this.products = data))
                    .catch()
            },
        },
        computed:{
            todaySales(){
                let value = this.sales;
                let decimal = Number(value).toFixed(2);
                return decimal;
            },
            todayIncome(){
                let value = this.income;
                let decimal = Number(value).toFixed(2);
                return decimal;
            },
            todayDue(){
                let value = this.due;
                let decimal = Number(value).toFixed(2);
                return decimal;
            },
            todayExpense(){
                let value = this.expense;
                let decimal = Number(value).toFixed(2);
                return decimal;
            },
        },
        mounted(){
            this.TodaySales();
            this.TodayIncome();
            this.TodayDue();
            this.TodayExpense();
            this.StockOut();
        },
        created(){
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
        },
    }
</script>

<style scoped>
    #em_photo{
        height: 100px;
        width: 135px;
    }
</style>
