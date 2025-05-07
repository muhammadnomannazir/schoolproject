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
      <li><a href="Home.html">Home</a></li>
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
      <!-- Time options -->
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
  const phone = document.getElementById('phone').value.trim();
  const date = new Date(document.getElementById('date').value);
  const today = new Date();
  today.setHours(0, 0, 0, 0); // reset hours for proper comparison
  const maxDate = new Date();
  maxDate.setMonth(today.getMonth() + 1);
  const comments = document.getElementById('comments').value.trim();
  const commentWords = comments.split(/\s+/).filter(word => word.length > 0);

  // Phone validation: must match (xxx) xxx-xxxx
  const phoneRegex = /^\(\d{3}\)\s\d{3}-\d{4}$/;
  if (!phoneRegex.test(phone)) {
    alert("Please enter a valid phone number format: (123) 456-7890");
    e.preventDefault();
    return;
  }

  // Date validation: not before today and not after 1 month
  if (date < today || date > maxDate) {
    alert("Reservation date must be within 1 month from today.");
    e.preventDefault();
    return;
  }

  // Comment validation: max 50 words
  if (commentWords.length > 50) {
    alert("Comments cannot exceed 50 words.");
    e.preventDefault();
    return;
  }
});
</script>

<!-- Footer Section -->
<footer class="footer">
    <div class="footer-container">
  
      <!-- Contact Information -->
      <div class="footer-section">
        <h3>Contact</h3>
        <p><strong>Call us on:</strong> <a href="tel:9292459647">(929)245-9647</a></p>
        <p><a href="OrderOnline.html">Order Online</a></p>
        <p><strong>Address:</strong><br>
          <a href="https://www.google.com/maps?q=1809+Emmons+Ave,+Brooklyn,+NY+11235" target="_blank">
          1809 Emmons Ave<br>
          Brooklyn, NY 11235
          </a>
</p>
        <p><strong>Email:</strong><br>
          <a href="mailto:muhammadnomannazir123@gmail.com">muhammadnomannazir123@gmail.com</a></p>
      </div>
  
      <!-- About Section -->
      <div class="footer-section about">
        <h3>About</h3>
        <p>Rana's Cafe & Restaurant is renowned for its Mediterranean cuisine, homemade dishes, and breakfast offerings that include a wide range of delicacies. Brighten up your day and enjoy a meal your taste buds will never forget here at Masal Plus Cafe & Restaurant.</p>
      </div>
  
      <!-- Open Hours -->
      <div class="footer-section">
        <h3>Open Hours</h3>
        <ul>
          <li>Monday: 09:00 AM - 2:00 AM</li>
          <li>Tuesday: 09:00 AM - 2:00 AM</li>
          <li>Wednesday: 09:00 AM - 2:00 AM</li>
          <li>Thursday: 09:00 AM - 2:00 AM</li>
          <li>Friday: 09:00 AM - 2:00 AM</li>
          <li>Saturday: 09:00 AM - 2:00 AM</li>
          <li>Sunday: 09:00 AM - 2:00 AM</li>
        </ul>
      </div>
  
    </div>
  
    <!-- Footer Bottom -->
    <div class="footer-bottom">
      <p>© Rana's | Developed by Authorize Local</p>
    </div>
  </footer>  

</body>
</html>
