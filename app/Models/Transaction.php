<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const MAX_TRANSACTION_QUANTITY = 50000000;
    const MIN_TRANSACTION_QUANTITY = 1000;

    protected $fillable = [
        'status', 'quantity', 'fee_quantity', 'src_credit_card_id', 'dst_credit_card_id'
    ];

    protected $casts = [
        'quantity' => 'decimal:0',
        'status'   => TransactionStatus::class,
    ];

    protected $appends = [
        'formatted_quantity',
    ];

    /**
     * Relationships
     */

    public function srcCreditCard(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CreditCard::class, 'src_credit_card_id');
    }

    public function dstCreditCard(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CreditCard::class, 'dst_credit_card_id');
    }

    public function fees(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TransactionFee::class);
    }

    /**
     * Methods
     */

    public function isSuccess(): bool
    {
        return $this->status === TransactionStatus::Success;
    }

    /**
     * Attributes
     */

    public function getFormattedQuantityAttribute()
    {
        return number_format($this->quantity);
    }

    public function getQuantityWithFeeAttribute()
    {
        return $this->quantity + $this->total_fee;
    }

    public function getTotalFeeAttribute()
    {
        return $this->fees()->where('credit_card_id', $this->src_credit_card_id)->sum('quantity');
    }
}
