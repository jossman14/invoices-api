<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\PaymentServices;
use App\Models\WorkServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $invoices = Invoices::where("deleted_at","=", null)->get();

        foreach ($invoices as $key=>$invoice) {
            //work services data
            $temp_work_services = WorkServices::select('work_services.*')
            ->where("invoices.invoice_number","=", $invoice->invoice_number)
            ->leftJoin("invoices","invoices.id",'=','work_services.invoices_id')
            ->get();
            $invoices[$key]->{"work_services"} = $temp_work_services;

            //payment services data
            $temp_payment_services = PaymentServices::select('payment_services.*')
            ->where("invoices.invoice_number","=", $invoice->invoice_number)
            ->leftJoin("invoices","invoices.id",'=','payment_services.invoices_id')
            ->get();
            $invoices[$key]->{"payment_services"} = $temp_payment_services;
        }

        return response(
            $invoices ,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('signature')) {
            $signature  = $request->file('signature');
            $fileName   = time().'_'.$signature->getClientOriginalName();
            $filePath   = $signature->storeAs('images/signature', $fileName, 'public');
        }

        $invoice = Invoices::create([

            'customer' => $request->customer,
            'address' => $request->address,
            'invoice_number' => $request->invoice_number,
            'date' => $request->date,
            'expire_date' => $request->expire_date,
            'note' => $request->note ?? '',
            'signature' => $filePath ?? '',

        ]);


        for ($i=0; $i < count($request->description) ; $i++) {
            WorkServices::create([
                'invoices_id' => $invoice->id,
                'description' => $request->description[$i] ?? '',
                'amount' => $request->amount[$i] ?? 0,
                'unit' => $request->unit[$i] ?? '',
                'unit_price' => $request->unit_price[$i] ?? 0,
                'total' => $request->total[$i] ?? 0,
            ]);
        }

        for ($i=0; $i < count($request->payment) ; $i++) {

            PaymentServices::create([
                'invoices_id' => $invoice->id,
                'payment' => $request->payment[$i] ?? '',
                'due_date' => $request->due_date[$i] ?? '',
                'invoice_portion' => $request->invoice_portion[$i] ?? 0,
                'payment_amount' => $request->payment_amount[$i] ?? 0,
            ]);
        }


        return response($invoice ,200);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($invoices_id)
    {
        $invoices = Invoices::where("deleted_at","=", null)->find($invoices_id);

        //work services data
        $temp_work_services = WorkServices::select('work_services.*')
        ->where("invoices.id","=", $invoices_id)
        ->leftJoin("invoices","invoices.id",'=','work_services.invoices_id')
        ->get();
        $invoices->{"work_services"} = $temp_work_services;

        //payment services data
        $temp_payment_services = PaymentServices::select('payment_services.*')
        ->where("invoices.invoice_number","=", $invoices_id)
        ->leftJoin("invoices","invoices.id",'=','payment_services.invoices_id')
        ->get();
        $invoices->{"payment_services"} = $temp_payment_services;


        return response(
            $invoices ,200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoices $invoices)
    {
        $invoice = Invoices::find($invoices);

        if ($request->hasFile('signature')) {
            $signature  = $request->file('signature');
            $fileName   = time().'_'.$signature->getClientOriginalName();
            $filePath   = $signature->storeAs('images/signature', $fileName, 'public');
        }

        $data = [
            'id' => $request->id,
            'customer' => $request->customer,
            'address' => $request->address,
            'invoice_number' => $request->invoice_number,
            'date' => $request->date,
            'expire_date' => $request->expire_date,
            'note' => $request->note ?? '',
            'signature' => $filePath ?? '',
        ];

        $invoice->update($data);
        return response(
            $invoice ,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy($invoices)
    {
        $invoice = Invoices::destroy($invoices);
        return response(["msg" => "succes delete", 'callback' => $invoice] ,200);
    }
}
