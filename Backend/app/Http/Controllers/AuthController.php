<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

public function read(Request $request)
{
$query = User::query();

if ($request->has('search')) {
$search = $request->input('search');
$query->where('name', 'like', "%{$search}%")
->orWhere('email', 'like', "%{$search}%");
}

return response()->json($query->get());
}


public function register(Request $request)
    {
       
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3',
        ]);

      
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        
        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

public function update(Request $request)
    {
        $user = $request->user(); 
    
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:3',
        ]);
    

        $validatedData['password'] = isset($validatedData['password']) ? Hash::make($validatedData['password']) : $user->password;
    
        $user->update($validatedData); 
    
        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }


    public function destroy(Request $request)
    {
        $user = $request->user();

        $user->tokens()->delete();
        $user->delete();

        return response()->json(['message' => 'User deleted successfully', 'user' => $user], 200);
    }
}
