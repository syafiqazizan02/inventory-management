<template>
    <div>
<!--        <div class="row justify-content-center">-->
<!--            <div class="col-xl-12 col-lg-12 col-md-12">-->
<!--                <div class="card shadow-sm my-5">-->
<!--                    <div class="card-body p-0">-->
<!--                        <div class="row">-->
<!--                            <div class="col-lg-12">-->
<!--                                <div class="login-form">-->
<!--&lt;!&ndash;                                    <div class="text-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <h1 class="h4 text-gray-900 mb-4">View Products</h1>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <hr>&ndash;&gt;-->
<!--                                    Hello World!-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <!-- Container Fluid-->
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
                            <h5 class="m-0 text-gray-900">Monthly Recap Report</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                123
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-7">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h5 class="m-0 text-gray-900">Monthly Recap Report</h5>
                        </div>
<!--                        <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top: 20px;">-->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Product</a>
                            </li>
                            <li class="nav-item" v-for="category in categories" :key="category.id">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="subProduct(category.id)" >{{ category.category_name }}</a>
<!--                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ category.category_name }}</a>-->
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card-body">
                                    <input type="text" v-model="searchTerm" class="form-control" style="width: 590px;  margin-bottom: 8px;" placeholder="Search Product">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filtersearch" :key="product.id">
                                            <a href="#">
                                                <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                                                    <img :src="product.product_image" id="em_photo" class="card-img-top">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ product.product_name }}</h6>
                                                        <span class="badge badge-success" v-if="product.product_quantity  >= 1 ">Available {{ product.product_quantity }}  </span>
                                                        <span class="badge badge-danger" v-else="">Stock Out </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
        <!---Container Fluid-->
    </div>
</template>

<script>
    export default {
        data(){
            return{
                products:[],
                categories:[],
                getproducts:[],
                searchTerm:'',
                getsearchTerm:'',
            }
        },
        methods:{
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
            }
        },
        created(){
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
            this.allProduct(); // load get Product
            this.allCategory(); // load get Category
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
