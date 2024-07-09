<?php

use App\Livewire\Example;
use App\Livewire\Auth\Opt;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Customer\Cart;
use App\Livewire\Customer\Contact;
use App\Livewire\Customer\Product;
use App\Livewire\Customer\Profile;
use App\Livewire\Customer\Homepage;
use App\Livewire\Customer\MyOrders;
use Illuminate\Support\Facades\Route;
use App\Livewire\Customer\ProductView;
use App\Http\Controllers\MainController;
use App\Livewire\ChangePassword;

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

Route::get('/', Homepage::class)->name('homepage');
Route::get('/Product', Product::class)->name('product');
Route::get('/Contact', Contact::class)->name('contact');
Route::get('/Product/{id}', ProductView::class)->name('product.view');
Route::get('/Login', Login::class)->name('login');
Route::get('/Register', Register::class)->name('register');
Route::get('/Otp/{id}', Opt::class)->name('otp');
Route::get('/x',Example::class);
Route::get('/term&condition',\App\Livewire\Customer\TermAndCondition::class)->name('term.condition');
Route::middleware('auth.customer')->prefix('customer')->group(function()
{
    Route::get('logout',[MainController::class,'logoutCustomer'])->name('logout.customer');
    Route::get('my-orders',MyOrders::class)->name('my-orders.customer');
    Route::get('Profile',Profile::class)->name('profile.customer');
    Route::get('cart',Cart::class)->name('cart.customer');
});

Route::get('/admin',function()
{
    return redirect()->route('filament.admin.pages.dashboard');
});
