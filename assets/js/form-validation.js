// Fungsi untuk validasi form dengan menonaktifkan pengiriman form jika ada field yang tidak valid
(() => {
    "use strict";

    // ambil semua form yang ingin diterapkan fungsi validasi
    const forms = document.querySelectorAll(".needs-validation");

    // berikan keterangan pada form dan cegah pengiriman form
    Array.from(forms).forEach((form) => {
        form.addEventListener(
            "submit",
            (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });
})();

/**
 * Validasi karakter input
 * @param {KeyboardEvent} e - Event keyboard
 * @param {string} allowedChars - Daftar karakter yang diizinkan
 * @returns {boolean}
 */
function allowChars(e, allowedChars) {
    // Dapatkan karakter yang ditekan
    const key = e.key;

    // Izinkan tombol kontrol
    if (
        e.ctrlKey ||
        e.metaKey ||
        ['Backspace', 'Tab', 'Escape', 'ArrowLeft', 'ArrowRight', 'Delete'].includes(key)
    ) {
        return true;
    }

    // Enter → pindah ke input berikutnya
    if (key === 'Enter') {
        e.preventDefault(); // Mencegah submit form
        const form = e.target.form;
        if (!form) return false;

        const elements = Array.from(form.elements).filter(el => !el.disabled);
        const index = elements.indexOf(e.target);
        const next = elements[index + 1] || elements[0];
        next.focus();
        return false;
    }

    // Validasi karakter
    if (!allowedChars.toLowerCase().includes(key.toLowerCase())) {
        e.preventDefault();
        return false;
    }

    return true;
}
