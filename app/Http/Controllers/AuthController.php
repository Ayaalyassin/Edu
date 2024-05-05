<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\GeneralTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    use GeneralTrait;

    private $uploadPath = "assets/images/users";

<<<<<<< HEAD
=======

>>>>>>> origin/khader
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $token = JWTAuth::attempt($credentials);

<<<<<<< HEAD
        if (!$token)
            return $this->returnError('token Not found', 400);
=======
        $exist=User::where('email',$request->email)->first();
        if($exist && !$token)
            return $this->returnError(400,'The password is wrong');

        if (!$token)
            return $this->returnError(400,'Account Not found');
>>>>>>> origin/khader

        $user = auth()->user();
        $user->token = $token;
        $user->loadMissing(['roles']);

        return $this->returnData($user, 'operation completed successfully');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $existingUser = User::where('google_id', $user->id)->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->google_id = $user->id;
            $newUser->password = bcrypt(request(Str::random()));
            $newUser->save();

            auth()->login($newUser, true);
        }

        return $this->returnData($user, 'operation completed successfully');
    }



    public function login_admin(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $token = JWTAuth::attempt($credentials);

        if (!$token)
            return $this->returnError("", 'Unauthorized');

        $user = auth()->user();
        $user->token = $token;

        return $this->returnData($user, 'operation completed successfully');
    }

    public function register(RegisterRequest $request)
    {
        $image = null;
        if (isset($request->image)) {
            $image = $this->saveImage($request->image, $this->uploadPath);
<<<<<<< HEAD
        } else {
            return $this->returnError('the image not found', 404);
=======
>>>>>>> origin/khader
        }
        $user = User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'password'       => $request->password,
            'address'         => $request->address,
            'governorate'    => $request->governorate,
            'birth_date'     => $request->birth_date,
            'image'          => $image,
        ]);

        $credentials = ['email' => $user->email, 'password' => $request->password];
        $token = JWTAuth::attempt($credentials);
        $user->token = $token;

        $role = Role::where('id', '=', $request->role_id)->first();
<<<<<<< HEAD
=======
        if(!$role)
            return $this->returnError(400,'Role Not found');
>>>>>>> origin/khader
        $user->assignRole($role);
        $user->loadMissing(['roles']);
        if (!$token)
            return $this->returnError(501, 'Unauthorized');
        $wallet = Wallet::create([
            'user_id' => $user->id,
            'number' => random_int(1000000000000, 9000000000000),
            'value' => 0,
        ]);
        return $this->returnData($user, 'operation completed successfully');
    }


    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        if ($token) {
            try {
                JWTAuth::setToken($token)->invalidate();
                return $this->returnError("", 'Logged out successfully');
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return $this->returnError("", 'some thing went wrongs');
            }
        } else {
            return $this->returnError("", 'some thing went wrongs');
        }
    }
}
