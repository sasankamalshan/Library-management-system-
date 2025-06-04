<template>
    <div>
      <section class="hero-section">
        <h1 class="hero-title">Discover The Books</h1>
        <p class="hero-subtitle">Explore the Endless World of Books</p>
        <button class="cta-button" @mouseenter="animateButton" @mouseleave="resetButton">
         Start Reading
        </button>
        <img src="@/assets/child.png" alt="Swinging Child" class="swing-child" />
      </section>
      <section class="books-section">
        <h2 class="section-title">Library Books</h2>
        <table class="books-table">
          <thead>
            <tr>
              <th>Book ID</th>
              <th>Title</th>
              <th>Description</th>
              <th>Genre</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="book in paginatedBooks" :key="book.id">
              <td>{{ book.id }}</td>
              <td class="title-column">
                <img :src="book.image" :alt="book.title" class="book-image" />
                <span>{{ book.title }}</span>
              </td>
              <td>{{ book.description }}</td>
              <td>{{ book.genre }}</td>
              <td>${{ book.price.toFixed(2) }}</td>
              <td>
                <button 
                  v-if="!borrowedBooks.includes(book.id)" 
                  @click="borrowBook(book.id)"
                  class="action-button borrow-button"
                >
                  Borrow
                </button>
                <button 
                  v-else 
                  @click="returnBook(book.id)"
                  class="action-button return-button"
                >
                  Return
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="pagination">
          <button 
            @click="currentPage--" 
            :disabled="currentPage === 1"
            class="pagination-button"
          >
            Previous
          </button>
          <span>Page {{ currentPage }} of {{ totalPages }}</span>
          <button 
            @click="currentPage++" 
            :disabled="currentPage === totalPages"
            class="pagination-button"
          >
            Next
          </button>
        </div>
        <div v-if="borrowedBooks.length" class="borrowed-section">
          <h3>Your Borrowed Books</h3>
          <ul>
            <li v-for="bookId in borrowedBooks" :key="bookId">
              {{ getBookById(bookId).title }}
            </li>
          </ul>
        </div>
      </section>
    </div>
</template>

<script>
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export default {
  name: 'HomePage', // table information tika
  data() {
    return {
      currentPage: 1,
      booksPerPage: 5,
      borrowedBooks: [],
      books: [
        { id: 1, title: 'The Great Novel', description: 'A captivating story of adventure', genre: 'Fiction', price: 19.99, image: 'https://books.google.lk/books/content?id=QikP0QEACAAJ&printsec=frontcover&img=1&zoom=1&imgtk=AFLRE739VJPvmEr20uF9hYTajrM5dh9o6s4cATXsNDaBTocyrVfyCqdxLygVw3vfzx98RKYIiLkXr-Z_7nG49Pw6Nlmz06U3ZGvNp-lDBcWOgedxNF-Q9b_gnsyyhHxRg_aI-RFXLWuy' },
        { id: 2, title: 'Adventure Tales', description: 'Thrilling tales of exploration', genre: 'Adventure', price: 15.99, image: 'https://cdn.penguin.co.in/wp-content/uploads/2024/05/9780143455264.jpg' },
        { id: 3, title: 'Mystery Chronicles', description: 'Intriguing mysteries to solve', genre: 'Mystery', price: 12.99, image: 'https://images-cdn.reedsy.com/discovery/image/682/image/medium_f2478525b5efef784b36852102d30fa99776d0b9.jpg' },
        { id: 4, title: 'Sci-Fi Saga', description: 'A journey through the stars', genre: 'Science Fiction', price: 22.99, image: 'https://brightspotcdn.byu.edu/dims4/default/841f0c6/2147483647/strip/true/crop/500x762+0+0/resize/500x762!/quality/90/?url=https%3A%2F%2Fbrigham-young-brightspot-us-east-2.s3.us-east-2.amazonaws.com%2F41%2F71%2Fd7d439b4fbd9ccee241416bf8d5c%2Fsorcerors-stone.jpg' },
        { id: 5, title: 'Historical Journey', description: 'A tale of ancient times', genre: 'Historical', price: 18.99, image: 'https://via.placeholder.com/50x75' },
        { id: 6, title: 'Fantasy Realm', description: 'Magical worlds await', genre: 'Fantasy', price: 20.99, image: 'https://via.placeholder.com/50x75' },
        { id: 7, title: 'Romantic Escape', description: 'A love story for the ages', genre: 'Romance', price: 14.99, image: 'https://via.placeholder.com/50x75' },
        { id: 8, title: 'Thriller Nights', description: 'Edge-of-your-seat suspense', genre: 'Thriller', price: 16.99, image: 'https://via.placeholder.com/50x75' }
      ]
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.books.length / this.booksPerPage);
    },
    paginatedBooks() {
      const start = (this.currentPage - 1) * this.booksPerPage;
      const end = start + this.booksPerPage;
      return this.books.slice(start, end);
    }
  },
  methods: {
    animateButton() {
      gsap.to('.cta-button', {
        scale: 1.1,
        backgroundColor: '#059669',
        duration: 0.3,
        ease: 'power2.out'
      });
    },
    resetButton() {
      gsap.to('.cta-button', {
        scale: 1,
        backgroundColor: '#10b981',
        duration: 0.3,
        ease: 'power2.out'
      });
    },
    borrowBook(bookId) {
      if (!this.borrowedBooks.includes(bookId)) {
        this.borrowedBooks.push(bookId);
      }
    },
    returnBook(bookId) {
      this.borrowedBooks = this.borrowedBooks.filter(id => id !== bookId);
    },
    getBookById(bookId) {
      return this.books.find(book => book.id === bookId) || {};
    }
  },
  mounted() {
    // Text and button animations
    gsap.from('.hero-title', {
      x: -100,
      opacity: 0,
      duration: 1,
      ease: 'power2.out'
    });
    gsap.from('.hero-subtitle', {
      y: 50,
      opacity: 0,
      duration: 1,
      delay: 0.5,
      ease: 'power2.out'
    });
    gsap.from('.cta-button', {
      scale: 0.8,
      opacity: 0,
      duration: 0.8,
      delay: 1,
      ease: 'elastic.out(1, 0.3)'
    });

    // Animate colors changes 
    gsap.to('.hero-section', {
      '--overlay-color': 'rgba(31, 41, 55, 0.6)',
      duration: 2,
      repeat: -1,
      yoyo: true,
      ease: 'sine.inOut'
    });

    // Animate books table rows on scroll
    gsap.from('.books-table tr', { // Fixed: Changed from '.book-card' to '.books-table tr'
      y: 100,
      opacity: 0,
      duration: 0.8,
      stagger: 0.2,
      ease: 'power2.out',
      scrollTrigger: {
        trigger: '.books-section',
        start: 'top 80%',
        toggleActions: 'play none none none'
      }
    });

    // child swing settings tika
    const tl = gsap.timeline({ repeat: -3, yoyo: true });
    tl.fromTo('.swing-child', {
      x: '100%',
      y: 100,
      rotation: -20
    }, {
      x: '100%',
      y: 200,
      rotation: 20,
      duration: 1.5,
      ease: 'power1.inOut'
    });
  }
};
</script>

<style scoped>
.hero-section {
  padding: 100px 20px;
  color: white;
  border-radius: 10px;
  text-align: center;
  margin: 20px;
  min-height: 500px;
  background-image: linear-gradient(var(--overlay-color, rgba(0, 0, 0, 0.5)), var(--overlay-color, rgba(0, 0, 0, 0.5))),
    url('@/assets/back.jpg');
  background-size: cover;
  background-position: center;
  position: relative;
  transition: background-color 1s ease;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.hero-title {
  font-size: 3rem;
  margin-bottom: 20px;
  opacity: 0;
}

.hero-subtitle { 
  font-size: 3.5rem;
  margin-bottom: 30px;  
  opacity: 1; /* Fixed: Changed from opacity: 10 to 1 */
}

.cta-button {
  padding: 15px 30px;
  font-size: 1.2rem;
  background-color: #04a25e;
  color: rgb(251, 251, 250);
  border: none;
  border-radius: 80px;
  cursor: pointer;
}

.swing-child {
  position: absolute;
  top: -250px;
  left: 71%;
  transform: translateX(-50%);
  width: 250px;
  height: auto;
  transform-origin: top center;
}

.books-section {
  padding: 50px 20px;
  background-color: #f4f4f4;
  text-align: center;
}

.section-title {
  font-size: 2rem;
  margin-bottom: 30px;
  color: rgb(14, 87, 7);
}

.books-table {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  border-collapse: collapse;
  background: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.books-table th, .books-table td {
  padding: 15px;
  border: 1px solid #ddd;
  text-align: left;
}

.books-table th {
  background-color: #04a25e;
  color: white;
}

.books-table tr:nth-child(even) {
  background-color: #f9f9f9;
}

.title-column {
  display: flex;
  align-items: center;
  gap: 10px;
}

.book-image {
  width: 50px;
  height: 75px;
  object-fit: cover;
  border-radius: 5px;
}

.action-button {
  padding: 8px 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 0.9rem;
}

.borrow-button {
  background-color: #04a25e;
  color: white;
}

.return-button {
  background-color: #dc3545;
  color: white;
}

.pagination {
  margin-top: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
}

.pagination-button {
  padding: 8px 16px;
  border: none;
  border-radius: 5px;
  background-color: #04a25e;
  color: white;
  cursor: pointer;
}

.pagination-button:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}

.borrowed-section {
  margin-top: 30px;
  text-align: left;
  max-width: 1200px;
  margin-left: auto;
  margin-right: auto;
}

.borrowed-section h3 {
  color: rgb(14, 87, 7);
  margin-bottom: 10px;
}

.borrowed-section ul {
  list-style: none;
  padding: 0;
}

.borrowed-section li {
  padding: 5px 0;
}
</style>