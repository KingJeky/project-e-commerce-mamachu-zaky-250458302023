<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Produk - Mamachu</title>

    <!-- Google Fonts: Poppins (Agar font mirip dengan referensi) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Konfigurasi Tema Warna Mamachu -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        mamachu: {
                            bg: '#FFF5F5',       // Pink lembut background
                            primary: '#FF6B6B',  // Merah coral tombol
                            primaryHover: '#FF5252',
                            dark: '#2D2D2D',     // Warna teks gelap
                            yellow: '#FDCB58'    // Warna aksen kuning
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom scrollbar agar lebih rapi */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #FF6B6B;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #FF5252;
        }

        /* Animasi fade in untuk produk */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-mamachu-bg font-sans text-mamachu-dark antialiased">

    <!-- HEADER / NAVBAR -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-2 text-2xl font-bold text-mamachu-primary">
                <i class="fa-solid fa-bottle-droplet"></i>
                MAMACHU
            </a>

            <!-- Menu Desktop -->
            <div class="hidden md:flex gap-8 font-medium text-gray-600">
                <a href="#" class="hover:text-mamachu-primary transition">Beranda</a>
                <a href="#" class="text-mamachu-primary font-bold">Kategori</a>
                <a href="#" class="hover:text-mamachu-primary transition">Brand</a>
                <a href="#" class="hover:text-mamachu-primary transition">Unggulan</a>
            </div>

            <!-- Icons & Button -->
            <div class="flex items-center gap-4">
                <div class="relative cursor-pointer hover:text-mamachu-primary transition">
                    <i class="fa-solid fa-cart-shopping text-xl"></i>
                    <span class="absolute -top-2 -right-2 bg-mamachu-primary text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">3</span>
                </div>
                <button class="bg-mamachu-primary hover:bg-mamachu-primaryHover text-white px-6 py-2 rounded-full font-semibold shadow-lg shadow-red-200 transition transform hover:-translate-y-0.5">
                    Masuk
                </button>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="container mx-auto px-4 py-8">

        <!-- Header Page Title -->
        <div class="text-center mb-10">
            <span class="bg-mamachu-yellow text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider text-yellow-900 mb-2 inline-block">Cari Kesegaranmu</span>
            <h1 class="text-3xl md:text-4xl font-bold text-mamachu-dark">Eksplorasi Minuman Favorit</h1>
            <p class="text-gray-500 mt-2">Gunakan filter di bawah untuk menemukan minuman yang pas buat kamu.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">

            <!-- SIDEBAR FILTER (Kiri) -->
            <aside class="w-full lg:w-1/4">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-24">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-lg"><i class="fa-solid fa-filter mr-2 text-mamachu-primary"></i> Filter</h3>
                        <button onclick="resetFilters()" class="text-xs text-gray-400 hover:text-mamachu-primary underline">Reset Semua</button>
                    </div>

                    <!-- Filter Harga -->
                    <div class="mb-6 border-b border-gray-100 pb-6">
                        <label class="block text-sm font-semibold mb-3">Maksimal Harga</label>
                        <input type="range" id="priceRange" min="0" max="100000" step="5000" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-mamachu-primary">
                        <div class="flex justify-between text-sm mt-2 font-medium text-gray-600">
                            <span>Rp 0</span>
                            <span id="priceValue" class="text-mamachu-primary">Rp 100.000</span>
                        </div>
                    </div>

                    <!-- Filter Kategori -->
                    <div class="mb-6 border-b border-gray-100 pb-6">
                        <h4 class="text-sm font-semibold mb-3">Kategori</h4>
                        <div class="space-y-2" id="categoryFilterContainer">
                            <!-- Checkbox akan digenerate via JS -->
                        </div>
                    </div>

                    <!-- Filter Brand -->
                    <div class="mb-2">
                        <h4 class="text-sm font-semibold mb-3">Brand</h4>
                        <div class="space-y-2 max-h-40 overflow-y-auto pr-2" id="brandFilterContainer">
                             <!-- Checkbox akan digenerate via JS -->
                        </div>
                    </div>
                </div>
            </aside>

            <!-- PRODUCT GRID AREA (Kanan) -->
            <main class="w-full lg:w-3/4">

                <!-- Search Bar Besar -->
                <div class="relative mb-8">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-gray-400 text-lg"></i>
                    </div>
                    <input type="text" id="searchInput"
                        class="block w-full pl-12 pr-4 py-4 rounded-2xl border-none shadow-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-mamachu-primary focus:shadow-lg transition text-lg"
                        placeholder="Cari nama minuman, rasa, atau brand...">
                </div>

                <!-- Info Hasil Pencarian -->
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600">Menampilkan <span id="resultCount" class="font-bold text-mamachu-dark">0</span> produk</p>

                    <select id="sortSelect" class="bg-white border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-mamachu-primary focus:border-mamachu-primary block p-2.5 outline-none">
                        <option value="default">Urutkan: Relevansi</option>
                        <option value="low">Harga: Terendah</option>
                        <option value="high">Harga: Tertinggi</option>
                        <option value="az">Nama: A-Z</option>
                    </select>
                </div>

                <!-- Grid Produk -->
                <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Produk card akan muncul disini via JS -->
                </div>

                <!-- Tampilan Jika Kosong -->
                <div id="emptyState" class="hidden text-center py-20">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-red-50 mb-4">
                        <i class="fa-solid fa-mug-hot text-3xl text-mamachu-primary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Yah, Produk tidak ditemukan!</h3>
                    <p class="text-gray-500 mt-2">Coba ganti kata kunci atau atur ulang filter kamu.</p>
                </div>

            </main>
        </div>
    </div>

    <!-- FOOTER SIMPLE -->
    <footer class="bg-white border-t border-red-100 mt-12 py-8">
        <div class="container mx-auto px-4 text-center">
            <div class="flex items-center justify-center gap-2 text-2xl font-bold text-mamachu-primary mb-4">
                <i class="fa-solid fa-bottle-droplet"></i> MAMACHU
            </div>
            <p class="text-gray-500 text-sm">© 2024 Mamachu E-Commerce. Segar setiap saat.</p>
        </div>
    </footer>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        // --- 1. MOCK DATABASE (DATA DUMMY) ---
        const productsData = [
            { id: 1, name: "Fresh Cola Classic", category: "Soda", brand: "ColaCo", price: 15000, rating: 4.8, image: "https://images.unsplash.com/photo-1622483767028-3f66f32aef97?auto=format&fit=crop&q=80&w=300&h=300" },
            { id: 2, name: "Orange Squeeze", category: "Jus", brand: "FruityLife", price: 25000, rating: 4.5, image: "https://images.unsplash.com/photo-1600271886742-f049cd451bba?auto=format&fit=crop&q=80&w=300&h=300" },
            { id: 3, name: "Matcha Latte Cold", category: "Kopi & Teh", brand: "ZenTea", price: 35000, rating: 4.9, image: "https://images.unsplash.com/photo-1515823064-d6e0c04616a7?auto=format&fit=crop&q=80&w=300&h=300" },
            { id: 4, name: "Lemon Sparkling", category: "Soda", brand: "FruityLife", price: 18000, rating: 4.3, image: "https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?auto=format&fit=crop&q=80&w=300&h=300" },
            { id: 5, name: "Mineral Water 1L", category: "Air Mineral", brand: "AquaPure", price: 8000, rating: 4.7, image: "https://images.unsplash.com/photo-1560023907-5f339617ea30?auto=format&fit=crop&q=80&w=300&h=300" },
            { id: 6, name: "Iced Americano", category: "Kopi & Teh", brand: "BeanBrew", price: 22000, rating: 4.6, image: "https://images.unsplash.com/photo-1517701604599-bb29b5c7fa5b?auto=format&fit=crop&q=80&w=300&h=300" },
            { id: 7, name: "Strawberry Yogurt", category: "Susu & Yogurt", brand: "MilkyWay", price: 30000, rating: 4.9, image: "https://images.unsplash.com/photo-1563805042-7684c019e1cb?auto=format&fit=crop&q=80&w=300&h=300" },
            { id: 8, name: "Energy Drink X", category: "Soda", brand: "PowerUp", price: 12000, rating: 4.2, image: "https://images.unsplash.com/photo-1626897505254-e0f811aa9bf7?auto=format&fit=crop&q=80&w=300&h=300" },
            { id: 9, name: "Avocado Juice", category: "Jus", brand: "FruityLife", price: 28000, rating: 4.8, image: "https://images.unsplash.com/photo-1603569283847-aa295f0d016a?auto=format&fit=crop&q=80&w=300&h=300" },
            { id: 10, name: "Oat Milk Barista", category: "Susu & Yogurt", brand: "MilkyWay", price: 45000, rating: 4.7, image: "https://images.unsplash.com/photo-1601389814457-3f338d7c4a16?auto=format&fit=crop&q=80&w=300&h=300" },
            { id: 11, name: "Green Tea Botol", category: "Kopi & Teh", brand: "ZenTea", price: 10000, rating: 4.4, image: "https://images.unsplash.com/photo-1627435601361-ec25f5b1d0e5?auto=format&fit=crop&q=80&w=300&h=300" },
        ];

        // --- 2. STATE MANAGEMENT ---
        let filters = {
            search: "",
            categories: [],
            brands: [],
            maxPrice: 100000,
            sortBy: "default"
        };

        // --- 3. DOM ELEMENTS ---
        const productGrid = document.getElementById('productGrid');
        const emptyState = document.getElementById('emptyState');
        const searchInput = document.getElementById('searchInput');
        const priceRange = document.getElementById('priceRange');
        const priceValue = document.getElementById('priceValue');
        const categoryContainer = document.getElementById('categoryFilterContainer');
        const brandContainer = document.getElementById('brandFilterContainer');
        const resultCount = document.getElementById('resultCount');
        const sortSelect = document.getElementById('sortSelect');

        // --- 4. UTILITY FUNCTIONS ---
        const formatRupiah = (number) => {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
        }

        // --- 5. INITIALIZATION: GENERATE FILTERS ---
        function initFilters() {
            // Get Unique Categories and Brands
            const categories = [...new Set(productsData.map(p => p.category))];
            const brands = [...new Set(productsData.map(p => p.brand))];

            // Render Category Checkboxes
            categories.forEach(cat => {
                const div = document.createElement('div');
                div.className = "flex items-center";
                div.innerHTML = `
                    <input id="cat-${cat}" type="checkbox" value="${cat}" class="w-4 h-4 text-mamachu-primary bg-gray-100 border-gray-300 rounded focus:ring-mamachu-primary focus:ring-2 category-checkbox">
                    <label for="cat-${cat}" class="ml-2 text-sm text-gray-700 cursor-pointer hover:text-mamachu-primary">${cat}</label>
                `;
                categoryContainer.appendChild(div);
            });

            // Render Brand Checkboxes
            brands.forEach(brand => {
                const div = document.createElement('div');
                div.className = "flex items-center";
                div.innerHTML = `
                    <input id="brand-${brand}" type="checkbox" value="${brand}" class="w-4 h-4 text-mamachu-primary bg-gray-100 border-gray-300 rounded focus:ring-mamachu-primary focus:ring-2 brand-checkbox">
                    <label for="brand-${brand}" class="ml-2 text-sm text-gray-700 cursor-pointer hover:text-mamachu-primary">${brand}</label>
                `;
                brandContainer.appendChild(div);
            });

            // Set Max Price in Slider
            const maxPriceInDb = Math.max(...productsData.map(p => p.price));
            priceRange.max = maxPriceInDb + 5000;
            priceRange.value = maxPriceInDb + 5000;
            updatePriceLabel(priceRange.value);
            filters.maxPrice = priceRange.value;
        }

        function updatePriceLabel(val) {
            priceValue.textContent = formatRupiah(val);
        }

        // --- 6. CORE LOGIC: FILTER & RENDER ---
        function applyFilters() {
            let result = productsData.filter(product => {
                // 1. Search Filter (Case insensitive)
                const matchSearch = product.name.toLowerCase().includes(filters.search.toLowerCase());

                // 2. Category Filter (If none selected, show all)
                const matchCategory = filters.categories.length === 0 || filters.categories.includes(product.category);

                // 3. Brand Filter
                const matchBrand = filters.brands.length === 0 || filters.brands.includes(product.brand);

                // 4. Price Filter
                const matchPrice = product.price <= filters.maxPrice;

                return matchSearch && matchCategory && matchBrand && matchPrice;
            });

            // 5. Sorting
            if (filters.sortBy === 'low') {
                result.sort((a, b) => a.price - b.price);
            } else if (filters.sortBy === 'high') {
                result.sort((a, b) => b.price - a.price);
            } else if (filters.sortBy === 'az') {
                result.sort((a, b) => a.name.localeCompare(b.name));
            }

            renderProducts(result);
        }

        function renderProducts(products) {
            productGrid.innerHTML = '';
            resultCount.textContent = products.length;

            if (products.length === 0) {
                productGrid.classList.add('hidden');
                emptyState.classList.remove('hidden');
            } else {
                productGrid.classList.remove('hidden');
                emptyState.classList.add('hidden');

                products.forEach(product => {
                    const card = document.createElement('div');
                    card.className = "bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 overflow-hidden group fade-in flex flex-col";

                    card.innerHTML = `
                        <div class="relative overflow-hidden h-48 bg-gray-100">
                            <img src="${product.image}" alt="${product.name}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-xs font-bold px-2 py-1 rounded-lg text-gray-600">
                                ${product.category}
                            </span>
                        </div>
                        <div class="p-5 flex flex-col flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs text-mamachu-primary font-bold uppercase tracking-wide">${product.brand}</span>
                                <div class="flex items-center text-yellow-400 text-xs">
                                    <i class="fa-solid fa-star mr-1"></i> ${product.rating}
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight group-hover:text-mamachu-primary transition">${product.name}</h3>
                            <div class="mt-auto pt-4 flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900">${formatRupiah(product.price)}</span>
                                <button class="w-10 h-10 rounded-full bg-red-50 text-mamachu-primary flex items-center justify-center hover:bg-mamachu-primary hover:text-white transition">
                                    <i class="fa-solid fa-cart-plus"></i>
                                </button>
                            </div>
                        </div>
                    `;
                    productGrid.appendChild(card);
                });
            }
        }

        function resetFilters() {
            filters.search = "";
            filters.categories = [];
            filters.brands = [];
            filters.sortBy = "default";

            // Reset UI
            searchInput.value = "";
            document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
            priceRange.value = priceRange.max; // Reset slider to max
            filters.maxPrice = priceRange.max;
            updatePriceLabel(filters.maxPrice);
            sortSelect.value = "default";

            applyFilters();
        }

        // --- 7. EVENT LISTENERS ---

        // Search Listener (Live)
        searchInput.addEventListener('input', (e) => {
            filters.search = e.target.value;
            applyFilters();
        });

        // Price Listener
        priceRange.addEventListener('input', (e) => {
            filters.maxPrice = parseInt(e.target.value);
            updatePriceLabel(filters.maxPrice);
            applyFilters();
        });

        // Checkbox Listeners (Delegation)
        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('category-checkbox')) {
                const value = e.target.value;
                if (e.target.checked) {
                    filters.categories.push(value);
                } else {
                    filters.categories = filters.categories.filter(c => c !== value);
                }
                applyFilters();
            }

            if (e.target.classList.contains('brand-checkbox')) {
                const value = e.target.value;
                if (e.target.checked) {
                    filters.brands.push(value);
                } else {
                    filters.brands = filters.brands.filter(b => b !== value);
                }
                applyFilters();
            }
        });

        // Sort Listener
        sortSelect.addEventListener('change', (e) => {
            filters.sortBy = e.target.value;
            applyFilters();
        });

        // --- 8. RUN ON LOAD ---
        initFilters();
        applyFilters();

    </script>
</body>
</html>
