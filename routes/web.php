<?php


use App\Livewire\BukuComponent;
use App\Livewire\HomeComponent;
use App\Livewire\UserComponent;
use App\Livewire\LoginComponent;
use App\Livewire\MemberComponent;
use App\Livewire\KategoriComponent;
use App\Livewire\KembaliComponent;
use App\Livewire\PinjamComponent;
use Illuminate\Support\Facades\Route;

Route::get('/',HomeComponent::class)->middleware('auth')->name('home');

// route untuk user
Route::get('/user', UserComponent::class)->middleware('auth')->name('user');
// route untuk member
Route::get('/member', MemberComponent::class)->middleware('auth')->name('member');
//  route untuk kategori
Route::get('/kategori', KategoriComponent::class)->middleware('auth')->name('kategori');
//  route untuk buku
Route::get('/buku', BukuComponent::class)->middleware('auth')->name('buku');
// route pinjam pinjam
Route::get('/pinjam', PinjamComponent::class)->middleware('auth')->name('pinjam');
// route untuk kembali
Route::get('/kembali', KembaliComponent::class)->middleware('auth')->name('kembali');


Route::get('/login',LoginComponent::class)->name('login');

Route::get('/logout', [LoginComponent::class, 'keluar'])->name('logout');

