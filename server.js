// server.js or app.js

const express = require('express');
const mongoose = require('mongoose');
const bodyParser = require('body-parser');
const nodemailer = require('nodemailer'); // if you're sending confirmations via email/SMS
const cors = require('cors');

const app = express();
app.use(cors());
app.use(bodyParser.json());

// Connect to MongoDB
mongoose.connect('mongodb://localhost:27017/reservations', {
  useNewUrlParser: true,
  useUnifiedTopology: true
});

// Define Reservation schema
const reservationSchema = new mongoose.Schema({
  persons: Number,
  date: String,
  time: String,
  phone: String,
  comments: String
});

const Reservation = mongoose.model('Reservation', reservationSchema);

// 🔽 PLACE THE ROUTE HERE
app.post('/api/reserve', async (req, res) => {
  const { persons, date, time, phone, comments } = req.body;
  const key = `${date} ${time}`;

  try {
    const count = await Reservation.countDocuments({ date, time });

    if (count >= 10) {
      return res.status(400).json({ error: 'This time slot is fully booked.' });
    }

    const newReservation = new Reservation({ persons, date, time, phone, comments });
    await newReservation.save();

    // Optional: Send SMS/email here using nodemailer or Twilio
    // ...

    return res.json({ message: 'Reservation confirmed!' });
  } catch (error) {
    return res.status(500).json({ error: 'Server error' });
  }
});

// Start the server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});
