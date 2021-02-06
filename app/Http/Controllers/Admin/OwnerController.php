<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $owners = Owner::where('name', 'LIKE', '%'.$search.'%')
            ->orWhere('email', 'LIKE', '%'.$search.'%')
            ->orWhere('phone', 'LIKE', '%'.$search.'%')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('admin.owners.index', compact('owners', 'search'));
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

            Owner::create($request->all());

            $request->session()->flash('sucesso', "Proprietário cadastrado com sucesso!");

            return redirect()->route('admin.owners.index');

        }catch (\Exception $e){
            $request->session()->flash('sucesso', 'Erro: '.$e->getMessage());
            return redirect()->route('admin.owners.index');
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
     * @param  int  $owner
     * @return \Illuminate\Http\Response
     */
    public function edit($owner)
    {
        $owners = Owner::find($owner);

        return response()->json([
            'data' => $owners
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $owner)
    {
        try{
            $owner = Owner::find($owner);
            $owner->name = $request->name_;
            $owner->email = $request->email_;
            $owner->phone = $request->phone_;
            $owner->transfer_day = $request->transfer_day_;
            $owner->save();

            $request->session()->flash('sucesso', "Proprietário atualizado com sucesso!");
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
    public function destroy($owner)
    {
        try{
            $owner = Owner::findOrFail($owner);
            $owner->delete();

            session()->flash('sucesso', "Proprietário removido com sucesso!");

            return redirect()->route('admin.owners.index');
        }catch (\Exception $e){
            session()->flash('sucesso', 'Erro: '.$e->getMessage());
            return redirect()->route('admin.owners.index');
        }
    }
}
