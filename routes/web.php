<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\LoketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\FrontController;

Route::get('/', [FrontController::class, 'index']);
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'authenticate']);
Route::get('auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::get('logout', [LoginController::class, 'logout']);

Route::get('pemilihan_instansi', [FrontController::class, 'index']);
Route::get('instansi/{instansi:slug}', [FrontController::class, 'pelayanan']);
Route::get('pelayanan/{pelayanan:slug}', [FrontController::class, 'persyaratan']);
Route::post('no_antrian', [FrontController::class, 'no_antrian']);
Route::get('panggil_antrian', [FrontController::class, 'panggil_antrian']);
Route::post('panggil_antrian', [FrontController::class, 'panggil_antrian_ref']);

Route::get('home', [DashboardController::class, 'index'])->middleware('auth');

Route::get('antrian', [AntrianController::class, 'index'])->middleware('auth');
Route::post('panggil_next', [AntrianController::class, 'panggil_next'])->middleware('auth');
Route::post('panggil_selesai', [AntrianController::class, 'panggil_selesai'])->middleware('auth');
Route::post('panggil_lewati', [AntrianController::class, 'panggil_lewati'])->middleware('auth');

Route::get('instansi', [InstansiController::class, 'index'])->middleware('auth');
Route::post('instansi', [InstansiController::class, 'tambah'])->middleware('auth');
Route::post('edit_instansi', [InstansiController::class, 'edit'])->middleware('auth');
Route::post('hapus_instansi', [InstansiController::class, 'hapus'])->middleware('auth');

Route::get('pelayanan', [PelayananController::class, 'index'])->middleware('auth');
Route::get('tambah_pelayanan', [PelayananController::class, 'tambah_pelayanan'])->middleware('auth');
Route::post('tambah_pelayanan', [PelayananController::class, 'tambah'])->middleware('auth');
Route::post('edit_pelayanan', [PelayananController::class, 'edit_pelayanan'])->middleware('auth');
Route::post('ubah_pelayanan', [PelayananController::class, 'edit'])->middleware('auth');
Route::post('hapus_pelayanan', [PelayananController::class, 'hapus'])->middleware('auth');

Route::get('loket', [LoketController::class, 'index'])->middleware('auth');
Route::post('loket', [LoketController::class, 'tambah'])->middleware('auth');
Route::post('detail_edit_loket', [LoketController::class, 'detail_edit'])->middleware('auth');
Route::post('edit_loket', [LoketController::class, 'edit'])->middleware('auth');
Route::post('hapus_loket', [LoketController::class, 'hapus'])->middleware('auth');

Route::get('user', [UserController::class, 'index'])->middleware('auth');
Route::get('tambah_user', [UserController::class, 'tambah_user'])->middleware('auth');
Route::post('tambah_user', [UserController::class, 'tambah'])->middleware('auth');
Route::post('edit_user', [UserController::class, 'edit_user'])->middleware('auth');
Route::post('ubah_user', [UserController::class, 'edit'])->middleware('auth');
Route::post('hapus_user', [UserController::class, 'hapus'])->middleware('auth');
