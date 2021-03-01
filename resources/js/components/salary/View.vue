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
                                        <h1 class="h4 text-gray-900 mb-4">View Salary</h1>
                                    </div>
                                    <hr>
                                    <input type="text" v-model="searchTerm" class="form-control"
                                           style="float:right; width:200px;" placeholder="Search by (Month)"><br><br>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Month</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="salary in filtersearch" :key="salary.id">
                                                    <td>{{ salary.name }}</td>
                                                    <td>{{ salary.salary_month }}</td>
                                                    <td>{{ salary.amount }}</td>
                                                    <td>{{ salary.salary_date }}</td>
                                                    <td>
                                                        <router-link :to="{name: 'edit-salary', params:{id:salary.id}}" class="btn btn-sm btn-primary">Edit</router-link>
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
                salaries:[],
                searchTerm:''
            }
        },
        methods:{
            viewSalary(){
                let id = this.$route.params.id
                axios.get('/api/salary/view/'+id)
                    .then(({data}) => (this.salaries = data))
                    .catch(error =>this.errors = error.response.data.errors)
            }
        },
        created(){
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
            this.viewSalary(); // load get salaries
        },
        computed:{
            filtersearch(){
                return this.salaries.filter(salary => {
                    return salary.name.match(this.searchTerm)
                })
            }
        }
    }
</script>

<style scoped>

</style>
