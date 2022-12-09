<?php

namespace App\V1\Customer\Controllers;

use App\Http\Controllers\Controller;
use App\V1\Customer\Requests\CustomerIndexRequest;
use App\V1\Customer\Requests\CustomerStoreRequest;
use App\V1\Customer\Requests\CustomerUpdateRequest;
use App\V1\Customer\Services\CustomerService;
use App\Models\User;
use App\V1\Customer\Resources\CustomerResource;

class CustomerController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(CustomerIndexRequest $request)
    {
        $input = $request->validated();
        $customers = $this->customerService->getCustomers($input);

        return CustomerResource::collection($customers);
    }

    public function store(CustomerStoreRequest $request)
    {
        $input = $request->validated();
        $customer = $this->customerService->registerCustomer($input);
        return new CustomerResource($customer);
    }

    public function show(User $customer)
    {
        $customer->load('invoices');
        return new CustomerResource($customer);
    }

    public function update(User $customer, CustomerUpdateRequest $request)
    {
        $input = $request->validated();

        $customer->fill($input);
        $customer->save();

        return new CustomerResource($customer);
    }

    public function delete(User $customer)
    {
        $customer->roles()->detach();
    }
}
