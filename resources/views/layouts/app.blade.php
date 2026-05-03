<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login - SmartPark</title>

<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

/* BACKGROUND */
body {
    height: 100vh;
    background: #f4f6fb;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* WRAPPER */
.container {
    width: 100%;
    max-width: 700px;
    text-align: center;
    padding: 10px;
}

/* LOGO */
.logo {
    margin-bottom: 12px;
}

.logo img {
    width: 180px;
}

/* TITLE */
.title {
    font-size: 24px;
    font-weight: 600;
    color: #1e293b;
}

.subtitle {
    color: #6b7280;
    font-size: 14px;
    margin-bottom: 20px;
}

/* CARD */
.card {
    background: white;
    padding: 25px;
    border-radius: 18px;
    width: 100%;
    max-width: 360px;
    margin: auto;

    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

/* LABEL */
.label {
    text-align: left;
    font-size: 13px;
    margin-bottom: 5px;
    color: #374151;
}

/* INPUT GROUP */
.input-group {
    display: flex;
    align-items: center;
    background: #f9fafb;
    border-radius: 10px;
    padding: 10px 12px;
    margin-bottom: 15px;
    border: 1px solid #e5e7eb;
    transition: 0.2s;
}

.input-group:focus-within {
    border-color: #3b82f6;
}

.input-group input {
    border: none;
    outline: none;
    flex: 1;
    background: transparent;
    font-size: 14px;
}

/* PASSWORD ACTION */
.password-action {
    text-align: right;
    font-size: 12px;
    margin-bottom: 10px;
}

.password-action a {
    color: #3b82f6;
    text-decoration: none;
}

/* BUTTON */
.btn {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: none;
    cursor: pointer;

    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    font-weight: 500;

    transition: 0.3s;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(37,99,235,0.4);
}

/* DIVIDER */
.divider {
    margin: 15px 0;
    font-size: 13px;
    color: #9ca3af;
}

/* GOOGLE BUTTON */
.btn-google {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    background: white;
    cursor: pointer;
    transition: 0.2s;
}

.btn-google:hover {
    background: #f3f4f6;
}

/* FOOTER */
.footer {
    margin-top: 15px;
    font-size: 13px;
}

.footer a {
    color: #2563eb;
    text-decoration: none;
}

</style>
</head>

<body>

<div class="container">

    <!-- LOGO -->
    <div class="logo">
        <img src="{{ asset('images/logo.png') }}">
    </div>

    <!-- TITLE -->
    <h2 class="title">Selamat datang kembali!</h2>
    <p class="subtitle">Masuk untuk melanjutkan ke akun Anda</p>

    <!-- CARD -->
    <div class="card">

        <form method="POST" action="/login">
            @csrf

            <!-- EMAIL -->
            <div class="label">Email</div>
            <div class="input-group">
                
                <input type="email" name="email" placeholder="Masukkan email Anda" required>
            </div>

            <!-- PASSWORD -->
            <div class="label">Password</div>
            <div class="input-group">
                🔒
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
                <span onclick="togglePassword()" style="cursor:pointer;">👁</span>
            </div>

            <!-- LUPA PASSWORD -->
            <div class="password-action">
                <a href="#">Lupa password?</a>
            </div>

            <!-- BUTTON -->
            <button class="btn">Masuk</button>

        </form>

        <!-- DIVIDER -->
        <div class="divider">atau</div>

        <!-- GOOGLE -->
        <button class="btn-google">
            🔵 Masuk dengan Google
        </button>

    </div>

    <!-- FOOTER -->
    <div class="footer">
        Belum punya akun? <a href="#">Daftar sekarang</a>
    </div>

</div>

<script>
function togglePassword() {
    let pass = document.getElementById("password");
    pass.type = pass.type === "password" ? "text" : "password";
}
</script>

</body>
</html>