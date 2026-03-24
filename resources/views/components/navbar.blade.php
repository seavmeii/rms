<!-- Header -->
<header class="site-header">
    <div class="header-container">
        <p><strong>Flower Restaurant</strong> – Purchase your favorite dishes online!</p>
    </div>
</header>

<!-- Navbar -->
<nav class="navbar">
    <div class="nav-container">
        <a href="#" class="logo">Flower<span>Restaurant</span></a>
    </div>
</nav>

<style>
/* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Segoe UI", system-ui, sans-serif;
}

/* Header */
.site-header {
    background: #f5f5f5; /* light gray */
    color: #333;
    padding: 0.6rem 1.5rem;
    text-align: center;
    font-size: 0.95rem;
    font-weight: 500;
    border-bottom: 1px solid #e0e0e0;
}

/* Navbar */
.navbar {
    background: #fff; 
    padding: 1rem 1.5rem;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05); /* subtle shadow for modern feel */
}

/* Container */
.nav-container {
    max-width: 1200px;
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* Logo */
.logo {
    color: #111;
    font-size: 1.6rem;
    font-weight: 700;
    text-decoration: none;
}

.logo span {
    color: #555;
}

/* Links */
.nav-links {
    list-style: none;
    display: flex;
    align-items: center;
    gap: 2rem;
}

.nav-links a {
    color: #333;
    text-decoration: none;
    font-size: 1rem;
    transition: all 0.3s ease;
    position: relative;
}

.nav-links a::after {
    content: '';
    position: absolute;
    width: 0%;
    height: 2px;
    left: 0;
    bottom: -4px;
    background: #333;
    transition: width 0.3s ease;
}

.nav-links a:hover::after {
    width: 100%;
}

.nav-links a:hover {
    color: #111;
}

/* Button link */
.nav-links .btn {
    padding: 0.5rem 1.2rem;
    border-radius: 25px;
    background: #111;
    color: #fff;
    font-weight: 600;
    transition: background 0.3s ease;
}

.nav-links .btn:hover {
    background: #555;
}

/* Cart icon */
.nav-links .cart {
    position: relative;
    font-size: 1.3rem;
    color: #333;
}

.nav-links .cart-count {
    position: absolute;
    top: -8px;
    right: -10px;
    background: #555;
    color: #fff;
    font-size: 0.75rem;
    padding: 2px 6px;
    border-radius: 50%;
}

/* Mobile menu */
.menu-toggle {
    display: none;
    font-size: 1.8rem;
    color: #333;
    cursor: pointer;
}

/* Responsive */
@media (max-width: 768px) {
    .menu-toggle {
        display: block;
    }

    .nav-links {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #fff;
        flex-direction: column;
        gap: 1rem;
        padding: 1rem 0;
        display: none;
        border-top: 1px solid #e0e0e0;
    }

    .nav-links.active {
        display: flex;
    }

    .nav-links li {
        text-align: center;
    }

    
    
}
</style>

<script>
const menuToggle = document.getElementById("menuToggle");
const navLinks = document.getElementById("navLinks");

menuToggle.addEventListener("click", () => {
    navLinks.classList.toggle("active");
});
</script>