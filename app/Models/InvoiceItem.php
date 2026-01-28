<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    protected $table = 'invoice_item';
    public $timestamps = false;

    protected $fillable = [
        'invoice_id',
        'quantity',
        'unit_price',
        'item_id'
    ];

    public function invoice(): BelongsTo {
        return $this->belongsTo(Invoice::class);
    }

    public function item(): BelongsTo {
        return $this->belongsTo(Item::class);
    }
}
