<template>
    <div class="container mt-5">
        <div class="card" style="max-width: 600px; margin: auto">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Edit Profile</h3>

                <form @submit.prevent="updateProfile">
                    <div class="mb-3">
                        <label for="name" class="form-label">First Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="first_name"
                            v-model="first_name"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Last Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="last_name"
                            v-model="last_name"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"
                            >Email address</label
                        >
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            v-model="email"
                            required
                        />
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        Update Profile
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            first_name: "",
            last_name: "",
            email: "",
        };
    },
    created() {
        this.getProfile();
    },
    methods: {
        async getProfile() {
            try {
                const response = await axios.get("/profile", {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "auth_token"
                        )}`,
                    },
                });
                this.first_name = response.data.first_name;
                this.last_name = response.data.last_name;
                this.email = response.data.email;
            } catch (error) {
                console.error("Failed to fetch profile:", error);
            }
        },
        async updateProfile() {
            try {
                await axios.post(
                    "/profile",
                    {
                        first_name: this.first_name,
                        last_name: this.last_name,
                        email: this.email,
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem(
                                "auth_token"
                            )}`,
                        },
                    }
                );
                alert("Profile updated successfully!");
            } catch (error) {
                console.error("Profile update failed:", error);
                alert("Failed to update profile. Please check your details.");
            }
        },
    },
};
</script>

<style scoped>
.container {
    max-width: 600px;
    margin-top: 50px;
}
.card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
</style>
