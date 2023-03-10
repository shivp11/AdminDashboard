<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\password_reset;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
// use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic as Image;


class AuthUserController extends Controller
{
    // public $role = User::where('role', '=', 'Admin');
    function login(){
        return view('auth.login');
    }
    
    function registration(){
        return view('auth.registration');
    }
    
    function registerUser(Request $req){
        $req->validate([
            'name'=>'required',
            'role'=>'required',
            'profile'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|max:12',
        ]);

        $image = $req->profile;
        $img_name = $image->getClientOriginalName();
        $image->move(public_path('images'),$img_name);

        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->role = $req->role;
        $user->profile = $img_name;
        $user->password = Hash::make($req->password);
        $result = $user->save();

        if($result){
            return back()->with('success', 'You have registered successfuly!!!');
        }else{
            return back()->with('failed', 'Something Wrong!!!');
        }
    }

    function loginUser(Request $req){
        $req->validate([
            'email'=>'required|email',
            'password'=>'required|min:8|max:12',
        ]);

        $user = User::where('email', '=', $req->email)->first();
        if($user){
            if(Hash::check($req->password, $user->password)){
                $req->session()->put('loginId', $user->id);
                return redirect('dashboard');
            }else{
                return back()->with('failed', 'Password is not match!!');
            }
        }else{
            return back()->with('failed', 'This email is not registrered!!');
        }
    }

    
    function profile(){
        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        return view('layouts.pages.pages-profile', compact('data'));
    }

    function dashboard(){

        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        $usercount = User::all()->count();
        $commentcount = Comment::all()->count();
        return view('dashboard', compact('data', 'usercount', 'commentcount'));
    }


    function logout(){
        if(Session()->has('loginId')){
            Session()->pull('loginId');
            return redirect('login');
        }
    }

        
    function forgot(){
        return view('auth.forgot-password');
    }

    function changeform(Request $req, $id){
        $data = User::where('id', '=', $id)->first();
        return view('auth.change-password', compact('data'));
    }

    function changepwd(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'new_password' => 'required|min:8|max:12',
        ]);
        $user = User::where('id', '=', $request->id)->first();

        if($user){
            if(Hash::check($request->password, $user->password)){
                $user->password = Hash::make($request->new_password);
                $user->save();
                Session()->pull('loginId');
                return redirect('login')->with('changed', 'Your have to changed password.So, Please login again!!' );
            }else{
                return back()->with('failed', 'Your old password was entered incorrectly.Please enter it again!!');
            }
        }
        
    }


    function forgotpwd(Request $req)
    {
        $token = base64_encode(Str::random(64));
        password_reset::create([
            'email'=>$req->email,
            'token'=>$token,
            'created_at'=>Carbon::now(),
        ]);

        $user = User::where('email', $req->email)->first();
        $link = route('reset-form',['token'=>$token, 'email'=>$req->email]);
        $body_message = "We are received a request to reset the password for <b>Larablog</b> account associated with ".$req->email.". <br> You can reset your password by clicking the button below.";
        $body_message.='<br>';
        $body_message.='<a href="'.$link.'" target="_blank" style="color:#FFF;border-color:#22bc66;border-style:solid;border-width:10px 180px; background-color:#22bc66;display:inline-block;text-decoration:none;border-radius:3px;box-shadow:0 2px 3px rgba(0,0,0,0.16);-webkit-text-size-adjust:none;box-sizing:border-box">Reset Password</a>';
        $body_message.='<br>';
        $body_message.='If you did not request for a password reset, please ignore this email';

        $data = array(
            'name' => $user->name,
            'body_message'=>$body_message,
        );

        Mail::send('forgot-email-template', $data, function($message) use ($user){
            $message->from('shivpatel19@gnu.ac.in','Larablog');
            $message->to($user->email, $user->name)
                    ->subject('Reset Password');
        });
        
        return back()->with('success', 'We sent link on your email');
    }

    function resetpwdtoken(Request $request, string $token)
    {
        return view('auth.reset-token-password', ['token' => $token]);
    }

    function resetpwd(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $check_token = DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();

        if(!$check_token){
            return back()->with('fail','Invalid Token.');
        }else{
            User::where('email', $request->input('email'))->update([
                'password'=>Hash::make($request->input('password'))
            ]);
            DB::table('password_resets')->where([
                'email'=>$request->input('email')
            ])->delete();

            return redirect('login')->with('success','Your password has been updated successfully. Login with your email and your new password');
        }
    }
    
    function icons(){
        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        return view('layouts.tools.icons-feather', compact('data'));
    }

    function buttons(){
        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        return view('layouts.tools.ui-buttons', compact('data'));
    }

    function cards(){
        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        return view('layouts.tools.ui-cards', compact('data'));
    }

    function forms(){
        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        return view('layouts.tools.ui-forms', compact('data'));
    }

    function typography(){
        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        return view('layouts.tools.ui-typography', compact('data'));
    }

    function charts(){
        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        return view('layouts.plugins.charts-chartjs', compact('data'));
    }

    function maps(){
        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        return view('layouts.plugins.maps-google', compact('data'));
    }


    function user(){
        $users = User::all();
        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        return view('layouts.pages.user', compact('users', 'data'));
    }

    function changeprofile(Request $req){
        $user = User::find($req->id);    
        if($req->hasfile('changeAuthorPictureFile')){
            $image = $req->file('changeAuthorPictureFile')->resize(100, 100);
            $img_name = $image->getClientOriginalName();
            $image->move(public_path('images/upadated'),$img_name);   
            $user->profile = $img_name;
        }
        $user->save();
        return 'hi';

    }
}
?>