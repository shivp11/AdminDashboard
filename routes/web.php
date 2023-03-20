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
    Route::post('/addAuthor', [AuthUserController::class, 'addAuthor']);
    Route::post('updates/{id}', [UserController::class, 'updates']);
    Route::post('deleteuser/{id}', [UserController::class, 'delete']);
    Route::get('profile',[AuthUserController::class, 'profile'])->name('profile');
    Route::post('/crop', [UserController::class, 'crop'])->name('user.crop');
    Route::post('/userinfocrop', [UserController::class, 'userinfocrop'])->name('userinfo.crop');
    Route::post('/profileedit', [UserController::class, 'profileedit'])->name('author.change-profile-picture');
    
    // category
    Route::get('category', [UserController::class, 'showcategory']);
    Route::post('/addcategory', [UserController::class, 'addcategory']);
    
    // POST 
    Route::get('post', [PostController::class, 'showpost']);
    Route::get('viewcomments/{id}', [PostController::class, 'viewcomments']);
    Route::get('postcomment', [PostController::class, 'postcomment']);
    Route::post('addpost', [PostController::class, 'addpost']);;
    Route::post('updatepost/{id}', [PostController::class, 'updatepost']);
    Route::post('deletepost/{id}', [PostController::class, 'deletepost']);
    
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
    Route::get('comment/{id}', [blogController::class, 'commentpage'])->middleware('isLoggedIn')->name('comment');
    Route::post('addcomment', [PostController::class, 'addcomment'])->middleware('isLoggedIn');
    Route::post('replycomment/{id}', [PostController::class, 'replycomment'])->middleware('isLoggedIn');
    Route::post('rereplycomment/{id}', [PostController::class, 'rereplycomment'])->middleware('isLoggedIn');
    Route::post('like/{id}', [PostController::class, 'like'])->middleware('isLoggedIn')->name('like');
    Route::post('dislike/{id}', [PostController::class, 'dislike'])->middleware('isLoggedIn');
});  

?>