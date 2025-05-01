<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Registrarse - TipstersBet</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-[#0b0b0b] text-white min-h-screen flex items-center justify-center px-4">

  <div class="bg-[#121212] w-full max-w-md rounded-2xl p-8 shadow-xl space-y-6 text-center">
    <img src="{{ asset('img/logo.png') }}" alt="Logo TipstersBet" class="h-14 mx-auto">

    <h2 class="text-2xl font-bold text-green-400">📝 Crear cuenta</h2>
    
    <!-- Aquí comienza el formulario con la lógica de Laravel -->
    <x-validation-errors class="mb-4 text-center text-red-500" />

    <form method="POST" action="{{ route('register') }}" class="space-y-4 text-left">
      @csrf

      <div>
        <x-label for="name" class="text-sm text-gray-400 block mb-1" value="{{ __('Nombre de usuario') }}" />
        <x-input id="name" class="w-full bg-gray-800 border border-gray-600 rounded px-3 py-2 mb-4" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
      </div>

      <div>
        <x-label for="email" class="text-sm text-gray-400 block mb-1" value="{{ __('Correo electrónico') }}" />
        <x-input id="email" class="w-full px-4 py-2 bg-[#1f1f1f] border border-gray-700 rounded text-white" type="email" name="email" :value="old('email')" required autocomplete="username" />
      </div>

      <div>
        <x-label for="password" class="text-sm text-gray-400 block mb-1" value="{{ __('Contraseña') }}" />
        <x-input id="password" class="w-full px-4 py-2 bg-[#1f1f1f] border border-gray-700 rounded text-white" type="password" name="password" required autocomplete="new-password" />
      </div>

      <div>
        <x-label for="password_confirmation" class="text-sm text-gray-400 block mb-1" value="{{ __('Confirmar Contraseña') }}" />
        <x-input id="password_confirmation" class="w-full px-4 py-2 bg-[#1f1f1f] border border-gray-700 rounded text-white" type="password" name="password_confirmation" required autocomplete="new-password" />
      </div>

      @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
        <div class="mt-4">
          <x-label for="terms">
            <div class="flex items-center">
              <x-checkbox name="terms" id="terms" required />
              <div class="ms-2 text-sm text-gray-400">
                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                ]) !!}
              </div>
            </div>
          </x-label>
        </div>
      @endif

      <div class="flex items-center justify-between mt-4">
        <p class="text-sm text-gray-400">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-green-400 hover:underline">Inicia sesión</a></p>

        <x-button class="ms-4 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-xl">
          {{ __('Registrarme') }}
        </x-button>
      </div>
    </form>
  </div>

</body>
</html>
