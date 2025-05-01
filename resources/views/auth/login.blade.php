<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title>Iniciar Sesión - TipstersBet</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    input[type="password"]::-ms-reveal,
    input[type="password"]::-webkit-credentials-button,
    input[type="password"]::-webkit-textfield-decoration-container,
    input[type="password"]::-webkit-clear-button {
      filter: invert(1);
    }
  </style>
</head>

<body class="bg-[#0b0b0b] text-white min-h-[100dvh] w-screen flex items-center justify-center p-0 m-0">
  <div class="flex flex-col justify-center items-center w-full h-full px-6">
    <form method="POST" action="{{ route('login') }}" class="bg-[#121212] w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl mx-auto rounded-xl p-6 sm:p-8 shadow-lg space-y-6">
      @csrf

      <div class="flex justify-center">
        <img src="{{ asset('img/logo.png') }}" alt="Logo TipstersBet" class="h-20">
      </div>

      <h2 class="text-3xl font-bold text-white-400 text-center">Iniciar sesión</h2>

      @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600 text-center">
          {{ session('status') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="mb-4">
          <ul class="text-sm text-red-500 list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div>
        <label class="text-sm text-gray-400 block mb-1">Correo electrónico</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
          class="w-full px-3 py-2 sm:px-4 sm:py-3 bg-[#1f1f1f] border border-gray-600 rounded-md text-white text-base sm:text-lg transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-green-400" />
      </div>

      <div>
        <label class="text-sm text-gray-400 block mb-1">Contraseña</label>
        <input type="password" name="password" required autocomplete="current-password"
          class="w-full px-3 py-2 sm:px-4 sm:py-3 bg-[#1f1f1f] border border-gray-600 rounded-md text-white text-base sm:text-lg transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-green-400" />
      </div>

      <div class="block mt-4">
        <label for="remember_me" class="flex items-center">
          <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-600 bg-[#1f1f1f] text-green-500 focus:ring-green-400">
          <span class="ms-2 text-sm text-gray-400">Recuérdame</span>
        </label>
      </div>

      <button type="submit"
        class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 sm:py-3 rounded-lg text-base sm:text-lg transition-all duration-150">
        Entrar
      </button>

      <div class="text-sm text-center">
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="text-gray-400 hover:text-green-400 underline">¿Olvidaste tu contraseña?</a>
        @endif
      </div>

      <p class="text-sm text-gray-400 text-center">¿No tienes cuenta?
        <a href="{{ route('register') }}" class="text-green-400 hover:underline">Regístrate aquí</a>
      </p>
    </form>
  </div>
</body>
</html>
