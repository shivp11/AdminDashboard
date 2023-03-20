<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;



class UserController extends Controller
{
    function displayOrsearch(Request $req)
    {
        $users = User::all();
        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        return view('layouts.pages.user-app', compact('users', 'data'));
    }

    function create(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'role' => 'required',
            'profile' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:12',
        ]);

        $image = $req->profile;
        $img_name = $image->getClientOriginalName();
        $image->move(public_path('images'), $img_name);

        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->role = $req->role;
        $user->profile = $img_name;
        $user->password = Hash::make($req->password);
        $result = $user->save();

        if ($result) {
            return back()->with('success', 'You have registered successfuly!!!');
        } else {
            return back()->with('failed', 'Something Wrong!!!');
        }
    }

    function updates(Request $req, $id)
    {
        $req->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find($id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->role = $req->role;

        if ($req->hasfile('profile')) {
            $image = $req->file('profile');
            $img_name = $image->getClientOriginalName();
            $image->move(public_path('images/'), $img_name);
            $user->profile = $img_name;
        }
        $result = $user->save();

        if ($result) {
            return redirect('userinfo')->with('success', 'User Upadated');
        } else {
            return redirect('userinfo')->with('failed', 'Something Wrong!!!');
        }
    }
    function delete(Request $req, $id)
    {

        $user = User::where("id", '=', $id)->first();
        echo $user;
        $result = $user->delete();
        if ($result) {
            return back()->with('success', 'User Deleted');
        } else {
            return redirect('userinfo')->with('failed', 'Something Wrong!!!');
        }
    }


    function showcategory(Request $req)
    {
        $data = category::all();
        return view('layouts.pages.category', ['users' => $data]);
    }

    function addcategory(Request $req)
    {
        $req->validate([
            'cat_title' => 'required',
        ]);

        $category = new category();
        $category->cat_title = $req->cat_title;
        $result = $category->save();

        if ($result) {
            return back()->with('success', 'Category Added!!!');
        } else {
            return back()->with('failed', 'Something Wrong!!!');
        }
    }

    function profileedit(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $result = $user->save();
        if ($result) {
            return redirect('profile')->with('success', 'Updated!!!');
        } else {
            return redirect('profile')->with('failed', 'Something Wrong!!!');
        }
    }

    function crop(Request $request)
    {
        $path = 'images/';
        if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777, true);
        }
        $file = $request->file('_userAvatarFile');
        $new_image_name = 'UIMG' . date('Ymd') . uniqid() . '.jpg';
        $upload = $file->move(public_path($path), $new_image_name);
        if (!$upload) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
        } else {
            $userInfo = User::where('id', '=', Session()->get('loginId'))->first();
            $userPhoto = $userInfo->profile;
            if ($userPhoto != '') {
                unlink($path . $userPhoto);
            }
            User::where('id', '=', Session()->get('loginId'))->update(['profile' => $new_image_name]);
            return response()->json(['status' => 1, 'msg' => 'Image has been cropped successfully.', 'name' => $new_image_name]);
        }
    }

    function userinfocrop(Request $request)
    {
        $path = 'images/';
        if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777, true);
        }
        $file = $request->file('_userAvatarFile');
        $new_image_name = 'UIMG' . date('Ymd') . uniqid() . '.jpg';
        $upload = $file->move(public_path($path), $new_image_name);
        if (!$upload) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
        } else {
            $userInfo = User::where('id', '=', Session()->get('loginId'))->first();
            $userPhoto = $userInfo->profile;
            if ($userPhoto != '') {
                unlink($path . $userPhoto);
            }
            User::where('id', '=', Session()->get('loginId'))->update(['profile' => $new_image_name]);
            return response()->json(['status' => 1, 'msg' => 'Image has been cropped successfully.', 'name' => $new_image_name]);
        }
    }
}
