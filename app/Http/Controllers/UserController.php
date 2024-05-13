<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(string $id)
    {
        return User::findOrFail($id);
    }

    public function index()
    {
        $users = DB::table('users')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->join('users_status', 'users.status_id', '=', 'users_status.id')
            ->select(
                'users.*',
                'departments.name as departments',
                'users_status.name as status'
                )
            ->get();
            // ->paginate();

        return response()->json($users);
    }

    public function create(){
        $users_status = DB::table("users_status")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();

        $departments = DB::table("departments")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();

        return response()->json([
            "users_status" => $users_status,
            "departments" => $departments,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'title' => 'required|unique:posts|max:255',
            // 'body' => 'required',
            'status_id' => 'required',
            'username' => 'required|unique:users,username',
            'name' => 'required',
            'email' => 'required|email',
            'department_id' => 'required',
            'password' => 'required|confirmed'
        ],[
            'status_id.required' => 'Nhap tinh trang',

            'username.required' => 'Nhap ten tai khoan',
            'username.unique' => 'Ten tai khoan da ton tai',

            'name.required' => 'Nhap ten',

            'email.required' => 'Nhap email',
            'email.email' => 'Email khong hop le',

            'department_id.required' => 'Nhap phong ban',

            'password.required' => 'Nhap mat khau',
            'password.confirmed' => 'Mat khau xac nhan khong khop',
        ]);

        $user = $request->except(["password", "password_confirmation"]);
        $user["password"] = \Hash::make($request["password"]);
        User::create($user);


        //Eloquent orm
        // User::create([
        //     "status_id" => $request["status_id"],
        //     "username" => $request["username"],
        //     "name" => $request["name"],
        //     "email" => $request["email"],
        //     "department_id" => $request["department_id"],
        //     "password" => \Hash::make($request["password"])
        // ]);

    }

    public function edit($id){
        $users = User::find($id);

        $users_status = DB::table("users_status")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();

        $departments = DB::table("departments")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();

        return response()->json([
            "users" => $users,
            "users_status" => $users_status,
            "departments" => $departments,
        ]);

    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            // 'title' => 'required|unique:posts|max:255',
            // 'body' => 'required',
            'status_id' => 'required',
            'username' => 'required|unique:users,username,'.$id,
            'name' => 'required',
            'email' => 'required|email',
            'department_id' => 'required',
        ],[
            'status_id.required' => 'Nhap tinh trang',

            'username.required' => 'Nhap ten tai khoan',
            'username.unique' => 'Ten tai khoan da ton tai',

            'name.required' => 'Nhap ten',

            'email.required' => 'Nhap email',
            'email.email' => 'Email khong hop le',

            'department_id.required' => 'Nhap phong ban',
        ]);

        if($request["change_password"] == true){
            $validated = $request->validate([
                'password' => 'required|confirmed'
            ],[
                'password.required' => 'Nhap mat khau',
                'password.confirmed' => 'Mat khau xac nhan khong khop'
            ]);
        }
    }
}
