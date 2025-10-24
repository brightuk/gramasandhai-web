<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Firebase OTP Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ✅ Use Firebase v8 (not v9) -->
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-box {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 350px;
    }
    h2 { text-align: center; }
    input, button {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    button {
      background: #007bff;
      color: #fff;
      border: none;
      cursor: pointer;
    }
    button:hover { background: #0056b3; }
  </style>
</head>
<body>

  <div class="login-box">
    <h2>Login with Phone</h2>

    <!-- Phone Input -->
    <input type="text" id="phone" placeholder="+91XXXXXXXXXX">

    <!-- Recaptcha -->
    <div id="recaptcha-container"></div>

    <!-- Buttons -->
    <button onclick="sendOTP()">Send OTP</button>
    <input type="text" id="otp" placeholder="Enter OTP">
    <button onclick="verifyOTP()">Verify OTP</button>
  </div>

  <script>
    // Firebase Config
    const firebaseConfig = {
      apiKey: "AIzaSyD2R1g2acRWQ8Y9v9ofs6V2bKDyS5vnV98",
      authDomain: "shop-c2996.firebaseapp.com",
      projectId: "shop-c2996",
      storageBucket: "shop-c2996.appspot.com",
      messagingSenderId: "1073327777463",
      appId: "1:1073327777463:web:e31f09b229cc805d52cf32",
      measurementId: "G-20KC18CZXV"
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    const auth = firebase.auth();

    // Render reCAPTCHA
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();

    // Send OTP
    function sendOTP() {
      const phoneNumber = document.getElementById('phone').value;
      auth.signInWithPhoneNumber(phoneNumber, window.recaptchaVerifier)
        .then(confirmationResult => {
          window.confirmationResult = confirmationResult;
          alert("OTP Sent!");
        })
        .catch(error => {
          console.error(error);
          alert("Error: " + error.message);
        });
    }

    // Verify OTP
    function verifyOTP() {
      const code = document.getElementById('otp').value;
      window.confirmationResult.confirm(code).then(result => {
        return result.user.getIdToken();
      }).then(idToken => {
        // ✅ Send ID Token to backend
        fetch('https://gofresha.in/services/index.php/test', {
          method: 'POST',
          headers: { 
            'Content-Type': 'application/x-www-form-urlencoded',
            'x-api': 'SEC195C79FC4CCB09B48AA8' // ✅ Added your custom header here
          },
          body: 'idToken=' + encodeURIComponent(idToken)
        })
        .then(res => res.json())
        .then(data => {
          console.log("Backend Response:", data);
        //   alert("Login Successful!");
        })
        // .catch(err => console.error(err));
      }).catch(error => {
        // console.error(error);
        // alert("Invalid OTP");
      });
    }
  </script>

</body>
</html>
