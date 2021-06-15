<?php

namespace App\Policies;

use App\Models\Tshirt;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TshirtPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->tipo == 'A' || $user->tipo == 'C';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tshirt  $tshirt
     * @return mixed
     */
    public function view(User $user, Tshirt $tshirt)
    {
        return $user->tipo=='A' || $user->tipo == 'C';
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->tipo == 'C'){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tshirt  $tshirt
     * @return mixed
     */
    public function update(User $user, Tshirt $tshirt)
    {
        return ($user->tipo=='A' ||  $user->tipo=='F');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tshirt  $tshirt
     * @return mixed
     */
    public function delete(User $user, Tshirt $tshirt)
    {
        return false;
    }
}
