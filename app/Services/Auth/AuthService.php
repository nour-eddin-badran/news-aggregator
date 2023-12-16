<?php

namespace App\Services\Auth;

use App\Dto\RegisterInfoDto;
use App\Enums\GeneralEnum;
use App\Exceptions\UserException;
use App\Http\Resources\User as UserResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(RegisterInfoDto $registerInfo): array
    {
        return \DB::transaction(function () use ($registerInfo) {
            $user = User::whereEmail($registerInfo->getEmail())->first();

            if ($user) {
                throw new UserException(__('messages.email_already_existed'), GeneralEnum::ALREADY_REGISTERED, Response::HTTP_CONFLICT);
            }

            $user = User::create([
                'name' => $registerInfo->getName(),
                'email' => $registerInfo->getEmail(),
                'password' => Hash::make($registerInfo->getPassword())
            ]);

            return (new UserResource($user))->toArray(null);
        });
    }

    public function login(string $email, string $password)
    {
        $user = User::whereEmail(['email' => $email])->first();

        if (!$user) {
            throw new UserException(__('messages.email_not_registered'), GeneralEnum::NOT_REGISTERED, Response::HTTP_PRECONDITION_FAILED);
        }

        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            throw new UserException(__('messages.invalid_credentials'), GeneralEnum::INVALID_CREDENTIALS, Response::HTTP_UNAUTHORIZED);
        }

        $user->token = $this->generateAccessToken($user);

        return new UserResource($user);
    }

    private function generateAccessToken(User $user): string
    {
        // clear all previous tokens
        $user->tokens()->delete();

        return $user->createToken('token')->plainTextToken;
    }
}
