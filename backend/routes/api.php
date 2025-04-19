<?php

use App\Models\Clothing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users', function (Request $request) {
    return User::all();
});
Route::get('/clothes', function () {
    return Clothing::all();
});
Route::post('/clothes', function (Request $request) {
    return Clothing::create($request->all());
});
Route::put('/clothes/{id}', function (Request $request, $id) {
    $clothing = Clothing::findOrFail($id);
    $clothing->update($request->all());
    return $clothing;
});

Route::delete('/clothes/{id}', function ($id) {
    Clothing::findOrFail($id)->delete();
    return response()->json(['message' => 'Deleted']);
});