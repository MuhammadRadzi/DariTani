<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Kode Verifikasi DariTani</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f4f4; padding: 24px;">
    <table role="presentation" width="100%" style="max-width:480px; margin:0 auto; background:#ffffff; border-radius:8px; overflow:hidden;">
        <tr>
            <td style="background:#2e7d32; padding:20px; text-align:center;">
                <h1 style="color:#ffffff; margin:0; font-size:20px;">DariTani</h1>
            </td>
        </tr>
        <tr>
            <td style="padding:24px;">
                <p style="font-size:15px; color:#333;">Halo <strong>{{ $name }}</strong>,</p>
                <p style="font-size:15px; color:#333;">
                    Terima kasih sudah mendaftar di DariTani. Gunakan kode verifikasi berikut untuk mengaktifkan akun kamu:
                </p>
                <div style="text-align:center; margin:24px 0;">
                    <span style="display:inline-block; font-size:32px; letter-spacing:8px; font-weight:bold; color:#2e7d32; background:#e8f5e9; padding:12px 24px; border-radius:6px;">
                        {{ $code }}
                    </span>
                </div>
                <p style="font-size:14px; color:#666;">
                    Kode ini berlaku selama <strong>10 menit</strong>. Jangan bagikan kode ini ke siapa pun.
                </p>
                <p style="font-size:14px; color:#666;">
                    Kalau kamu tidak merasa mendaftar di DariTani, abaikan saja email ini.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
