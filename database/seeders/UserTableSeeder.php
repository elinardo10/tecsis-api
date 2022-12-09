<?php

namespace Database\Seeders;

use App\V1\Role\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleCustomer = Role::query()->whereName('customer')->first('id');

        // Create normal customers
        User::factory(5)->create()->each(function ($user) use ($roleCustomer) {
            $user->roles()->attach($roleCustomer->id);
        });
    }
}
