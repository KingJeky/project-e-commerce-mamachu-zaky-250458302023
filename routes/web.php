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
// Fix Storage Link & Advanced Debug
Route::get('/fix-storage', function () {
    $results = [];
    $results['app_url'] = env('APP_URL');
    $results['document_root'] = $_SERVER['DOCUMENT_ROOT'];
    
    // 1. Check Static Asset (Profile Image)
    $staticPath = public_path('mazer/assets/compiled/jpg/1.jpg');
    $staticExists = file_exists($staticPath);
    $staticUrl = asset('mazer/assets/compiled/jpg/1.jpg');
    
    // 2. Check Storage Uploads
    $storagePath = storage_path('app/public');
    $publicStorage = public_path('storage');
    $symlinkExists = is_link($publicStorage);
    
    // List some files in storage to see if uploads are there
    $storageFiles = [];
    if (is_dir($storagePath)) {
        $storageFiles = array_diff(scandir($storagePath), ['.', '..']);
        $storageFiles = array_slice($storageFiles, 0, 10); // Take first 10
    }

    $output = "<html><body style='font-family:sans-serif; padding:20px;'>";
    $output .= "<h1>🕵️ Deep Storage Debugger 2.0</h1>";
    
    $output .= "<h3>1. Environment & Config</h3>";
    $output .= "<ul>";
    $output .= "<li><b>APP_URL:</b> " . $results['app_url'] . "</li>";
    $output .= "<li><b>Document Root:</b> " . $results['document_root'] . "</li>";
    $output .= "<li><b>Public Path:</b> " . public_path() . "</li>";
    $output .= "</ul>";

    $output .= "<h3>2. Static Mazer Asset Debug (Sidebar Profile)</h3>";
    $output .= "<ul>";
    $output .= "<li><b>Looking for file at:</b> " . $staticPath . "</li>";
    $output .= "<li><b>File Exists on Disk?</b> " . ($staticExists ? "✅ YES" : "❌ NO (File Missing!)") . "</li>";
    $output .= "<li><b>Generated Asset URL:</b> <a href='$staticUrl'>$staticUrl</a></li>";
    $output .= "</ul>";
    
    if ($staticExists) {
        $output .= "<p>Test Render Static: <br><img src='$staticUrl' style='width:50px; border:2px solid green'></p>";
    } else {
        $output .= "<p class='error'>⚠️ NOTE: Jika file ini 'NO', berarti deploy GitHub Anda belum mengirim folder 'public/mazer' ke server.</p>";
    }

    $output .= "<h3>3. Storage Debug</h3>";
    $output .= "<ul>";
    $output .= "<li><b>Storage Root:</b> " . $storagePath . "</li>";
    $output .= "<li><b>Symlink Exists?</b> " . ($symlinkExists ? "✅ YES" : "❌ NO") . "</li>";
    $output .= "<li><b>Storage Folder Contents:</b> <pre>" . json_encode($storageFiles, JSON_PRETTY_PRINT) . "</pre></li>";
    $output .= "</ul>";

    // Attempt to show a category image based on common paths if found
    $output .= "<h3>4. Upload Test</h3>";
    $output .= "<p>Try dragging a file here or manually verify a category image URL.</p>";
    
    $output .= "<style>.error { color: red; font-weight: bold; }</style>";
    $output .= "</body></html>";
    
    return $output;
});


