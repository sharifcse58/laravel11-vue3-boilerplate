<template>
    <div>
        <h2>Settings</h2>
        <form @submit.prevent="updateSettings">
            <div class="form-group">
                <label>Company Name</label>
                <input
                    v-model="settings.company_name"
                    type="text"
                    class="form-control"
                    placeholder="Enter company name"
                />
            </div>
            <div class="form-group">
                <label>Card Color</label>
                <color-picker
                    v-model:pureColor="pureColor"
                    v-model:gradientColor="gradientColor"
                />
            </div>

            <!-- Reset Button to Set Default Color -->
            <!-- <button @click.stop="setDefaultColor" class="btn btn-default">
                Set Default Color
            </button> -->

            <!-- Checkbox to Set Default Color -->
            <div>
                <label>
                    <input
                        type="checkbox"
                        v-model="defaultColorCheck"
                        @change="toggleDefaultColor"
                    />
                    Use Default Color
                </label>
            </div>

            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>
    </div>
</template>

<script>
import { ColorPicker } from "vue3-colorpicker";
import "vue3-colorpicker/style.css";

import axios from "axios";

export default {
    components: {
        ColorPicker,
    },
    data() {
        return {
            settings: {
                company_name: "",
                card_color: "#f5a623",
            },
            pureColor: "red",
            gradientColor:
                "linear-gradient(0deg, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 1) 100%)",
            defaultColor: "#f5a623",
            defaultColorCheck: false,
        };
    },
    methods: {
        async fetchSettings() {
            try {
                const response = await axios.get("/settings");
                console.log(response.data);
                this.pureColor = response.data.card_color
                    ? this.hexToRgb(response.data.card_color)
                    : "red";
                this.settings = response.data || this.settings;
            } catch (error) {
                console.error("Error fetching settings:", error);
            }
        },
        async updateSettings() {
            try {
                await axios.post("/settings", this.settings);
                window.location.href = "/dashboard";
            } catch (error) {
                console.error("Error updating settings:", error);
            }
        },
        hexToRgb(hexColor) {
            if (hexColor.startsWith("#")) hexColor = hexColor.slice(1);
            const bigint = parseInt(hexColor, 16);
            const r = (bigint >> 16) & 255;
            const g = (bigint >> 8) & 255;
            const b = bigint & 255;
            return `rgb(${r}, ${g}, ${b})`;
        },

        rgbStringToHex(rgbString) {
            // Extract the numbers from the "rgb(...)" string using a regular expression
            const result = rgbString.match(/\d+/g);

            // Ensure the result has exactly 3 values for R, G, and B
            if (result && result.length === 3) {
                // Convert each RGB component to a hex string and pad with zero if necessary
                return (
                    "#" +
                    result
                        .map((x) => {
                            const hex = parseInt(x).toString(16);
                            return hex.length === 1 ? "0" + hex : hex;
                        })
                        .join("")
                );
            } else {
                return null;
            }
        },
        setDefaultColor() {
            this.settings.color = this.defaultColor;
            this.pureColor = this.hexToRgb(this.defaultColor);
        },
        toggleDefaultColor() {
            this.settings.color = this.defaultColor;
            if (this.defaultColorCheck) {
                this.pureColor = this.hexToRgb(this.defaultColor);
            }
        },
    },
    mounted() {
        this.fetchSettings();
    },
    watch: {
        pureColor: function (newColor) {
            this.settings.card_color = this.rgbStringToHex(newColor);
            this.defaultColorCheck = false;
        },
    },
};
</script>

<style scoped>
.form-group {
    margin-bottom: 1rem;
}
</style>
