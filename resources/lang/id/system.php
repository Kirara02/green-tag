<?php

return [
    // === SIDEBAR NAVIGATION ===
    'nav_dashboard' => 'Dasbor',

    // Grup
    'nav_group_operational' => 'Operasional',
    'nav_group_master_data' => 'Master Data',
    'nav_group_system' => 'Sistem',

    // Item Menu
    'nav_complaints' => 'Pengaduan',
    'nav_schedules' => 'Jadwal',
    'nav_educations' => 'Edukasi',
    'nav_locations' => 'Lokasi',
    'nav_bins' => 'Tempat Sampah',
    'nav_users' => 'Pengguna',

    // === DASHBOARD ADMIN ===
    'admin_dashboard_title' => 'Dasbor Admin',
    'admin_dashboard_welcome' => 'Selamat datang, :name! Berikut adalah gambaran umum sistem.',

    // Statistik
    'stat_total_officers' => 'Total Petugas',
    'stat_total_bins' => 'Total Tempat Sampah',
    'stat_new_complaints' => 'Pengaduan Baru',
    'stat_resolved_complaints' => 'Pengaduan Selesai',

    // Grafik
    'chart_complaint_trend' => 'Tren Pengaduan (7 Hari Terakhir)',
    'chart_complaint_count' => 'Jumlah Pengaduan',
    'chart_category_composition' => 'Komposisi Kategori',
    'chart_amount' => 'Jumlah',

    // Daftar Aktivitas
    'table_recent_complaint_activity' => 'Aktivitas Pengaduan Terbaru',
    'table_no_complaint_activity' => 'Tidak ada aktivitas pengaduan.',
    'table_view_details' => 'Lihat Detail',

    // Status Lencana (Badge Statuses)
    'status_new' => 'Baru',
    'status_in_progress' => 'Diproses',
    'status_resolved' => 'Selesai',
    'status_rejected' => 'Ditolak',

    // Kategori Pengaduan (Complaint Categories - untuk grafik)
    // Kunci harus cocok dengan nilai di database
    'category_garbage_pile' => 'Tumpukan Sampah',
    'category_odor' => 'Bau Tidak Sedap',
    'category_full_bin' => 'Tempat Sampah Penuh',
    'category_broken_bin' => 'Tempat Sampah Rusak',
    'category_other' => 'Lainnya',

    'officer_dashboard_title' => 'Dasbor Petugas',
    'officer_dashboard_welcome' =>
        'Selamat datang kembali, :name! Berikut adalah ringkasan tugas Anda.',

    // Statistik
    'stat_new_complaints_total' => 'Pengaduan Baru (Total)',
    'stat_my_in_progress' => 'Tugas Saya (Diproses)',
    'stat_today_schedules' => 'Jadwal Hari Ini',

    // Grafik
    'chart_active_tasks' => 'Komposisi Tugas Aktif',
    'chart_your_performance' => 'Laporan Kinerja Anda (7 Hari Terakhir)',
    'chart_resolved_complaints_per_day' => 'Jumlah pengaduan yang diselesaikan per hari.',
    'chart_resolved_complaints_label' => 'Pengaduan Selesai',
    'chart_label_new_unassigned' => 'Baru (Belum Ditugaskan)',
    'chart_label_my_tasks' => 'Tugas Saya (Diproses)',

    // Daftar Tugas
    'table_attention_needed' => 'Pengaduan yang Membutuhkan Perhatian',
    'table_no_active_complaints' => 'Tidak ada pengaduan aktif. Kerja bagus!',
    'table_today_schedules' => 'Jadwal Pengambilan Hari Ini',
    'table_no_schedules_today' => 'Tidak ada jadwal untuk hari ini.',
    'table_view_button' => 'Lihat',

    // === USER MANAGEMENT ===
    'users_title' => 'Manajemen Pengguna',
    'users_subtitle' => 'Tambah, edit, atau hapus akun admin dan petugas.',
    'users_add_new' => 'Tambah Pengguna Baru',
    'users_not_found' => 'Tidak ada pengguna yang ditemukan.',

    // Tabel
    'users_table_name' => 'Nama',
    'users_table_email' => 'Email',
    'users_table_role' => 'Role',
    'users_table_created_at' => 'Tanggal Dibuat',
    'users_table_actions' => 'Aksi',

    // Peran
    'role_admin' => 'Admin',
    'role_officer' => 'Petugas',

    // Aksi
    'action_edit' => 'Edit',
    'action_delete' => 'Hapus',
    'action_delete_confirm' => 'Apakah Anda yakin ingin menghapus pengguna ini?',

    // === USER MANAGEMENT FORMS ===
    'users_create_title' => 'Tambah Pengguna Baru',
    'users_create_subtitle' => 'Buat akun baru untuk admin atau petugas.',

    'users_edit_title' => 'Edit Pengguna',
    'users_edit_subtitle' => 'Edit Pengguna: :name',

    // Form Labels
    'form_full_name' => 'Nama Lengkap',
    'form_email_address' => 'Alamat Email',
    'form_role' => 'Role',
    'form_password' => 'Password',
    'form_confirm_password' => 'Konfirmasi Password',

    // Password Section on Edit Page
    'form_change_password' => 'Ubah Password',
    'form_change_password_help' => 'Biarkan kosong jika tidak ingin mengubah password.',
    'form_new_password' => 'Password Baru',
    'form_confirm_new_password' => 'Konfirmasi Password Baru',

    // Role Options
    'role_option_officer' => 'Petugas (Officer)',
    'role_option_admin' => 'Admin',

    // Buttons
    'btn_save_user' => 'Simpan Pengguna',
    'btn_update_user' => 'Perbarui Pengguna',
    'btn_cancel' => 'Batal',

    // Breadcrumbs
    'breadcrumb_dashboard' => 'Dasbor',
    'breadcrumb_system' => 'Sistem',
    'breadcrumb_user_management' => 'Manajemen Pengguna',
    'breadcrumb_add_user' => 'Tambah Pengguna Baru',
    'breadcrumb_edit_user' => 'Edit Pengguna',

    // === EDUCATION (INFORMATIONS) MANAGEMENT ===
    'educations_title' => 'Manajemen Edukasi',
    'educations_subtitle' => 'Buat dan kelola artikel edukasi, berita, atau pengumuman.',
    'educations_add_new' => 'Tambah Artikel',
    'educations_not_found' => 'Belum ada artikel.',
    'educations_delete_confirm' => 'Hapus artikel ini?',

    // Tabel
    'educations_table_image' => 'Gambar',
    'educations_table_title' => 'Judul',
    'educations_table_category' => 'Kategori',
    'educations_table_status' => 'Status',
    'educations_table_author' => 'Penulis',
    'educations_table_actions' => 'Aksi',

    // Forms
    'educations_create_title' => 'Tambah Artikel Baru',
    'educations_edit_title' => 'Edit Artikel',
    'form_article_title' => 'Judul Artikel',
    'form_content' => 'Konten',
    'form_metadata' => 'Metadata',
    'form_main_image' => 'Gambar Utama',
    'form_main_image_help' => 'Biarkan kosong untuk mempertahankan gambar saat ini.',
    'form_status_published' => 'Published',
    'form_status_draft' => 'Draft',
    'btn_save_article' => 'Simpan Artikel',
    'btn_update_article' => 'Perbarui Artikel',

    // Breadcrumbs
    'breadcrumb_operational' => 'Operasional',
    'breadcrumb_education_management' => 'Manajemen Edukasi',
    'breadcrumb_add_article' => 'Tambah Artikel Baru',
    'breadcrumb_edit_article' => 'Edit Artikel',

    // === COMPLAINTS MANAGEMENT ===
    'complaints_title' => 'Manajemen Pengaduan',
    'complaints_subtitle' => 'Tinjau dan kelola semua pengaduan yang masuk dari warga.',
    'complaints_not_found' => 'Tidak ada pengaduan yang ditemukan.',
    'complaints_details_title' => 'Detail Pengaduan',
    'complaints_details_subtitle' => 'Tinjau dan perbarui status pengaduan.',
    'complaints_reporter_info' => 'Informasi Pelapor',
    'complaints_reporter_name' => 'Nama Pelapor',
    'complaints_reporter_phone' => 'Telepon Pelapor',
    'complaints_reporter_address' => 'Detail Alamat Pelapor',
    'complaints_reporter_not_provided' => 'Tidak diberikan',
    'complaints_attached_photo' => 'Foto Terlampir',
    'complaints_photo_enlarge' => 'Klik gambar untuk memperbesar',
    'complaints_bin_code' => 'Kode Tempat Sampah',
    'form_actions' => 'Aksi',
    'form_actions_subtitle' => 'Perbarui status dan tambahkan catatan penyelesaian.',
    'form_set_status' => 'Atur Status',
    'form_resolution_notes' => 'Catatan Penyelesaian',
    'form_resolution_notes_placeholder' => 'Tambahkan catatan jika status Selesai atau Ditolak...',
    'btn_update_complaint' => 'Perbarui Pengaduan',
    'btn_back_to_list' => 'Kembali ke daftar',

    // Breadcrumbs
    'breadcrumb_complaint_management' => 'Manajemen Pengaduan',
    'breadcrumb_complaint_details' => 'Detail Pengaduan',

    // === SCHEDULE MANAGEMENT ===
    'schedules_title' => 'Manajemen Jadwal',
    'schedules_subtitle' => 'Buat dan kelola rute pengambilan sampah.',
    'schedules_add_new' => 'Tambah Jadwal Baru',
    'schedules_not_found' => 'Tidak ada jadwal yang ditemukan.',
    'schedules_delete_confirm' => 'Apakah Anda yakin ingin menghapus jadwal ini?',

    // Tabel
    'schedules_table_route_name' => 'Nama Rute',
    'schedules_table_day' => 'Hari',
    'schedules_table_time' => 'Waktu',
    'schedules_table_linked_locations' => 'Lokasi Terhubung',
    'schedules_table_location_count' => ':count Lokasi',

    // Forms
    'schedules_create_title' => 'Tambah Jadwal Baru',
    'schedules_edit_title' => 'Edit Jadwal',
    'schedules_edit_subtitle' => 'Edit Jadwal: :name',
    'form_route_details' => 'Detail Rute',
    'form_start_time' => 'Waktu Mulai',
    'form_end_time' => 'Waktu Selesai',
    'form_assign_locations' => 'Tetapkan Lokasi',
    'form_assign_locations_help' => 'Pilih semua lokasi yang termasuk dalam rute ini.',
    'form_search_location_placeholder' => 'Cari nama atau kode...',
    'form_selected_locations' => 'Lokasi Terpilih',
    'form_select_all' => 'Pilih Semua',
    'form_no_locations_found' => 'Tidak ada lokasi. Buat lokasi terlebih dahulu.',
    'btn_save_schedule' => 'Simpan Jadwal',
    'btn_update_schedule' => 'Perbarui Jadwal',

    // Breadcrumbs
    'breadcrumb_schedule_management' => 'Manajemen Jadwal',
    'breadcrumb_add_schedule' => 'Tambah Jadwal Baru',
    'breadcrumb_edit_schedule' => 'Edit Jadwal',

    // === LOCATION MANAGEMENT ===
    'locations_title' => 'Manajemen Lokasi',
    'locations_subtitle' => 'Kelola semua lokasi fisik tempat tong sampah ditempatkan.',
    'locations_add_new' => 'Tambah Lokasi Baru',
    'locations_not_found' => 'Tidak ada lokasi yang ditemukan.',
    'locations_delete_confirm' => 'Apakah Anda yakin ingin menghapus lokasi ini?',

    // Tabel
    'locations_table_code' => 'Kode Lokasi',
    'locations_table_name' => 'Nama Lokasi',
    'locations_table_address' => 'Alamat',

    // Forms
    'locations_create_title' => 'Tambah Lokasi Baru',
    'locations_edit_title' => 'Edit Lokasi',
    'form_location_code' => 'Kode Lokasi (Unik)',
    'form_location_name' => 'Nama Lokasi',
    'form_full_address' => 'Alamat Lengkap',
    'placeholder_location_code' => 'cth: LOC-SAKURA01',
    'placeholder_location_name' => 'cth: Taman Sakura Blok A',
    'placeholder_full_address' => 'Masukkan alamat lengkap lokasi...',
    'btn_save_location' => 'Simpan Lokasi',
    'btn_update_location' => 'Perbarui Lokasi',

    // Breadcrumbs
    'breadcrumb_location_management' => 'Manajemen Lokasi',
    'breadcrumb_add_location' => 'Tambah Lokasi Baru',
    'breadcrumb_edit_location' => 'Edit Lokasi',

    // === BIN MANAGEMENT ===
    'bins_title' => 'Manajemen Tempat Sampah',
    'bins_subtitle' => 'Kelola semua aset tempat sampah yang terdaftar di sistem.',
    'bins_add_new' => 'Tambah Baru',
    'bins_not_found' => 'Tidak ada tempat sampah yang ditemukan.',
    'bins_delete_confirm' => 'Apakah Anda yakin ingin menghapus item ini?',
    'bins_show_qr' => 'Tampil QR',

    // Tabel
    'bins_table_asset_code' => 'Kode Aset',
    'bins_table_qr_token' => 'QR Token',
    'bins_table_accepted_waste' => 'Jenis Sampah Diterima',

    // Forms
    'bins_create_title' => 'Tambah Tempat Sampah Baru',
    'bins_edit_title' => 'Edit Tempat Sampah',
    'form_select_location' => '-- Pilih Lokasi --',
    'form_description_optional' => 'Deskripsi (Opsional)',
    'form_accepted_waste_types' => 'Jenis Sampah Diterima',
    'form_accepted_waste_types_help' => 'Pisahkan dengan koma.',
    'placeholder_asset_code' => 'cth: BIN-PLASTIK-001',
    'placeholder_description' => 'cth: Khusus Botol Plastik',
    'placeholder_accepted_waste' => 'cth: Organik, Anorganik, B3',
    'form_qr_token_help' => 'Token ini dibuat otomatis dan tidak dapat diubah.',
    'btn_save_bin' => 'Simpan',
    'btn_update_bin' => 'Perbarui',

    // Breadcrumbs
    'breadcrumb_bin_management' => 'Manajemen Tempat Sampah',
    'breadcrumb_add_bin' => 'Tambah Tempat Sampah',
    'breadcrumb_edit_bin' => 'Edit Tempat Sampah',

    // QR Code Page
    'qr_code_page_title' => 'Kode QR untuk: :code',
    'qr_code_scan_to_report' => 'Pindai untuk Melapor',
    'qr_code_bin_code' => 'Kode Tempat Sampah',
    'qr_code_location' => 'Lokasi',
    'btn_print' => 'Cetak',
];
