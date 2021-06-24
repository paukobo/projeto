<?php

namespace App\Policies;

use App\Models\Carrinho;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarrinhoPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if($user->tipo == 'C'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return ($user->tipo=='C' || $user->tipo=='F' || auth()->check() );
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Carrinho  $carrinho
     * @return mixed
     */
    public function view(User $user, Carrinho $carrinho)
    {
        if($user->tipo == 'C' || $user->tipo == 'F'){
            return true;
        }
        return false;
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
     * @param  \App\Models\Carrinho  $carrinho
     * @return mixed
     */
    public function update(User $user, Carrinho $carrinho)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Carrinho  $carrinho
     * @return mixed
     */
    public function delete(User $user, Carrinho $carrinho)
    {
        return false;
    }

}
