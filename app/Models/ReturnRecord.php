<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnRecord extends Model
{
    protected $table = 'returns';

    public $timestamps = false;

    protected $fillable = [
        'loan_detail_id',
        'charge',
        'amount',
    ];

    public function loanDetail()
    {
        return $this->belongsTo(LoanDetail::class, 'loan_detail_id', 'id');
    }
}
