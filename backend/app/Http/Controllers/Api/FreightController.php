<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FreightRequest;
use App\Models\Freight;
use Database\Seeders\FreightSeed;
use Illuminate\Http\Request;

class FreightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $freight;
    private $totalPage = 4;
    public function __construct(Freight $freight)
    {
        $this->freight = $freight;
    }
    public function index(Request $request)
    {
        $freight = $this->freight->getResults($request->all(),$this->totalPage);

        return response()->json($freight);
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
    public function store(FreightRequest $request)
    {
        $data = $request->all();
        if(!$freight = $this->freight->create($data))
            return response()->json(['error'=> 'error_insert'],500);
        return response()->json($freight,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(! $freight= $this->freight->find($id))
            return response()->json(['error'=>'freight_not_found'],404);
        return response()->json($freight);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $data = $request->validate([
            'board' => 'required',
            'vehicle_owner' => 'required',
            'price_freight' => 'required',
            'date_start' => 'required|date_format:Y-m-d',
            'date_end' => 'required|date_format:Y-m-d',
            'status' => 'required|in:Iniciado,em trânsito,concluido',
          ]);
        if(!$freight = $this->freight->find($id))
            return response()->json(['error'=> 'freight_not_found'],404);
        if(!$freight->update($data))
           return response()->json(['error'=> 'freight_not_update'],500);
        return response()->json($freight);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$freight = $this->freight->find($id))
           return response()->json(['error'=>'freight_not_found'],404);
        if(!$freight->delete())
           return response()->json(['error'=>'freight_not_delete'],500);
        return response()->json($freight,204);
    }
}
