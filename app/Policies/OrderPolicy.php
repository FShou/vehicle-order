<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use RingleSoft\LaravelProcessApproval\Models\ProcessApprovalFlowStep;

class OrderPolicy
{




    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        $roleIds = ProcessApprovalFlowStep::all()->pluck('role_id');
        $roleNameUsed = Role::whereIn('id', $roleIds)->pluck('name')->toArray();
        return $user->hasRole('Admin') || $user->hasRole($roleNameUsed);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Order $order): bool
    {
        $roleIds = ProcessApprovalFlowStep::all()->pluck('role_id');
        $roleNameUsed = Role::whereIn('id', $roleIds)->pluck('name')->toArray();
        return $user->hasRole('Admin') || $user->hasRole($roleNameUsed);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Order $order): bool
    {
        //
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Order $order): bool
    {
        //
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Order $order): bool
    {
        //
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Order $order): bool
    {
        //
        return $user->hasRole('Admin');
    }
}
