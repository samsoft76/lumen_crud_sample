<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        //validate incoming request
        
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        // do login
        if (! $token = Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * change user password.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        try {
            if ( Hash::check($request->oldpassword, \auth()->user()->getAuthPassword()) ) {
                User::query()
                    ->where('id', \auth()->user()->id)
                    ->update(['password' => Hash::make($request->newpassword)]);
                return response()->json(['message' => 'success'], 201);
            } else {
                return response()->json(['message' => 'password lama tidak valid'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    /**
     * Get user details.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken()
    {
        return $this->respondWithToken(Auth::guard()->refresh());

    }

    /**
     * Send password reset link
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPassword(Request $request)
    {
        //
    }

    /**
     * reset user password.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        //
    }

    /**
     * End JWT session.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        if( auth()->user() !== null ) {
            Auth::logout();
        }

        return response()->json(['message' => 'logged out'], 200);
    }
}