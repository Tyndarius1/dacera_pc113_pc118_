<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

public function login(Request $request)
{
$validate = $request->validate([
'email' => 'required|string|email',
'password' => 'required|string',
]);

$user = User::where('email', $validate['email'])->first();

if (!$user || !Hash::check($validate['password'], $user->password)) {
return response()->json([
'message' => 'Invalid email or password'
], 401);
}

$token = $user->createToken('auth_token')->plainTextToken;

return response()->json([
'message' => 'Login successful',
'user' => $user,
'role' => $user->role,
'token' => $token,
], 200);
}




public function logout(Request $request)
{

$request->user()->tokens()->delete();

return response()->json([
'message' => 'Logout successful'
], 200);
}




//CRUD





// Get All Users

public function index(Request $request)
{
    $role = $request->query('role'); 

    if ($role) {
        $users = User::where('role', $role)->get(); 
    } else {
        $users = User::all();
    }

    return response()->json($users);
}





// Get User by ID
public function show($id)
{
$user = User::find($id);
if (!$user) {
return response()->json(['message' => 'User not found'], 404);
}
return response()->json($user, 200);
}










public function register(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|string',
        'middle_name' => 'required|string',
        'last_name' => 'required|string',
        'address' => 'required|string',
        'age' => 'required|string',
        'contact_number' => 'required|string',
        'gender' => 'required|string',
        'status' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:3',
        
    ]);

    try {
      
        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'age' => $request->age,
            'gender' => $request->gender,
            'status' => $request->status,
            'email' => $request->email,
            'password' => bcrypt($request->password),
           
        ]);
        return response()->json(['message' => 'User registered successfully!'], 201);
    } catch (\Exception $e) {
       
        return response()->json(['message' => 'Registration failed', 'error' => $e->getMessage()], 500);
    }
}









// Update Users
public function update(Request $request, $id = null)
{
$user = Auth::user(); 

if (!$user) {
return response()->json(['message' => 'Unauthorized'], 401);
}


if (!$id) {
if (!$user instanceof User) {
return response()->json(['message' => 'User not found'], 404);
}

$user->update($request->except('role'));
return response()->json([
'message' => 'Profile updated successfully',
'user' => $user
], 200);
}


if ($user->role !== 'admin') {
return response()->json(['message' => 'Unauthorized'], 403);
}

$targetUser = User::find($id);

if (!$targetUser || !$targetUser instanceof User) {
return response()->json(['message' => 'User not found'], 404);
}


if ($request->has('role') && in_array($request->role, ['student', 'employee'])) {
$targetUser->role = $request->role;
}


$targetUser->update($request->except('role'));

return response()->json([
'message' => 'User updated successfully',
'user' => $targetUser
], 200);
}








// Delete User
public function destroy(Request $request, $id = null)
{
$user = Auth::user();

if (!$user) {
return response()->json(['message' => 'Unauthorized'], 403);
}


if ($user->role === 'admin' && $id !== null) {
$userToDelete = User::find($id);

if (!$userToDelete) {
return response()->json(['message' => 'User not found'], 404);
}


if (method_exists($userToDelete, 'tokens')) {
$userToDelete->tokens()->delete();
}


$userToDelete->delete();

return response()->json(['message' => 'User deleted successfully'], 200);
}


if ($id === null || $id == $user->id) {
if (method_exists($user, 'tokens')) {
$user->tokens()->delete();
}

$user->delete();

return response()->json(['message' => 'Your account has been deleted successfully', 'user' => $user], 200);
}

return response()->json(['message' => 'Unauthorized' ], 403);
}







}
