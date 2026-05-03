<x-guest-layout>

<!-- ERROR -->
@if ($errors->any())
    <div class="mb-3 text-red-500 text-sm text-center">
        {{ $errors->first() }}
    </div>
@endif

<!-- 🔥 TRIK ANTI AUTOFILL -->
<input type="text" style="display:none">
<input type="password" style="display:none">

<form method="POST" action="{{ route('login') }}" autocomplete="off" class="space-y-4">
    @csrf

    <!-- EMAIL -->
    <div>
        <label class="text-sm text-gray-600">Email</label>
        <div class="mt-1 flex items-center bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 
                    focus-within:ring-2 focus-within:ring-blue-500 transition">

            <span class="text-gray-400 mr-2">📧</span>

            <input type="email"
                   name="email"
                   value=""
                   required
                   autocomplete="off"
                   class="w-full bg-transparent outline-none text-sm placeholder-gray-400"
                   placeholder="Masukkan email Anda">
        </div>
    </div>

    <!-- PASSWORD -->
    <div>
        <label class="text-sm text-gray-600">Password</label>

        <div class="mt-1 flex items-center bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 
                    focus-within:ring-2 focus-within:ring-blue-500 transition">

            <span class="text-gray-400 mr-2">🔒</span>

            <input type="password"
                   id="password"
                   name="password"
                   required
                   autocomplete="new-password"
                   class="w-full bg-transparent outline-none text-sm placeholder-gray-400"
                   placeholder="Masukkan password Anda">

            <!-- SHOW PASSWORD -->
            <span onclick="togglePassword()" class="cursor-pointer text-gray-400 hover:text-gray-600 text-sm">
                👁
            </span>
        </div>

        <div class="text-right mt-1">
            <a href="{{ route('password.request') }}" class="text-blue-500 text-xs hover:underline">
                Lupa password?
            </a>
        </div>
    </div>

    <!-- REMEMBER -->
    <div class="flex items-center text-sm">
        <input type="checkbox" name="remember" class="rounded border-gray-300">
        <span class="ml-2 text-gray-600">Remember me</span>
    </div>

    <!-- BUTTON -->
    <button type="submit"
        class="w-full py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold 
               shadow-md hover:shadow-lg hover:scale-[1.01] transition">
        Masuk
    </button>

</form>

<!-- DIVIDER -->
<div class="flex items-center my-4">
    <div class="flex-1 border-t border-gray-200"></div>
    <span class="mx-3 text-xs text-gray-400">atau</span>
    <div class="flex-1 border-t border-gray-200"></div>
</div>

<!-- GOOGLE -->
<a href="{{ route('google.login') }}"
   class="w-full flex items-center justify-center gap-3 border border-gray-200 rounded-xl py-2.5 
          text-sm bg-white hover:bg-gray-50 transition shadow-sm">

    <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5">

    <span class="font-medium text-gray-700">
        Masuk dengan Google
    </span>
</a>

<!-- REGISTER -->
<p class="mt-4 text-sm text-gray-500 text-center">
    Belum punya akun?
    <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:underline">
        Daftar sekarang
    </a>
</p>

<!-- SCRIPT -->
<script>
function togglePassword() {
    const input = document.getElementById("password");
    input.type = input.type === "password" ? "text" : "password";
}
</script>

</x-guest-layout>