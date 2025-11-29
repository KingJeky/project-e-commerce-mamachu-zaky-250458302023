# 🥤 Mamachu - E-Commerce Minuman

> **Segarkan Harimu!** Platform e-commerce minuman modern dengan integrasi pembayaran Midtrans.

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-3.6-4E56A6?style=for-the-badge&logo=livewire&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind-3.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)

## 📋 Daftar Isi

- [Tentang Project](#-tentang-project)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Prerequisites](#-prerequisites)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Database Setup](#-database-setup)
- [Running the Application](#-running-the-application)
- [Payment Integration](#-payment-integration)
- [Project Structure](#-project-structure)
- [Screenshots](#-screenshots)
- [Contributing](#-contributing)
- [License](#-license)

## 🎯 Tentang Project

**Mamachu** adalah platform e-commerce yang dikembangkan menggunakan Laravel 12 dan Livewire 3, dikhususkan untuk penjualan berbagai jenis minuman. Project ini dilengkapi dengan sistem pembayaran terintegrasi menggunakan Midtrans, manajemen produk, keranjang belanja, dan fitur pemesanan yang lengkap.

### Kenapa Mamachu?

- 🚀 **Modern Stack**: Dibangun dengan Laravel 12, Livewire 3, dan TailwindCSS
- 💳 **Payment Gateway**: Terintegrasi dengan Midtrans untuk pembayaran yang aman
- 📱 **Responsive Design**: Mobile-first design yang cantik dan user-friendly
- ⚡ **Real-time**: Menggunakan Livewire untuk interaksi real-time tanpa reload
- 🎨 **Beautiful UI**: Desain modern dengan animasi smooth dan warna yang eye-catching

## ✨ Features

### For Customers (User)
- 🏠 **Homepage** dengan produk featured dan promosi
- 🔍 **Browse Products** berdasarkan kategori dan brand
- 🛒 **Shopping Cart** dengan update real-time
- 📦 **Order Management** dengan tracking status  
- 💰 **Multiple Payment Methods**:
  - Transfer Bank dengan upload bukti pembayaran
  - Midtrans (DANA, GoPay, Credit Card, VA, QRIS, dll)
- 📍 **Address Management** untuk pengiriman
- 👤 **User Profile** management
- ✅ **Auto Payment Status Update** setelah pembayaran Midtrans berhasil

### For Admin
- 📊 **Dashboard** dengan statistics
- 🏷️ **Product Management** (CRUD)
- 📂 **Category Management**
- 🏢 **Brand Management**
- 👥 **User Management** dengan role-based access
- 📋 **Order Management** dengan update status
- 🖼️ **Image Upload** untuk produk dengan multiple images

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 12.0
- **PHP**: 8.2+
- **Database**: SQLite (default) / MySQL
- **ORM**: Eloquent

### Frontend
- **UI Framework**: Livewire 3.6
- **CSS**: TailwindCSS 3.0
- **Icons**: Font Awesome 6.4
- **Animations**: CSS Animations & Transitions
- **Forms**: SweetAlert2 untuk notifications

### Third-party Services
- **Payment Gateway**: Midtrans (Sandbox & Production)
- **Image Storage**: Laravel File Storage (Public disk)

## 📦 Prerequisites

Pastikan sistem Anda sudah memiliki:

- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.x
- **NPM** >= 9.x
- **SQLite** atau **MySQL** (optional)
- **Git**

## 🚀 Installation

### 1. Clone Repository

```bash
git clone https://github.com/yourusername/mamachu.git
cd mamachu
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup

```bash
# Create SQLite database (if using SQLite)
touch database/database.sqlite

# Run migrations
php artisan migrate

# (Optional) Seed database with sample data
php artisan db:seed
```

### 5. Storage Link

```bash
# Create symbolic link for file uploads
php artisan storage:link
```

### 6. Build Assets

```bash
# For development
npm run dev

# For production
npm run build
```

## ⚙️ Configuration

### Database Configuration

Edit file `.env` untuk database configuration:

**SQLite (Default)**:
```env
DB_CONNECTION=sqlite
# DB_DATABASE akan auto-detect database/database.sqlite
```

**MySQL** (Alternative):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mamachu
DB_USERNAME=root
DB_PASSWORD=
```

### Midtrans Configuration

1. **Daftar di Midtrans**: 
   - Sandbox: https://dashboard.sandbox.midtrans.com/
   - Production: https://dashboard.midtrans.com/

2. **Dapatkan API Keys** dari dashboard Midtrans

3. **Update `.env` file**:

```env
# Midtrans Configuration
MIDTRANS_MERCHANT_ID=your_merchant_id
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_IS_PRODUCTION=false  # Set true for production
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

4. **Clear config cache**:
```bash
php artisan config:clear
php artisan cache:clear
```

## 🗄️ Database Setup

### Migrations

Project ini sudah include migrations untuk:
- Users (with roles)
- Categories
- Brands
- Products
- Addresses
- Carts & Cart Items
- Orders & Order Items

Run migrations:
```bash
php artisan migrate
```

### Seeders (Optional)

Jika ingin populate database dengan sample data:

```bash
php artisan db:seed
```

## 🏃 Running the Application

### Development Mode

**Option 1: Using Laravel Artisan**
```bash
# Terminal 1 - Run Laravel server
php artisan serve

# Terminal 2 - Run Vite dev server
npm run dev

# Terminal 3 - Run queue worker (for background jobs)
php artisan queue:work
```

**Option 2: Using Composer Script**
```bash
# Run all development servers concurrently
composer run dev
```

Application akan berjalan di: `http://localhost:8000`

### Production Mode

```bash
# Build assets
npm run build

# Optimize Laravel
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run with production server (e.g. Apache/Nginx)
```

## 💳 Payment Integration

### Midtrans Payment Flow

1. **User memilih produk** dan checkout
2. **User pilih Midtrans** sebagai payment method
3. **System generate Snap Token** dari Midtrans
4. **Midtrans payment popup** terbuka
5. **User menyelesaikan pembayaran** (DANA/GoPay/CC/etc)
6. **Status otomatis update** ke "Dibayar" setelah payment success
7. **Order masuk ke processing**

### Webhook Configuration

Untuk production, setup webhook URL di Midtrans Dashboard:

**Notification URL**: `https://yourdomain.com/midtrans/callback`

Webhook akan otomatis update payment status ketika:
- Payment berhasil (settlement/capture)
- Payment pending
- Payment gagal/expire

### Testing Payment (Sandbox)

Gunakan test credentials dari [Midtrans Sandbox Documentation](https://docs.midtrans.com/en/technical-reference/sandbox-test):

**Test Credit Card**:
- Card Number: `4811 1111 1111 1114`
- CVV: `123`
- Exp: `01/25`

**Test E-Wallet**:
- Pilih DANA/GoPay
- Akan muncul simulator payment
- Klik "Success" untuk simulate successful payment

## 📁 Project Structure

```
mamachu/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── MidtransController.php    # Midtrans webhook & callbacks
│   │   └── Middleware/
│   │       └── CheckRole.php             # Role-based middleware
│   ├── Livewire/
│   │   └── Features/
│   │       ├── Admin/                    # Admin components
│   │       │   ├── Dashboard.php
│   │       │   ├── Products/
│   │       │   ├── Categories/
│   │       │   ├── Brands/
│   │       │   ├── Users/
│   │       │   └── Orders/
│   │       └── User/                     # User components
│   │           ├── Main.php              # User main page
│   │           ├── CartPage.php          # Shopping cart
│   │           ├── OrderPage.php         # Checkout
│   │           ├── MyOrders.php          # Order history
│   │           ├── MidtransPayment.php   # Midtrans payment
│   │           └── Addresses.php         # Address management
│   └── Models/
│       ├── User.php
│       ├── Product.php
│       ├── Category.php
│       ├── Brand.php
│       ├── Order.php
│       ├── OrderItem.php
│       ├── Cart.php
│       └── Address.php
├── config/
│   └── midtrans.php                      # Midtrans config
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   └── storage/                          # Symlinked to storage/app/public
├── resources/
│   └── views/
│       ├── components/
│       │   └── layouts/                  # Main layouts
│       └── livewire/                     # Livewire views
├── routes/
│   └── web.php                           # All routes defined here
└── storage/
    └── app/
        └── public/                       # User uploads (images)
```

## 📸 Screenshots

> **Note**: Add your screenshots here

### User Interface
- Homepage
- Product Listing
- Shopping Cart
- Checkout Page
- My Orders
- Midtrans Payment

### Admin Panel
- Dashboard
- Product Management
- Order Management
- User Management

## 👥 Default Users

Setelah seeding, Anda bisa login dengan:

**Admin**:
- Email: `admin@mamachu.com`
- Password: `password`

**User**:
- Email: `user@mamachu.com`
- Password: `password`

> ⚠️ **Important**: Ganti password default di production!

## 🧪 Testing

Run tests dengan Pest:

```bash
# Run all tests
php artisan test

# Or using composer
composer test

# Run specific test file
php artisan test tests/Feature/ProductTest.php
```

## 🐛 Troubleshooting

### Issue: Midtrans Error 401

**Solution**: 
1. Pastikan API Keys di `.env` sudah benar
2. Hubungi Midtrans Support jika akun belum activated
3. Clear config: `php artisan config:clear`

### Issue: Payment Status Tidak Auto-Update

**Solution**:
1. Clear all caches: `php artisan optimize:clear`
2. Hard refresh browser (Ctrl+Shift+R)
3. Check logs: `storage/logs/laravel.log`

### Issue: Images Tidak Muncul

**Solution**:
1. Run: `php artisan storage:link`
2. Pastikan folder `storage/app/public` exists
3. Check file permissions

## 🤝 Contributing

Contributions are welcome! Silakan:

1. Fork repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author

- **Your Name** - [GitHub](https://github.com/yourusername)

## 🙏 Acknowledgments

- Laravel Team untuk framework yang luar biasa
- Livewire Team untuk reactive components
- Midtrans untuk payment gateway integration
- TailwindCSS untuk utility-first CSS framework
- Font Awesome untuk beautiful icons

---

<div align="center">
  <p>Made with ❤️ and 🥤 by Mamachu Team</p>
  <p>© 2024 Mamachu Inc. All rights reserved.</p>
</div>
