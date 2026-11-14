import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Ambil pesan galat yang ramah dari respons fetch yang gagal.
// 401 dan 419 = sesi habis atau token CSRF kedaluwarsa.
window.pesanGagal = async (res, cadangan) => {
    if (res.status === 401 || res.status === 419) {
        return 'Sesi habis. Muat ulang halaman lalu login lagi.';
    }

    const data = await res.json().catch(() => ({}));

    return data.message ?? cadangan;
};

