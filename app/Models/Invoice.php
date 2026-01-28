<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    //
    protected $fillable = [
        'client_id',
        'due_date',
        'discount',
        'tax',
        'subtotal',
        'total'
    ];

    protected $casts = [
        'due_date' => 'datetime'
    ];

    public function client(): BelongsTo {
        return $this->belongsTo(Client::class);
    }

    public function invoice_items() {
        return $this->hasMany(InvoiceItem::class);
    }
}
