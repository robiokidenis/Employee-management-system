<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function company()
    {
       return  $this->belongsTo(Companies::class,'companies_id','id');
        # code...
    }

    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
