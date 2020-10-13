// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here, other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
firebase.initializeApp({
    apiKey: "AIzaSyCWL1JioFFgVfp7mP05MkSSSoigV6_cVvg",
    authDomain: "luan-van-e8dfd.firebaseapp.com",
    databaseURL: "https://luan-van-e8dfd.firebaseio.com",
    projectId: "luan-van-e8dfd",
    storageBucket: "luan-van-e8dfd.appspot.com",
    messagingSenderId: "115901231588",
    appId: "1:115901231588:web:00c34bc2544ce729ab17f1",
    measurementId: "G-XD5CCQ9TKC"
});
// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    const {title,body}=payload.notification;
    const notificationOptions = {
      body,
    };
    return self.registration.showNotification(title,
      notificationOptions);
  });
