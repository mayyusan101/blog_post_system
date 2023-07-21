<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //user login  and release token
    public function login(Request $request)
    {
        //email password
        $user = User::where('email', $request->email)->first();

        if (isset($user)) {
            if (Hash::check($request->password, $user->password)) {
                return response()->json([
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken
                ]);
            } else {
                return response()->json([
                    'error' => [
                        'code' => 400,
                        'message' => 'The crendential does not match',
                    ],
                ], 400);
            }
        } else {
            return response()->json([
                'error' => [
                    'code' => 404,
                    'message' => 'The email does not exit',
                ],
            ], 404);
        }
    }
    //register
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required | unique:App\Models\User,email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            $response = [
                'status' => '0',
                'error' => $validator->errors(),
            ];
            return response()->json([$response], 401);
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'role' => 'user'
        ];

        User::create($data);
        $user = User::where('email', $request->email)->first();
        return response()->json([
            'user' => $user,
            'token' => $user->createToken(time())->plainTextToken
        ]);
    }

    //check validation
    private function validationCheck($request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required | unique:App\Models\User,email',
            'password' => 'required',
        ])->validate();
        return $validator;
    }
}
