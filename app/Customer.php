<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable =[
        "customer_group_id", "user_id", "name", "company_name","walk-in-customer","full_name","last_visited",
        "email", "phone_number","requirement","tax_no", "address", "city",
        "state", "postal_code", "country", "points", "deposit", "expense","remark","customer_marry_date","customer_dob", "is_active"
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
        return $this->hasMany(Payment::class,'customer_id','id');
    }

    public function CustomerGroup()
    {
        return $this->belongsTo(CustomerGroup::class,'customer_group_id','id');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)->format(config('global.model_date_format'));
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format(config('global.model_date_format'));
    }

    public function getLastVisitedAttribute($date)
    {
        return Carbon::parse($date)->format(config('global.model_date_format'));
    }

 
}
