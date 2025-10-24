<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <h2>Hello</h2>

    <script type="module">
    // Import the functions you need from the SDKs you need
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/12.4.0/firebase-app.js";
    import {
        getAnalytics
    } from "https://www.gstatic.com/firebasejs/12.4.0/firebase-analytics.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyBXYJ9878NpEOdhuLaz9orl5QmgZxZpcGo",
        authDomain: "gramasandhai-90bcc.firebaseapp.com",
        projectId: "gramasandhai-90bcc",
        storageBucket: "gramasandhai-90bcc.firebasestorage.app",
        messagingSenderId: "285597065701",
        appId: "1:285597065701:web:da9ea107dffaff20e90f0c",
        measurementId: "G-M0JMQXZLKV"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);
    </script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Firebase Web Push Token</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

    <h2>Firebase Web Push Token</h2>
    <button onclick="getDeviceToken()">Get Device Token</button>


    <!-- <form id = "firebaseForm">
        <input type="text" id="token" name="token" placeholder="Token" required>
        <button type="submit"></button>
    </form> -->

    <!-- Firebase SDK -->
    <script src="https://www.gstatic.com/firebasejs/10.13.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.13.1/firebase-messaging.js"></script>

    <script>
        // ✅ Initialize Firebase (Only Once)
        const firebaseConfig = {
            apiKey: "AIzaSyBXYJ9878NpEOdhuLaz9orl5QmgZxZpcGo",
            authDomain: "gramasandhai-90bcc.firebaseapp.com",
            projectId: "gramasandhai-90bcc",
            storageBucket: "gramasandhai-90bcc.firebasestorage.app",
            messagingSenderId: "285597065701",
            appId: "1:285597065701:web:da9ea107dffaff20e90f0c",
            measurementId: "G-M0JMQXZLKV"
        };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        // ✅ Request Permission and Get Token
        function getDeviceToken() {
            Notification.requestPermission().then((permission) => {
                if (permission === "granted") {
                    messaging.getToken({
                        vapidKey: "BFWVJ6J0frwEug-R5_BzmlVsaIJzjplyOucIJ7Urq_8_Ek9AOZ_dvK0yUWDlbhI8tCqxVpZIF2e9CMZtggcctFM"
                    })
                    .then((token) => {
                        console.log("✅ Device Token:", token);
                        alert("Device Token:\n" + token);
                    })
                    .catch((err) => {
                        console.error("❌ Failed to get token", err);
                    });
                } else {
                    console.warn("⚠️ Notification permission not granted");
                }
            });
        }
    </script>

</body>

</html>
