<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Customer;
use App\Owner;
use App\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customers = Customer::count();
        $owners = Owner::count();
        $properties = Property::count();
        $contracts = Contract::count();

        return view('home', compact('customers', 'owners', 'properties', 'contracts'));
    }
}
