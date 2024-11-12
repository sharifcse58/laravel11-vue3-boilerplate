<template>
    <div class="col-xl-12 col-lg-7">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div
                        class="col-lg-2 d-none d-lg-block bg-register-image"
                    ></div>
                    <div class="col-lg-9">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">
                                    Create an account !
                                </h1>
                            </div>
                            <form
                                class="user"
                                autocomplete="off"
                                @submit.prevent="register"
                            >
                                <!-- Profile Image Input -->
                                <div class="form-group">
                                    <label
                                        for="profile_image"
                                        class="form-label"
                                        >Profile Image</label
                                    >
                                    <input
                                        type="file"
                                        class="form-control"
                                        id="profile_image"
                                        @change="handleFileUpload"
                                    />
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="formData.first_name"
                                            placeholder="First Name"
                                        />
                                    </div>
                                    <div class="col-sm-6">
                                        <input
                                            type="text"
                                            v-model="formData.last_name"
                                            class="form-control"
                                            placeholder="Last Name"
                                        />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input
                                        type="email"
                                        v-model="formData.email"
                                        class="form-control"
                                        placeholder="Email"
                                    />
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input
                                            type="password"
                                            v-model="formData.password"
                                            class="form-control"
                                            placeholder="Password"
                                        />
                                    </div>
                                    <div class="col-sm-6">
                                        <input
                                            type="password"
                                            class="form-control"
                                            v-model="formData.c_password"
                                            placeholder="Confirm Password"
                                        />
                                    </div>
                                </div>
                                <button
                                    class="btn btn-primary btn-user btn-block"
                                >
                                    Create Account
                                </button>
                            </form>
                            <hr />
                            <div class="text-center">
                                <a class="small" href="#" @click="goToLogin"
                                    >Already have an account? Log in !</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            error: "",
            formData: {
                first_name: "",
                last_name: "",
                email: "",
                password: "",
                c_password: "",
            },
        };
    },
    methods: {
        async register() {
            try {
                const formData = new FormData();

                // Loop through formData and append each key-value pair to FormData
                for (const key in this.formData) {
                    if (this.formData.hasOwnProperty(key)) {
                        formData.append(key, this.formData[key]);
                    }
                }

                // If there is a profile image, append it to FormData
                if (this.profileImage) {
                    formData.append("profile_image", this.profileImage);
                }

                await axios.post("/register", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                });

                window.location.href = "/login";
            } catch (error) {
                this.error =
                    error.response?.data?.message || "Registration failed";
                console.error("Registration failed:", error);
                alert("Registration failed. Please check your details.");
            }
        },
        goToLogin() {
            window.location.href = "/login";
        },
        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.profileImage = file;
            }
        },
    },
};
</script>

<style scoped>
.container {
    max-width: 400px;
    width: 100%;
}
.card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
</style>
