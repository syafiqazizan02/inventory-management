<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">View Orders</h1>
                                    </div>
                                    <hr>
                                    <input type="text" v-model="searchTerm" class="form-control"
                                           style="float:right; width:200px;" placeholder="Search by (Name)"><br><br>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Total Price</th>
                                                <th>Payment Method</th>
                                                <th>Payment Amount</th>
                                                <th>Payment Balance</th>
                                                <th>Order Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="order in filtersearch" :key="order.id">
                                                <td> {{ order.name }} </td>
                                                <td>RM {{ order.total }} </td>
                                                <td> {{ order.pay_method }} </td>
                                                <td>RM {{ order.pay_amount }} </td>
                                                <td>RM {{ order.pay_balance }} </td>
                                                <td>{{ order.order_date }} </td>
                                                <td>
                                                    <router-link :to="{name: 'view-order', params:{id:order.id}}" class="btn btn-sm btn-primary">Details</router-link>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                orders:[],
                searchTerm:''
            }
        },
        methods:{
            allOrder(){
                axios.get('/api/order/order-views/')
                    .then(({data}) => (this.orders = data))
                    .catch()
            }
        },
        created(){
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
            this.allOrder();
        },
        computed:{
            filtersearch(){
                return this.orders.filter(order => {
                    return order.name.match(this.searchTerm)
                })
            }
        },
    }
</script>

<style scoped>

</style>
