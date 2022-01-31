<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'unit', 
        'street', 
        'postcode', 
        'country'
    ];

    public function fullAddress()
    {
        return "{$this->unit} {$this->street} {$this->country} {$this->postcode}";
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
