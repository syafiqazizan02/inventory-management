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
                                        <h1 class="h4 text-gray-900 mb-4">New Product</h1>
                                    </div>
                                    <hr>
                                    <form class="user" @submit.prevent="productInsert" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label>Product Name :</label>
                                                    <input type="text" class="form-control" id="exampleInputName" v-model="form.product_name">
                                                    <small class="text-danger" v-if="errors.product_name"> {{ errors.product_name[0]}} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Product Code :</label>
                                                    <input type="text" class="form-control" id="exampleInputCode" v-model="form.product_code">
                                                    <small class="text-danger" v-if="errors.product_code"> {{ errors.product_code[0]}} </small>
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
                                                <div class="col-md-6">
                                                    <label>Buying Price :</label>
                                                    <input type="text" class="form-control" id="exampleInputBuyingPrice" v-model="form.buying_price">
                                                    <small class="text-danger" v-if="errors.buying_price"> {{ errors.buying_price[0]}} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Selling Price :</label>
                                                    <input type="text" class="form-control" id="exampleInputSellingPrice" v-model="form.selling_price">
                                                    <small class="text-danger" v-if="errors.selling_price"> {{ errors.selling_price[0]}} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label>Buying Date :</label>
                                                    <input type="date" class="form-control" id="exampleInputBuyingDate" v-model="form.buying_date">
                                                    <small class="text-danger" v-if="errors.buying_date"> {{ errors.buying_date[0]}} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Selling Date :</label>
                                                    <input type="date" class="form-control" id="exampleInputSellingDate" v-model="form.selling_date">
                                                    <small class="text-danger" v-if="errors.selling_date"> {{ errors.selling_date[0]}} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label>Product Stock :</label>
                                                    <input type="text" class="form-control" id="exampleInputStock" v-model="form.product_stock">
                                                    <small class="text-danger" v-if="errors.product_stock"> {{ errors.product_stock[0]}} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Product Quantity :</label>
                                                    <input type="text" class="form-control" id="exampleInputQuantity" v-model="form.product_quantity">
                                                    <small class="text-danger" v-if="errors.product_quantity"> {{ errors.product_quantity[0]}} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-2">
                                                    <label>Product Image :</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="file" class="custom-file-input" id="customFile"
                                                           @change="onFileSelected">
                                                    <small class="text-danger" v-if="errors.product_image"> {{ errors.product_image[0]}} </small>
                                                    <label class="custom-file-label" for="customFile">Choose File</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <img :src="form.product_image" style="height: 40px; width: 40px;">
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
                    product_name: null,
                    product_code: null,
                    category_id: null,
                    supplier_id: null,
                    buying_price: null,
                    selling_price: null,
                    buying_date: null,
                    selling_date: null,
                    product_stock: null,
                    product_quantity: null,
                    product_image: null
                },
                errors: {},
                categories:{},
                suppliers:{}
            }
        },
        methods:{
            onFileSelected(event){
                let file = event.target.files[0];
                if (file.size > 1048770) {
                    Notification.image_validation() // image helpers
                }else{
                    let reader = new FileReader();
                    reader.onload = event =>{
                        this.form.product_image = event.target.result
                    };
                    reader.readAsDataURL(file);
                }
            },
            productInsert(){
                axios.post('/api/product',this.form)
                    .then(() => {
                        this.$router.push({ name: 'product'})
                        Notification.success()
                    })
                    .catch(error =>this.errors = error.response.data.errors)
            },
        },
        created(){
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }

            axios.get('/api/category/')
                .then(({data}) => (this.categories = data))

            axios.get('/api/supplier/')
                .then(({data}) => (this.suppliers = data))
        }
    }
</script>

<style scoped>

</style>
