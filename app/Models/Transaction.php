<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'quantity', 'src_account_id', 'dst_account_id'
    ];

    protected $casts = [
        'quantity' => 'decimal:0',
        'status'   => TransactionStatus::class,
    ];
}
