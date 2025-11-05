<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'phone', 'email', 'address', 'user_id'];

    // a customer belongs to an employee(User)
    public function User(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
