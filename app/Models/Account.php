<?php

namespace App\Models;

use App\Enums\AccountType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'card_number', 'sheba_number', 'quantity', 'user_id'
    ];

    protected $casts = [
        'quantity' => 'decimal:0',
        'type'     => AccountType::class,
    ];
}
