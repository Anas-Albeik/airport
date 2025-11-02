<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//new
use App\Models\User;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//new
Route::post('/login', function (Request $r) {
    $r->validate(['email'=>'required|email','password'=>'required']);
    $user = User::where('email', $r->email)->first();

    if (! $user || ! Hash::check($r->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('api')->plainTextToken;   // فيك تضيف abilities هون
    return ['token' => $token];
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', fn(Request $r) => $r->user());

    Route::post('/logout', function (Request $r) {
        // احذف التوكن الحالي فقط
        $r->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    });

    // مثال لمسار محمي:
    Route::get('/projects', fn() => ['items' => []]);
});