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
                                        <h1 class="h4 text-gray-900 mb-4">Pay Salary by Employees</h1>
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
                                                <th>Salary</th>
                                                <th>Joining Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="employee in filtersearch" :key="employee.id">
                                                <!--<td><img :src="employee.photo" id="em_photo"></td>-->
                                                <td> {{ employee.name }}</td>
                                                <td>{{ employee.phone }}</td>
                                                <td>{{ employee.salary }}</td>
                                                <td>{{ employee.joining_date }}</td>
                                                <td>
                                                    <router-link :to="{name: 'pay-now-salary', params:{id:employee.id}}"
                                                                 class="btn btn-sm btn-primary">Pay</router-link>
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
                employees:[],
                searchTerm:''
            }
        },
        methods:{
            allEmployee(){
                axios.get('/api/employee/')
                    .then(({data}) => (this.employees = data))
                    .catch()
            }
        },
        created(){
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
            this.allEmployee(); // load get employee
        },
        computed:{
            filtersearch(){
                return this.employees.filter(employee => {
                    return employee.name.match(this.searchTerm)
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
