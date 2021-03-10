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
                                        <h1 class="h4 text-gray-900 mb-4">Order Details</h1>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6 mb-4">
                                            <div class="card">
                                                <div class="table-responsive">
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><b>Name :</b> {{ orders.name }} </li>
                                                        <li class="list-group-item"><b>Phone :</b> {{ orders.phone }}</li>
                                                        <li class="list-group-item"><b>Address :</b> {{ orders.address }}</li>
                                                        <li class="list-group-item"><b>Order Date :</b> {{ orders.order_date }}</li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer">
                                                    <b>Payment Method :</b> {{ orders.pay_method }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="card">
                                                <div class="table-responsive">
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><b>Sub Total :</b> RM {{ orders.sub_total }}</li>
                                                        <li class="list-group-item"><b>Discount :</b> {{ orders.discount }} %</li>
                                                        <li class="list-group-item"><b>Total :</b> RM {{ orders.total }}</li>
                                                        <li class="list-group-item"><b>Payment  Amount :</b> RM {{ orders.pay_amount }}</li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer">
                                                    <b>Payment Balance :</b> RM {{ orders.pay_balance }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <div class="card">
                                                <div class="table-responsive">
                                                    <table class="table align-items-center table-flush">
                                                        <thead class="thead-light">
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>Product Name</th>
                                                            <th>Product Code</th>
                                                            <th>Unit Price</th>
                                                            <th>Quantity</th>
                                                            <th>Total Price</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="detail in details">
                                                            <td><img :src="'/'+detail.product_image" id="em_photo"></td>
                                                            <td>{{ detail.product_name }}</td>
                                                            <td>{{ detail.product_code }}</td>
                                                            <td>RM {{ detail.pro_price }}</td>
                                                            <td>{{ detail.pro_quantity }}</td>
                                                            <td>RM {{ detail.sub_total }}</td>
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
                orders:{},
                details:{},
            }
        },
        methods:{

        },
        created(){
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }

            let id = this.$route.params.id

            axios.get('/api/order/order-infos/'+id)
                .then(({data}) => (this.orders = data))
                .catch(console.log('error'))

            axios.get('/api/order/order-details/'+id)
                .then(({data}) => (this.details = data))
                .catch(console.log('error'))
        }
    }
</script>

<style scoped>
    #em_photo{
        height: 40px;
        width: 40px;
    }
</style>
