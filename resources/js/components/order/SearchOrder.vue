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
                                        <h1 class="h4 text-gray-900 mb-4">Search Orders</h1>
                                    </div>
                                    <hr>
                                    <form class="user" @submit.prevent="searchDate" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label>Search By Date :</label>
                                                    <input type="date" class="form-control" id="exampleInputDate" v-model="date" required>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                                        </div>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Sub Total</th>
                                        <th>Discount</th>
                                        <th>Total </th>
                                        <th>Payment Amount</th>
                                        <th>Payment Balance</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="order in orders">
                                        <td>{{ order.name }}</td>
                                        <td>RM {{ order.sub_total }}</td>
                                        <td>{{ order.discount}} %</td>
                                        <td>RM {{ order.total }}</td>
                                        <td>RM {{ order.pay_amount }}</td>
                                        <td>RM {{ order.pay_balance }}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                date:'',
                orders:{}
            }
        },
        methods:{
            searchDate(){
                var data = {date:this.date}
                axios.post('/api/order/order-search/',data)
                    .then(({data}) => (this.orders = data))
                    .catch(error =>this.errors = error.response.data.errors)
            },
        },
        created(){
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
        }
    }
</script>

<style scoped>

</style>
