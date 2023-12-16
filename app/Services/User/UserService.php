<?php

namespace App\Services\User;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Dto\UserPreferencesDto;
use App\Enums\UserPreferencesEnum;
use App\Models\UserPreference;
use App\Http\Resources\UserPreference as UserPreferenceResource;

class UserService
{
    public function refreshPreferences(UserPreferencesDto $preferencesDto): void
    {
        UserPreference::updateOrCreate([
            'user_id' => authUser()->id,
            'key' => UserPreferencesEnum::SOURCES->value,
        ], [
            'value' => $preferencesDto->getSources()
        ]);

        UserPreference::updateOrCreate([
            'user_id' => authUser()->id,
            'key' => UserPreferencesEnum::CATEGORIES->value,
        ], [
            'value' => $preferencesDto->getCategories()
        ]);

        UserPreference::updateOrCreate([
            'user_id' => authUser()->id,
            'key' => UserPreferencesEnum::AUTHORS->value,
        ], [
            'value' => $preferencesDto->getAuthors()
        ]);
    }

    public function getMyPreferences(): AnonymousResourceCollection
    {
        return UserPreferenceResource::collection(authUser()->preferences);
    }
}
