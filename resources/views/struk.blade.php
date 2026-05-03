<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Struk Parkir</title>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #e2e8f0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* WRAPPER */
.wrapper {
    text-align: center;
}

/* CARD */
.card {
    background: white;
    padding: 40px;
    border-radius: 25px;
    width: 380px;

    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
}

/* TITLE */
.title {
    font-size: 22px;
    font-weight: bold;
    letter-spacing: 2px;
}

.subtitle {
    font-size: 13px;
    color: #64748b;
    margin-bottom: 15px;
}

/* LINE */
.line {
    border-top: 1px dashed #cbd5e1;
    margin: 15px 0;
}

/* ROW */
.row {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    margin: 6px 0;
}

/* TOTAL */
.total {
    font-size: 20px;
    font-weight: bold;
    color: #16a34a;
    margin-top: 10px;
}

/* QR */
.qr {
    margin-top: 15px;
}

/* FOOTER */
.footer {
    font-size: 12px;
    color: #64748b;
    margin-top: 10px;
}

/* BUTTON GROUP */
.btn-group {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    gap: 10px;
}

/* BUTTON */
.btn {
    padding: 10px 18px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 14px;
    transition: 0.3s;
}

/* NAV BUTTON */
.btn-nav {
    background: #e2e8f0;
    color: #1e293b;
}

.btn-nav:hover {
    background: #cbd5f5;
}

/* DOWNLOAD BUTTON */
.btn-download {
    display: inline-block;
    margin-top: 15px;
    padding: 12px 25px;
    border-radius: 12px;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    text-decoration: none;
    transition: 0.3s;
}

.btn-download:hover {
    transform: scale(1.05);
}
</style>

</head>
<body>

<div class="wrapper">

    <div class="card">

        <div class="title">SMARTPARK</div>
        <div class="subtitle">Parkir Otomatis Modern</div>

        <div class="line"></div>

        <div class="row">
            <span>ID Tiket</span>
            <span>#{{ $parkir->id }}</span>
        </div>

        <div class="row">
            <span>Jenis</span>
            <span>{{ $parkir->kendaraan->jenis_kendaraan }}</span>
        </div>

        <div class="row">
            <span>Masuk</span>
            <span>{{ $parkir->waktu_masuk }}</span>
        </div>

        <div class="row">
            <span>Keluar</span>
            <span>{{ $parkir->waktu_keluar }}</span>
        </div>

        <div class="row">
            <span>Durasi</span>
            <span>{{ $durasi }} Jam</span>
        </div>

        <div class="line"></div>

        <div class="row">
            <span>Tarif/Jam</span>
            <span>Rp {{ number_format($tarif->harga_per_jam) }}</span>
        </div>

        <div class="line"></div>

        <div class="total">
            TOTAL: Rp {{ number_format($biaya) }}
        </div>

        <div class="line"></div>

        <!-- QR -->
        <div class="qr">
            {!! QrCode::size(110)->generate($parkir->qr_code) !!}
        </div>

        <div class="footer">
            Terima kasih 🙏 <br>
            Simpan struk ini sebagai bukti
        </div>

        <!-- NAV BUTTON -->
        <div class="btn-group">
            <a href="/dashboard" class="btn btn-nav">🏠 Dashboard</a>
            <a href="/scan" class="btn btn-nav">📷 Scan Lagi</a>
        </div>

        <!-- 🔥 DOWNLOAD PINDAH KE SINI -->
        <a href="/download/{{ $parkir->id }}" class="btn-download">
            ⬇ Download PDF
        </a>

    </div>

</div>

</body>
</html>