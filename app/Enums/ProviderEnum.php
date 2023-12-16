<?php

namespace App\Enums;

enum ProviderEnum: string
{
    case NEWS_API_ORG = 'NewsAPI.org';
    case NEW_YORK_TIMES = 'New York Times';
    case THE_GUARDIAN = 'The Guardian';
}
