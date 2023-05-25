<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Registraton;
use App\Http\Livewire\Dashboard\Dashboard;
use App\Http\Livewire\Itemgroup\ItemGroups;
use App\Http\Livewire\Itemgroup\AddItemGroup;
use App\Http\Livewire\Item\AddItem;
use App\Http\Livewire\Item\Items;
use App\Http\Livewire\user\Profile;
use App\Http\Livewire\user\Expenditures;
use App\Http\Livewire\user\Addexpenditures;
use App\Http\Livewire\user\Users;



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

Route::get('/',Login::class);


Route::get('login',Login::class)->name('login');

Route::get('register',Registraton::class)->name('register');
Route::prefix('/')->middleware('auth','isAdmin')->group(function(){
     

Route::get('itemGroup',ItemGroups::class)->name('itemGroup');
Route::get('itemGroup/add',AddItemGroup::class)->name('itemGroup/add');
Route::get('item/add',AddItem::class)->name('item/add');
Route::get('item',Items::class)->name('item');
Route::get('profile',Profile::class)->name('profile');



Route::get('users',Users::class)->name('users');
});
Route::prefix('/')->middleware('auth')->group(function(){
Route::get('dashboard',Dashboard::class)->name('dashboard');
Route::get('profile',Profile::class)->name('profile');
Route::get('user/expenditure',Expenditures::class)->name('user/expenditure');
Route::get('user/expenditure/add',Addexpenditures::class)->name('user/expenditure/add');
});