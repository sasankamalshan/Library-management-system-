import { createRouter, createWebHistory } from 'vue-router';
import HomePage from '../views/Homepage.vue';
import BooksPage from '../views/MyBooks.vue';
import ServicePage from '../views/Service.vue';
import ContactPage from '../views/Contact.vue';

const routes = [
  { path: '/', name: 'Home', component: HomePage },
  { path: '/books', name: 'Books', component: BooksPage },
  { path: '/services', name: 'Services', component: ServicePage },
  { path: '/contact', name: 'Contact', component: ContactPage }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;