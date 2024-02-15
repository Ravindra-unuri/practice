<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Jobs\MailSentJob;



class AuthController extends Controller
{

    public function registration(Request $request)
    {
        // $request->validate([

        // ]);
        $data = validator::make($request->all(), [
            'name' => 'required|string|min:3|max:25',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);
        // if ($request->validate([
        //     'name' => 'required|string|min:3|max:25',
        //     'email' => 'required|email',
        //     'password' => 'required|string|confirmed|min:8',
        // ])) {
        // Validation passed 

        // Check if user with the given email already exists
        if (User::where('email', $request->input('email'))->first()) {
            return response([
                'message' => 'Requested User Already Registered',
                'status' => 'fail'
            ], 401);
        } else {
            // User with the given email does not exist, create a new user
            $data=User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'), // Make sure to hash the password
            ]);
            // MailSentJob::dispatch($data);
            // MailSentJob::dispatch($data->toArray())->onQueue('high');
            dispatch(new MailSentJob($data));

            // dd('ok');
            // return response([
            //     'message' => 'User Registered Successfully',
            //     'status' => 'success'
            // ], 200);
            // }
            // } else {
            //     // Validation failed
            //     return response([
            //         'message' => 'Validation failed',
            //         'status' => 'fail'
            //     ], 422);
            // }
            // dispatch(new MailSentJob($request));
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user && $request->password == $user->password) {
            $token = $user->createToken($request->email)->plainTextToken;
            return response([
                'token' => $token,
                'messsage' => 'Login successfull',
                'status' => 'success'
            ], 200);
        }
        return response([
            'messsage' => 'Unauthorized User',
            'status' => 'failed'
        ], 401);
    }

    public function get(Request $request)
    {
        $search = $request->input('name');

        if ($search) {
            $users = User::where('name', 'LIKE', '%' . $search . '%')->get();

            if ($users->isNotEmpty()) {
                return response([
                    'message' => 'User with the specified name found',
                    'status' => 'success',
                    'data' => $users
                ], 200);
            }

            return response([
                'message' => 'No user found with the specified name',
                'status' => 'failed'
            ], 404);
        } else {
            $users = User::all();

            if ($users->isNotEmpty()) {
                return response([
                    'message' => 'Users available at our site',
                    'status' => 'success',
                    'data' => $users
                ], 200);
            }

            return response([
                'message' => 'There are no users available',
                'status' => 'failed'
            ], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'name' => 'required|string|min:3|max:25',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        if ($validator) {
            $user = User::find($id);

            if (!$user) {
                return response([
                    'message' => 'User not found',
                    'status' => 'failed',
                ], 404);
            }

            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);

            return response([
                'message' => 'The user updated successfully',
                'status' => 'success',
            ], 200);
        } else {
            // Validation failed
            return response([
                'message' => 'Validation failed',
                'status' => 'fail',
            ], 422);
        }
    }
    public function delete(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response([
                "message" => "The user you want to delete is not present",
                "status" => "failed"
            ], 404);
        } else {
            $user->delete();
            return response([
                "message" => "User deleted successfully",
                "status" => "success"
            ], 200);
        }
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'messsage' => 'User logout successfull',
            'status' => 'success'
        ], 200);
    }

    public function profile()
    {
        $data = auth()->user();
        return response([
            'messsage' => 'Profile',
            'status' => 'success',
            'message' => 'Branch Checking',
            'data' => $data
        ], 200);
    }
}
