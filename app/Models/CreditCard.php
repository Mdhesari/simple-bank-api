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

    /**
     * Methods
     */

    public function getTotalBalance()
    {
        return $this->account->quantity;
    }
}
