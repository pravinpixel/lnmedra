<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable =[
        "customer_group_id", "user_id", "name", "company_name",
        "email", "phone_number","requirement","tax_no", "address", "city",
        "state", "postal_code", "country", "points", "deposit", "expense", "is_active"
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
 
}
