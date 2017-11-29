<?php

use Illuminate\Http\Request;
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

function success($data = [], $info = 'success')
{
    return response()->json([
        'code' => 0,
        'info' => $info,
        'data' => $data
    ]);
}

function error($code = -1, $info = 'error', $data = [])
{
    return response()->json([
        'code' => $code,
        'info' => $info,
        'data' => $data
    ]);
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, HEAD, POST, PUT, PATCH, DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin, Accept, Authorization, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");

Route::post('login', function (Request $request) {
    $credentials = $request->only('name', 'password');
    try {
        if (!$token = JWTAuth::attempt($credentials)) {
            return error(-1, "邮箱或者密码错误");
        }
    } catch (JWTException $e) {
        return error(-3, "token 无法生成");
    }
    return success(compact('token'));
});

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $user = JWTAuth::parseToken()->authenticate();
    });
});
