// Keep SW light; use the compat build for simplicity
importScripts("https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js");
importScripts("https://www.gstatic.com/firebasejs/10.12.2/firebase-messaging-compat.js");

firebase.initializeApp({
    apiKey: "AIzaSyBXYJ9878NpEOdhuLaz9orl5QmgZxZpcGo",
    authDomain: "gramasandhai-90bcc.firebaseapp.com",
    projectId: "gramasandhai-90bcc",
    storageBucket: "gramasandhai-90bcc.firebasestorage.app",
    messagingSenderId: "285597065701",
    appId: "1:285597065701:web:da9ea107dffaff20e90f0c",
    measurementId: "G-M0JMQXZLKV"
});


const messaging = firebase.messaging();

// Background messages
messaging.onBackgroundMessage((payload) => {
  const title = (payload.notification && payload.notification.title) || "Background Message";
  const options = {
    body: payload.notification && payload.notification.body,
    icon: payload.notification && payload.notification.icon, // optional
    data: payload.data || {}
  };
  self.registration.showNotification(title, options);
});

// Optional: handle clicks
self.addEventListener("notificationclick", (event) => {
  event.notification.close();
  const url = event.notification.data?.click_action || "/";
  event.waitUntil(clients.openWindow(url));
});
