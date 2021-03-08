<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">POS</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">POS</li>
                </ol>
            </div>

            <div class="row mb-3">
                <div class="col-xl-5 col-lg-5">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h5 class="m-0 text-gray-900">Expenses Insert</h5>
                        </div>

                        <div class="table-responsive" style="font-size: 12px">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>Quantity</td>
                                    <td>Unit</td>
                                    <td>Total</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">X</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">Total Quantity:
                                    <strong>10</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total:
                                    <strong>15</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Vat:
                                    <strong>5</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Total:
                                    <strong>20</strong>
                                </li>
                            </ul><br>

                            <form>
                                <label>Customer Name</label>
                                <select class="form-control" v-model="customer_id">
                                    <option :value="customer.id" v-for="customer in customers">{{customer.name }} </option>
                                </select>
                                <label style="margin-top: 8px;">Pay</label>
                                <input type="text" class="form-control" v-model="pay" required="">
                                <label style="margin-top: 8px;">Due</label>
                                <input type="text" class="form-control" v-model="due" required="">
                                <label style="margin-top: 8px;">Pay By</label>
                                <select class="form-control" v-model="payby" required="">
                                    <option value="HandCash">Hand Cash</option>
                                    <option value="Cheaque">Cheaque</option>
                                    <option value="GiftCard">Gift Card</option>
                                </select>
                                <br>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-7">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h5 class="m-0 text-gray-900">Products List</h5>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top: 10px;">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Product</a>
                            </li>
                            <li class="nav-item" v-for="category in categories" :key="category.id">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="subProduct(category.id)" >{{ category.category_name }}</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card-body">
                                    <input type="text" v-model="searchTerm" class="form-control" style="width: 590px;  margin-bottom: 8px;" placeholder="Search Product">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filtersearch" :key="product.id">
                                            <button class="btn btn-sm" @click.prevent="AddToCart(product.id)">
                                                <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                                                    <img :src="product.product_image" id="em_photo" class="card-img-top">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ product.product_name }}</h6>
                                                        <span class="badge badge-success" v-if="product.product_quantity  >= 1 ">Available {{ product.product_quantity }}  </span>
                                                        <span class="badge badge-danger" v-else="">Stock Out </span>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="card-body">
                                    <input type="text" v-model="getsearchTerm" class="form-control" style="width: 590px;  margin-bottom: 8px;" placeholder="Search Product">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="getproduct in getfiltersearch" :key="getproduct.id">
                                            <a href="#">
                                                <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                                                    <img :src="getproduct.product_image" id="em_photo" class="card-img-top">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ getproduct.product_name }}</h6>
                                                        <span class="badge badge-success" v-if="getproduct.product_quantity  >= 1 ">Available {{ getproduct.product_quantity }}  </span>
                                                        <span class="badge badge-danger" v-else="">Stock Out </span>
                                                    </div>
                                                </div>
                                            </a>
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
        data(){
            return{
                customer_id:'',
                pay:'',
                due:'',
                payby:'',

                products:[],
                categories:[],
                getproducts:[],
                searchTerm:'',
                getsearchTerm:'',
                customers:[],
            }
        },
        methods:{
            // Pos Data
            allProduct(){
                axios.get('/api/product/')
                    .then(({data}) => (this.products = data))
                    .catch()
            },
            allCategory(){
                axios.get('/api/category/')
                    .then(({data}) => (this.categories = data))
                    .catch()
            },
            subProduct(id){
                axios.get('/api/product/get-product/'+id)
                    .then(({data}) => (this.getproducts = data))
                    .catch()
            },
            allCustomer(){
                axios.get('/api/customer/')
                    .then(({data}) => (this.customers = data))
                    .catch()
            },

            // Pos Process
            AddToCart(id){
                axios.get('/api/cart/add-to-cart/'+id)
                    .then(() => {
                        // Reload.$emit('Add To Cart!');
                        Notification.cart_success()
                    })
                    .catch()
            }
        },
        created(){
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
            this.allProduct(); // load get Product
            this.allCategory(); // load get Category
            this.allCustomer(); // load get Customer
        },
        computed:{
            filtersearch(){
                return this.products.filter(product => {
                    return product.product_name.match(this.searchTerm)
                })
            },
            getfiltersearch(){
                return this.getproducts.filter(getproduct => {
                    return getproduct.product_name.match(this.getsearchTerm)
                })
            }
        },
    }
</script>

<style type="text/css" scoped>
    #em_photo{
        height: 100px;
        width: 135px;
    }
</style>
