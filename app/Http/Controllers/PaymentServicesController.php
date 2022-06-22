<?php

namespace App\Http\Controllers;

use App\Models\PaymentServices;
use Illuminate\Http\Request;

class PaymentServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $payment_services = PaymentServices::create([
            'invoices_id' => $request->invoices_id,
            'payment' => $request->payment ?? '',
            'due_date' => $request->due_date ?? '',
            'invoice_portion' => $request->invoice_portion ?? 0,
            'payment_amount' => $request->payment_amount ?? 0,
        ]);

        return response(
            $payment_services ,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment_services = PaymentServices::select('payment_services.*')
            ->where("invoices.invoice_number","=", $id)
            ->leftJoin("invoices","invoices.id",'=','payment_services.invoices_id')
            ->first();

            return response(
                $payment_services ,200);
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
        $payment_services = PaymentServices::find($id);

        $data = [
            'invoices_id' => $request->invoices_id,
            'payment' => $request->payment ?? '',
            'due_date' => $request->due_date ?? '',
            'invoice_portion' => $request->invoice_portion ?? 0,
            'payment_amount' => $request->payment_amount ?? 0,
        ];

        $payment_services->update($data);
        return response(
            $payment_services ,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment_services = PaymentServices::destroy($id);
        return response(["msg" => "succes delete", 'callback' => $payment_services] ,200);
    }

    //add function for auto generate api docs
    public function create(){
        //
    }
    public function edit(){
        //
    }
}
