<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Kode OTP</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', Arial, sans-serif; background: #f6f7f8; }
        .wrapper { max-width: 520px; margin: 40px auto; background: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,.08); }
        .header { background: linear-gradient(135deg, #1f3b61 0%, #2d5a9e 100%); padding: 36px 40px; text-align: center; }
        .header h1 { color: #ffffff; font-size: 22px; font-weight: 900; letter-spacing: -0.5px; }
        .header p  { color: rgba(255,255,255,.65); font-size: 13px; margin-top: 4px; }
        .body   { padding: 40px; }
        .greeting { font-size: 16px; color: #1e293b; font-weight: 600; margin-bottom: 12px; }
        .desc   { font-size: 14px; color: #64748b; line-height: 1.7; margin-bottom: 32px; }
        .otp-box { background: #f1f5f9; border: 2px dashed #cbd5e1; border-radius: 16px; padding: 24px; text-align: center; margin-bottom: 28px; }
        .otp-label { font-size: 11px; font-weight: 700; color: #94a3b8; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 10px; }
        .otp-code { font-size: 48px; font-weight: 900; letter-spacing: 14px; color: #1f3b61; font-family: 'Courier New', monospace; }
        .expire { background: #fff7ed; border: 1px solid #fed7aa; border-radius: 10px; padding: 12px 16px; font-size: 13px; color: #c2410c; text-align: center; margin-bottom: 28px; }
        .expire strong { color: #9a3412; }
        .divider { border: none; border-top: 1px solid #f1f5f9; margin: 24px 0; }
        .warning { font-size: 12px; color: #94a3b8; line-height: 1.6; }
        .footer { background: #f8fafc; padding: 24px 40px; text-align: center; border-top: 1px solid #f1f5f9; }
        .footer p { font-size: 12px; color: #94a3b8; line-height: 1.6; }
        .footer strong { color: #475569; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>{{ $namaSekolah }}</h1>
            <p>Reset Kata Sandi Akun Anda</p>
        </div>
        <div class="body">
            <p class="greeting">Halo,</p>
            <p class="desc">
                Kami menerima permintaan untuk mereset kata sandi akun Anda.
                Gunakan kode OTP berikut untuk melanjutkan proses reset kata sandi:
            </p>

            <div class="otp-box">
                <p class="otp-label">Kode OTP Anda</p>
                <p class="otp-code">{{ $otp }}</p>
            </div>

            <div class="expire">
                ⏱ Kode ini berlaku selama <strong>10 menit</strong> dan hanya dapat digunakan <strong>satu kali</strong>.
            </div>

            <hr class="divider"/>

            <p class="warning">
                Jika Anda tidak merasa meminta reset kata sandi, abaikan email ini.
                Kata sandi Anda tidak akan berubah. Jangan bagikan kode ini kepada siapapun,
                termasuk pihak yang mengaku dari sekolah.
            </p>
        </div>
        <div class="footer">
            <p>Email ini dikirim otomatis oleh sistem <strong>{{ $namaSekolah }}</strong>.<br/>Mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>
