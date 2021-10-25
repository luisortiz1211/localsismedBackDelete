<?php

namespace App\Http\Controllers;

use App\User;
use App\Medic;
use App\Assistent;
use App\Admin;

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\Exceptions\JWTException;



class UserController extends Controller
{
    public static $rules = [
        'name' => 'nullable|string',
        'lastName' => 'nullable|string',
        'email' => 'required|unique:users|e-mail',
        'ci' => 'required|unique:users',
        'password' => 'nullable|confirmed',
        'availableStatus' => 'nullable|boolean',
        'roleUser' => 'nullable|string',
    ];

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!($token = JWTAuth::attempt($credentials))) {
                return response()->json(
                    ['message' => 'invalid_credentials'],
                    400
                );
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'could_not_create_token'], 500);
        }
        //return response()->json(compact('token'));
        $user = JWTAuth::user();
        return response()
            ->json(compact('token', 'user'))
            ->withCookie(
                'token',
                $token,
                config('jwt.ttl'), // ttl => time to live
                '/', // path
                null, // domain
                config('app.env') !== 'local', // secure
                true, // httpOnly
                false,
                config('app.env') !== 'local' ? 'None' : 'Lax' // SameSite
            );
    }
    public function register(Request $request)
    {
        $this->authorize('create', User::class);
        
        //$validator = Validator::make($request->all(), [
        $request->validate([
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'availableStatus' => 'required|boolean',
            'roleUser' => 'required|string|max:20',
        ]);
        
        if ($request->roleUser == User::ROLE_MEDIC) {

            $userable = Medic::create([
                'ci' => $request->get('ci'),
                'employment' => $request->get('employment'),
            ]);
        } else if ($request->roleUser == User::ROLE_ASSISTENT){
            $userable = Assistent::create([
                'ci' => $request->get('ci'),
                'employment' => $request->get('employment'),
            ]);
        }else{
            $userable = Admin::create([
                'ci' => $request->get('ci'),
                'employment' => $request->get('employment'),
            ]);
        }
        $user = $userable->user()->create([
            'name' => $request->get('name'),
            'lastName' => $request->get('lastName'),
            'availableStatus' =>$request->get('availableStatus'),
            'roleUser' => $request->get('roleUser'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),]);

            $token = JWTAuth::fromUser($user);
            return response()->json(new UserResource($user, $token), 201)
            ->withCookie(
                'token',
                $token,
                config('jwt.ttl'),
                '/',
                null,
                config('app.env') !== 'local',
                true,
                false,
                config('app.env') !== 'local' ? 'None' : 'Lax'
            );
        {/*$value = $request->input('roleUser');
        //$value = $request->query('roleUser');
        //https://laravel.com/docs/8.x/requests
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        if ('ROLE_ASSISTENT' == $value )
            {
                $assistent = Assistent::create([
                    'ci' => $request->get('ci'),
                    'employment' => $request->get('employment'),
                ]);

                $assistent->user()->create([
                    'name' => $request->get('name'),
                    'lastName' => $request->get('lastName'),
                    'email' => $request->get('email'),
                    'password' => Hash::make($request->get('password')),
                    'availableStatus' => $request->get('availableStatus'),
                    'roleUser' => $request->get('roleUser'),
                ]);

                $user = $assistent->user;
                $token = JWTAuth::fromUser($assistent->user);

            }else if( 'ROLE_MEDIC'==$value)
                {
                 $medic = Medic::create([
                    'ci' => $request->get('ci'),
                    'employment' => $request->get('employment'),
                 ]);

                 $medic->user()->create([
                    'name' => $request->get('name'),
                    'lastName' => $request->get('lastName'),
                    'email' => $request->get('email'),
                    'password' => Hash::make($request->get('password')),
                    'availableStatus' => $request->get('availableStatus'),
                    'roleUser' => $request->get('roleUser'),
                 ]);

                    $user=$medic->user;
                    $token = JWTAuth::fromUser($medic->user);
                }

                return response()
                ->json(new UserResource($user, $token), 201)
            ->withCookie(
                'token',
                $token,
                config('jwt.ttl'), // ttl => time to live
                '/', // path
                null, // domain
                config('app.env') !== 'local', // secure
                true, // httpOnly
                false,
                config('app.env') !== 'local' ? 'None' : 'Lax' // SameSite
           );*/}

    }
    public function getAuthenticatedUser()
    {
        try {
            if (!($user = JWTAuth::parseToken()->authenticate())) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        //return response()->json(compact('user'));
        return response()->json(new UserResource($user),200);
        
    }
    //Mostrar los datos de todos los usuarios
    public function index()
    {
        //$this->authorize('view', $user);
        return response()->json(UserResource::collection(User::all()), 200);
       // return new UserCollection(User::paginate(10));
    }
    // Mostrar los datos de un usuario
    public function show(User $user)
    {
        //$this->authorize('view',$user);
        return response()->json(new UserResource($user), 200);
    }
    // Actualizar
    public function update(Request $request, User $user)
    {
        /* $this->authorize('update', $user);
        $user = Auth::user();
         */$request->validate(self::$rules);
        $user->update($request->all());
        return response()->json($user, 200);
    }
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'User successfully logged out.',
                ],
                200
            )->withCookie(
                'token',
                null,
                config('jwt.ttl'),
                '/',
                null,
                config('app.env') !== 'local',
                true,
                false,
                config('app.env') !== 'local' ? 'None' : 'Lax'
            );
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(
                ['message' => 'No se pudo cerrar la sesión.'],
                500
            );
        }
    }
}
