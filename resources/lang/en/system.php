<?php

return [
    // === SIDEBAR NAVIGATION ===
    'nav_dashboard' => 'Dashboard',

    // Grup
    'nav_group_operational' => 'Operational',
    'nav_group_master_data' => 'Master Data',
    'nav_group_system' => 'System',

    // Item Menu
    'nav_complaints' => 'Complaints',
    'nav_schedules' => 'Schedules',
    'nav_educations' => 'Educations',
    'nav_locations' => 'Locations',
    'nav_bins' => 'Bins',
    'nav_users' => 'Users',

    // === DASHBOARD ADMIN ===
    'admin_dashboard_title' => 'Admin Dashboard',
    'admin_dashboard_welcome' => 'Welcome, :name! Here is an overview of the system.',

    // Statistik
    'stat_total_officers' => 'Total Officers',
    'stat_total_bins' => 'Total Bins',
    'stat_new_complaints' => 'New Complaints',
    'stat_resolved_complaints' => 'Resolved Complaints',

    // Grafik
    'chart_complaint_trend' => 'Complaint Trend (Last 7 Days)',
    'chart_complaint_count' => 'Number of Complaints',
    'chart_category_composition' => 'Category Composition',
    'chart_amount' => 'Amount',

    // Daftar Aktivitas
    'table_recent_complaint_activity' => 'Recent Complaint Activity',
    'table_no_complaint_activity' => 'No complaint activity.',
    'table_view_details' => 'View Details',

    // Status Lencana (Badge Statuses)
    'status_new' => 'New',
    'status_in_progress' => 'In Progress',
    'status_resolved' => 'Resolved',
    'status_rejected' => 'Rejected',

    // Kategori Pengaduan (Complaint Categories - untuk grafik)
    // Kunci harus cocok dengan nilai di database
    'category_garbage_pile' => 'Garbage Pile',
    'category_odor' => 'Odor',
    'category_full_bin' => 'Full Bin',
    'category_broken_bin' => 'Broken Bin',
    'category_other' => 'Other',

    // === DASHBOARD OFFICER ===
    'officer_dashboard_title' => 'Officer Dashboard',
    'officer_dashboard_welcome' => 'Welcome back, :name! Here is a summary of your tasks.',

    // Statistik
    'stat_new_complaints_total' => 'New Complaints (Total)',
    'stat_my_in_progress' => 'My Tasks (In Progress)',
    'stat_today_schedules' => "Today's Schedules",

    // Grafik
    'chart_active_tasks' => 'Active Tasks Composition',
    'chart_your_performance' => 'Your Performance (Last 7 Days)',
    'chart_resolved_complaints_per_day' => 'Resolved complaints per day.',
    'chart_resolved_complaints_label' => 'Resolved Complaints',
    'chart_label_new_unassigned' => 'New (Unassigned)',
    'chart_label_my_tasks' => 'My Tasks (In Progress)',

    // Daftar Tugas
    'table_attention_needed' => 'Complaints Needing Attention',
    'table_no_active_complaints' => 'No active complaints. Great job!',
    'table_today_schedules' => 'Today\'s Pickup Schedules',
    'table_no_schedules_today' => 'No schedules for today.',
    'table_view_button' => 'View',

    // === USER MANAGEMENT ===
    'users_title' => 'User Management',
    'users_subtitle' => 'Add, edit, or delete admin and officer accounts.',
    'users_add_new' => 'Add New User',
    'users_not_found' => 'No users found.',

    // Tabel
    'users_table_name' => 'Name',
    'users_table_email' => 'Email',
    'users_table_role' => 'Role',
    'users_table_created_at' => 'Created At',
    'users_table_actions' => 'Actions',

    // Peran
    'role_admin' => 'Admin',
    'role_officer' => 'Officer',

    // Aksi
    'action_edit' => 'Edit',
    'action_delete' => 'Delete',
    'action_delete_confirm' => 'Are you sure you want to delete this user?',

    // === USER MANAGEMENT FORMS ===
    'users_create_title' => 'Add New User',
    'users_create_subtitle' => 'Create a new account for an admin or officer.',

    'users_edit_title' => 'Edit User',
    'users_edit_subtitle' => 'Edit User: :name',

    // Form Labels
    'form_full_name' => 'Full Name',
    'form_email_address' => 'Email Address',
    'form_role' => 'Role',
    'form_password' => 'Password',
    'form_confirm_password' => 'Confirm Password',

    // Password Section on Edit Page
    'form_change_password' => 'Change Password',
    'form_change_password_help' => 'Leave blank if you do not want to change the password.',
    'form_new_password' => 'New Password',
    'form_confirm_new_password' => 'Confirm New Password',

    // Role Options
    'role_option_officer' => 'Officer',
    'role_option_admin' => 'Admin',

    // Buttons
    'btn_save_user' => 'Save User',
    'btn_update_user' => 'Update User',
    'btn_cancel' => 'Cancel',

    // Breadcrumbs
    'breadcrumb_dashboard' => 'Dashboard',
    'breadcrumb_system' => 'System',
    'breadcrumb_user_management' => 'User Management',
    'breadcrumb_add_user' => 'Add New User',
    'breadcrumb_edit_user' => 'Edit User',

    // === EDUCATION (INFORMATIONS) MANAGEMENT ===
    'educations_title' => 'Education Management',
    'educations_subtitle' => 'Create and manage educational articles, news, or announcements.',
    'educations_add_new' => 'Add New Article',
    'educations_not_found' => 'No articles found.',
    'educations_delete_confirm' => 'Delete this article?',

    // Tabel
    'educations_table_image' => 'Image',
    'educations_table_title' => 'Title',
    'educations_table_category' => 'Category',
    'educations_table_status' => 'Status',
    'educations_table_author' => 'Author',
    'educations_table_video' => 'Video',
    'educations_table_actions' => 'Actions',

    // Forms
    'educations_create_title' => 'Add New Article',
    'educations_edit_title' => 'Edit Article',
    'form_article_title' => 'Article Title',
    'form_content' => 'Content',
    'form_metadata' => 'Metadata',
    'form_main_image' => 'Main Image',
    'form_image_label' => 'Image File',
    'form_image_label_optional' => 'Image File (Optional)',
    'form_main_image_help' => 'Leave blank to keep the current image.',
    'form_supporting_video' => 'Supporting Video',
    'form_video_url' => 'Video URL (Optional)',
    'form_video_url_help' => 'Paste a link from YouTube or another platform.',
    'form_status_published' => 'Published',
    'form_status_draft' => 'Draft',
    'btn_save_article' => 'Save Article',
    'btn_update_article' => 'Update Article',

    // Breadcrumbs
    'breadcrumb_operational' => 'Operational',
    'breadcrumb_education_management' => 'Education Management',
    'breadcrumb_add_article' => 'Add New Article',
    'breadcrumb_edit_article' => 'Edit Article',

    // === COMPLAINTS MANAGEMENT ===
    'complaints_title' => 'Complaints Management',
    'complaints_subtitle' => 'Review and manage all incoming complaints from citizens.',
    'complaints_not_found' => 'No complaints found.',
    'complaints_details_title' => 'Complaint Details',
    'complaints_details_subtitle' => 'Review and update the complaint status.',
    'complaints_reporter_info' => 'Reporter Information',
    'complaints_reporter_name' => 'Reporter Name',
    'complaints_reporter_phone' => 'Reporter Phone',
    'complaints_reporter_address' => "Reporter's Address Detail",
    'complaints_reporter_not_provided' => 'Not provided',
    'complaints_attached_photo' => 'Attached Photo',
    'complaints_photo_enlarge' => 'Click image to enlarge',
    'complaints_bin_code' => 'Bin Code',
    'form_actions' => 'Actions',
    'form_actions_subtitle' => 'Update status and add resolution notes.',
    'form_set_status' => 'Set Status',
    'form_resolution_notes' => 'Resolution Notes',
    'form_resolution_notes_placeholder' => 'Add notes if status is Resolved or Rejected...',
    'btn_update_complaint' => 'Update Complaint',
    'btn_back_to_list' => 'Back to list',

    // Breadcrumbs
    'breadcrumb_complaint_management' => 'Complaints Management',
    'breadcrumb_complaint_details' => 'Complaint Details',

    // === SCHEDULE MANAGEMENT ===
    'schedules_title' => 'Schedule Management',
    'schedules_subtitle' => 'Create and manage waste collection routes.',
    'schedules_add_new' => 'Add New Schedule',
    'schedules_not_found' => 'No schedules found.',
    'schedules_delete_confirm' => 'Are you sure you want to delete this schedule?',

    // Tabel
    'schedules_table_route_name' => 'Route Name',
    'schedules_table_day' => 'Day',
    'schedules_table_time' => 'Time',
    'schedules_table_linked_locations' => 'Linked Locations',
    'schedules_table_location_count' => ':count Locations',

    // Forms
    'schedules_create_title' => 'Add New Schedule',
    'schedules_edit_title' => 'Edit Schedule',
    'schedules_edit_subtitle' => 'Edit Schedule: :name',
    'form_route_details' => 'Route Details',
    'form_start_time' => 'Start Time',
    'form_end_time' => 'End Time',
    'form_assign_locations' => 'Assign Locations',
    'form_assign_locations_help' => 'Select all locations that are part of this route.',
    'form_search_location_placeholder' => 'Search name or code...',
    'form_selected_locations' => 'Selected Locations',
    'form_select_all' => 'Select All',
    'form_no_locations_found' => 'No locations found. Please create a location first.',
    'btn_save_schedule' => 'Save Schedule',
    'btn_update_schedule' => 'Update Schedule',

    // Breadcrumbs
    'breadcrumb_schedule_management' => 'Schedule Management',
    'breadcrumb_add_schedule' => 'Add New Schedule',
    'breadcrumb_edit_schedule' => 'Edit Schedule',

    // === LOCATION MANAGEMENT ===
    'locations_title' => 'Location Management',
    'locations_subtitle' => 'Manage all physical locations where bins are placed.',
    'locations_add_new' => 'Add New Location',
    'locations_not_found' => 'No locations found.',
    'locations_delete_confirm' => 'Are you sure you want to delete this location?',

    // Tabel
    'locations_table_code' => 'Location Code',
    'locations_table_name' => 'Location Name',
    'locations_table_address' => 'Address',

    // Forms
    'locations_create_title' => 'Add New Location',
    'locations_edit_title' => 'Edit Location',
    'form_location_code' => 'Location Code (Unique)',
    'form_location_name' => 'Location Name',
    'form_full_address' => 'Full Address',
    'placeholder_location_code' => 'e.g., LOC-SAKURA01',
    'placeholder_location_name' => 'e.g., Sakura Park Block A',
    'placeholder_full_address' => 'Enter the full location address...',
    'btn_save_location' => 'Save Location',
    'btn_update_location' => 'Update Location',

    // Breadcrumbs
    'breadcrumb_location_management' => 'Location Management',
    'breadcrumb_add_location' => 'Add New Location',
    'breadcrumb_edit_location' => 'Edit Location',

    // === BIN MANAGEMENT ===
    'bins_title' => 'Bin Management',
    'bins_subtitle' => 'Manage all registered bin assets in the system.',
    'bins_add_new' => 'Add New Bin',
    'bins_not_found' => 'No bins found.',
    'bins_delete_confirm' => 'Are you sure you want to delete this bin?',
    'bins_show_qr' => 'Show QR',

    // Tabel
    'bins_table_asset_code' => 'Asset Code',
    'bins_table_qr_token' => 'QR Token',
    'bins_table_accepted_waste' => 'Accepted Waste Types',

    // Forms
    'bins_create_title' => 'Add New Bin',
    'bins_edit_title' => 'Edit Bin',
    'form_select_location' => '-- Select a Location --',
    'form_description_optional' => 'Description (Optional)',
    'form_accepted_waste_types' => 'Accepted Waste Types',
    'form_accepted_waste_types_help' => 'Separate with a comma.',
    'placeholder_asset_code' => 'e.g., BIN-PLASTIC-001',
    'placeholder_description' => 'e.g., For Plastic Bottles',
    'placeholder_accepted_waste' => 'e.g., Organic, Inorganic, B3',
    'form_qr_token_help' => 'This token is auto-generated and cannot be changed.',
    'btn_save_bin' => 'Save Bin',
    'btn_update_bin' => 'Update Bin',

    // Breadcrumbs
    'breadcrumb_bin_management' => 'Bin Management',
    'breadcrumb_add_bin' => 'Add New Bin',
    'breadcrumb_edit_bin' => 'Edit Bin',

    // QR Code Page
    'qr_code_page_title' => 'QR Code for Bin: :code',
    'qr_code_scan_to_report' => 'Scan to Report',
    'qr_code_bin_code' => 'Bin Code',
    'qr_code_location' => 'Location',
    'btn_print' => 'Print',
];
