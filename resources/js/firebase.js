// resources/js/firebase.js
import { initializeApp } from "firebase/app";
import { getAuth } from "firebase/auth";
import { getAnalytics } from "firebase/analytics";

const firebaseConfig = {
    apiKey: "AIzaSyDEhsNAcusoBWhQ9UnCy4W0yzfYPemZDBI",
    authDomain: "interview-2cbfd.firebaseapp.com",
    projectId: "interview-2cbfd",
    storageBucket: "interview-2cbfd.appspot.com",
    messagingSenderId: "65372875467",
    appId: "1:65372875467:web:a92ae4064fb3c8747c894e",
    measurementId: "G-SVRDRPEQ28",
};

// Инициализация Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const analytics = getAnalytics(app);

export { auth, analytics };
