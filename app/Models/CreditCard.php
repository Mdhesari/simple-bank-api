<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'card_number',
        'sheba_number',
    ];

    /**
     * Relationships
     */

    public function account(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function deposits(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaction::class, 'dst_credit_card_id');
    }

    public function withdraws(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaction::class, 'src_credit_card_id');
    }

    /**
     * Methods
     */

    public function getTotalBalance()
    {
        return $this->account->quantity;
    }
}
