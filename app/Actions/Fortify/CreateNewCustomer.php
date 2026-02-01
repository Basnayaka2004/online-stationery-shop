<?php

namespace App\Actions\Fortify;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewCustomer implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered customer.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): Customer
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $username = \Illuminate\Support\Str::slug($input['name']) . '_' . substr(uniqid(), -4);
        while (Customer::where('username', $username)->exists()) {
            $username = \Illuminate\Support\Str::slug($input['name']) . '_' . substr(uniqid(), -4);
        }

        return Customer::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'username' => $username,
            'password' => Hash::make($input['password']),
        ]);
    }
}
