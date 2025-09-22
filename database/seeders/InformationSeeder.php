<?php

namespace Database\Seeders;

use App\Models\Information;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Cari user Admin untuk dijadikan sebagai penulis (author)
        // Pastikan seeder untuk admin sudah dijalankan sebelumnya.
        $author = User::where('email', 'admin@example.com')->first();

        // Jika admin tidak ditemukan, hentikan seeder untuk menghindari error.
        if (!$author) {
            $this->command->error('Admin user not found. Please seed the admin user first.');
            return;
        }

        // 2. Siapkan 3 data artikel contoh
        $articles = [
            [
                'title' => 'Cara Mudah Memilah Sampah dari Rumah',
                'content' =>
                    '<p>Memilah sampah adalah langkah pertama dan terpenting dalam pengelolaan limbah yang bertanggung jawab. Dengan memisahkan sampah organik, anorganik, dan B3 (Bahan Berbahaya dan Beracun), kita membantu proses daur ulang menjadi lebih efisien.</p><p><strong>Sampah Organik:</strong> Sisa makanan, daun kering, dan potongan sayur. Sampah ini bisa diolah menjadi kompos.<br><strong>Sampah Anorganik:</strong> Botol plastik, kaleng, kertas, dan kaca. Sampah ini dapat didaur ulang menjadi produk baru.<br><strong>Sampah B3:</strong> Baterai bekas, lampu neon, dan botol pembersih. Sampah ini harus ditangani secara khusus karena berbahaya bagi lingkungan.</p>',
                'category' => 'education',
                'status' => 'published',
            ],
            [
                'title' => 'Program Bank Sampah Baru Diluncurkan di Kecamatan Melati',
                'content' =>
                    '<p>Pemerintah kota hari ini secara resmi meluncurkan program "Bank Sampah Melati Bersinar" di Kecamatan Melati. Program ini bertujuan untuk mendorong partisipasi warga dalam memilah sampah sekaligus memberikan nilai ekonomis bagi sampah yang dapat didaur ulang.</p><p>Warga dapat menukarkan sampah anorganik yang telah dipilah, seperti botol plastik dan kertas, dengan saldo yang akan dicatat di buku tabungan. "Kami berharap program ini tidak hanya mengurangi volume sampah yang masuk ke TPA, tetapi juga meningkatkan kesadaran dan kesejahteraan masyarakat," ujar Kepala Dinas Lingkungan Hidup.</p>',
                'category' => 'news',
                'status' => 'published',
            ],
            // [
            //     'title' => 'Tutorial Membuat Kompos dari Sampah Dapur',
            //     'content' => '<div>Membuat kompos adalah cara terbaik untuk mengurangi limbah organik sekaligus menyuburkan tanaman Anda. Ikuti langkah-langkah sederhana dalam video ini untuk memulai komposter Anda sendiri di rumah.</div>',
            //     'image' => 'information-images/compost-placeholder.jpg', // Contoh path gambar
            //     'video_url' => 'https://www.youtube.com/watch?v=co5BWe_i_E0', // Contoh link video valid
            //     'category' => 'education',
            //     'status' => 'published',
            // ],
            // [
            //     'title' => 'Pentingnya Mengurangi Penggunaan Plastik Sekali Pakai',
            //     'content' => '<div>Plastik sekali pakai seperti sedotan, kantong kresek, dan botol minum menjadi ancaman serius bagi lingkungan kita. Limbah plastik ini sulit terurai dan seringkali berakhir di lautan, membahayakan kehidupan laut. Dengan membawa tas belanja, botol minum, dan sedotan sendiri, kita bisa membuat perbedaan besar.</div>',
            //     'image' => 'information-images/plastic-waste-placeholder.jpg',
            //     'video_url' => null,
            //     'category' => 'education',
            //     'status' => 'published',
            // ],
            [
                'title' => 'Perubahan Jadwal Pengambilan Sampah Selama Libur Nasional',
                'content' =>
                    '<p>Diberitahukan kepada seluruh warga bahwa akan terjadi perubahan jadwal pengambilan sampah selama periode libur nasional mendatang.</p><p>Pengambilan sampah yang seharusnya dilakukan pada hari Jumat akan dimajukan ke hari Kamis. Mohon untuk meletakkan sampah di depan rumah sebelum pukul 07:00 pagi pada hari tersebut. Jadwal akan kembali normal pada minggu berikutnya. Terima kasih atas perhatiannya.</p>',
                'category' => 'announcement',
                'status' => 'draft', // Kita buat satu sebagai draft untuk testing
            ],
        ];

        // 3. Masukkan data ke dalam database
        foreach ($articles as $articleData) {
            // Gunakan updateOrCreate untuk menghindari duplikasi jika seeder dijalankan lagi
            Information::updateOrCreate(
                ['title' => $articleData['title']], // Kunci unik untuk dicari
                [
                    'content' => $articleData['content'],
                    'category' => $articleData['category'],
                    'status' => $articleData['status'],
                    'author_id' => $author->id,
                    'slug' => Str::slug($articleData['title']),
                    'image' => null, // Kita biarkan kosong untuk contoh ini
                ],
            );
        }
    }
}
