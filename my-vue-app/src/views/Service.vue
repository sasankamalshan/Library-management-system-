<template>
    <div class="service-page">
        <h1>Our Services</h1>
        <p>Explore the wide range of services we offer to meet your needs.</p>
        <ul>
            <li v-for="(service, index) in services" :key="index">
                {{ service }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "ServicePage",
    data() {
        return {
            services: [
                "Web Development",
                "Mobile App Development",
                "UI/UX Design",
                "Digital Marketing",
                "SEO Optimization",
            ],
        };
    },
};
</script>

<style scoped>
.service-page {
    padding: 20px;
    font-family: Arial, sans-serif;
}

h1 {
    color: #333;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    margin: 5px 0;
    color: #555;
}
</style>