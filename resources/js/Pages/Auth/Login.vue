<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    login: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
  <Head title="Iniciar sesión - TipstersBet" />

  <div class="bg-[#0b0b0b] text-white min-h-[100dvh] w-screen flex items-center justify-center p-0 m-0">
    <div class="flex flex-col justify-center items-center w-full h-full px-6">
      <form @submit.prevent="submit" class="bg-[#121212] w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl mx-auto rounded-xl p-6 sm:p-8 shadow-lg space-y-6">
        <div class="flex justify-center">
          <img src="/img/logo.png" alt="Logo TipstersBet" class="h-20" />
        </div>

        <h2 class="text-3xl font-bold text-white-400 text-center">Iniciar sesión</h2>

        <div>
          <label class="text-sm text-gray-400 block mb-1">Correo o usuario</label>
          <input
            v-model="form.login"
            type="text"
            name="login"
            required
            placeholder="Ej. usuario123 o correo@mail.com"
            class="w-full px-3 py-2 sm:px-4 sm:py-3 bg-[#1f1f1f] border border-gray-600 rounded-md text-white text-base sm:text-lg transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-green-400"
          />
          <p v-if="form.errors.login" class="text-red-500 text-sm mt-1">{{ form.errors.login }}</p>
        </div>

        <div>
          <label class="text-sm text-gray-400 block mb-1">Contraseña</label>
          <input
            v-model="form.password"
            type="password"
            name="password"
            required
            class="w-full px-3 py-2 sm:px-4 sm:py-3 bg-[#1f1f1f] border border-gray-600 rounded-md text-white text-base sm:text-lg transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-green-400"
          />
          <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</p>
        </div>

        <button
          type="submit"
          :disabled="form.processing"
          class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 sm:py-3 rounded-lg text-base sm:text-lg transition-all duration-150"
        >
          Entrar
        </button>

        <div class="text-sm text-center">
          <Link v-if="canResetPassword" :href="route('password.request')" class="text-gray-400 hover:text-green-400 underline">¿Olvidaste tu contraseña?</Link>
        </div>

        <p class="text-sm text-gray-400 text-center">¿No tienes cuenta? 
          <Link href="/register" class="text-green-400 hover:underline">Regístrate aquí</Link>
        </p>
      </form>
    </div>
  </div>
</template>
