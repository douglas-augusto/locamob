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

        $properties = Property::join('owners', 'owner_id', 'owners.id')
            ->select('properties.*', 'owners.name')
            ->orderBy('properties.id', 'asc')
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
        $id = $properties->owner_id;
        $owner = Owner::where('id', '=', $id)
            ->select('name')
            ->get();
        $name = $owner->get('0')->name;

        return response()->json([
            'data' => $properties,
            'name' => $name
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
            $property = Property::find($property);
            $property->owner_id = $request->owner_id_;
            $property->street = $request->street_;
            $property->district = $request->district_;
            $property->city = $request->city_;
            $property->number = $request->number_;
            $property->zip_code = $request->zip_code_;
            $property->uf = $request->uf_;
            $property->save();

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
    public function destroy($property)
    {
        try{
            $property = Property::findOrFail($property);
            $property->delete();

            session()->flash('sucesso', "Imóvel removido com sucesso!");

            return redirect()->route('admin.properties.index');
        }catch (\Exception $e){
            session()->flash('sucesso', 'Erro: '.$e->getMessage());
            return redirect()->route('admin.properties.index');
        }
    }

    public function searchOwner()
    {
        $owner = Owner::all();

        return response()->json($owner);
    }

}
