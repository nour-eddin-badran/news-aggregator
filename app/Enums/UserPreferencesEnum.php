<?php

namespace App\Enums;

enum UserPreferencesEnum: string
{
    case SOURCES = 'sources';
    case CATEGORIES = 'categories';
    case AUTHORS = 'authors';
}
