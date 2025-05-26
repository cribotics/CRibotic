<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AngelShop Navbar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-[#109fc3] border-b shadow-md sticky top-0 z-50">
  <div class="container mx-auto px-6 py-4 flex items-center justify-between">
    <a href="index.php" class="text-white text-2xl font-extrabold hover:text-white transition">Cribotics</a>

    <!-- Mobile menu button -->
    <button id="menuBtn" class="md:hidden text-white focus:outline-none" aria-label="Toggle menu">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
        <path d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>

    <!-- Desktop menu -->
    <div id="menu" class="hidden md:flex md:items-center md:space-x-8">
      <a href="index.php" class="text-white hover:text-blue-200 font-semibold transition">Home</a>
      <a href="products.php" class="text-white hover:text-blue-200 font-semibold transition">Products</a>
      <a href="shopnow.php" class="text-white hover:text-blue-200 font-semibold transition">Shop Now</a>
      <a href="about.php" class="text-white hover:text-blue-200 font-semibold transition">About</a>
      <a href="contact.php" class="text-white hover:text-blue-200 font-semibold transition">Contact</a>
    </div>

    <!-- User actions -->
    <div class="hidden md:flex items-center space-x-4">
      <?php if (isset($_SESSION['user'])): ?>
        <span class="text-white text-sm">Welcome, <span class="font-semibold"><?= htmlspecialchars($_SESSION['user']) ?></span></span>
        <a href="logout.php" class="text-orange-300 hover:text-white font-semibold transition ml-4">Logout</a>
      <?php else: ?>
        <button id="loginBtn" class="text-[#109fc3] bg-white px-4 py-1 rounded-md hover:bg-orange-100 font-semibold transition">Log in</button>
        <button id="registerBtn" class="bg-white text-orange-600 px-4 py-1 rounded-md hover:bg-orange-100 font-semibold transition">Register</button>
      <?php endif; ?>
    </div>
  </div>

  <!-- Mobile menu -->
  <div id="mobileMenu" class="md:hidden hidden bg-orange-600 px-6 py-4 space-y-3">
    <a href="index.php" class="block text-white hover:text-orange-200 font-semibold">Home</a>
    <a href="products.php" class="block text-white hover:text-orange-200 font-semibold">Products</a>
    <a href="about.php" class="block text-white hover:text-orange-200 font-semibold">About</a>
    <a href="contact.php" class="block text-white hover:text-orange-200 font-semibold">Contact</a>
    <div class="pt-2 border-t border-orange-500">
      <?php if (isset($_SESSION['user'])): ?>
        <span class="block text-white mb-2">Welcome, <strong><?= htmlspecialchars($_SESSION['user']) ?></strong></span>
        <a href="logout.php" class="w-full block text-orange-600 bg-white px-4 py-2 rounded-md hover:bg-orange-100 font-semibold transition text-center">Logout</a>
      <?php else: ?>
        <button id="loginBtnMobile" class="w-full text-[#109fc3] bg-white px-4 py-2 rounded-md hover:bg-orange-100 font-semibold transition mb-2">Log in</button>
        <button id="registerBtnMobile" class="w-full bg-white text-[#109fc3] px-4 py-2 rounded-md hover:bg-[#109fc3] font-semibold transition">Register</button>
      <?php endif; ?>
    </div>
  </div>
</nav>

<!-- Login Modal -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white rounded-lg w-full max-w-md p-6 mx-4 relative">
    <button id="closeLogin" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-2xl font-bold">&times;</button>
    <h2 class="text-2xl font-bold mb-4 text-[#109fc3]">Login to CRIBOTICS</h2>
    <form action="login.php" method="POST" class="space-y-4">
      <div>
        <label for="loginEmail" class="block text-sm font-semibold mb-1">Email</label>
        <input id="loginEmail" name="email" type="email" required placeholder="you@example.com"
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#109fc3]" />
      </div>
      <div>
        <label for="loginPassword" class="block text-sm font-semibold mb-1">Password</label>
        <input id="loginPassword" name="password" type="password" required placeholder="******"
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#109fc3]" />
      </div>
      <button type="submit"
        class="w-full bg-[#109fc3] text-white font-semibold py-2 rounded-md hover:bg-[#0d88a8] transition">Log in</button>
    </form>
  </div>
</div>

<!-- Register Modal -->
<div id="registerModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 overflow-auto py-10">
  <div class="bg-white rounded-lg w-full max-w-lg p-6 mx-4 relative">
    <button id="closeRegister" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-2xl font-bold">&times;</button>
    <h2 class="text-2xl font-bold mb-4 text-[#109fc3]">Register to Cribotics</h2>
    <form action="register.php" method="POST" class="space-y-4">
      <div>
        <label for="registerEmail" class="block text-[#109fc3] font-semibold mb-1">Email</label>
        <input id="registerEmail" name="email" type="email" required placeholder="you@example.com"
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#109fc3]" />
      </div>
      <div class="flex space-x-4">
        <div class="flex-1">
          <label for="registerFirstname" class="block text-[#109fc3] font-semibold mb-1">First Name</label>
          <input id="registerFirstname" name="firstname" type="text" required placeholder="John"
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400" />
        </div>
        <div class="flex-1">
          <label for="registerLastname" class="block text-[#109fc3] font-semibold mb-1">Last Name</label>
          <input id="registerLastname" name="lastname" type="text" required placeholder="Doe"
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#109fc3]" />
        </div>
      </div>
      <div>
        <label for="registerBirthdate" class="block text-sm font-semibold mb-1">Birthdate</label>
        <input id="registerBirthdate" name="birthdate" type="date" required
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#109fc3]" />
      </div>
      <div>
        <label for="registerUsername" class="block text-sm font-semibold mb-1">Username</label>
        <input id="registerUsername" name="username" type="text" required placeholder="username123"
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#109fc3]" />
      </div>
      <div class="flex space-x-4">
        <div class="flex-1">
          <label for="registerPassword" class="block text-sm font-semibold mb-1">Password</label>
          <input id="registerPassword" name="password" type="password" required placeholder="******"
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#109fc3]" />
        </div>
        <div class="flex-1">
          <label for="registerConfirmPassword" class="block text-sm font-semibold mb-1">Confirm Password</label>
          <input id="registerConfirmPassword" name="confirm_password" type="password" required placeholder="******"
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#109fc3]" />
        </div>
      </div>
      <button type="submit"
        class="w-full bg-[#109fc3] text-white font-semibold py-2 rounded-md hover:bg-[#109fc3]-700 transition">Register</button>
    </form>
  </div>
</div>

<!-- JavaScript -->
<script>
  const menuBtn = document.getElementById('menuBtn');
  const mobileMenu = document.getElementById('mobileMenu');
  menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));

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

  loginBtn.addEventListener('click', () => openModal(loginModal));
  loginBtnMobile.addEventListener('click', () => {
    openModal(loginModal);
    mobileMenu.classList.add('hidden');
  });

  registerBtn.addEventListener('click', () => openModal(registerModal));
  registerBtnMobile.addEventListener('click', () => {
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
