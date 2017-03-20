<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\POST(
     *   path="/auth/login",
     *   summary="Login",
     *   produces={"application/json"},
     *     @SWG\Parameter(
     *     in="formData",
     *     type="string",
     *     name="email",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/User")
     *   ),
     *     @SWG\Parameter(
     *     in="formData",
     *     type="string",
     *     name="password",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/User")
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="Returns a JWT token for authorization"
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="Not found User, Invalid password"
     *   ),
     *   @SWG\Response(
     *     response=422,
     *     description="Validation of formData failed"
     *   )
     * )
     */
    public function loginPost(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        try {
            if (!$token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], $e->getStatusCode());
        }

        return response()->json(compact('token'));
    }
}
