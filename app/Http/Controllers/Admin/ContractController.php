<?php

namespace App\Http\Controllers\Admin;

use App\Contract;
use App\Customer;
use App\Http\Controllers\Controller;
use App\MonthlyPayment;
use App\Owner;
use App\Property;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $contracts = Contract::join('owners', 'owner_id', 'owners.id')
            ->join('customers', 'customer_id', 'customers.id')
            ->select('owners.name AS name_owner', 'customers.name AS name_customer', 'contracts.start_day', 'contracts.end_day', 'contracts.id')
            ->orderBy('contracts.id', 'asc')
            ->paginate(10);

        return view('admin.contracts.index', compact('contracts', 'search'));
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

            $start = implode('-', array_reverse(explode('/', $request->start_day)));
            $end = implode('-', array_reverse(explode('/', $request->end_day)));

            $administrative = str_replace(',','.',str_replace('.','',$request->administrative_fee));
            $rent = str_replace(',','.',str_replace('.','',$request->rent_amount));
            $condominium = str_replace(',','.',str_replace('.','',$request->condominium_amount));
            $iptu = str_replace(',','.',str_replace('.','',$request->iptu_amount));

            $contract = Contract::create([
                'property_id' => $request->property_id,
                'owner_id' => $request->owner_id,
                'customer_id' => $request->customer_id,
                'start_day' => $start,
                'end_day' => $end,
                'administrative_fee' => $administrative,
                'rent_amount' => $rent,
                'condominium_amount' => $condominium,
                'iptu_amount' => $iptu
            ]);

            $id_contract = $contract->id;

            $dia = date('d',strtotime($start));
            $mes = date('m',strtotime($start));
            $ano = date('Y',strtotime($start));
            $dias_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

            $taxa_iptu = $iptu / 12;
            $total_mensalidade = $rent + $condominium + $taxa_iptu;

            $total_repasse = $total_mensalidade - $administrative - $condominium;

            if($dia == '01'){
                $valor_parcela = $total_mensalidade;
            }else{
                $valor_por_dia = $total_mensalidade / $dias_mes;
                $proporcao = $valor_por_dia * $dia;
                $valor_parcela = $total_mensalidade - $proporcao;
            }
            MonthlyPayment::create([
                'contract_id' => $id_contract,
                'pay_day' => $start,
                'pay_value' => $valor_parcela,
                'type' => 'M'
            ]);
            MonthlyPayment::create([
                'contract_id' => $id_contract,
                'pay_day' => $start,
                'pay_value' => $total_repasse,
                'type' => 'R'
            ]);

            for ($i = 1; $i <= 11; $i++){

                if ($mes == 12) {
                    $mes = 1;
                    $ano = $ano + 1;
                }else{
                    $mes = $mes + 1;
                }

             $pag_data = $ano.'-'.$mes.'-'.'01';

                MonthlyPayment::create([
                    'contract_id' => $id_contract,
                    'pay_day' => $pag_data,
                    'pay_value' => $total_mensalidade,
                    'type' => 'M'
                ]);
                MonthlyPayment::create([
                    'contract_id' => $id_contract,
                    'pay_day' => $pag_data,
                    'pay_value' => $total_repasse,
                    'type' => 'R'
                ]);

            }

            $request->session()->flash('sucesso', "Contrato cadastrado com sucesso!");

            return redirect()->route('admin.contracts.index');

        }catch (\Exception $e){
            $request->session()->flash('sucesso', 'Erro: '.$e->getMessage());
            return redirect()->route('admin.contracts.index');
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
     * @param  int  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit($contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy($contract)
    {
        //
    }

    public function searchProperty()
    {
        $property = Property::join('owners', 'owner_id', 'owners.id')
            ->select('properties.owner_id', 'properties.id', 'owners.name', 'properties.street', 'properties.number')
            ->get();

        return response()->json($property);
    }

    public function searchCustomer()
    {
        $owner = Customer::all();

        return response()->json($owner);
    }
}
