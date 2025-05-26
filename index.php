<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CRIBOTICS</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/e2b0301d80.js" crossorigin="anonymous"></script>

  <style>
    .modal-bg {
      background-color: rgba(0, 0, 0, 0.5);
    }

    body {
          font-family: 'Playfair Display',serif;
            padding: 0;
            background-color: whitesmoke;
            margin: 0;
        
    }

    #box1 {
      position: fixed;
      height: 300px;
      width: 300px;
      overflow: hidden;
      top: 50%;
      right: 10%;
      transform: translateY(-50%);
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
      border-radius: 12px;
      z-index: 10;
    }

    #box2 {
      display: flex;
      animation: slider 25s infinite;
      position: relative;
      left: 0;
    }

    #box2 img {
      width: 300px;
      height: 300px;
      flex-shrink: 0;
      border-radius: 12px;
      object-fit: cover;
    }

    @keyframes slider {
      0%, 5% { transform: translateX(0); }
      10%, 15% { transform: translateX(-300px); }
      20%, 25% { transform: translateX(-600px); }
      30%, 35% { transform: translateX(-900px); }
      40%, 45% { transform: translateX(-1200px); }
      50%, 55% { transform: translateX(-1500px); }
      60%, 65% { transform: translateX(-1800px); }
      70%, 75% { transform: translateX(-2100px); }
      80%, 85% { transform: translateX(-2400px); }
      90%, 95% { transform: translateX(-2700px); }
      100% { transform: translateX(-3000px); }
    }

    footer {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      background-color:#ABD6EB;;
      color: dark white;
      text-align: center;
      padding: 1rem 0;
      box-shadow: inset 0 1px 0 rgba(255,255,255,0.2);
      z-index: 10000;
    }
  </style>
</head>
<body>

  <?php
  if (isset($_GET['register'])) {
      if ($_GET['register'] === 'success') {
          echo "<script>alert('Registered successfully! You can now log in.');</script>";
      } elseif ($_GET['register'] === 'exists') {
          echo "<script>alert('Email already exists. Please use a different one or log in.');</script>";
      } elseif ($_GET['register'] === 'nomatch') {
          echo "<script>alert('Passwords do not match. Please try again.');</script>";
      }
  }

  if (isset($_GET['login']) && $_GET['login'] === 'failed') {
      echo "<script>alert('Invalid email or password. Please try again.');</script>";
  }
  ?>

  <?php include 'navbar.php'; ?>

 <section class="bg-[#ABD6EB] py-20">
  <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between">
    
    <!-- Text Section -->
    <div class="md:w-1/2 mb-10 md:mb-0 text-center md:text-left">
      <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
        Welcome to CRIBOTICS!
      </h1>
      <p class="text-lg text-[#109fc3] mb-8"><center>
        Where innovation meets precision—step into a world of cutting-edge robotics and smart technology.
Let’s build the future, one circuit at a time!
</center>
      </p>
      <a href="shopnow.php" class="bg-[#109fc3] hover:bg-[#ABD6EB] text-white px-8 py-3 rounded-full text-lg transition">
        Shop Now
      </a>
    </div>

  <!-- Image Slider -->
  <div id="box1">
    <div id="box2">
      <img src="images/LOVOTT.png" alt="Soft Baby Onesie" />
      <img src="images/AIBOO.png" alt="Cute Baby Hat" />
      <img src="images/EMYSS.png" alt="Warm Baby Booties" />
      <img src="images/FABLEE.png" alt="Colorful Baby Bibs" />
      <img src="images/VECTORR.png" alt="Cozy Baby Sleepers" />
      <img src="images/SLOTHBOTH.png" alt="Soft Baby Blanket" />
      <img src="images/QTROBOTT.png" alt="Comfortable Baby Bodysuit" />
      <img src="images/BIGDOGG.png" alt="Adorable Baby Jumper" />
      <img src="images/LEGO BOOSTT.png" alt="Infant Toddler Dress" />
      <img src="images/NXT.png" alt="Cute Baby Romper" />
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <p class="mb-0">&copy; copyCopyright 2025. All Rights Reserved.</p>
  </footer>

</body>
</html>
