<template>
    <div
        class="container d-flex justify-content-center align-items-center vh-100"
    >
        <div class="card p-4" style="max-width: 400px; width: 100%">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Login</h3>

                <!-- Login Form -->
                <form @submit.prevent="login">
                    <div class="mb-3">
                        <label for="email" class="form-label"
                            >Email address</label
                        >
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            v-model="email"
                            placeholder="Enter your email"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"
                            >Password</label
                        >
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            v-model="password"
                            placeholder="Enter your password"
                            required
                        />
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        Login
                    </button>
                </form>
                <div v-if="error" class="mt-3 text-danger">{{ error }}</div>

                <!-- Register Button -->
                <div class="text-center mt-3">
                    <p>
                        Don't have an account?
                        <a
                            @click="goToRegister"
                            href="#"
                            class="text-decoration-none"
                            >Register Now</a
                        >
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { setAuthToken } from "../axiosConfig.js";

export default {
    data() {
        return {
            email: "",
            password: "",
            error: "",
        };
    },
    methods: {
        async login() {
            try {
                const response = axios
                    .post("/login", {
                        email: this.email,
                        password: this.password,
                    })
                    .then((response) => {
                        console.log(response);
                        console.log(response.data.data.token);
                        setAuthToken(response.data.data.token);
                        window.location.href = "/dashboard";
                    });
            } catch (error) {
                this.error = error.response?.data?.message || "Login failed";
            }
        },
        goToRegister() {
            window.location.href = "/register";
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
