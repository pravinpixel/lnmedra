<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    
    protected $fillable =[

        "name","category","phone_number", "email","password","address", "city", "state", "country","postal_code",
        "company_name", "gst","contact_person","entity_name","bank_name","account_no","ifs_code","branch",
        "vat_number","image","is_active"
    ];

    public function product()
    {
    	return $this->hasMany('App/Product');
    	
    }
}
