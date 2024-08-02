<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users=User::all();
        return view('admin.list_user',compact('users'));
    }
    public function toggleActive(User $user)
    {
        $user->active=!$user->active;
        $user->save();
        return redirect()->route('list_user')->with('mes','tài khaonr đã được cập nhật'); 
    }
}
