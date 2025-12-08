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
// Fix Storage Link & Debug
Route::get('/fix-storage', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');
    
    $output = "<h1>Storage Debug Info</h1>";
    $output .= "<p><b>APP_URL:</b> " . env('APP_URL') . "</p>";
    $output .= "<p><b>Target (Real Path):</b> " . $target . "</p>";
    $output .= "<p><b>Link (Public Path):</b> " . $link . "</p>";
    
    if (file_exists($link)) {
        $output .= "<p>✅ Link exists.</p>";
        if (is_link($link)) {
            $output .= "<p>🔗 It is a symlink pointing to: " . readlink($link) . "</p>";
        } else {
            $output .= "<p>❌ It is a DIRECTORY (not a link). This is bad.</p>";
        }
    } else {
        $output .= "<p>❌ Link does NOT exist.</p>";
    }

    try {
        // Force re-create
        if (file_exists($link)) {
             // Rename old one just in case (safer than delete for now)
             rename($link, $link . '_backup_' . time());
             $output .= "<p>🗑️ Existing link/folder moved to backup.</p>";
        }
        
        // Attempt to link
        symlink($target, $link);
        $output .= "<p>✅ New symlink created successfully!</p>";
        
    } catch (\Exception $e) {
        $output .= "<p>❌ Error creating symlink: " . $e->getMessage() . "</p>";
    }

    return $output;
});


