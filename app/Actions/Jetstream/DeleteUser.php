<?php

namespace App\Actions\Jetstream;

use App\Models\Customer;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user (customer).
     */
    public function delete(Customer $user): void
    {
        $user->tokens()->delete();
        $user->delete();
    }
}
