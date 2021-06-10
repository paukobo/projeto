<?php

namespace App\Policies;

use App\Models\Encomenda;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EncomendaPolicy
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
        if($user->tipo=='A'){
            return ($user->tipo=='F' || $user->tipo=='A');
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Encomenda  $encomenda
     * @return mixed
     */
    public function view(User $user, Encomenda $encomenda)
    {
        if($user->tipo=='A'){
            return ($user->tipo=='F' || $user->tipo=='A' || $user->id);
        }elseif($user->tipo=='F'){
            return $user->id;
        }
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
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Encomenda  $encomenda
     * @return mixed
     */
    public function update(User $user, Encomenda $encomenda)
    {
        return $user->id == (auth()->user()->tipo == 'F' || auth()->user()->tipo == 'A');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Encomenda  $encomenda
     * @return mixed
     */
    public function delete(User $user, Encomenda $encomenda)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Encomenda  $encomenda
     * @return mixed
     */
    public function restore(User $user, Encomenda $encomenda)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Encomenda  $encomenda
     * @return mixed
     */
    public function forceDelete(User $user, Encomenda $encomenda)
    {
        //
    }
}
