<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, HEAD, POST, PUT, PATCH, DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin, Accept, Authorization, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");

Route::post('login', function (Request $request) {
    $credentials = $request->only('name', 'password');
    try {
        if (!$token = JWTAuth::attempt($credentials)) {
            return error(-1, "用户名或密码错误");
        }
    } catch (JWTException $e) {
        return error(-3, "token 无法生成");
    }
    return success(compact('token'));
});

Route::middleware('jwt.api.auth')->group(function () {
    Route::get('/user', function () {
        $user = Auth::user();
        return success(compact('user'));
    });
    Route::get('/rooms', function () {
        return success(['hello']);
    });
    Route::get('/room/{id}', function ($id) {

    });
});
