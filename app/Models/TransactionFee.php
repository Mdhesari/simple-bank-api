<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionFee extends Model
{
    use HasFactory;

    const DEFAULT_FEE = 500;

    protected $fillable = [
        'quantity', 'transaction_id', 'credit_card_id',
    ];

    protected $casts = [
        'quantity' => 'decimal:0',
    ];

    public function transaction(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function creditCard(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CreditCard::class);
    }
}
