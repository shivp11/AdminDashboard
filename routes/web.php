<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\blogController;
use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('hie', function () {
    return view('layouts.pages.profile');
});

Route::group(['middleware'=>['isLoggedIn']], function(){
    Route::get('dashboard',[AuthUserController::class, 'dashboard']);
    Route::get('userinfo', [UserController::class, 'displayOrsearch']);
    Route::post('/adduser', [UserController::class, 'create']);
    Route::get('updatedelete', [UserController::class, 'updateordelete']);
    Route::post('update/{id}', [UserController::class, 'update']);
    Route::post('/profileedit', [UserController::class, 'profileedit']);
    
    
    Route::get('profile',[AuthUserController::class, 'profile']);
    Route::get('icons',[AuthUserController::class, 'icons']);
    Route::get('ui-buttons',[AuthUserController::class, 'buttons']);
    Route::get('ui-cards',[AuthUserController::class, 'cards']);
    Route::get('ui-forms',[AuthUserController::class, 'forms']);
    Route::get('ui-typography',[AuthUserController::class, 'typography']);
    Route::get('charts',[AuthUserController::class, 'charts']);  
    
    Route::get('category', [UserController::class, 'showcategory']);
    Route::post('/addcategory', [UserController::class, 'addcategory']);
    
    // POST 
    Route::get('post', [PostController::class, 'showpost']);
    Route::post('addpost', [PostController::class, 'addpost']);
    Route::get('updatedeletepost', [PostController::class, 'updateordeletepost']);
    Route::post('updatepost/{id}', [PostController::class, 'updatepost']);
    
});

    Route::post('registeruser',[AuthUserController::class, 'registerUser']);
    Route::post('loginuser',[AuthUserController::class, 'loginUser']);
    Route::get('logout',[AuthUserController::class, 'logout']);

    Route::group(['middleware'=>['alreadyLoggedIn']], function(){
    Route::get('login',[AuthUserController::class, 'login'])->name('login');
    Route::get('registration',[AuthUserController::class, 'registration']); 
});


// Forgot Password
Route::get('forgot',[AuthUserController::class, 'forgot']);
Route::post('/forgot-password-email',[AuthUserController::class, 'forgotpwd'])->name('password.email');
Route::get('/reset-password-email/{token}',[AuthUserController::class, 'resetpwdtoken'])->name('reset-form');
Route::post('/repwd',[AuthUserController::class, 'resetpwd']);
// Change Password
Route::get('changeform/{id}',[AuthUserController::class, 'changeform']);
Route::post('change-password',[AuthUserController::class, 'changepwd']);  




Route::group(['prefix' => '/'], function()  
{  
    Route::get('blog',[blogController::class, 'home'])->middleware('isLoggedIn');
    Route::get('comment/{id}', [blogController::class, 'commentpage'])->middleware('isLoggedIn');
    Route::post('addcomment', [PostController::class, 'addcomment'])->middleware('isLoggedIn');
});  
?>