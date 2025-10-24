// Use Firebase v10 modular SDK (stable and widely supported)
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
import { getMessaging, getToken, onMessage, isSupported } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-messaging.js";

window.addEventListener("DOMContentLoaded", () => {  // ✅ FIX START

  const firebaseConfig = {
    apiKey: "AIzaSyBXYJ9878NpEOdhuLaz9orl5QmgZxZpcGo",
    authDomain: "gramasandhai-90bcc.firebaseapp.com",
    projectId: "gramasandhai-90bcc",
    storageBucket: "gramasandhai-90bcc.firebasestorage.app",
    messagingSenderId: "285597065701",
    appId: "1:285597065701:web:da9ea107dffaff20e90f0c",
    measurementId: "G-M0JMQXZLKV"
  };

  const app = initializeApp(firebaseConfig);

  const btn = document.getElementById("enable");
  const tokenDisplay = document.getElementById("tokenDisplay");
  const tokenInput = document.getElementById("tokenInput");

  (async () => {
    if (!(await isSupported())) {
      tokenDisplay.textContent = "Push/Notifications not supported in this browser.";
      btn.disabled = true;
      return;
    }

    const swReg = await navigator.serviceWorker.register("https://gramasandhai.in/firebase/firebase-messaging-sw.js");

    btn.addEventListener("click", async () => {
      try {
        const permission = await Notification.requestPermission();
        if (permission !== "granted") {
          tokenDisplay.textContent = "Permission denied.";
          return;
        }

        const messaging = getMessaging(app);

        const currentToken = await getToken(messaging, {
          vapidKey: "BFWUv6JOfrwEug-R5_8zmIVsalXzjpIyOuciJ7Urq_8_Ek9AOZ_dvK0yUWDiBhI8tCqxVpZIfZe9CMZtqgcctFM",
          serviceWorkerRegistration: swReg
        });

        if (currentToken) {
          tokenDisplay.textContent = "FCM Token:\n" + currentToken;
          tokenInput.value = currentToken;
        } else {
          tokenDisplay.textContent = "No registration token available.";
        }

        onMessage(messaging, (payload) => {
          alert(`Foreground message:\n${payload.notification?.title || "Title"}\n${payload.notification?.body || ""}`);
        });
      } catch (err) {
        tokenDisplay.textContent = "Error: " + (err?.message || err);
        console.error(err);
      }
    });
  })();
});  // ✅ FIX END
