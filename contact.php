<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us - Cribotics.ph</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Pvu7idFhc3MK4ZfczVzJz+4rm61ZohJYONKPZb8F4Hv9U9I3t3RkXPT+p+DWuqbg+aBSz8sAK3oZFcYXLaUqTQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-pink-50 text-gray-800">

  <div class="max-w-6xl mx-auto px-4 py-16">
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
      
      <!-- Contact Info Section -->
      <div class="bg-gradient-to-br from-[#ABD6EB] to-[#ABD6EB]-400 text-black p-10 flex flex-col justify-between">
        <div>
          <h2 class="text-4xl font-bold mb-4">Get in Touch</h2>
          <p class="mb-6 text-black-100">Questions or comments? We’d love to hear from you!</p>

          <ul class="space-y-4 text- [#109fc3]">
            <li>
              <strong>📍 Address:</strong><br/>
              Abulan Jones, Isabela
            </li>
            <li>
              <strong>📞 Phone:</strong><br/>
              +63 162 829 322
            </li>
            <li>
              <strong>✉️ Email:</strong><br/>
              support@criboticsrobots.com
            </li>
          </ul>
        </div>

        <div class="mt-10">
          <h3 class="text-xl font-semibold mb-3">Follow Us</h3>
          <div class="flex gap-4 text-2xl">
            <a href="https://facebook.com" target="_blank" class="hover:text-white/70 transition"><i class="fab fa-facebook"></i></a>
            <a href="https://instagram.com" target="_blank" class="hover:text-white/70 transition"><i class="fab fa-instagram"></i></a>
            <a href="https://tiktok.com" target="_blank" class="hover:text-white/70 transition"><i class="fab fa-tiktok"></i></a>
            <a href="https://m.me/yourpage" target="_blank" class="hover:text-white/70 transition"><i class="fab fa-facebook-messenger"></i></a>
          </div>
        </div>
      </div>

      <!-- Contact Form Section -->
      <div class="p-10 bg-white">
        <h2 class="text-3xl font-semibold text-[#109fc3;] mb-8">Send us a message</h2>
        <form action="#" method="POST" class="space-y-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <input type="text" name="name" required class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#109fc3]" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" required class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#109fc3]" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
            <textarea name="message" rows="5" required class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#109fc3]"></textarea>
          </div>
          <button type="submit" class="bg-[#109fc3] hover:bg- [ABD6EB] text-white font-semibold py-3 px-6 rounded-xl transition w-full md:w-auto">Send Message</button>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
