<?php

namespace App\Enums;


use Illuminate\Support\Str;

enum RoleEnum: string
{
    case User = 'user';
    case Admin = 'admin';
    case SuperAdmin = 'super_admin';
    case StoreManager = 'store_manager';

    public function title()
    {
        return Str::of($this->value)->replace('_', ' ')->title();
    }
}
