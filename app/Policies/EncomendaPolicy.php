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
        return $user->tipo == 'A';
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
        if ($user->tipo=='F'){
            if ($encomenda->estado == 'paga' || $encomenda->estado == 'pendente'){
                return true;
            }
        }
        return ($user->tipo=='A' || $user->id==$encomenda->cliente_id);
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
        if ($user->tipo=='F'){
            if ($encomenda->estado == 'paga' || $encomenda->estado == 'pendente'){
                return true;
            }
        }
        return ($user->tipo=='A' || $user->id==$encomenda->cliente_id);
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
}
