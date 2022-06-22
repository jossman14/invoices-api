<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceStatus extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "invoice_statuses";
    protected $fillable = ['invoices_id','paid','unpaid','payment_method','status',];

}
