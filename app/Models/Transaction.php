<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'quantity', 'fee_quantity', 'src_account_id', 'dst_account_id'
    ];

    protected $casts = [
        'quantity' => 'decimal:0',
        'status'   => TransactionStatus::class,
    ];

    /**
     * Relationships
     */

    public function srcAccount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Account::class, 'src_account_id');
    }

    public function dstAccount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Account::class, 'dst_account_id');
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

    public function getQuantityWithFeeAttribute()
    {
        return $this->quantity + $this->total_fee;
    }

    public function getTotalFeeAttribute()
    {
        return $this->fees()->where('account_id', $this->src_account_id)->sum('quantity');
    }
}
