<?php

namespace App\Enums;


use Illuminate\Support\Str;

enum RoleEnum: string
{
    case SuperAdmin = 'super_admin';
    case Admin = 'admin';
    case StoreManager = 'store_manager';
    case BranchManager = 'branch_manager';
    case DeliveryManger = 'delivery_manager';
    case DeliveryMan = 'delivery';
    case User = 'user';


    public function title()
    {
        return Str::of($this->value)->replace('_', ' ')->title();
    }
}
