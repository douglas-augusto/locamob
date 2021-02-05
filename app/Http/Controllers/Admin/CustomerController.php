<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $customers = Customer::where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('email', 'LIKE', '%'.$search.'%')
                ->orWhere('phone', 'LIKE', '%'.$search.'%')
                ->orderBy('name', 'asc')
                ->paginate(10);

        return view('admin.customers.index', compact('customers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            Customer::create($request->all());

            $request->session()->flash('sucesso', "Cliente cadastrado com sucesso!");

            return redirect()->route('admin.customers.index');

        }catch (\Exception $e){
            $request->session()->flash('sucesso', 'Erro: '.$e->getMessage());
            return redirect()->route('admin.customers.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($customer)
    {
        $customers = Customer::find($customer);

        return response()->json([
            'data' => $customers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $customer)
    {
        try{

            Customer::updateOrCreate(
                [
                    'id' => $customer
                ],
                [
                    'name' => $request->name_,
                ],
                [
                    'email' => $request->email_,
                ],
                [
                    'phone' => $request->phone_,
                ]
            );
            $request->session()->flash('sucesso', "Cliente atualizado com sucesso!");
            return response()->json([ 'success' => true ]);

        }catch (\Exception $e){

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($customer)
    {
        try{
            $customer = Customer::findOrFail($customer);
            $customer->delete();

            session()->flash('sucesso', "Cliente removido com sucesso!");

            return redirect()->route('admin.customers.index');
        }catch (\Exception $e){
            session()->flash('sucesso', 'Erro: '.$e->getMessage());
            return redirect()->route('admin.customers.index');
        }
    }
}
