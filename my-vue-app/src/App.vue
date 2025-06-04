<template>
  <div>
    <MainNavbar @search="handleSearch" />
    <router-view></router-view>
  </div>
</template>

<script>
import MainNavbar from './components/Navbar.vue';

export default {
  name: 'App',
  components: { MainNavbar },
  methods: {
    handleSearch(query) {
      console.log('Search query:', query);
    }
  }
};
</script>

<style>
body {
  margin: 0;
  font-family: Arial, sans-serif;
}
</style>