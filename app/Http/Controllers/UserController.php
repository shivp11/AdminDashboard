<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\category;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
// use Intervention\Image\Facades\Image;
// use Intervention\Image\ImageManagerStatic as Image;


class UserController extends Controller
{
    function displayOrsearch(Request $req){
        // $search = $req['search'] ?? "";
        // if($search != ""){
        //     $data = User::where('name', 'LIKE', "%$search%")->get();
        // }else{
        // }
        
        $users = User::all();
        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        return view('layouts.pages.user-app', compact('users', 'data'));
    }
    
    function create(Request $req){
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

    
    function update(Request $req, $id){
        
        $user = User::find($id);    
        $user->name = $req->name;
        $user->email = $req->email;
        $user->role = $req->role;

        if($req->hasfile('profile')){
            $image = $req->file('profile');
            $img_name = $image->getClientOriginalName();
            $image->move(public_path('images/upadated'),$img_name);   
            $user->profile = $img_name;
        }
        $user->save();

        return redirect('userinfo');
       }



    function updateordelete(Request $req){

       $id =$req->get('id');
       $name =$req->get('name');
       $email =$req->get('email');
       $profile =$req->get('profile');
       $role =$req->get('role');

       if($req->get('edit') == 'Edit'){
        return view('user.edit', ['id'=>$id, 'name'=>$name, 'email'=>$email, 'profile'=>$profile, 'role'=>$role]);
       }else{
            $dlt = User::find($id);
            $dlt->delete();
        }
        return redirect('userinfo');
    }


    function showcategory(Request $req){
            $data = category::all();
            return view('layouts.pages.category', ['users'=>$data]);
        }
        
        function addcategory(Request $req){
            $req->validate([
                'cat_title'=>'required',
            ]);
            
            $category = new category();
            $category->cat_title = $req->cat_title;
            $result = $category->save();
            
            if($result){
                return back()->with('success', 'Category Added!!!');
            }else{
                return back()->with('failed', 'Something Wrong!!!');
            }
            
        }
        
        function profileedit(Request $req){
            // return 'hi';
            $req->validate([
                'name'=>'required|',
                'profile'=>'mimes:jpeg,jpg,png',
           ]);

           $user = User::find($req->id);
           $user->name = $req->name;
           
            if($req->hasfile('profile')){
            $image = $req->file('profile');
            $img_name = $image->getClientOriginalName();
            $image->move(public_path('images/'),$img_name);   
            $user->profile = $img_name;
            }
            $user->update();

            return redirect('profile');
}

}
?>