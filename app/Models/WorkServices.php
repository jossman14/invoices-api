<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkServices extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "work_services";
    protected $fillable = ['invoices_id','description','amount','unit','unit_price','total',];
}
