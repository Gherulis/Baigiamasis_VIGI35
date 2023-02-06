<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\Request;
use App\Http\Controllers\TotalCostController;
use App\Http\Controllers\PricelistController;
use App\Http\Controllers\DeclareWaterController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FlatController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NkfController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostsController::class, 'index'])->middleware('auth')->name('main');



    Route::get('/main', function () {
        return view('main');
    })->name('pagrindinis');

// Route::get('/billing/billing.index', function () {
//     return view ('/billing/billing.index');

// });

// Route::get('/contacts', function () {
//     return view ('contacts');

// });

// Route::get('/newContact', function () {
//     return view ('newContact');

// });

// Route::get('/newUser', function () {
//     return view ('newUser');

// });

// Route::get('/declare', function () {
//     return view ('declare');

// });

// Route::get('/pamirsauslaptazodi', function () {
//     return view ('forgotPassword');

// });

// Route::get('/login', function () {
//     return view ('login');

// });

// Route::get('/logint', function () {
//     return view ('logintest');

// });
//  <<<   contacts routes >>>



Route::get('/contacts/index', [ContactsController::class, 'index'])->name('contacts.index')->middleware('auth');
Route::get('/contacts/create', [ContactsController::class, 'create'])->name('contacts.create')->middleware('auth');
Route::get('/contacts/edit/{contacts}', [ContactsController::class, 'edit'])->name('contact.edit')->middleware('auth');
Route::get('/contacts/show/{contact}', [ContactsController::class, 'show'])->name('contact.show')->middleware('auth');

Route::post('/contacts/store', [ContactsController::class, 'store'])->name('contacts.store')->middleware('auth');

Route::post('/contacts/update/{contacts}', [ContactsController::class, 'update'])->name('contact.update')->middleware('auth');
Route::post('/contacts/destroy/{contact}', [ContactsController::class, 'destroy'])->name('contact.destroy')->middleware('auth');




Route::prefix('declare')->group(function(){
Route::get('/index', [DeclareWaterController::class, 'index'])->name('declare.index')->middleware('auth');
Route::get('/index/month', [DeclareWaterController::class, 'indexByMonth'])->name('month.index')->middleware('auth');
Route::get('/edit/{declareWater}', [DeclareWaterController::class, 'edit'])->name('declare.edit')->middleware('auth');
Route::get('/show', [DeclareWaterController::class, 'show'])->name('declare.show')->middleware('auth');
Route::get('/create', [DeclareWaterController::class, 'create'])->name('declare.create')->middleware('auth');
Route::post('/store', [DeclareWaterController::class, 'store'])->name('declare.store')->middleware('auth');
Route::post('/destroy/{declareWater}', [DeclareWaterController::class, 'destroy'])->name('declare.destroy')->middleware('auth');
Route::get('/index/flat', [DeclareWaterController::class, 'indexFlat'])->name('declare.indexFlat')->middleware('auth');
Route::post('/update/{declareWater}', [DeclareWaterController::class, 'update'])->name('declare.update')->middleware('auth');
});

Route::prefix('user')->group(function(){
    Route::get('/index', [UserController::class, 'index'])->name('user.index')->middleware('auth');
    Route::get('/show', [UserController::class, 'show'])->name('user.show')->middleware('auth');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');
    Route::post('/update/{user}', [UserController::class, 'update'])->name('user.update')->middleware('auth');
    Route::get('/create', [UserController::class, 'create'])->name('user.create')->middleware('auth');
    Route::post('/store', [UserController::class, 'store'])->name('user.store')->middleware('auth');
    Route::post('/destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('auth');
});
Route::prefix('flat')->group(function(){
    Route::get('/index', [FlatController::class, 'index'])->name('flat.index')->middleware('auth');

    Route::get('/show', [FlatController::class, 'show'])->name('flat.show')->middleware('auth');
    Route::get('/edit/{flat}', [FlatController::class, 'edit'])->name('flat.edit')->middleware('auth');
    Route::get('/create', [FlatController::class, 'create'])->name('flat.create')->middleware('auth');
    Route::post('/store', [FlatController::class, 'store'])->name('flat.store')->middleware('auth');
    Route::post('/destroy/{flat}', [FlatController::class, 'destroy'])->name('flat.destroy')->middleware('auth');
    Route::post('/update/{flat}', [FlatController::class, 'update'])->name('flat.update')->middleware('auth');
    Route::get('/createFlats', [FlatController::class, 'createFlats'])->name('flat.createFlats')->middleware('auth');
    Route::post('/storeFlats', [FlatController::class, 'storeFlats'])->name('flat.storeFlats')->middleware('auth');


});
Route::prefix('house')->group(function(){
    Route::get('/index', [HouseController::class, 'index'])->name('house.index')->middleware('auth');
    Route::get('/show', [HouseController::class, 'show'])->name('house.show')->middleware('auth');
    Route::get('/edit/{house}', [HouseController::class, 'edit'])->name('house.edit')->middleware('auth');
    Route::get('/create', [HouseController::class, 'create'])->name('house.create')->middleware('auth');
    Route::post('/store', [HouseController::class, 'store'])->name('house.store')->middleware('auth');
    Route::post('/destroy/{house}', [HouseController::class, 'destroy'])->name('house.destroy')->middleware('auth');
    Route::post('/update/{house}', [HouseController::class, 'update'])->name('house.update')->middleware('auth');

});






// Route::get('/pricelist/index', [PricelistController::class, 'index'])->name('pricelist.index')->middleware('auth');
// Route::get('/pricelist/create', [PricelistController::class, 'create'])->name('pricelist.create')->middleware('auth');
// Route::get('/pricelist/store', [PricelistController::class, 'store'])->name('pricelist.store')->middleware('auth');
// Route::post('/pricelist/destroy/{contact}', [PricelistController::class, 'destroy'])->name('pricelist.destroy')->middleware('auth');
// Route::get('/contacts/create', [ContactsController::class, 'index'])->name('contacts.create')->middleware('auth');
// Route::get('/contacts/create', [ContactsController::class, 'create'])->name('contacts.create')->middleware('auth');
// Route::post('/contacts', [ContactsController::class, 'store'])->name('contacts.store')->middleware('auth');
// Route::get('/contacts/editID={id}', [ContactsController::class, 'show'])->name('contacts.show')->middleware('auth');
// Route::delete('/contacts/{id}', [ContactsController::class, 'destroy'])->middleware('auth');
// Route::put('/contacts/updateID={id}', [ContactsController::class, 'update'])->middleware('auth');


//   <<<   contacts routes >>>


Route::get('/main',[PostsController::class, 'index'])->name('home')->middleware('auth');

Route::get('/pricelist/index/', [PricelistController::class, 'index',])->name('pricelist.index')->middleware('auth');
Route::get('pricelist/create', [PricelistController::class, 'create'])->name('pricelist.create')->middleware('auth');
Route::post('/pricelist/create', [PricelistController::class, 'store'])->name('pricelist.store')->middleware('auth');
Route::get('pricelist/{pricelist}', [PricelistController::class, 'show'])->name('pricelist.show')->middleware('auth');
Route::get('pricelist/price/{pricelist}', [PricelistController::class, 'showPrices'])->name('pricelist.showPrices')->middleware('auth');
Route::post('/pricelist/{pricelist}', [PricelistController::class, 'update'])->name('pricelist.update')->middleware('auth');
Route::get('/pricelist/edit/{pricelist}', [PricelistController::class, 'edit'])->name('pricelist.edit')->middleware('auth');
Route::get('pricelist/lastbill/{pricelist}', [PricelistController::class, 'lastBill'])->name('pricelist.lastbill')->middleware('auth');
Route::post('/pricelist/destroy/{pricelist}', [PricelistController::class, 'destroy'])->name('pricelist.delete')->middleware('auth');

Route::get('/home', [PostsController::class, 'index'])->name('posts.index')->middleware('auth');
Route::get('posts/newpost', [PostsController::class, 'create'])->name('post.create')->middleware('auth');
Route::post('posts/store', [PostsController::class, 'store'])->name('post.store')->middleware('auth');
Route::get('posts/{posts}', [PostsController::class, 'show'])->name('post.show')->middleware('auth');
Route::get('/post/edit/{posts}', [PostsController::class, 'edit'])->name('post.edit')->middleware('auth');
Route::post('/post/update/{posts}', [PostsController::class, 'update'])->name('post.update')->middleware('auth');
Route::post('/post/destroy/{posts}', [PostsController::class, 'destroy'])->name('post.delete')->middleware('auth');
Auth::routes();

Route::prefix('invoices')->group(function(){

    Route::get('/index', [InvoicesController::class, 'index'])->name('invoices.index')->middleware('auth');
    Route::get('/editInvoices', [InvoicesController::class, 'editInvoices'])->name('invoices.editInvoices')->middleware('auth');

    Route::get('/indexFlat', [InvoicesController::class, 'indexFlat'])->name('invoices.indexFlat')->middleware('auth');
    Route::get('/create', [InvoicesController::class, 'create'])->name('invoices.create')->middleware('auth');
    Route::post('/store', [InvoicesController::class, 'store'])->name('invoices.store')->middleware('auth');
    Route::get('bills/index', [InvoicesController::class, 'show'])->name('bills.index')->middleware('auth');
    Route::get('bills/index/last', [InvoicesController::class, 'showLast'])->name('bills.indexLast')->middleware('auth');
    Route::post('/invoicesUpdate', [InvoicesController::class, 'invoicesUpdate'])->name('invoices.Update')->middleware('auth');



});
Route::prefix('permissions')->group(function(){
    Route::get('/', [PermissionController::class, 'index'])->name('permissions.index')->middleware('auth');
    Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware('auth');
    Route::post('/store', [PermissionController::class, 'store'])->name('permissions.store')->middleware('auth');
    Route::get('/show/{id}', [PermissionController::class, 'show'])->name('permissions.show')->middleware('auth');
    Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('auth');
    Route::post('/update/{id}', [PermissionController::class, 'update'])->name('permissions.update')->middleware('auth');
    Route::post('/destroy/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy')->middleware('auth');
});
Route::prefix('roles')->group(function(){
    Route::get('/', [RoleController::class, 'index'])->name('roles.index')->middleware('auth');
    Route::get('/create', [RoleController::class, 'create'])->name('roles.create')->middleware('auth');
    Route::post('/store', [RoleController::class, 'store'])->name('roles.store')->middleware('auth');
    Route::get('/show/{id}', [RoleController::class, 'show'])->name('roles.show')->middleware('auth');
    Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit')->middleware('auth');
    Route::post('/update/{id}', [RoleController::class, 'update'])->name('roles.update')->middleware('auth');
    Route::post('/destroy/{id}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('auth');
});
Route::prefix('nkf')->group(function(){
    Route::get('/index', [NkfController::class, 'index'])->name('nkf.index')->middleware('auth');
    Route::get('/show', [NkfController::class, 'show'])->name('nkf.show')->middleware('auth');
    Route::get('/edit/{nkf}', [NkfController::class, 'edit'])->name('nkf.edit')->middleware('auth');
    Route::get('/create', [NkfController::class, 'create'])->name('nkf.create')->middleware('auth');
    Route::post('/store', [NkfController::class, 'store'])->name('nkf.store')->middleware('auth');
    Route::post('/destroy/{nkf}', [NkfController::class, 'destroy'])->name('nkf.destroy')->middleware('auth');
    Route::post('/update/{nkf}', [NkfController::class, 'update'])->name('nkf.update')->middleware('auth');

});
