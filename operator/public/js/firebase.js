importScripts('https://www.gstatic.com/firebasejs/10.13.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/10.13.1/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyBXYJ9878NpEOdhuLaz9orl5QmgZxZpcGo",
    authDomain: "gramasandhai-90bcc.firebaseapp.com",
    projectId: "gramasandhai-90bcc",
    storageBucket: "gramasandhai-90bcc.appspot.com",
    messagingSenderId: "285597065701",
    appId: "1:285597065701:web:da9ea107dffaff20e90f0c",
    measurementId: "G-M0JMQXZLKV"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body
    };
    self.registration.showNotification(notificationTitle, notificationOptions);
});
