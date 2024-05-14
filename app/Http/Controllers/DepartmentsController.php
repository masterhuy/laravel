<?php

namespace App\Http\Controllers;
use App\Models\Departments;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function show(string $id)
    {
        return User::findOrFail($id);
    }

    public function index()
    {
        $departments = Departments::all();
            // ->paginate();

        return response()->json($departments);
    }

    public function create(){
        return "ok";
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Please enter department name',
        ]);

        // $user = $request->except(["password", "password_confirmation"]);
        // $user["password"] = \Hash::make($request["password"]);
        // User::create($user);


        // Eloquent orm
        Departments::create([
            "name" => $request["name"],
        ]);

    }

    public function edit($id){
        $departments = Departments::find($id);

        return response()->json([
            "users" => $departments
        ]);

    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Please enter department name',
        ]);

        Departments::find($id)->update([
            'name' => $request['name'],
        ]);
    }

    public function destroy($id){
        Departments::find($id)->delete();
    }
}
