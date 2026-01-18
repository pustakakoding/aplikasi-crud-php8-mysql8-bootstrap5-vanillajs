
/**
 * Validasi dan preview image sebelum upload
 * - Validasi tipe file (jpg, jpeg, png)
 * - Validasi ukuran file (max 1MB)
 * - Tampilkan preview image
 */

(function () {
    'use strict';

    // Konstanta konfigurasi
    const CONFIG = {
        maxFileSize: 1000000, // 1MB dalam bytes
        allowedExtensions: ['jpg', 'jpeg', 'png'],
        defaultImage: 'images/img-default.png'
    };

    const fileInput = document.getElementById('image');
    const previewImage = document.getElementById('preview-image');

    // Jika tidak ada file dipilih atau elemen preview tidak ditemukan
    if (!fileInput || !previewImage) {
        return;
    }

    /**
     * Validasi tipe file
     */
    function isValidFileType(fileName) {
        const extension = fileName.split('.').pop().toLowerCase();
        return CONFIG.allowedExtensions.includes(extension);
    }

    /**
     * Validasi ukuran file
     */
    function isValidFileSize(fileSize) {
        return fileSize <= CONFIG.maxFileSize;
    }

    /**
     * Format ukuran file ke format yang lebih readable
     */
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    /**
     * Reset input file dan preview
     */
    function resetFileInput() {
        fileInput.value = '';
        previewImage.src = CONFIG.defaultImage;
        previewImage.alt = 'Preview image';
    }

    /**
     * Tampilkan preview image
     */
    function showPreview(file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewImage.alt = file.name;
        };

        reader.onerror = function () {
            alert('Gagal membaca file. Silakan coba lagi.');
            resetFileInput();
        };

        reader.readAsDataURL(file);
    }

    /**
     * Handler untuk perubahan file input
     */
    function handleFileChange(event) {
        const file = event.target.files[0];

        // Cek apakah ada file yang dipilih
        if (!file) {
            resetFileInput();
            return;
        }

        // Validasi tipe file
        if (!isValidFileType(file.name)) {
            alert(
                'Tipe file tidak sesuai.\n\n' +
                'Format yang diperbolehkan: ' + CONFIG.allowedExtensions.join(', ').toUpperCase() + '\n' +
                'File Anda: ' + file.name.split('.').pop().toUpperCase()
            );
            resetFileInput();
            return;
        }

        // Validasi ukuran file
        if (!isValidFileSize(file.size)) {
            const maxSizeMB = CONFIG.maxFileSize / 1000000;
            alert(
                'Ukuran file terlalu besar.\n\n' +
                'Ukuran maksimal: ' + maxSizeMB + ' MB\n' +
                'Ukuran file Anda: ' + formatFileSize(file.size)
            );
            resetFileInput();
            return;
        }

        // Jika semua validasi lolos, tampilkan preview
        showPreview(file);
    }

    // Event listener untuk perubahan file
    fileInput.addEventListener('change', handleFileChange);

})();
