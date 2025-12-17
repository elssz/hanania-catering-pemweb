<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register.post');

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.post');

Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\PasswordResetController;

Route::get('/password/reset', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.update');

Route::get('/layout', function () {
    return view('components/layout');
});

Route::get('/menu', function () {
    $menus = \App\Models\Menu::orderBy('kategori')->orderBy('namaMenu')->get();
    return view('menu', compact('menus'));
})->name('menu');

Route::get('/keranjang', function () {
    $cart = null;
    if (auth()->check()) {
        $cart = \App\Models\Order::with(['items.menu'])
            ->where('user_id', auth()->id())
            ->where('status_order', 'cart')
            ->first();
    }
    return view('user.order.keranjang', compact('cart'));
})->name('keranjang');


Route::get('/pesanan', function () {
    $cart = null;
    if (auth()->check()) {
        $cart = \App\Models\Order::with(['items.menu'])
            ->where('user_id', auth()->id())
            ->where('status_order', 'cart')
            ->first();
    }
    return view('user.order.pesanan', compact('cart'));
})->name('pesanan')->middleware('auth');


// Checkout & Confirmation routes
use App\Http\Controllers\User\CartController;

Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::get('/order/{orderId}/confirmation', [CartController::class, 'confirmation'])->name('order.confirmation')->middleware('auth');

// viewtransaksi
use App\Http\Controllers\User\TransactionController;

Route::get('/transaksi-saya', [TransactionController::class, 'index'])
    ->middleware('auth')->name('transaksi-saya');

//cart.add

Route::post('/cart/add/{menuId}', [CartController::class, 'addToCart'])
    ->name('cart.add')
    ->middleware('auth');


use App\Http\Controllers\Admin\MenuController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('menus', MenuController::class);

    // Orders
    Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::post('orders/{order}/update-status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Transactions
    Route::get('transactions', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/{transaction}', [\App\Http\Controllers\Admin\TransactionController::class, 'show'])->name('transactions.show');
    Route::post('transactions/{transaction}/verify', [\App\Http\Controllers\Admin\TransactionController::class, 'verify'])->name('transactions.verify');
});
