importScripts('https://www.gstatic.com/firebasejs/9.14.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.14.0/firebase-messaging-compat.js');
const firebaseConfig = {
  // firebaseConfig here
  apiKey: "AIzaSyByc2HkXpLxwZVtDwHPU4DynFGxmLCTgKI",

  authDomain: "adastra-project.firebaseapp.com",

  projectId: "adastra-project",

  storageBucket: "adastra-project.appspot.com",

  messagingSenderId: "860097321121",

  appId: "1:860097321121:web:f150953edc8058a80978e0",

  measurementId: "G-ZPRZV7F405"

};

// Initialize Firebase
const app = firebase.initializeApp(firebaseConfig)
const messaging = firebase.messaging();
messaging.onBackgroundMessage(function (payload) {
  // Customize notification here
  const notificationTitle = payload.data.title;
  const notificationOptions = {
    body: payload.data.body,
    icon: payload.data.icon,
    image: payload.data.image
  };

  self.registration.showNotification(notificationTitle, notificationOptions);
  self.addEventListener('notificationclick', function (event) {
    const clickedNotification = event.notification;
    clickedNotification.close();
    event.waitUntil(
      clients.openWindow(payload.data.click_action)
    );
  });
});