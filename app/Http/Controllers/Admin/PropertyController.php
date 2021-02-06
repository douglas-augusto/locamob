<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Owner;
use App\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $properties = Property::orderBy('name', 'asc')
            ->paginate(10);

        return view('admin.properties.index', compact('properties', 'search'));
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

            Property::create($request->all());

            $request->session()->flash('sucesso', "Imóvel cadastrado com sucesso!");

            return redirect()->route('admin.properties.index');

        }catch (\Exception $e){
            $request->session()->flash('sucesso', 'Erro: '.$e->getMessage());
            return redirect()->route('admin.properties.index');
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
     * @param  int  $property
     * @return \Illuminate\Http\Response
     */
    public function edit($property)
    {
        $properties = Property::find($property);

        return response()->json([
            'data' => $properties
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $property)
    {
        try{

            Property::updateOrCreate(
                [
                    'id' => $property
                ],
                [
                    'name' => $request->name_,
                ],
                [
                    'email' => $request->email_,
                ],
                [
                    'phone' => $request->phone_,
                ],
                [
                    'transfer_day' => $request->transfer_day_,
                ]
            );
            $request->session()->flash('sucesso', "Imóvel atualizado com sucesso!");
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
    public function destroy($id)
    {
        //
    }

}
