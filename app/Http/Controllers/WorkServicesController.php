<?php

namespace App\Http\Controllers;

use App\Models\WorkServices;
use Illuminate\Http\Request;

class WorkServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $work_services =  WorkServices::create([
            'invoices_id' => $request->invoices_id,
            'description' => $request->description ?? '',
            'amount' => $request->amount ?? 0,
            'unit' => $request->unit ?? '',
            'unit_price' => $request->unit_price ?? 0,
            'total' => $request->total ?? 0,
        ]);

        return response(
            $work_services ,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $work_services = WorkServices::select('work_services.*')
            ->where("invoices.invoice_number","=", $id)
            ->leftJoin("invoices","invoices.id",'=','work_services.invoices_id')
            ->first();

            return response(
                $work_services ,200);
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
        $work_services = WorkServices::find($id);

        $data = [
            'invoices_id' => $request->invoices_id,
            'description' => $request->description ?? '',
            'amount' => $request->amount ?? 0,
            'unit' => $request->unit ?? '',
            'unit_price' => $request->unit_price ?? 0,
            'total' => $request->total ?? 0,
        ];

        $work_services->update($data);
        return response(
            $work_services ,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $work_services = WorkServices::destroy($id);
        return response(["msg" => "succes delete", 'callback' => $work_services] ,200);
    }

    //add function for auto generate api docs
    public function create(){
        //
    }
    public function edit(){
        //
    }
}
