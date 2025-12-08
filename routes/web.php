<?php


use Illuminate\Support\Facades\Route;
use App\Livewire\Features\User\Home;

Route::get('/', Home::class)->name('home');

// buat login register logout bang!
require __DIR__ . '/auth.php';

require __DIR__ . '/global.php';

// Buat admin bang!
require __DIR__ . '/admin.php';

// Buat user bang!
require __DIR__ . '/user.php';

// Midtrans
require __DIR__ . '/midtrans.php';

// Fix Storage Link
// Fix Storage Link & Update ENV
Route::get('/fix-storage', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');
    $output = "<h1>Storage & ENV Auto-Fixer</h1>";

    // 1. Check/Fix Symlink
    if (file_exists($link)) {
        $output .= "<p>✅ Symlink storage sudah ada.</p>";
    } else {
        try {
            symlink($target, $link);
            $output .= "<p>✅ Sukses membuat symlink storage!</p>";
        } catch (\Exception $e) {
            $output .= "<p>❌ Gagal membuat symlink: " . $e->getMessage() . "</p>";
        }
    }

    // 2. Fix APP_URL in .env
    $envPath = base_path('.env');
    $targetUrl = 'https://mamachu.tomorie.my.id';
    
    if (file_exists($envPath)) {
        $envContent = file_get_contents($envPath);
        
        if (preg_match('/^APP_URL=(.*)$/m', $envContent, $matches)) {
            $currentUrl = trim($matches[1]);
            $output .= "<p>Current APP_URL: <b>" . $currentUrl . "</b></p>";
            
            if ($currentUrl !== $targetUrl) {
                // Update .env file
                $newEnvContent = preg_replace('/^APP_URL=.*$/m', 'APP_URL=' . $targetUrl, $envContent);
                file_put_contents($envPath, $newEnvContent);
                $output .= "<p>✅ BERHASIL mengubah APP_URL menjadi: <b>" . $targetUrl . "</b></p>";
                
                // Clear Config Cache
                try {
                    \Illuminate\Support\Facades\Artisan::call('config:clear');
                    $output .= "<p>✅ Config cache dibersihkan.</p>";
                } catch (\Exception $e) {
                    $output .= "<p>⚠️ Gagal clear cache (tidak fatal): " . $e->getMessage() . "</p>";
                }
            } else {
                $output .= "<p>✅ APP_URL sudah benar (tidak perlu diubah).</p>";
            }
        } else {
            $output .= "<p>❌ APP_URL tidak ditemukan di file .env</p>";
        }
    } else {
        $output .= "<p>❌ File .env tidak ditemukan.</p>";
    }

    $output .= "<br><h3>Silakan refresh halaman website utama Anda sekarang!</h3>";
    $output .= "<a href='/'>Kembali ke Home</a>";
    
    return $output;
});


