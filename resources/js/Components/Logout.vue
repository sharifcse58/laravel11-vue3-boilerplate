<template>
    <a class="dropdown-item" href="#" @click="logout">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
    </a>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            isDropdownOpen: false,
        };
    },
    methods: {
        toggleDropdown() {
            this.isDropdownOpen = !this.isDropdownOpen;
        },
        async logout() {
            try {
                const res = await axios.post("/logout");
                localStorage.removeItem("token"); // Clear token from localStorage
                window.location.href = "/login"; // Redirect to login page
            } catch (error) {
                console.error("Logout failed:", error);
            }
        },
    },
};
</script>

<style scoped>
/* Basic styling for dropdown */
.dropdown {
    position: relative;
    display: inline-block;
}
.dropdown-toggle {
    cursor: pointer;
}
.dropdown-menu {
    display: block;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: white;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    padding: 12px;
}
.dropdown-item {
    padding: 8px;
    cursor: pointer;
}
</style>
