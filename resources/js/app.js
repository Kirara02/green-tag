import "./bootstrap";
import Trix from "trix";

document.addEventListener("DOMContentLoaded", () => {
    // Cari elemen-elemen yang dibutuhkan
    const complaintDialog = document.getElementById("complaintDialog");
    const qrTokenInput = document.getElementById("qr_token_input");

    // Ambil parameter dari URL
    const urlParams = new URLSearchParams(window.location.search);
    const qrToken = urlParams.get("qr_token");

    // Jika parameter qr_token ada di URL
    if (qrToken) {
        // Isi nilai input tersembunyi
        if (qrTokenInput) {
            qrTokenInput.value = qrToken;
        }
    }
});
