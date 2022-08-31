<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string|max:25',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6|max:25|regex:/[#$%^&*()+=!?¿.,:;]/i',
                ]
            );

            if ($validator->fails()) {
                return response()->json(

                    [
                        'success' => false,
                        'message' => $validator->errors()
                    ],
                    400
                );
            }

            $user = User::create(
                [
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'password' => bcrypt($request->password),
                    'address' => $request->get('address'),
                    'phoneNumber' => $request->get('phoneNumber'),
                    'apellido' => $request->get('apellido'),
                    'segundoApellido' => $request->get('segundoApellido'),
                ]
            );

            $user->roles()->attach(1);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'usuario creado',
                    'data' => $user
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error('error al crear usuario' . $exception->getMessage());
            return response()->json(
                [
                    'seccess' => false,
                    'message' => 'error al crear nuevo usuario'
                ],
                404
            );
        }
    }
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json(
                [
                    'succes' => false,
                    'message' => 'registro erroneo'
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }
        return response()->json(
            [
                'succes' => true,
                'token' => $jwt_token,
            ]
        );
    }
    public function logout(Request $request)
    {
        try {
            $this->validate(
                $request,
                [
                    'token' => 'require'
                ]
            );
            JWTAuth::invalidate($request->token);
            return response()->json(
                [
                    'success' => true,
                    'token' => 'te has podido desloguear'
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'No puedes desloguearte por no estar registrado'
                ],
                404
            );
        }
    }
    public function profile()
    {
        return response()->json(
            [
                "success" => true,
                "data" => auth()->user()
            ]
        );
    }
    public function update(Request $request, $id)
    {

        try {
            $user = User::query()->find($id);

            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');

            if (isset($name)) {
                $user->name = $name;
            };

            if (isset($email)) {
                $user->email = $email;
            };

            if (isset($password)) {
                $user->password = bcrypt($password);
            };

            $user->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'you have modifcate your profile successfully',
                    'name' => $name,
                    'email' => $email
                ],
                200
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'You cant modify you profile'
                ],
                404
            );
        }
    }
    const USER_ROLE = 1;
    const ADMIN_ROLE = 2;

    public function addAdmin($id)
    {
        try {
            $user = User::query()->find($id);

            $user->roles()->attach(self::ADMIN_ROLE);

            return response()->json([
                'success' => true,
                'message' => "Rol Admin activated"
            ]);
        } catch (\Exception $exception) {
            Log::error('Error change rol' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error to change rol'
                ],
                404
            );
        };
    }
}
