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
                                        <h1 class="h4 text-gray-900 mb-4">View Supplier</h1>
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
                                                <th>Shop</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="supplier in filtersearch" :key="supplier.id">
                                                <!--<td><img :src="supplier.photo" id="em_photo"></td>-->
                                                <td> {{ supplier.name }}</td>
                                                <td>{{ supplier.phone }}</td>
                                                <td>{{ supplier.shop }}</td>
                                                <td>
                                                    <router-link :to="{name: 'edit-supplier', params:{id:supplier.id}}"
                                                                 class="btn btn-sm btn-primary">Edit</router-link>
                                                    <a @click="deleteSupplier(supplier.id)"
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
                supplies:[],
                searchTerm:''
            }
        },
        methods:{
            allSupplier(){
                axios.get('/api/supplier/')
                    .then(({data}) => (this.supplies = data))
                    .catch()
            },
            deleteSupplier(id){
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
                        axios.delete('/api/supplier/'+id)
                            .then(() => {
                                this.supplies = this.supplies.filter(supplier => {
                                    return supplier.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push({name: 'supplier'})
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
            this.allSupplier(); // load get supplier
        },
        computed:{
            filtersearch(){
                return this.supplies.filter(supplier => {
                    return supplier.name.match(this.searchTerm)
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
