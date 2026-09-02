<?php

namespace App\Enums;

enum UserStatus : string
{
    case User = 'user';
    case Admin = 'admin';
}
