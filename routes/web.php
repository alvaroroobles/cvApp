<?php
use App\Http\Controllers\MainController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

Route::get('/',[MainController::class,'main'])->name("main");
Route::get('about',[MainController::class,'about'])->name("about");

// 7 métodos principales
Route::get('curriculum',[CurriculumController::class,'index'])->name('curriculum.index');
Route::get('curriculum/create',[CurriculumController::class,'create'])->name('curriculum.create');
Route::post('curriculum',[CurriculumController::class,'store'])->name('curriculum.store');
Route::get('curriculum/{curriculum}',[CurriculumController::class,'show'])->name('curriculum.show');
Route::get('curriculum/{curriculum}/edit',[CurriculumController::class,'edit'])->name('curriculum.edit');
Route::put('curriculum/{curriculum}',[CurriculumController::class,'update'])->name('curriculum.update');
Route::delete('curriculum/{curriculum}',[CurriculumController::class,'destroy'])->name('curriculum.destroy');
