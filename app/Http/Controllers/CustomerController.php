<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index()
    {
        return view('home');

    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        [$data['name'], $data['phone'],$data['wallet_activated']]=[$request->name,$request->phone,0];
        $customer = Customer::create($data);
        return redirect('/customers/' . $customer->id);
    }

    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }

    public function searchCustomers(Request $request)
    {
        $customer_list = Customer::where('name', 'like', '%' .$request->get("query") . '%')
            ->orWhere('phone', 'like', '%' . $request->get("query") . '%')
            ->get();
        return json_encode($customer_list);
    }
    
    public function activateWallet(Customer $customer)
    {
        [$type, $message]=$customer->walletActivator();
        return redirect()->route('show_wallet', ['wallet' => $customer->wallet])->with($type, $message);
    }
}
