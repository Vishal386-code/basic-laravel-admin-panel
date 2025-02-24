<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index'); // View file for listing users
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select(['id', 'name', 'email', 'created_at']);
            dd($users);
            
            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    return '
                        <a href="' . route('admin.users.show', $user->id) . '" class="btn btn-sm btn-primary">View</a>
                        <button class="btn btn-sm btn-danger delete-user" data-id="' . $user->id . '">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
