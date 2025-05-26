<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cribotics Navbar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-[#109fc3] border-b shadow-md sticky top-0 z-50">
  <div class="container mx-auto px-6 py-4 flex items-center justify-between">
    <a href="index.php" class="text-white text-2xl font-extrabold hover:text-white-200 transition"> <img src="logo.jpg" height="70px" width="240px"></a>

    <!-- Mobile menu button -->
    <button id="menuBtn" class="md:hidden text-white focus:outline-none" aria-label="Toggle menu">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
        <path d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>

    <!-- Menu -->
    <div id="menu" class="hidden md:flex md:items-center md:space-x-8">
      <a href="index.php" class="text-white hover:text-orange-200 font-semibold transition">Home</a>
      <a href="products.php" class="text-white hover:text-orange-200 font-semibold transition">Products</a>
      <a href="shopnow.php" class="text-white hover:text-orange-200 font-semibold transition">Shop Now</a>
      <a href="about.php" class="text-white hover:text-orange-200 font-semibold transition">About</a>
      <a href="contact.php" class="text-white hover:text-orange-200 font-semibold transition">Contact</a>
    </div>

    <!-- User actions -->
    <div class="hidden md:flex items-center space-x-4">
      <?php if (isset($_SESSION['user'])): ?>
        <span class="text-white text-sm">Welcome, <span class="font-semibold"><?= htmlspecialchars($_SESSION['user']) ?></span></span>
        <a href="logout.php" class="text-white border border-white px-3 py-1 rounded-md hover:bg-white hover:text-[#109fc3] font-semibold transition">Logout</a>
      <?php else: ?>
        <button id="loginBtn" class="text-[#109fc3] bg-white px-4 py-1 rounded-md hover:bg-orange-100 font-semibold transition">Log in</button>
        <button id="registerBtn" class="bg-white text-[#109fc3] px-4 py-1 rounded-md hover:bg-orange-100 font-semibold transition">Register</button>
      <?php endif; ?>
    </div>
  </div>

  <!-- Mobile menu dropdown -->
  <div id="mobileMenu" class="md:hidden hidden bg-[#109fc3] px-6 py-4 space-y-3">
    <a href="index.php" class="block text-white hover:text-orange-200 font-semibold">Home</a>
    <a href="products.php" class="block text-white hover:text-orange-200 font-semibold">Products</a>
    <a href="about.php" class="block text-white hover:text-orange-200 font-semibold">About</a>
    <a href="contact.php" class="block text-white hover:text-orange-200 font-semibold">Contact</a>
    <div class="pt-2 border-t border-white/30">
      <?php if (isset($_SESSION['user'])): ?>
        <span class="block text-white mb-2">Welcome, <strong><?= htmlspecialchars($_SESSION['user']) ?></strong></span>
        <a href="logout.php" class="w-full block text-[#109fc3] bg-white px-4 py-2 rounded-md hover:bg-orange-100 font-semibold transition text-center">Logout</a>
      <?php else: ?>
        <button id="loginBtnMobile" class="w-full text-[#109fc3] bg-white px-4 py-2 rounded-md hover:bg-orange-100 font-semibold transition mb-2">Log in</button>
        <button id="registerBtnMobile" class="w-full bg-white text-[#109fc3] px-4 py-2 rounded-md hover:bg-orange-100 font-semibold transition">Register</button>
      <?php endif; ?>
    </div>
  </div>
</nav>

<!-- Modals stay the same from your code -->

<!-- JS -->
<script>
  const menuBtn = document.getElementById('menuBtn');
  const mobileMenu = document.getElementById('mobileMenu');
  menuBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });

  const loginBtn = document.getElementById('loginBtn');
  const registerBtn = document.getElementById('registerBtn');
  const loginBtnMobile = document.getElementById('loginBtnMobile');
  const registerBtnMobile = document.getElementById('registerBtnMobile');

  const loginModal = document.getElementById('loginModal');
  const registerModal = document.getElementById('registerModal');

  const closeLogin = document.getElementById('closeLogin');
  const closeRegister = document.getElementById('closeRegister');

  function openModal(modal) {
    modal.classList.remove('hidden');
  }
  function closeModal(modal) {
    modal.classList.add('hidden');
  }

  loginBtn?.addEventListener('click', () => openModal(loginModal));
  loginBtnMobile?.addEventListener('click', () => {
    openModal(loginModal);
    mobileMenu.classList.add('hidden');
  });

  registerBtn?.addEventListener('click', () => openModal(registerModal));
  registerBtnMobile?.addEventListener('click', () => {
    openModal(registerModal);
    mobileMenu.classList.add('hidden');
  });

  closeLogin.addEventListener('click', () => closeModal(loginModal));
  closeRegister.addEventListener('click', () => closeModal(registerModal));

  window.addEventListener('click', (e) => {
    if (e.target === loginModal) closeModal(loginModal);
    if (e.target === registerModal) closeModal(registerModal);
  });
</script>

</body>
</html>
