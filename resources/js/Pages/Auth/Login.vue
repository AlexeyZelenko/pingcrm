<template>
  <Head title="Login" />
  <div class="flex items-center justify-center p-6 min-h-screen bg-indigo-800">
    <div class="w-full max-w-md">
      <logo class="block mx-auto w-full max-w-xs fill-white" height="50" />

      <!-- Форма для входа -->
      <form v-if="showLogin" class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="signInWithEmail">
        <div class="px-10 py-12">
          <h1 class="text-center text-3xl font-bold">Welcome Back!</h1>
          <div class="mt-6 mx-auto w-24 border-b-2" />
          <text-input v-model="form.email" :error="form.errors.email" class="mt-10" label="Email" type="email" autofocus autocapitalize="off" />
          <text-input v-model="form.password" :error="form.errors.password" class="mt-6" label="Password" type="password" />
          <label class="flex items-center mt-6 select-none" for="remember">
            <input id="remember" v-model="form.remember" class="mr-1" type="checkbox" />
            <span class="text-sm">Remember Me</span>
          </label>
          <div class="mt-6">
            <span class="mr-1.5">Нет аккаунта?</span>
            <button @click="switchForm" type="button" class="text-blue-600">Register</button>
          </div>
        </div>
        <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Login</loading-button>
        </div>
      </form>

      <!-- Форма для регистрации -->
      <form v-else class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="register">
        <div class="px-10 py-12">
          <h1 class="text-center text-3xl font-bold">Register</h1>
          <div class="mt-6 mx-auto w-24 border-b-2" />
          <text-input v-model="formRegister.email" :error="formRegister.errors.email" class="mt-10" label="Email" type="email" autofocus autocapitalize="off" />
          <text-input v-model="formRegister.password" :error="formRegister.errors.password" class="mt-6" label="Password" type="password" />
          <text-input v-model="formRegister.confirmPassword" :error="formRegister.errors.confirmPassword" class="mt-6" label="Confirm Password" type="password" />
          <div class="mt-6">
            <span class="mr-1.5">Do you have an account?</span>
            <button @click="switchForm" type="button" class="text-blue-600">Login</button>
          </div>
        </div>
        <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
          <loading-button :loading="formRegister.processing" class="btn-indigo ml-auto" type="submit">Register</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { auth } from '@/firebase.js';
import { signInWithEmailAndPassword, createUserWithEmailAndPassword } from "firebase/auth";
import { Head } from '@inertiajs/vue3'
import Logo from '@/Shared/Logo.vue'
import TextInput from '@/Shared/TextInput.vue'
import LoadingButton from '@/Shared/LoadingButton.vue'

export default {
  components: {
    Head,
    LoadingButton,
    Logo,
    TextInput,
  },
  data() {
    return {
      showLogin: true,
      form: this.$inertia.form({
        email: 'johndoe@example.com',
        password: 'secret',
        remember: false,
      }),
      formRegister: this.$inertia.form({
        email: '',
        password: '',
        confirmPassword: ''
      })
    };
  },
  methods: {
    switchForm() {
      this.showLogin = !this.showLogin;
    },
    async signInWithEmail() {
      try {
        const userCredential = await signInWithEmailAndPassword(auth, this.form.email, this.form.password);
        console.log("Вход выполнен:", userCredential.user);
        this.form.post('/login');
      } catch (error) {
        console.error("Ошибка входа:", error.message);
      }
    },
    async register() {
      try {
        if (this.formRegister.password !== this.formRegister.confirmPassword) {
          this.formRegister.errors.confirmPassword = 'The passwords do not match';
          return;
        }
        const userCredential = await createUserWithEmailAndPassword(auth, this.formRegister.email, this.formRegister.password);
        console.log("Регистрация выполнена:", userCredential.user);

        // Отправка данных на сервер
        this.formRegister.post('/register');
      } catch (error) {
        console.error("Ошибка регистрации:", error.message);
      }
    }
  },
};
</script>
