<template>
  <nav class="navbar">
    <div class="logo">The Books</div>
    <div class="search-container">
      <input 
        type="text" 
        class="search-input" 
        placeholder="Search books..."
        v-model="searchQuery"
        @keyup.enter="handleSearch"
      >
      <button class="search-button" @click="handleSearch" aria-label="Search books">
        <svg class="search-icon" viewBox="0 0 24 24" width="20" height="20">
          <path d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 001.48-4.23 6.5 6.5 0 10-6.5 6.5c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
        </svg>
      </button>
    </div>
    <ul class="nav-links">
      <li><RouterLink to="/">Home</RouterLink></li>
      <li><RouterLink to="/books">MyBooks</RouterLink></li>
      <li><RouterLink to="/services">Services</RouterLink></li>
      <li><RouterLink to="/contact">Contact</RouterLink></li>
    </ul>
    <!-- Profile icon with image from assets -->
    <div class="profile-container">
      <RouterLink to="/profile" class="profile-link" aria-label="User profile">
        <img 
          :src="profileImage" 
          class="profile-icon" 
          alt="User profile"
        >
      </RouterLink>
    </div>
  </nav>
</template>

<script>
import { gsap } from 'gsap';

export default {
  name: "MainNavbar",
  data() {
    return {
      searchQuery: '',
      // change profile image 
      profileImage: new URL('../assets/profile.jpg', import.meta.url).href
    };
  },
  mounted() {
    gsap.from(".logo", {
      x: -50,
      opacity: 0,
      duration: 0.8,
      ease: "power2.out"
    });
    gsap.from(".search-container", {
      y: 20,
      opacity: 0, // Adjusted to match the search input
      duration: 0.8,
      delay: 0.3,
      ease: "power2.out"
    });
    gsap.from(".nav-links li", {
      x: 50,
      opacity: 0,
      duration: 0.6,
      stagger: 0.2,
      delay: 0.5,
      ease: "power2.out"
    });
    gsap.from(".profile-container", {
      x: 50,
      opacity: 0,
      duration: 0.6,
      delay: 0.7,
      ease: "power2.out"
    });
  },
  methods: {
    handleSearch() {
      if (this.searchQuery.trim()) {
        this.$emit('search', this.searchQuery);
      }
    }
  }
};
</script>

<style scoped>
.navbar {
  display: flex; /* Use flexbox for layout */
  justify-content: space-between;
  align-items: center;
  background-color: #e7e0db;
  padding: 6px 15px;
  color: rgb(21, 74, 126);
}

.logo {
  font-size: 24px;
  font-weight: bold;
}

.nav-links {
  list-style: none;
  display: flex;
  gap: 20px;
}

.nav-links li a {
  color: rgb(12, 11, 11);
  text-decoration: none;
  font-weight: 800;
}

.nav-links li a:hover {
  text-decoration: underline;
}

.search-button {
  background-color: rgb(126, 21, 21);
  border: none;
  border-radius: 4px;
  padding: 8px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}

.search-container {
  display: flex;
  align-items: center;
  gap: 8px;
}

.search-input {
  padding: 8px 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 14px;
  width: 200px;
  background-color: #fff;
  color: rgb(12, 11, 11);
}

.search-input:focus {
  outline: none;
  border-color: rgb(126, 21, 21);
  box-shadow: 0 0 5px rgba(126, 21, 21, 0.3);
}

.search-button:hover {
  background-color: rgb(236, 232, 232);
}

.search-icon {
  fill: #fff;
}

.profile-container {
  position: sticky;
  top: 100;
  right: 60px;
  }

.profile-link {
  display: flex;
  align-items: center;
  text-decoration: none;
}

.profile-icon {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid rgb(126, 21, 21);
  transition: transform 0.3s ease, border-color 0.3s ease;
}

.profile-icon:hover {
  transform: scale(1.1);
  border-color: rgb(236, 232, 232);
}
</style>