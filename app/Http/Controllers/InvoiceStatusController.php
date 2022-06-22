<?php

namespace App\Http\Controllers;

use App\Models\InvoiceStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $recap_data = InvoiceStatus::select('invoices.invoice_number', 'invoices.customer',
        DB::raw('SUM(invoice_statuses.paid) as total_paid'),
        DB::raw('SUM(invoice_statuses.unpaid) as total_unpaid'),
        )
        ->leftJoin("invoices","invoices.id",'=','invoice_statuses.invoices_id')
        ->where("invoices.deleted_at","=", null)
        ->groupBy('invoices.invoice_number','invoices.customer',)
        ->get();

        $complete_data = InvoiceStatus::select('invoices.invoice_number', 'invoices.customer',
        DB::raw('(CASE
        WHEN invoice_statuses.payment_method = "0" THEN "Cash"
        WHEN invoice_statuses.payment_method = "1" THEN "Bank Transfer"
        END) AS last_payment_method'),
        DB::raw('(CASE
        WHEN invoice_statuses.status = "0" THEN "Paid"
        WHEN invoice_statuses.status = "1" THEN "Unpaid"
        WHEN invoice_statuses.status = "2" THEN "Dawn Payment"
        WHEN invoice_statuses.status = "3" THEN "Overdue payment"
        END) AS last_status'),)
        ->leftJoin("invoices","invoices.id",'=','invoice_statuses.invoices_id')
        ->where("invoices.deleted_at","=", null)
        ->groupBy('invoices.invoice_number','invoices.customer', 'last_payment_method','last_status')
        ->get();

        return response(
            [
                'complete_data' => $complete_data,
                'recap_data' => $recap_data,
            ] ,200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice_status = InvoiceStatus::create([
            'invoices_id' => $request->invoices_id,
            'paid' => $request->paid ?? 0,
            'unpaid' => $request->unpaid ?? 0,
            'payment_method' => $request->payment_method ?? 0,
            'status' => $request->status ?? 0,
        ]);

        return response(
            $invoice_status ,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoiceStatus  $InvoiceStatus
     * @return \Illuminate\Http\Response
     */
    public function show($InvoiceStatus)
    {

        $recap_data = InvoiceStatus::select('invoices.invoice_number', 'invoices.customer',
        DB::raw('SUM(invoice_statuses.paid) as total_paid'),
        DB::raw('SUM(invoice_statuses.unpaid) as total_unpaid'),
        )
        ->leftJoin("invoices","invoices.id",'=','invoice_statuses.invoices_id')
        ->where("invoices.id","=", $InvoiceStatus)
        ->where("invoices.deleted_at","=", null)
        ->groupBy('invoices.invoice_number','invoices.customer',)
        ->get();

        $complete_data = InvoiceStatus::select('invoices.invoice_number', 'invoices.customer',
        DB::raw('(CASE
        WHEN invoice_statuses.payment_method = "0" THEN "Cash"
        WHEN invoice_statuses.payment_method = "1" THEN "Bank Transfer"
        END) AS last_payment_method'),
        DB::raw('(CASE
        WHEN invoice_statuses.status = "0" THEN "Paid"
        WHEN invoice_statuses.status = "1" THEN "Unpaid"
        WHEN invoice_statuses.status = "2" THEN "Dawn Payment"
        WHEN invoice_statuses.status = "3" THEN "Overdue payment"
        END) AS last_status'),)
        ->leftJoin("invoices","invoices.id",'=','invoice_statuses.invoices_id')
        ->where("invoices.id","=", $InvoiceStatus)
        ->where("invoices.deleted_at","=", null)
        ->groupBy('invoices.invoice_number','invoices.customer', 'last_payment_method','last_status')
        ->get();

        return response(
            [
                'complete_data' => $complete_data,
                'recap_data' => $recap_data,
            ] ,200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvoiceStatus  $InvoiceStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceStatus $InvoiceStatus)
    {
        $invoice_status = InvoiceStatus::find($InvoiceStatus);

        $data = [
            'invoices_id' => $request->invoices_id,
            'paid' => $request->paid ?? 0,
            'unpaid' => $request->unpaid ?? 0,
            'payment_method' => $request->payment_method ?? 0,
            'status' => $request->status ?? 0,
        ];

        $invoice_status->update($data);
        return response(
            $invoice_status ,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoiceStatus  $InvoiceStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy($InvoiceStatus)
    {
        $invoice_status = InvoiceStatus::destroy($InvoiceStatus);
        return response(["msg" => "succes delete", 'callback' => $invoice_status] ,200);
    }

    //add function for auto generate api docs
    public function create(){
        //
    }
    public function edit(){
        //
    }
}
