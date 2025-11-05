<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'product_id', 'quantity'];

    /**
     * A purchase belongs to a customer 
     */
    public function customer(): BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    /**
     * A purchase is belong to a product 
     */
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
