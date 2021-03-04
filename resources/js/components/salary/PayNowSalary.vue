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
                                        <h1 class="h4 text-gray-900 mb-4">Pay Salary</h1>
                                    </div>
                                    <hr>
                                    <form class="user" @submit.prevent="salaryPaid" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label>Full Name :</label>
                                                    <input type="text" class="form-control" id="exampleInputName" v-model="form.name" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Employee Code :</label>
                                                    <input type="text" class="form-control" id="exampleInputCode" v-model="form.code" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label>Monthly Select :</label>
                                                    <select class="form-control" id="exampleFormControlSalaryMonth" v-model="form.salary_month">
                                                        <option value="January"> January </option>
                                                        <option value="February"> February </option>
                                                        <option value="March"> March </option>
                                                        <option value="April"> April </option>
                                                        <option value="May"> May </option>
                                                        <option value="Jun"> Jun </option>
                                                        <option value="July"> July </option>
                                                        <option value="August"> August </option>
                                                        <option value="September"> September </option>
                                                        <option value="October"> October </option>
                                                        <option value="November"> November </option>
                                                        <option value="December"> December </option>
                                                    </select>
                                                    <small class="text-danger" v-if="errors.salary_month"> {{ errors.salary_month[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Monthly Salary :</label>
                                                    <input type="text" class="form-control" id="exampleInputSalary" v-model="form.salary">
                                                    <small class="text-danger" v-if="errors.salary"> {{ errors.salary[0] }} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Pay Now</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <hr>
                                    Display Employee Salary by Months...
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
                    salary: "",
                    salary_month: ""
                },
                errors: {}
            };
        },
        methods: {
            salaryPaid() {
                let id = this.$route.params.id
                axios.post('/api/salary/pay/'+id,this.form)
                    .then(() => {
                        this.$router.push({ name: 'pay-salary'})
                        Notification.success()
                    })
                    .catch(error =>this.errors = error.response.data.errors)
            }
        },
        created() {
            if (!User.loggedIn()) {
                this.$router.push({ name: "/" });
            }

            // fetch get employee by id (shows())
            let id = this.$route.params.id;
            axios.get("/api/employee/" + id)
                .then(({ data }) => (this.form = data)) // access data (data())
                .catch(console.log("error"));
        }
    };
</script>

<style scoped>

</style>
