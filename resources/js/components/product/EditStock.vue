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
                                        <h1 class="h4 text-gray-900 mb-4">Update Stocks</h1>
                                    </div>
                                    <hr>
                                    <form class="user" @submit.prevent="stockUpdate" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label>Product Name :</label>
                                                    <input type="text" class="form-control" id="exampleInputName" v-model="form.product_name" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Product Code :</label>
                                                    <input type="text" class="form-control" id="exampleInputCode" v-model="form.product_code" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label>Product Category :</label>
                                                    <select class="form-control" id="exampleFormControlCategory" v-model="form.category_id">
                                                        <option :value="category.id" v-for="category in categories">{{ category.category_name }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Product Supplier :</label>
                                                    <select class="form-control" id="exampleFormControlSupplier" v-model="form.supplier_id">
                                                        <option :value="supplier.id" v-for="supplier in suppliers">{{ supplier.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <!--<div class="col-md-6">-->
                                                <!--    <label>Product Stock :</label>-->
                                                <!--    <input type="text" class="form-control" id="exampleInputStock" v-model="form.product_stock">-->
                                                <!--    <small class="text-danger" v-if="errors.product_stock"> {{ errors.product_stock[0]}} </small>-->
                                                <!--</div>-->
                                                <div class="col-md-6">
                                                    <label>Product Quantity :</label>
                                                    <input type="text" class="form-control" id="exampleInputQuantity" v-model="form.product_quantity">
                                                    <small class="text-danger" v-if="errors.product_quantity"> {{ errors.product_quantity[0]}} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                        </div>
                                    </form>
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
                form: {
                    // product_stock: '',
                    product_quantity: ''
                },
                errors: {},
                categories:{},
                suppliers:{}
            }
        },
        methods:{
            stockUpdate(){
                let id = this.$route.params.id
                axios.post('/api/stock/update/'+id,this.form)
                    .then(() => {
                        this.$router.push({ name: 'stock'})
                        Notification.success()
                    })
                    .catch(error =>this.errors = error.response.data.errors)
            }
        },
        created(){
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }

            let id = this.$route.params.id
            axios.get('/api/product/'+id)
                .then(({data}) => (this.form = data))
                .catch(console.log('error'))

            axios.get('/api/category/')
                .then(({data}) => (this.categories = data))

            axios.get('/api/supplier/')
                .then(({data}) => (this.suppliers = data))
        }
    }
</script>

<style scoped>

</style>
