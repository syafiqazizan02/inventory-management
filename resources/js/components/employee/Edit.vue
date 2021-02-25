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
                                        <h1 class="h4 text-gray-900 mb-4">Edit Employee</h1>
                                    </div>
                                    <hr>
                                    <form class="user" @submit.prevent="employeeUpdate" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputName"
                                                           placeholder="Full Name" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0]}} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputCode"
                                                           placeholder="Employee Code" v-model="form.code" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="email" class="form-control" id="exampleInputEmail"
                                                           placeholder="Email Address" v-model="form.email">
                                                    <small class="text-danger" v-if="errors.email"> {{ errors.email[0]}} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputPhone"
                                                           placeholder="Phone Number" v-model="form.phone">
                                                    <small class="text-danger" v-if="errors.phone"> {{ errors.phone[0]}} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputAddress"
                                                           placeholder="Residence Address" v-model="form.address">
                                                    <small class="text-danger" v-if="errors.address"> {{ errors.address[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputSalary"
                                                           placeholder="Monthly Salary" v-model="form.salary">
                                                    <small class="text-danger" v-if="errors.salary"> {{ errors.salary[0] }} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-5">
                                                    <input type="file" class="custom-file-input" id="customFile"
                                                           @change="onFileSelected">
                                                    <small class="text-danger" v-if="errors.photo"> {{ errors.photo[0]}} </small>
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        File
                                                    </label>
                                                </div>
                                                <div class="col-md-1">
                                                    <img :src="form.photo" style="height: 40px; width: 40px;">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Update</button>
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
                name: "",
                email: "",
                phone: "",
                salary: "",
                address: "",
                photo: "",
                newphoto: ""
            },
            errors: {}
        };
    },
    methods: {
        onFileSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.image_validation();
            } else {
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.newphoto = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        employeeUpdate() {
            let id = this.$route.params.id;
            axios
                .patch("/api/employee/" + id, this.form)
                .then(() => {
                    this.$router.push({ name: "employee" });
                    Notification.success();
                })
                .catch(error => (this.errors = error.response.data.errors));
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
