<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ReturnMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\StoreRequest;
use App\Services\Auth\AuthServices;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected $authService;

    /**
     * AuthController constructor.
     *
     * Initializes the AuthController with the provided AuthServices instance.
     *
     * @param AuthServices $authService The authentication service used for handling authentication logic.
     */
    public function __construct(AuthServices $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handles the registration of a new user.
     *
     * @param StoreRequest $request The validated request containing user registration data.
     * 
     * @return \Illuminate\Http\JsonResponse A JSON response indicating success or failure.
     * 
     * @throws \Exception If an error occurs during the registration process.
     */
    public function register(StoreRequest $request) : JsonResponse
    {
        try {
            $user = $this->authService->register($request->validated());
            return ReturnMessage::success('User registered successfully', $user->toArray(), 201);
        } catch (\Exception $e) {
            return ReturnMessage::error('Error', $e->getMessage(), [], 500);
        }
    }

    /**
     * Handles the login process for a user.
     *
     * @param LoginRequest $request The validated login request containing user credentials.
     * 
     * @return JsonResponse A JSON response indicating the success or failure of the login attempt.
     * 
     * @throws \Exception If an error occurs during the login process.
     */
    public function login(LoginRequest $request) : JsonResponse
    {
        try {
            $user = $this->authService->login($request->validated());
            return ReturnMessage::success('User logged in successfully', $user, 200);
        } catch (\Exception $e) {
            return ReturnMessage::error('Error', $e->getMessage(), [], 500);
        }
    }

    /**
     * Logs out the authenticated user by revoking all their tokens.
     *
     * @return JsonResponse A JSON response indicating the success or failure of the logout operation.
     *
     * @throws \Exception If an error occurs during the token deletion process.
     */
    public function logout() : JsonResponse
    {
        try {
            $this->authService->logout();
            return ReturnMessage::success('User logged out successfully', [], 200);
        } catch (\Exception $e) {
            return ReturnMessage::error('Error', $e->getMessage(), [], 500);
        }
    }

    /**
     * Retrieve the authenticated user's data.
     *
     * This method attempts to fetch the currently authenticated user's data
     * and return it in a JSON response. If an exception occurs during the
     * process, an error response is returned instead.
     *
     * @return \Illuminate\Http\JsonResponse
     * 
     * @throws \Exception If an error occurs while retrieving the user data.
     */
    public function me() : JsonResponse
    {
        try {
            $user = $this->authService->me();
            return ReturnMessage::success('User data retrieved successfully', $user->toArray(), 200);
        } catch (\Exception $e) {
            return ReturnMessage::error('Error', $e->getMessage(), [], 500);
        }
    }
}
