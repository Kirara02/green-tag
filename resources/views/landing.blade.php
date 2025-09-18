<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenTag - Waste Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <style>
        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
            100% { transform: translateY(0); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800" x-data="{ openComplaint: false }">

    <!-- Navbar -->
    <nav class="bg-green-600 text-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-xl font-bold flex items-center gap-2">
                <img src="/logo.svg" alt="GreenTag logo" class="w-7 h-7"/>
                GreenTag
            </h1>
            <div class="space-x-6">
                <a href="#about" class="hover:text-gray-200">About</a>
                <a href="#schedule" class="hover:text-gray-200">Schedule</a>
                <a href="#educations" class="hover:text-gray-200">Educations</a>
                <a href="#contact" class="hover:text-gray-200">Contact</a>
                <a href="{{ route('login') }}" class="inline-flex items-center bg-white/90 text-green-700 p-2 rounded-full shadow hover:bg-white transition-colors" aria-label="Admin Login">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path d="M3.75 4.5A2.25 2.25 0 0 1 6 2.25h6A2.25 2.25 0 0 1 14.25 4.5v3a.75.75 0 0 1-1.5 0v-3a.75.75 0 0 0-.75-.75H6a.75.75 0 0 0-.75.75v15a.75.75 0 0 0 .75.75h6a.75.75 0 0 0 .75-.75v-3a.75.75 0 0 1 1.5 0v3A2.25 2.25 0 0 1 12 21.75H6A2.25 2.25 0 0 1 3.75 19.5v-15Z"/>
                        <path d="M21 12a.75.75 0 0 1-.22.53l-3 3a.75.75 0 1 1-1.06-1.06l1.72-1.72H10.5a.75.75 0 0 1 0-1.5h6.94l-1.72-1.72a.75.75 0 1 1 1.06-1.06l3 3c.14.14.22.33.22.53Z"/>
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-green-50 via-white to-green-100">
        <div class="max-w-7xl mx-auto px-4 py-20 grid md:grid-cols-2 gap-8 items-center">
            <div class="text-center md:text-left">
                <div class="inline-flex items-center gap-2 bg-white shadow-sm rounded-full px-4 py-1 text-sm text-green-700 border border-green-100">
                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                Greener city, smarter waste management
                </div>
                <h2 class="mt-6 text-4xl md:text-5xl font-extrabold tracking-tight text-green-800">
                    Manage Waste Smarter, Cleaner, Together
                </h2>
                <p class="mt-4 text-lg text-gray-600 md:max-w-xl">
                    Scan QR on bins, submit complaints instantly, and follow collection schedules in your area.
                </p>
                <div class="mt-8 flex items-center md:justify-start justify-center gap-4">
                    <button 
                        onclick="document.getElementById('complaintDialog').showModal()" 
                        class="bg-green-600 text-white px-6 py-3 rounded-xl font-semibold shadow hover:bg-green-700 transition">
                        Report Complaint
                    </button>
                    <a href="#features" class="px-6 py-3 rounded-xl font-semibold border border-green-200 text-green-700 hover:bg-white shadow-sm transition">
                        Learn More
                    </a>
                </div>
            </div>
            <div class="hidden md:block">
                <svg class="w-full max-w-lg mx-auto animate-float" viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="grad" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0%" stop-color="#34d399"/>
                            <stop offset="100%" stop-color="#10b981"/>
                        </linearGradient>
                    </defs>
                    <rect x="40" y="60" width="320" height="180" rx="16" fill="url(#grad)" opacity="0.15"/>
                    <rect x="70" y="90" width="260" height="140" rx="12" fill="#fff" stroke="#d1fae5"/>
                    <rect x="90" y="120" width="100" height="12" rx="6" fill="#34d399"/>
                    <rect x="90" y="140" width="180" height="10" rx="5" fill="#a7f3d0"/>
                    <rect x="90" y="160" width="160" height="10" rx="5" fill="#a7f3d0"/>
                    <circle cx="310" cy="120" r="14" fill="#10b981"/>
                    <path d="M306 120l6 6 10-12" stroke="#fff" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                    <g opacity="0.4">
                        <rect x="240" y="60" width="40" height="10" rx="5" fill="#34d399"/>
                        <rect x="120" y="230" width="60" height="10" rx="5" fill="#10b981"/>
                    </g>
                </svg>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="max-w-7xl mx-auto px-4 py-16">
        <h3 class="text-2xl font-bold text-center mb-2">Frequently Asked Questions</h3>
        <p class="text-center text-gray-600 mb-8">Pertanyaan umum seputar GreenTag</p>
        <div class="max-w-3xl mx-auto space-y-3" x-data="{ open: null }">
            <div class="bg-white border border-gray-200 rounded-xl">
                <button class="w-full text-left px-4 py-3 font-medium flex justify-between items-center" @click="open = open === 1 ? null : 1">
                    How do I submit a complaint?
                    <span x-text="open === 1 ? '-' : '+'"></span>
                </button>
                <div x-show="open === 1" x-collapse class="px-4 pb-4 text-gray-600">Use the Report Complaint button and fill out the form. If you scan a bin QR, the ID auto-fills.</div>
            </div>
            <div class="bg-white border border-gray-200 rounded-xl">
                <button class="w-full text-left px-4 py-3 font-medium flex justify-between items-center" @click="open = open === 2 ? null : 2">
                    Can I track my complaint?
                    <span x-text="open === 2 ? '-' : '+'"></span>
                </button>
                <div x-show="open === 2" x-collapse class="px-4 pb-4 text-gray-600">Tracking coming soon. For now, you’ll be contacted if more info is needed.</div>
            </div>
            <div class="bg-white border border-gray-200 rounded-xl">
                <button class="w-full text-left px-4 py-3 font-medium flex justify-between items-center" @click="open = open === 3 ? null : 3">
                    Who can access the dashboard?
                    <span x-text="open === 3 ? '-' : '+'"></span>
                </button>
                <div x-show="open === 3" x-collapse class="px-4 pb-4 text-gray-600">Only administrators with valid credentials.</div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="max-w-7xl mx-auto px-4 py-16">
        <h3 class="text-2xl font-bold text-center mb-2">Why GreenTag?</h3>
        <p class="text-center text-gray-600 mb-10">Simple tools for communities and administrators to keep cities clean.</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow rounded-xl p-6">
                <div class="w-10 h-10 rounded-lg bg-green-100 text-green-700 grid place-items-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M12 2.25a.75.75 0 0 1 .75.75v6.19l2.53 2.53a.75.75 0 1 1-1.06 1.06l-3-3A.75.75 0 0 1 11 9V3a.75.75 0 0 1 1-.75Z"/><path d="M3 12a9 9 0 1 0 18 0 9 9 0 0 0-18 0Z"/></svg>
                </div>
                <h4 class="font-semibold text-green-700">Quick Reports</h4>
                <p class="text-gray-600 mt-2">Submit issues in seconds via QR scan or from the homepage.</p>
            </div>
            <div class="bg-white shadow rounded-xl p-6">
                <div class="w-10 h-10 rounded-lg bg-green-100 text-green-700 grid place-items-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3.75 6A2.25 2.25 0 0 1 6 3.75h12A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6Zm3 2.25A.75.75 0 0 0 6 9v6a.75.75 0 0 0 1.5 0V9a.75.75 0 0 0-.75-.75Zm4.5 0A.75.75 0 0 0 10.5 9v6a.75.75 0 0 0 1.5 0V9a.75.75 0 0 0-.75-.75Zm4.5 0A.75.75 0 0 0 15 9v6a.75.75 0 0 0 1.5 0V9a.75.75 0 0 0-.75-.75Z"/></svg>
                </div>
                <h4 class="font-semibold text-green-700">Clear Schedules</h4>
                <p class="text-gray-600 mt-2">Know what and when collections happen across your neighborhood.</p>
            </div>
            <div class="bg-white shadow rounded-xl p-6">
                <div class="w-10 h-10 rounded-lg bg-green-100 text-green-700 grid place-items-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-.53 5.72a.75.75 0 0 1 1.06 0l4.5 4.5a.75.75 0 0 1-1.06 1.06L12.75 10.56V18a.75.75 0 0 1-1.5 0v-7.44L9.03 13.53a.75.75 0 1 1-1.06-1.06l4.5-4.5Z"/></svg>
                </div>
                <h4 class="font-semibold text-green-700">Faster Response</h4>
                <p class="text-gray-600 mt-2">Help teams act quickly with detailed, geolocated complaints.</p>
            </div>
        </div>
    </section>

    <!-- Stats Band -->
    <section class="bg-white border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div>
                <div class="text-3xl font-extrabold text-green-700">5K+</div>
                <div class="text-gray-500">Complaints processed</div>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-green-700">1.2K</div>
                <div class="text-gray-500">Smart bins deployed</div>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-green-700">25+</div>
                <div class="text-gray-500">Districts supported</div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="max-w-7xl mx-auto px-4 py-16">
        <h3 class="text-2xl font-bold text-center mb-6">About GreenTag QR Scan</h3>
        <p class="text-center text-gray-600 max-w-3xl mx-auto">
            GreenTag QR Scan is dedicated to revolutionizing waste disposal by integrating QR code technology with environmental sustainability. 
            Our platform offers interactive information to guide users in responsible recycling and waste management. 
            Join us in creating a cleaner, greener future by leveraging smart technology for everyday eco-friendly actions.
        </p>
    </section>

    <!-- Schedule Section -->
    <section id="schedule" class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h3 class="text-2xl font-bold text-center mb-6">Collection Schedule</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white shadow rounded-xl p-6 text-center">
                    <h4 class="font-bold text-lg text-green-700">Monday</h4>
                    <p class="text-gray-600 mt-2">Plastic Waste</p>
                </div>
                <div class="bg-white shadow rounded-xl p-6 text-center">
                    <h4 class="font-bold text-lg text-green-700">Wednesday</h4>
                    <p class="text-gray-600 mt-2">Organic Waste</p>
                </div>
                <div class="bg-white shadow rounded-xl p-6 text-center">
                    <h4 class="font-bold text-lg text-green-700">Friday</h4>
                    <p class="text-gray-600 mt-2">Mixed Waste</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section id="educations" class="max-w-7xl mx-auto px-4 py-16">
        <h3 class="text-2xl font-bold text-center mb-6">Educations</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow rounded-xl p-6">
                <h4 class="font-semibold text-green-700">Reduce Plastic Use</h4>
                <p class="text-gray-600 mt-2">Bring reusable bags and bottles to minimize waste.</p>
            </div>
            <div class="bg-white shadow rounded-xl p-6">
                <h4 class="font-semibold text-green-700">Composting</h4>
                <p class="text-gray-600 mt-2">Turn organic waste into compost to support greener living.</p>
            </div>
            <div class="bg-white shadow rounded-xl p-6">
                <h4 class="font-semibold text-green-700">Waste Sorting</h4>
                <p class="text-gray-600 mt-2">Separate recyclable, organic, and hazardous waste properly.</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h3 class="text-2xl font-bold mb-6">Contact Us</h3>
            <p class="text-gray-600">📍 Jl. Hijau Indah No. 123, Jakarta</p>
            <p class="text-gray-600">📧 info@greentag.com</p>
            <p class="text-gray-600">📞 +62 812-3456-7890</p>
        </div>
    </section>


    <!-- Dialog: Complaint -->
    <dialog id="complaintDialog" 
        class="backdrop:bg-black/50 rounded-xl p-0 max-w-lg w-[90vw] m-auto">
        <div class="bg-white rounded-xl p-6 w-full">
            <h3 class="text-xl font-bold text-center mb-4">Submit Complaint</h3>
            <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium">Your Name</label>
                    <input type="text" name="reporter_name" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <input type="hidden" name="qr_id" value="{{ request('qr_id') }}">
                <div>
                    <label class="block text-sm font-medium">Address</label>
                    <input type="text" name="address" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Category</label>
                    <select name="category" class="w-full border rounded-lg px-3 py-2">
                        <option value="garbage pile">Garbage Pile</option>
                        <option value="odor">Odor</option>
                        <option value="full TPS">Full TPS</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Description</label>
                    <textarea name="description" rows="4" class="w-full border rounded-lg px-3 py-2"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium">Photo (optional)</label>
                    <input type="file" name="photo" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('complaintDialog').close()" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700">Submit</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Footer -->
    <footer class="bg-green-700 text-white py-10 mt-12">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h4 class="font-bold text-lg">GreenTag</h4>
                <p class="text-sm text-green-100 mt-2">Smart waste management platform for cleaner cities.</p>
            </div>
            <div>
                <h5 class="font-semibold">Quick Links</h5>
                <ul class="mt-2 space-y-2 text-green-100">
                    <li><a href="#features" class="hover:text-white">Features</a></li>
                    <li><a href="#schedule" class="hover:text-white">Schedule</a></li>
                    <li><a href="#educations" class="hover:text-white">Educations</a></li>
                    <li><a href="#faq" class="hover:text-white">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-semibold">Contact</h5>
                <ul class="mt-2 space-y-1 text-green-100">
                    <li>📍 Jl. Hijau Indah No. 123, Jakarta</li>
                    <li>📧 info@greentag.com</li>
                    <li>📞 +62 812-3456-7890</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-green-600 mt-8 pt-4 text-center text-green-100">&copy; {{ date('Y') }} GreenTag. All rights reserved.</div>
    </footer>

</body>

</html>
