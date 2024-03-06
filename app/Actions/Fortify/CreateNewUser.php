<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'lastname' => ['required', 'string', 'max:255'],
            'identification' => ['required', 'string', 'max:255', 'unique:users'],
            'birthdate' => ['required', 'date'],
            'birthday_place'=> ['string','max:255'],
            'sex' => ['required', 'string', 'max:255', 'in:M,F'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'civil_status' => ['required', 'string', 'max:255', 'in:soltero,casado,separado,viudo,union_libre'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'lastname' => $input['lastname'],
            'identification' => $input['identification'],
            'schooling' => $input['schooling'],
            'birthdate' => $input['birthdate'],
            'birthday_place' => $input['birthday_place'],
            'sex' => $input['sex'],
            'address' => $input['address'],
            'phone' => $input['phone'],
            'civil_status' => $input['civil_status'],
            'password' => Hash::make($input['password']),
        ]);

    }
}