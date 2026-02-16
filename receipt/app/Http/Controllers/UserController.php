<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 25); // default 25
        $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 25;

        $users = User::paginate($perPage)->withQueryString();

        return view('users.index', compact('users', 'perPage'));
    }
}
