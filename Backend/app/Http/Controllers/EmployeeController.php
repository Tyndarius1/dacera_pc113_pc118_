<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
public function index(Request $request)
{
$query = Employee::query();

if ($request->has('search')) {
$search = $request->input('search');
$query->where('name', 'like', "%{$search}%")
->orWhere('email', 'like', "%{$search}%");
}

return response()->json($query->get());
}





public function update(Request $request, $id)
{
$validate = $request->validate([
'name' => 'sometimes|required|string|max:255',
'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
'password' => 'sometimes|required|string|min:8',
'gender' => 'sometimes|required|string|max:255',
'mobile' => 'sometimes|required|string|max:255',
]);

$user = Employee::findOrFail($id);

if (isset($validate['name'])) {
$user->name = $validate['name'];
}
if (isset($validate['email'])) {
$user->email = $validate['email'];
}
if (isset($validate['password'])) {
$user->password = Hash::make($validate['password']);
}
if (isset($validate['gender'])) {
$user->gender = $validate['gender'];
}
if (isset($validate['mobile'])) {
$user->mobile = $validate['mobile'];
}

$user->save();

return response()->json([
'message' => 'User updated successfully',
'user' => $user
], 200);
}


public function destroy($id)
{
$user = Employee::findOrFail($id);
$user->delete();

return response()->json([
'message' => 'User deleted successfully'
], 200);
}



}
