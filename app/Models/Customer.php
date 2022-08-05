<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // nome da função padronizado no plural de seu relacionamento
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
