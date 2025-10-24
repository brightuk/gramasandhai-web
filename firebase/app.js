// Firebase v10 Modular SDK
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
import { getMessaging, getToken, onMessage, isSupported } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-messaging.js";

// Firebase Config
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

// Make sure DOM is loaded
window.addEventListener("DOMContentLoaded", async () => {
  const tokenEl = document.getElementById("tokenDisplay");
  const tokenInput = document.getElementById("tokenInput");

  if (!(await isSupported())) {
    tokenEl.textContent = "Push/Notifications not supported in this browser.";
    return;
  }

  let swReg;

  try {
    // ✅ Adjust path to where your SW really is
    swReg = await navigator.serviceWorker.register("/firebase/firebase-messaging-sw.js");

    // Automatically request FCM token
    await requestFcmToken(swReg, tokenEl, tokenInput);

  } catch (err) {
    tokenEl.textContent = "Service worker registration failed: " + (err?.message || err);
    console.error(err);
  }
});

// Function to request FCM token
export async function requestFcmToken(swReg, tokenEl, tokenInput) {
  try {
    const permission = await Notification.requestPermission();
    if (permission !== "granted") {
      tokenEl.textContent = "Permission denied for notifications.";
      return;
    }

    const messaging = getMessaging(app);

    const currentToken = await getToken(messaging, {
      vapidKey: "BFWUv6JOfrwEug-R5_8zmIVsalXzjpIyOuciJ7Urq_8_Ek9AOZ_dvK0yUWDiBhI8tCqxVpZIfZe9CMZtqgcctFM",
      serviceWorkerRegistration: swReg
    });

    if (currentToken) {
      tokenEl.textContent = "FCM Token:\n" + currentToken;
      tokenInput.value = currentToken;
    } else {
      tokenEl.textContent = "No registration token available.";
    }

    // Foreground messages
    onMessage(messaging, (payload) => {
      alert(`Foreground message:\n${payload.notification?.title || "Title"}\n${payload.notification?.body || ""}`);
    });

  } catch (err) {
    tokenEl.textContent = "Error fetching FCM token: " + (err?.message || err);
    console.error(err);
  }
}
