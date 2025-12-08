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
// Comprehensive Debug & Fix Route
Route::get('/fix-storage', function () {
    $output = "<html><head><style>
        body { font-family: sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #333; border-bottom: 3px solid #4CAF50; padding-bottom: 10px; }
        .section { margin: 20px 0; padding: 15px; background: #fafafa; border-radius: 5px; }
        .success { color: #4CAF50; font-weight: bold; }
        .error { color: #f44336; font-weight: bold; }
        .warning { color: #ff9800; font-weight: bold; }
        pre { background: #263238; color: #aed581; padding: 10px; border-radius: 4px; overflow-x: auto; }
        .test-img { border: 2px solid #4CAF50; margin: 10px 0; }
    </style></head><body><div class='container'>";
    
    $output .= "<h1>🔧 Complete System Diagnostic</h1>";
    
    // 1. Environment Check
    $output .= "<div class='section'><h2>1. Environment Configuration</h2>";
    $appUrl = env('APP_URL');
    $output .= "<p><b>APP_URL:</b> " . ($appUrl ?: '<span class="error">NOT SET</span>') . "</p>";
    $output .= "<p><b>Document Root:</b> " . ($_SERVER['DOCUMENT_ROOT'] ?? 'Unknown') . "</p>";
    $output .= "<p><b>Laravel Public Path:</b> " . public_path() . "</p>";
    $output .= "</div>";
    
    // 2. .htaccess Check
    $output .= "<div class='section'><h2>2. .htaccess Status</h2>";
    $htaccessPath = base_path('.htaccess');
    if (file_exists($htaccessPath)) {
        $htaccessContent = file_get_contents($htaccessPath);
        $output .= "<p class='success'>✅ .htaccess file exists at root</p>";
        $output .= "<p><b>Content:</b></p><pre>" . htmlspecialchars($htaccessContent) . "</pre>";
    } else {
        $output .= "<p class='error'>❌ .htaccess file NOT FOUND at project root</p>";
        $output .= "<p class='warning'>This will cause asset loading issues!</p>";
    }
    $output .= "</div>";
    
    // 3. Static Assets Check
    $output .= "<div class='section'><h2>3. Static Assets (Mazer)</h2>";
    $testImagePath = public_path('mazer/assets/compiled/jpg/1.jpg');
    $testImageUrl = asset('mazer/assets/compiled/jpg/1.jpg');
    $imageExists = file_exists($testImagePath);
    
    $output .= "<p><b>Test File:</b> " . $testImagePath . "</p>";
    $output .= "<p><b>File Exists?</b> " . ($imageExists ? '<span class="success">✅ YES</span>' : '<span class="error">❌ NO</span>') . "</p>";
    $output .= "<p><b>Generated URL:</b> <a href='$testImageUrl' target='_blank'>$testImageUrl</a></p>";
    
    if ($imageExists) {
        $output .= "<p><b>Render Test:</b><br><img src='$testImageUrl' class='test-img' style='max-width:100px;' onerror=\"this.parentElement.innerHTML+='<span class=error>❌ Failed to load!</span>'\"></p>";
    }
    $output .= "</div>";
    
    // 4. Storage Symlink Check
    $output .= "<div class='section'><h2>4. Storage Symlink</h2>";
    $storageSource = storage_path('app/public');
    $storageLink = public_path('storage');
    
    if (file_exists($storageLink)) {
        if (is_link($storageLink)) {
            $target = readlink($storageLink);
            $output .= "<p class='success'>✅ Symlink exists</p>";
            $output .= "<p><b>Points to:</b> $target</p>";
            $output .= "<p><b>Expected:</b> $storageSource</p>";
            if ($target === $storageSource) {
                $output .= "<p class='success'>✅ Symlink target is correct</p>";
            } else {
                $output .= "<p class='warning'>⚠️ Symlink points to wrong location!</p>";
            }
        } else {
            $output .= "<p class='error'>❌ 'storage' exists but is NOT a symlink (it's a directory)</p>";
        }
    } else {
        $output .= "<p class='warning'>⚠️ Storage symlink does NOT exist. Creating now...</p>";
        try {
            symlink($storageSource, $storageLink);
            $output .= "<p class='success'>✅ Symlink created successfully!</p>";
        } catch (\Exception $e) {
            $output .= "<p class='error'>❌ Failed to create symlink: " . $e->getMessage() . "</p>";
        }
    }
    $output .= "</div>";
    
    // 5. Midtrans Config
    $output .= "<div class='section'><h2>5. Midtrans Configuration</h2>";
    $midtransConfigured = env('MIDTRANS_SERVER_KEY') && env('MIDTRANS_CLIENT_KEY');
    if ($midtransConfigured) {
        $output .= "<p class='success'>✅ Midtrans keys are configured</p>";
        $output .= "<p><b>Merchant ID:</b> " . env('MIDTRANS_MERCHANT_ID') . "</p>";
        $output .= "<p><b>Client Key:</b> " . substr(env('MIDTRANS_CLIENT_KEY'), 0, 20) . "...</p>";
        $output .= "<p><b>Environment:</b> " . (env('MIDTRANS_IS_PRODUCTION') ? 'Production' : 'Sandbox') . "</p>";
    } else {
        $output .= "<p class='error'>❌ Midtrans keys are NOT configured</p>";
    }
    $output .= "</div>";
    
    $output .= "<div style='margin-top: 30px; padding: 20px; background: #e8f5e9; border-radius: 5px;'>";
    $output .= "<h3 style='margin-top: 0;'>✅ Diagnostic Complete</h3>";
    $output .= "<p>Please screenshot this page and share with support if issues persist.</p>";
    $output .= "<p><a href='/' style='display: inline-block; padding: 10px 20px; background: #4CAF50; color: white; text-decoration: none; border-radius: 4px;'>← Back to Home</a></p>";
    $output .= "</div>";
    
    $output .= "</div></body></html>";
    
    return $output;
});


