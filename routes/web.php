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
Route::get('/edit', [DeclareWaterController::class, 'edit'])->name('declare.edit')->middleware('auth');
Route::get('/show', [DeclareWaterController::class, 'show'])->name('declare.show')->middleware('auth');
Route::get('/create', [DeclareWaterController::class, 'create'])->name('declare.create')->middleware('auth');
Route::post('/store', [DeclareWaterController::class, 'store'])->name('declare.store')->middleware('auth');
Route::post('/destroy/{contact}', [DeclareWaterController::class, 'destroy'])->name('declare.destroy')->middleware('auth');
Route::get('/index/flat', [DeclareWaterController::class, 'indexFlat'])->name('declare.indexFlat')->middleware('auth');
});

Route::prefix('user')->group(function(){
    Route::get('/index', [UserController::class, 'index'])->name('user.index')->middleware('auth');
    Route::get('/show', [UserController::class, 'show'])->name('user.show');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/update/{user}', [UserController::class, 'update'])->name('user.update')->middleware('auth');
    Route::post('/destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy');
});
Route::prefix('flat')->group(function(){
    Route::get('/index', [FlatController::class, 'index'])->name('flat.index');
    Route::get('bills/index', [FlatController::class, 'billsIndex'])->name('bills.index');
    Route::get('/show', [FlatController::class, 'show'])->name('flat.show');
    Route::get('/edit/{flat}', [FlatController::class, 'edit'])->name('.flat.edit');
    Route::get('/create', [FlatController::class, 'create'])->name('flat.create');
    Route::post('/store', [FlatController::class, 'store'])->name('flat.store');
    Route::post('/destroy/{flat}', [FlatController::class, 'destroy'])->name('flat.destroy');
    Route::post('/update/{flat}', [FlatController::class, 'update'])->name('flat.update')->middleware('auth');

});
Route::prefix('house')->group(function(){
    Route::get('/index', [HouseController::class, 'index'])->name('house.index');
    Route::get('/show', [HouseController::class, 'show'])->name('house.show');
    Route::get('/edit/{house}', [HouseController::class, 'edit'])->name('house.edit');
    Route::get('/create', [HouseController::class, 'create'])->name('house.create');
    Route::post('/store', [HouseController::class, 'store'])->name('house.store');
    Route::post('/destroy/{house}', [HouseController::class, 'destroy'])->name('house.destroy');
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


Route::get('/main',[PostsController::class, 'index'])->name('home');

Route::get('/pricelist/index/', [PricelistController::class, 'index',])->name('pricelist.index');
Route::get('pricelist/create', [PricelistController::class, 'create'])->name('pricelist.create');
Route::post('/pricelist/create', [PricelistController::class, 'store'])->name('pricelist.store');
Route::get('pricelist/{pricelist}', [PricelistController::class, 'show']);
Route::post('/pricelist/{pricelist}', [PricelistController::class, 'update'])->name('pricelist.update');
Route::get('/pricelist/edit/{pricelist}', [PricelistController::class, 'edit'])->name('pricelist.edit')->middleware('auth');
Route::get('pricelist/lastbill/{pricelist}', [PricelistController::class, 'lastBill'])->name('pricelist.lastbill');


Route::get('/home', [PostsController::class, 'index'])->name('posts.index');
Route::get('posts/newpost', [PostsController::class, 'create'])->name('post.create');
Route::post('posts/store', [PostsController::class, 'store'])->name('post.store')->middleware('auth');
Route::get('posts/{posts}', [PostsController::class, 'show'])->name('post.show');
Route::get('/post/edit/{posts}', [PostsController::class, 'edit'])->name('post.edit');
Route::post('/post/update/{posts}', [PostsController::class, 'update'])->name('post.update');
Route::post('/post/destroy/{posts}', [PostsController::class, 'destroy'])->name('post.delete');
Auth::routes();
