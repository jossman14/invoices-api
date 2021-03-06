<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoices extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "invoices";
    protected $fillable = ['customer','address','invoice_number','date','expire_date', 'note','signature',];


}
