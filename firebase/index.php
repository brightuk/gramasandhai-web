<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Home – Web Push</title>
    <link rel="manifest" href="https://gramasandhai.in/firebase/manifest.json">
</head>

<body>
    <h1>Home</h1>
    <!-- <button id="enable">Enable Notifications</button> -->

    <!-- Display token here -->
    <pre id="tokenDisplay" style="white-space:pre-wrap;"></pre>

    <!-- Also write token into input field -->
    <form action="">
        <input type="text" name="devicetoken" id="tokenInput" readonly>
    </form>
    <script type="module">
    import {
        requestFcmToken
    } from './app.js';
    requestFcmToken(); // call automatically on page load
    </script>



    <script type="module" src="https://gramasandhai.in/firebase/app.js"></script>
</body>

</html>