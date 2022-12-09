<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\V1\Role\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name' => 'customer', 'label' => 'Customer'],
        ]);
    }
}
