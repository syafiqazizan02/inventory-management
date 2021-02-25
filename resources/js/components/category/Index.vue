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
                                        <h1 class="h4 text-gray-900 mb-4">View Categories</h1>
                                    </div>
                                    <hr>
                                    <input type="text" v-model="searchTerm" class="form-control"
                                           style="float:right; width:200px;" placeholder="Search by (Name)"><br><br>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th width="70%">Name</th>
                                                <th width="30%">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="category in filtersearch" :key="category.id">
                                                <td> {{ category.category_name }}</td>
                                                <td>
                                                    <router-link :to="{name: 'edit-category', params:{id:category.id}}"
                                                                 class="btn btn-sm btn-primary">Edit</router-link>
                                                    <a @click="deleteCategory(category.id)"
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
                categories:[],
                searchTerm:''
            }
        },
        methods:{
            allCategory(){
                axios.get('/api/category/')
                    .then(({data}) => (this.categories = data))
                    .catch()
            },
            deleteCategory(id){
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
                        axios.delete('/api/category/'+id)
                            .then(() => {
                                this.categories = this.categories.filter(category => {
                                    return category.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push({name: 'category'})
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
            this.allCategory(); // load get category
        },
        computed:{
            filtersearch(){
                return this.categories.filter(category => {
                    return category.category_name.match(this.searchTerm)
                })
            }
        },
    }
</script>

<style scoped>

</style>
