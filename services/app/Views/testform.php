<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>GoFresha Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: sans-serif;
      margin: 0;
      background: #fff;
    }

    .container {
      max-width: 400px;
      margin: 50px auto;
      padding: 30px;
      text-align: center;
    }

    h2 {
      color: #2e7d32;
    }

    input[type="text"] {
      width: 90%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    button {
      width: 90%;
      background-color: #2e7d32;
      color: white;
      padding: 12px;
      margin-top: 10px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #27642a;
    }

    .message {
      color: red;
      margin-top: 10px;
    }

    .success {
      color: green;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Login to GoFresha</h2>

  <!-- Step 1: Mobile Number -->
  <div id="phoneSection">
    <input type="text" id="mobile" placeholder="Enter Mobile Number" maxlength="10">
    <button onclick="sendOTP()">Request OTP</button>
    <div class="message" id="msgPhone"></div>
  </div>

  <!-- Step 2: OTP -->
  <div id="otpSection" style="display:none;">
    <input type="text" id="otp" placeholder="Enter OTP" maxlength="6">
    <button onclick="verifyOTP()">Verify OTP</button>
    <div class="message" id="msgOtp"></div>
  </div>
</div>

<script>
  // Use your local secure backend routes here
  const BACKEND_URL = '<?= base_url()?>index.php/'; // base path, change if needed

  async function sendOTP() {
    const mobile = document.getElementById('mobile').value.trim();
    const msgPhone = document.getElementById('msgPhone');
    msgPhone.textContent = '';
    msgPhone.className = 'message';

    if (!/^\d{10}$/.test(mobile)) {
      msgPhone.textContent = 'Enter a valid 10-digit mobile number';
      return;
    }

    const formData = new FormData();
    formData.append('mobile', mobile);

    try {
      const response = await fetch(BACKEND_URL + 'registration', {
        method: 'POST',
        body: formData
      });

      const data = await response.json();

      if (data.status == 'success') {
        msgPhone.textContent = data.message || 'OTP sent';
        msgPhone.className = 'message success';
        document.getElementById('otpSection').style.display = 'block';
      } else {
        msgPhone.textContent = data.message || 'Failed to send OTP';
      }
    } catch (err) {
      console.error(err);
      msgPhone.textContent = 'Server error while sending OTP';
    }
  }

  async function verifyOTP() {
    const mobile = document.getElementById('mobile').value.trim();
    const otp = document.getElementById('otp').value.trim();
    const msgOtp = document.getElementById('msgOtp');
    msgOtp.textContent = '';
    msgOtp.className = 'message';

    if (!otp || otp.length < 4) {
      msgOtp.textContent = 'Enter valid OTP';
      return;
    }

    const formData = new FormData();
    formData.append('mobile', mobile);
    formData.append('otp', otp);

    try {
      const response = await fetch(BACKEND_URL + 'reg', {
        method: 'POST',
        body: formData
      });

      const data = await response.json();

      if (data.status === 'success') {
        msgOtp.textContent = data.message || 'Verified';
        msgOtp.className = 'message success';

        setTimeout(() => {
          window.location.href = BACKEND_URL; // Redirect on success
        }, 1000);
      } else {
        msgOtp.textContent = data.message || 'Invalid OTP';
      }
    } catch (err) {
      console.error(err);
      msgOtp.textContent = 'Server error while verifying OTP';
    }
  }
</script>

</body>
</html>
