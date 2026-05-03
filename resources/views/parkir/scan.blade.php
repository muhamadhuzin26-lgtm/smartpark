<div class="hero">
    <div class="overlay">

        <div class="scan-card">

            <!-- BACK BUTTON -->
            <div class="back-wrapper">
                <a href="{{ route('dashboard') }}" class="back-btn">
                    ← Kembali
                </a>
            </div>

            <h2 class="title">Scan QR Code</h2>
            <p class="subtitle">Kendaraan Keluar</p>

            <!-- ICON -->
            <div class="scan-icon">📱</div>

            <!-- QR SCANNER -->
            <div id="reader"></div>

            <!-- AUTO SUBMIT -->
            <form id="formKeluar" method="POST" action="/parkir/keluar">
                @csrf
                <input type="hidden" name="qr_code" id="qr_code">
            </form>

            <!-- INPUT MANUAL -->
            <form action="/parkir/keluar" method="POST" class="manual-form">
                @csrf
                <input type="text" name="qr_code" placeholder="Input QR manual">
                <button type="submit">Proses</button>
            </form>

        </div>

    </div>
</div>

<style>

/* RESET FULL SCREEN */
html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
}

/* HAPUS CONTAINER LARAVEL */
body > div {
    max-width: 100% !important;
    padding: 0 !important;
}

/* BACKGROUND */
.hero {
    width: 100vw;
    height: 100vh;
    background: radial-gradient(circle at top, #1e3a8a 0%, #0f172a 70%);
}

/* CENTER */
.overlay {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* CARD */
.scan-card {
    width: 560px;
    padding: 50px;
    border-radius: 30px;

    background: #1e293b;
    color: white;
    text-align: center;

    border: 1px solid rgba(255,255,255,0.06);

    box-shadow:
        0 15px 40px rgba(0,0,0,0.6),
        0 0 30px rgba(59,130,246,0.08);

    position: relative;
    transition: 0.3s;
}

/* HOVER CARD */
.scan-card:hover {
    transform: translateY(-5px);
}

/* BACK BUTTON */
.back-wrapper {
    position: absolute;
    top: 20px;
    left: 25px;
}

.back-btn {
    font-size: 0.9rem;
    color: #9ca3af;
    text-decoration: none;
    transition: 0.3s;
}

.back-btn:hover {
    color: #ffffff;
    transform: translateX(-4px);
}

/* TITLE */
.title {
    font-size: 2rem;
    font-weight: 700;
    color: #e5e7eb;
    margin-top: 10px;
}

/* SUBTITLE */
.subtitle {
    font-size: 0.9rem;
    color: #9ca3af;
    margin-bottom: 25px;
}

/* ICON */
.scan-icon {
    font-size: 28px;
    margin-bottom: 15px;
}

/* QR SCANNER */
#reader {
    width: 100% !important;
    border-radius: 18px;
    overflow: hidden;
    margin-bottom: 25px;
    border: 1px solid rgba(255,255,255,0.1);
}

/* FORM */
.manual-form {
    display: flex;
    gap: 10px;
}

/* INPUT */
.manual-form input {
    flex: 1;
    padding: 12px;
    border-radius: 12px;
    border: none;
    outline: none;

    background: #0f172a;
    color: white;
}

/* BUTTON */
.manual-form button {
    padding: 12px 18px;
    border-radius: 12px;
    border: none;

    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    cursor: pointer;

    transition: 0.3s;
}

/* HOVER BUTTON */
.manual-form button:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 25px rgba(37,99,235,0.5);
}

</style>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
function onScanSuccess(decodedText) {
    document.getElementById('qr_code').value = decodedText;
    document.getElementById('formKeluar').submit();
}

let html5QrcodeScanner = new Html5QrcodeScanner("reader", {
    fps: 10,
    qrbox: 250
});

html5QrcodeScanner.render(onScanSuccess);
</script>