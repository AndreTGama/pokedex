<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthServices
{
    /**
     * Registers a new user with the provided data.
     *
     * @param array $data An associative array containing user data to be registered.
     * @return User The newly created User instance.
     */
    public function register(array $data): User
    {
        return User::create($data);
    }

    /**
     * Handles the login process for a user.
     *
     * @param array $data An associative array containing the user's login credentials:
     *                    - 'email' (string): The email address of the user.
     *                    - 'password' (string): The password of the user.
     *
     * @throws \Illuminate\Validation\ValidationException If the provided credentials are incorrect.
     *
     * @return array An associative array containing:
     *               - 'user' (User): The authenticated user instance.
     *               - 'token' (string): The generated plain text authentication token.
     */
    public function login(array $data): array
    {
        $user = User::where('email', $data['email'])->first();

        if (! $user || ! password_verify($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    /**
     * Logs out the currently authenticated user by deleting all their authentication tokens.
     *
     * @throws \Exception If there is no authenticated user.
     * @return void
     */
    public function logout(): void
    {
        if (!auth()->user()) {
            throw new \Exception("Error Processing Request", 1);
        }

        auth()->user()->tokens()->delete();
    }

    /**
     * Retrieve the currently authenticated user.
     *
     * @throws \Exception If there is no authenticated user.
     *
     * @return User The authenticated user instance.
     */
    public function me(): User
    {
        if (!auth()->user()) {
            throw new \Exception("Error Processing Request", 1);
        }

        return auth()->user();
    }
}
