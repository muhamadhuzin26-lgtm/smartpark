<div class="full-center">

    <div class="ticket-card">

        <!-- BACK BUTTON -->
        <div class="back-wrapper">
            <a href="{{ route('masuk.form') }}" class="back-btn">
                ← Kembali
            </a>
        </div>

        <h3 class="ticket-title">Tiket Parkir</h3>

        <div class="qr-container">
            <div class="qr-wrapper">
                {!! QrCode::size(220)->generate($parkir->qr_code) !!}
            </div>
        </div>

        <p class="qr-text">{{ $parkir->qr_code }}</p>

    </div>
</div>

<style>

/* BACKGROUND */
.full-center {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;

    background: 
        linear-gradient(rgba(17,24,39,0.7), rgba(31,41,55,0.8)),
        url('/images/bg-city.png') no-repeat center center;

    background-size: cover;
}

/* CARD */
.ticket-card {
    width: 380px;
    padding: 35px;
    border-radius: 30px;
    background: #1f2937;
    text-align: center;
    color: #ffffff;

    font-family: 'Poppins', sans-serif;

    box-shadow:
        0 0 40px rgba(59,130,246,0.10),
        0 20px 50px rgba(0,0,0,0.6);

    position: relative;

    /* 🔥 TAMBAHAN */
    transition: all 0.3s ease;
}

/* HOVER CARD */
.ticket-card:hover {
    transform: translateY(-6px) scale(1.02);

    box-shadow:
        0 0 60px rgba(59,130,246,0.18),
        0 30px 70px rgba(0,0,0,0.7);
}

/* BACK BUTTON */
.back-wrapper {
    position: absolute;
    top: 15px;
    left: 20px;
}

.back-btn {
    font-size: 0.85rem;
    color: #9ca3af;
    text-decoration: none;

    /* 🔥 TAMBAHAN */
    transition: all 0.3s ease;
}

/* HOVER BUTTON */
.back-btn:hover {
    color: #ffffff;
    transform: translateX(-4px);
}
/* TITLE */
.ticket-title {
    font-size: 1.7rem;
    font-weight: 600;
    margin-bottom: 25px;
}

/* QR */
.qr-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.qr-wrapper {
    background: #ffffff;
    padding: 20px;
    border-radius: 20px;

    box-shadow: 0 10px 25px rgba(0,0,0,0.25);
}

/* TEXT */
.qr-text {
    font-size: 0.8rem;
    color: #9ca3af;
    letter-spacing: 2px;
}

</style>