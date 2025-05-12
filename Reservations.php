<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reservation</title>
  <link rel="stylesheet" href="Reservations.css">
  <link rel="icon" href="Logo.jpg">
</head>
<body>
<header>
  <nav class="navbar">
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="Menu.html">Menu</a></li>
      <li><a href="Catering.html">Catering</a></li>
      <li><a href="Reservations.php">Reservation</a></li>
      <li><a href="OrderOnline.html">Order Online</a></li>
    </ul>
  </nav>
</header>

<section class="reservation-info">
  <h2>Reservations</h2>
  <p>To make a reservation:<br>
    Call <a href="tel:9292459647">(929) 245-9647</a> or Book online.</p>
</section>

<div class="logo-container">
  <img src="Logo.jpg" alt="Rana Cafe Logo" class="logo">
</div>

<section class="booking-form">
  <h2>Table Reservation</h2>

  <!-- Error message container -->
  <div id="errorMessage"></div>

  <form id="reservationForm" action="reserve.php" method="POST">
    <!-- Number of Persons -->
    <label for="persons">Number of Persons:</label>
    <select id="persons" name="persons" required>
      <option value="" disabled selected>Select</option>
      <option value="1">1 Person</option>
      <option value="2">2 Persons</option>
      <option value="3">3 Persons</option>
      <option value="4">4 Persons</option>
      <option value="5">5 Persons</option>
      <option value="6">6 Persons</option>
    </select>

    <!-- Date -->
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required>

    <!-- Time -->
    <label for="time">Time:</label>
    <select id="time" name="time" required>
      <option value="" disabled selected>Select Time</option>
      <option value="10:00 AM">10:00 AM</option>
      <option value="11:00 AM">11:00 AM</option>
      <option value="12:00 PM">12:00 PM</option>
      <option value="01:00 PM">01:00 PM</option>
      <option value="02:00 PM">02:00 PM</option>
      <option value="03:00 PM">03:00 PM</option>
      <option value="04:00 PM">04:00 PM</option>
      <option value="05:00 PM">05:00 PM</option>
      <option value="06:00 PM">06:00 PM</option>
      <option value="07:00 PM">07:00 PM</option>
      <option value="08:00 PM">08:00 PM</option>
      <option value="09:00 PM">09:00 PM</option>
      <option value="10:00 PM">10:00 PM</option>
    </select>

    <!-- Phone -->
    <label for="phone">Cell Phone Number:</label>
    <input type="tel" id="phone" name="phone" placeholder="(123) 456-7890" required>

    <!-- Comments -->
    <label for="comments">Comments (optional):</label>
    <textarea id="comments" name="comments" rows="3"></textarea>

    <button type="submit">Reserve Table</button>
  </form>
</section>

<script>
document.getElementById('reservationForm').addEventListener('submit', function(e) {
  e.preventDefault(); // Prevent form from submitting normally

  const errorMessageDiv = document.getElementById('errorMessage');
  errorMessageDiv.innerHTML = ''; // Clear previous errors

  const errors = [];

  const phone = document.getElementById('phone').value.trim();
  const dateInput = document.getElementById('date').value;
  const date = new Date(dateInput);
  const today = new Date();
  today.setHours(0, 0, 0, 0);
  const maxDate = new Date();
  maxDate.setMonth(today.getMonth() + 1);

  const comments = document.getElementById('comments').value.trim();
  const commentWords = comments.split(/\s+/).filter(word => word.length > 0);

  const phoneRegex = /^\(\d{3}\)\s\d{3}-\d{4}$/;
  if (!phoneRegex.test(phone)) {
    errors.push("• Phone must be in the format (123) 456-7890.");
  }

  if (!dateInput || date < today || date > maxDate) {
    errors.push("• Date must be within 1 month from today.");
  }

  if (commentWords.length > 50) {
    errors.push("• Comments cannot exceed 50 words.");
  }

  if (errors.length > 0) {
    errorMessageDiv.innerHTML = errors.join("<br>");
    return;
  }

  // If no errors, show thank you message
  const formSection = document.querySelector('.booking-form');
  formSection.innerHTML = `
    <div class="thank-you-message">
      <h2>🎉 Thank You!</h2>
      <p>Your reservation has been received. We'll see you soon at Rana's Cafe!</p>
      <a href="Reservations.php" class="back-button">Make Another Reservation</a>
    </div>
  `;
});
</script>


<!-- Footer Section -->
<footer class="footer bg-dark text-white py-10">
  <div class="container footer-container flex flex-wrap justify-between gap-8 px-4">

    <div class="footer-section w-full sm:w-1/3">
      <h3 class="text-lg font-bold mb-2">Contact</h3>
      <p><strong>Call us:</strong> <a href="tel:9292459647" class="text-blue-400 hover:underline">(929) 245-9647</a></p>
      <p><a href="OrderOnline.html" class="hover:underline">Order Online</a></p>
      <p><strong>Address:</strong><br>
        <a href="https://www.google.com/maps?q=1809+Emmons+Ave,+Brooklyn,+NY+11235" target="_blank" class="hover:underline">
          1809 Emmons Ave<br>
          Brooklyn, NY 11235
        </a>
      </p>
      <p><a href="mailto:muhammadnomannazir123@gmail.com" class="hover:underline">muhammadnomannazir123@gmail.com</a></p>
    </div>

    <div class="footer-section w-full sm:w-1/3">
      <h3 class="text-lg font-bold mb-2">About</h3>
      <p class="text-sm leading-relaxed">
        Rana's Cafe & Restaurant is renowned for its Mediterranean cuisine, homemade dishes, and hearty breakfasts.
        Enjoy a flavorful experience at Masal Plus Cafe & Restaurant, where every bite is a memory.
      </p>
    </div>

    <div class="footer-section w-full sm:w-1/3">
      <h3 class="text-lg font-bold mb-2">Open Hours</h3>
      <ul class="text-sm leading-relaxed">
        <li>Monday - Sunday: 09:00 AM - 2:00 AM</li>
      </ul>
    </div>

  </div>

  <div class="footer-bottom text-center mt-10 border-t border-gray-700 pt-4 text-sm">
    <p> © Rana's | Developed by Authorize Local</p>
  </div>
</footer>

</body>
</html>
