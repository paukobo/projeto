<?php

namespace App\Policies;

use App\Carrinho;
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
<<<<<<< HEAD
        return $user->tipo == 'C';
=======
        return ($user->tipo=='C' || $user->tipo=='F');
>>>>>>> parent of e0c9297 (Merge branch 'main' of https://github.com/paukobo/projeto into main)
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
        return false;
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
        return false;
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
