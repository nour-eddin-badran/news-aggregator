<?php

namespace App\Services\User;

use App\Enums\UserPreferencesEnum;
use App\Models\UserPreference;

class UserPreferencesService
{
    public function getSources(): ?UserPreference
    {
        return authUser()->preferences->where('key', UserPreferencesEnum::SOURCES->value)->first();
    }

    public function getCategories(): ?UserPreference
    {
        return authUser()->preferences->where('key', UserPreferencesEnum::CATEGORIES->value)->first();
    }

    public function getAuthors(): ?UserPreference
    {
        return authUser()->preferences->where('key', UserPreferencesEnum::AUTHORS->value)->first();
    }
}
