<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
public function show(Request $request)
{
$query = Student::query();


if ($request->has('search')) {
$search = $request->input('search');
$query->where('name', 'like', "%{$search}%")
->orWhere('email', 'like', "%{$search}%");
}

return response()->json($query->get());
}




public function update(Request $request, $id)
{
    try {
        $validate = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
            'gender' => 'sometimes|required|string|max:255',
            'mobile' => 'sometimes|required|string|max:255',
        ]);

        $user = Student::findOrFail($id);

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
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422); 
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Something went wrong',
            'error' => $e->getMessage()
        ], 500); 
    }
}


public function destroy($id)
{
$user = Student::findOrFail($id);
$user->delete();

return response()->json([
'message' => 'User deleted successfully'
], 200);
}

}
