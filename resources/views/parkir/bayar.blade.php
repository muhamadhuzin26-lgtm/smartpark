<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran</title>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="YOUR_CLIENT_KEY"></script>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
</head>

<body>

<div class="wrapper">

    <div class="payment-card">

        <h3 class="title">💳 Pembayaran Parkir</h3>

        <p class="subtitle">Silakan selesaikan pembayaran</p>

        <h1 class="price">Rp {{ number_format($biaya,0,',','.') }}</h1>

        <button id="pay-button" class="pay-btn">
            Bayar Sekarang
        </button>

    </div>

</div>

<style>

/* RESET */
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
}

/* BACKGROUND */
.wrapper {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;

    background: radial-gradient(circle at top, #1e3a8a, #0f172a);
}

/* CARD */
.payment-card {
    width: 400px;
    padding: 40px;
    border-radius: 30px;

    background: #1e293b;
    color: white;
    text-align: center;

    border: 1px solid rgba(255,255,255,0.05);

    box-shadow:
        0 15px 40px rgba(0,0,0,0.6),
        0 0 25px rgba(59,130,246,0.08);

    transition: 0.3s;
}

/* HOVER */
.payment-card:hover {
    transform: translateY(-5px);
}

/* TITLE */
.title {
    font-size: 1.6rem;
    font-weight: 600;
}

/* SUBTITLE */
.subtitle {
    font-size: 0.85rem;
    color: #9ca3af;
    margin-bottom: 20px;
}

/* PRICE */
.price {
    font-size: 2.5rem;
    font-weight: 700;
    color: #4ade80;
    margin: 20px 0;
}

/* BUTTON */
.pay-btn {
    width: 100%;
    padding: 14px;
    border-radius: 14px;
    border: none;

    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: white;

    font-size: 1rem;
    font-weight: 600;

    cursor: pointer;
    transition: 0.3s;
}

/* HOVER BUTTON */
.pay-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 25px rgba(34,197,94,0.5);
}

</style>

<script>
document.getElementById('pay-button').onclick = function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            alert("Pembayaran sukses!");
            window.location.href = "/struk/{{ $parkir->id }}";
        },
        onPending: function(result){
            alert("Menunggu pembayaran...");
        },
        onError: function(result){
            alert("Pembayaran gagal!");
        }
    });
};
</script>

</body>
</html>