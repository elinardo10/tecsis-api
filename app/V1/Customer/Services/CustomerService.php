<?php

namespace App\V1\Customer\Services;

use App\V1\Customer\Exceptions\CustomerHasBeenTakenException;
use App\V1\Role\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;

class CustomerService
{
    public function getCustomers($filter)
    {
        $customers = User::all();

        if (!empty($filter['keyword'])) {
            $customers->where(function ($query) use ($filter) {
                $query->where('name', 'LIKE', '%' . $filter['keyword'] . '%')
                    ->orWhere('email', 'LIKE', '%' . $filter['keyword'] . '%');
            });
        }

        return $customers;
    }

    public function registerCustomer(array $input)
    {
        $customer = User::where('email', $input['email'])->first();
        if (!empty($customer->id)) {
            throw new CustomerHasBeenTakenException();
        }

        $input['password'] = Str::random('10');

        $role = Role::whereName('customer')->first();

        $customer = User::create($input);
        $customer->roles()->attach($role->id);

        return $customer;
    }

    public function updateCustomer(User $customer, array $input)
    {
        if (!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        }

        $customer->fill($input);
        $customer->save();

        return $customer;
    }
}
