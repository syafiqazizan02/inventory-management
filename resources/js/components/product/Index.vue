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
                                        <h1 class="h4 text-gray-900 mb-4">View Products</h1>
                                    </div>
                                    <hr>
                                    <input type="text" v-model="searchTerm" class="form-control"
                                           style="float:right; width:200px;" placeholder="Search by (Name)"><br><br>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <!--<th>Photo</th>-->
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Buying Price</th>
                                                <th>Selling Price</th>
                                                <th>Stock</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="product in filtersearch" :key="product.id">
                                                <!--<td><img :src="product.product_image" id="em_photo"></td>-->
                                                <td>{{ product.product_name }}</td>
                                                <td>{{ product.category_name }}</td>
                                                <td>{{ product.buying_price }}</td>
                                                <td>{{ product.selling_price }}</td>
                                                <td>{{ product.product_stock }}</td>
                                                <td>
                                                    <router-link :to="{name: 'edit-product', params:{id:product.id}}"
                                                                 class="btn btn-sm btn-primary">Edit</router-link>
                                                    <a @click="deleteProduct(product.id)"
                                                       class="btn btn-sm btn-danger" style="color:white;">Delete</a>
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
                products:[],
                searchTerm:''
            }
        },
        methods:{
            allProduct(){
                axios.get('/api/product/')
                    .then(({data}) => (this.products = data))
                    .catch()
            },
            deleteProduct(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/product/'+id)
                            .then(() => {
                                this.products = this.products.filter(product => {
                                    return product.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push({name: 'product'})
                            })
                        Swal.fire(
                            'Deleted!',
                            'Successfully deleted.',
                            'success'
                        )
                    }
                })

            }
        },
        created(){
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
            this.allProduct(); // load get employee
        },
        computed:{
            filtersearch(){
                return this.products.filter(product => {
                    return product.product_name.match(this.searchTerm)
                })
            }
        },
    }
</script>

<style scoped>
    #em_photo{
        height: 40px;
        width: 40px;
    }
</style>
