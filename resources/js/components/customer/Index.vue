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
                                        <h1 class="h4 text-gray-900 mb-4">View Customers</h1>
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
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="customer in filtersearch" :key="customer.id">
                                                    <!--<td><img :src="customer.photo" id="em_photo"></td>-->
                                                    <td>{{ customer.name }}</td>
                                                    <td>{{ customer.phone }}</td>
                                                    <td>{{ customer.email }}</td>
                                                    <td>{{ customer.address }}</td>
                                                    <td>
                                                        <router-link :to="{name: 'edit-customer', params:{id:customer.id}}"
                                                                     class="btn btn-sm btn-primary">Edit</router-link>
                                                        <a @click="deleteCustomer(customer.id)"
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
                customers:[],
                searchTerm:''
            }
        },
        methods:{
            allCustomer(){
                axios.get('/api/customer/')
                    .then(({data}) => (this.customers = data))
                    .catch()
            },
            deleteCustomer(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/customer/'+id)
                            .then(() => {
                                this.customers = this.customers.filter(customer => {
                                    return customer.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push({name: 'customer'})
                            })
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
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
            this.allCustomer(); // load get employee
        },
        computed:{
            filtersearch(){
                return this.customers.filter(customer => {
                    return customer.name.match(this.searchTerm)
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
