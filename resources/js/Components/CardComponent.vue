<template>
    <div class="d-flex justify-content-center align-items-center">
        <div class="id-card shadow" :style="{ backgroundColor: cardColor }">
            <!-- Header Section -->
            <div
                class="text-center py-3"
                :style="{ backgroundColor: cardColor }"
            >
                <h2 class="card-title">{{ cardData.title }}</h2>
            </div>

            <!-- Logos Section -->
            <div class="my-3">
                <div class="row">
                    <div class="col-2 col-md-3 ml-4">
                        <img
                            :src="'https://via.placeholder.com/80x80?text=Logo1'"
                            alt="Club Logo"
                            class="logo img-fluid"
                        />
                    </div>
                    <div
                        class="col-7 col-md-6 d-flex justify-content-center ml-5 flex-wrap"
                    >
                        <img
                            v-for="(logo, index) in cardData.logos"
                            :key="index"
                            :src="logo"
                            alt="Club Logo"
                            class="logo img-fluid mx-2"
                        />
                    </div>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="row align-items-center">
                <div class="col-6 col-md-5 ml-5 text-md-left">
                    <h4 class="name">{{ cardData.name }}</h4>
                    <p class="position">{{ cardData.position }}</p>
                    <p class="discipline">{{ cardData.discipline }}</p>
                </div>
                <div class="col-4 col-md-4 d-flex justify-content-center">
                    <img
                        :src="cardData.profilePicture"
                        alt="Profile"
                        class="profile-pic img-fluid rounded-circle"
                    />
                </div>
            </div>

            <!-- Additional Information -->
            <div class="mt-4 px-3">
                <div class="row">
                    <div class="col-12 col-md-4"></div>
                    <div class="col-12 col-md-4 pl-5">
                        <h5 class="section-title">Caractéristiques</h5>
                        <p class="field">{{ cardData.characteristics }}</p>
                        <h5 class="section-title">Identifiant</h5>
                        <p class="field">{{ cardData.identifier }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-4 px-3">
                <div class="section">
                    <h5 class="section-title">Validité</h5>
                    <p class="field">{{ cardData.validity }}</p>
                </div>
            </div>

            <!-- QR Code Section -->
            <div class="d-flex justify-content-center my-4">
                <img
                    :src="cardData.qrCode"
                    alt="QR Code"
                    class="qr-code img-fluid"
                />
            </div>

            <!-- Footer Section (Optional) -->
            <div
                class="text-center py-2"
                :style="{ backgroundColor: cardColor }"
            >
                <small>&copy; {{ currentYear }} DIWA</small>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "CardComponent",
    data() {
        return {
            cardData: {
                title: "DIWA",
                logos: [
                    "https://via.placeholder.com/80x80?text=Logo1",
                    "https://via.placeholder.com/80x80?text=Logo2",
                ],
                profilePicture: "https://via.placeholder.com/150",
                name: "Yannick L. OLIMBO DIOUF",
                position: "Vice-President",
                discipline: "Basketball",
                characteristics: "Joueurs, Officiels, Techniciens",
                identifier: "ID on platform, Member status",
                validity: "Expires on 2025-12-31",
                qrCode: "https://via.placeholder.com/150",
            },
            currentYear: new Date().getFullYear(),
            cardColor: "#f5a623",
        };
    },
    methods: {
        async fetchCardData() {
            try {
                const response = await axios.get("card-details");
                this.cardData.name =
                    response.data.first_name + " " + response.data.last_name;
                this.cardData.position = response.data.situationProfessionnelle;
                this.cardData.discipline = response.data.discipline;
                this.cardData.characteristics =
                    response.data.fonctionTechnicien;
                this.cardData.identifier = response.data.mainForte;
                this.cardData.profilePicture = response.data.profile_image;
                this.cardData.qrCode = response.data.qr_code;
                this.cardColor = response.data.card_color || "#f5a623";
                console.log(response.data);
            } catch (error) {
                console.error("Error fetching card data:", error);
            }
        },
    },
    mounted() {
        this.fetchCardData();
    },
};
</script>

<style scoped>
.id-card {
    background-color: #f5a623;
    width: 100%;
    max-width: 350px;
    border-radius: 15px;
    color: #000;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card-header {
    background-color: #f5a623;
    border-bottom: none;
}

.card-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: bold;
}

.logo {
    width: 50px;
    height: 50px;
    object-fit: contain;
}

.profile-pic {
    width: 80px;
    height: 80px;
    border: 3px solid #fff;
    object-fit: cover;
}

.name {
    margin: 0.5rem 0 0.2rem 0;
    font-size: 1.2rem;
    font-weight: bold;
}

.position,
.discipline {
    margin: 0;
    font-size: 0.9rem;
    color: #333;
}

.section-title {
    font-size: 0.95rem;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 0.3rem;
}

.field {
    font-size: 0.85rem;
    color: #555;
}

.qr-code {
    width: 80px;
    height: 80px;
}

.card-footer {
    background-color: #f5a623;
    border-top: none;
    font-size: 0.75rem;
    color: #333;
}

/* Responsive Adjustments */
@media (max-width: 576px) {
    .id-card {
        width: 90%;
        margin: 0 auto;
    }
    .logo {
        width: 40px;
        height: 40px;
    }
    .profile-pic {
        width: 60px;
        height: 60px;
    }
    .qr-code {
        width: 60px;
        height: 60px;
    }
    .card-title {
        font-size: 1.2rem;
    }
    .name {
        font-size: 1rem;
    }
    .section-title,
    .field {
        font-size: 0.85rem;
    }
}
</style>
