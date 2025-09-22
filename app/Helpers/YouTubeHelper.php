<?php

if (!function_exists('getYoutubeEmbedUrl')) {
    /**
     * Mengubah URL YouTube standar menjadi URL yang bisa disematkan di iframe.
     *
     * @param string|null $url
     * @return string|null
     */
    function getYoutubeEmbedUrl($url): ?string
    {
        if (empty($url)) {
            return null;
        }

        // Mencocokkan berbagai format URL YouTube/youtu.be dan mengambil ID video
        preg_match('/(youtube\.com|youtu\.be)\/(watch\?v=|embed\/|v\/|)(.{11})/', $url, $matches);

        if (isset($matches[3]) && strlen($matches[3]) == 11) {
            return 'https://www.youtube.com/embed/' . $matches[3] . '?autoplay=0&rel=0';
        }

        return null; // Kembalikan null jika URL tidak valid atau bukan YouTube
    }
}
