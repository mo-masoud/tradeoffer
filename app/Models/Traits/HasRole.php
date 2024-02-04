<?php

namespace App\Models\Traits;

use App\Enums\RoleEnum;
use App\Models\Role;

trait HasRole
{
    public static function userRole(): Role
    {
        return Role::where('name', RoleEnum::User->value)->first();
    }

    public function assignRole(string $name): void
    {
        $role = Role::where('name', $name)->first();
        $this->role()->associate($role);
        $this->save();
    }

    public function role()
    {
        return $this->belongsTo(Role::class)->with('permissions');
    }

    public function scopeWhereRole($query, string $role)
    {
        return $query->whereHas('role', function ($query) use ($role) {
            $query->where('name', $role);
        });
    }

    public function hasPermission($permission)
    {
        return $this->role->permissions->contains('name', $permission);
    }

    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role->name, $roles);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(RoleEnum::Admin->value);
    }

    public function hasRole(string $role): bool
    {
        return $this->role?->name === $role;
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole(RoleEnum::SuperAdmin->value);
    }

    public function isUser(): bool
    {
        return $this->hasRole(RoleEnum::User->value);
    }
}
