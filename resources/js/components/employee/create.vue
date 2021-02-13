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
                                        <h1 class="h4 text-gray-900 mb-4">Add Employee</h1>
                                    </div>
                                    <form class="user" @submit.prevent="employeeInsert" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputName"
                                                           placeholder="Enter Name" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0]}} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="email" class="form-control" id="exampleInputEmail"
                                                           placeholder="Enter Email" v-model="form.email">
                                                    <small class="text-danger" v-if="errors.email"> {{ errors.email[0]}} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputIcNumber"
                                                           placeholder="Enter IC Number" v-model="form.ic">
                                                    <small class="text-danger" v-if="errors.ic"> {{ errors.ic[0]}} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputPhoneNumber"
                                                           placeholder="Enter Phone Number" v-model="form.phone">
                                                    <small class="text-danger" v-if="errors.phone"> {{ errors.phone[0]}} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputAddress"
                                                           placeholder="Enter Address" v-model="form.address">
                                                    <small class="text-danger" v-if="errors.address"> {{ errors.address[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputSalary"
                                                           placeholder="Enter Salary" v-model="form.salary">
                                                    <small class="text-danger" v-if="errors.salary"> {{ errors.salary[0] }} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <input type="file" class="custom-file-input" id="customFile"
                                                           @change="onFileSelected">
                                                    <small class="text-danger" v-if="errors.photo"> {{ errors.photo[0]}} </small>
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        File</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <img :src="form.photo" style="height: 40px; width: 40px;">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" class="form-control" id="exampleInputJoiningDate"
                                                           placeholder="Enter Joining Date"
                                                           v-model="form.joining_date">
                                                    <small class="text-danger" v-if="errors.joining_date"> {{ errors.joining_date[0] }} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                        </div>
                                    </form>
                                    <hr>
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
                    name: null,
                    email: null,
                    phone: null,
                    salary: null,
                    address: null,
                    photo: null,
                    ic: null,
                    joining_date: null
                },
                errors: {}
            }
        },
        methods:{

        },
        created(){
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
        }
    }
</script>

<style scoped>

</style>
