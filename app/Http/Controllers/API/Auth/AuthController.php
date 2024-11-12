<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $success['user']  = $auth;
            $success['token'] = $auth->createToken('LaravelSanctumAuth')->plainTextToken;

            return $this->handleResponse($success, 'User logged-in!');
        } else {
            return $this->handleError(['inactive' => ["Email ID and Password do not match."]], [], 200);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return $this->handleResponse(true, 'Logged out successfully');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'c_password' => 'required|same:password',
        ]);

        $profileImage = null;

        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image')->store('profile_images', 'public');
        }

        $role = Role::where('name', 'user')->first();

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'profile_image' => $profileImage,
            'role_id' => $role->id,
        ]);

        $success['token']  = $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['name']   = $user->first_name . '' . $user->last_name;

        return $this->handleResponse($success, 'User successfully registered!');
    }


    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }

        $user = User::where('email_verification_code', $request->reset_password_token)->first();

        if (!$user) {
            return $this->handleError(['invalid_request' => ["Invalid reset password request"]], [], 200);
        }

        if ($user->email_expire_at < now()) {
            return $this->handleError(['invalid_request' => ["Your reset password email is expired. Please sent another reset request."]], [], 200);
        }

        $user->update([
            'password'                => bcrypt($request->password),
            'email_verification_code' => null,
        ]);

        return $this->handleResponse(['user' => $user], 'Password restored successfully. Please login with new password.');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password'     => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return $this->handleError(['incorrect_password' => ["Passord does not match to our records"]], [], 200);
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return $this->handleResponse(['user' => $user], 'Password saved successfully');
    }
}
