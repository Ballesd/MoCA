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
        /*Validator::make($input, [
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
        ])->validate();*/

        //dd($input);
        //Guardamos el usuario
        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->lastname = $input['lastname'];
        $user->identification = $input['identification'];
        $user->birthdate = $input['birthdate'];
        $user->birthday_place = $input['birthday_place'];
        $user->sex = $input['sex'];
        $user->address = $input['address'];
        $user->phone = $input['phone'];
        $user->civil_status = $input['civil_status'];
        $user->password = Hash::make($input['password']);

        $user->save();
        return $user;
        /*try {   
            User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'lastname' => $input['lastname'],
                'identification' => $input['identification'],
                'birthdate' => $input['birthdate'],
                'birthday_place' => $input['birthday_place'],
                'sex' => $input['sex'],
                'address' => $input['address'],
                'phone' => $input['phone'],
                'civil_status' => $input['civil_status'],
                'password' => Hash::make($input['password']),
            ]);
        }
        catch (\Exception $e) {
            dd($e);
        }

        event(new Registered($user));
        */
    }
}