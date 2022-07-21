<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoldBill extends Model
{
    use HasFactory;
    protected $fillable = [
        "tbody_id", "customer_id", "customer_name", "user_id", "hold_bill_no", "localStorageProductCode", "discount_method", "order_discount", "shipping_cost_val", "order_tax_rate_select", "localStorageSaleUnit",
        "localStorageTaxMethod", "localStorageTaxRate", "localStorageTaxValue", "localStorageTempUnitName", "localStorageSubTotal",
        "localStorageQty", "localStorageTaxName", "localStorageSaleUnitOperationValue", "localStorageSaleUnitOperator", "localStorageProductDiscount",
        "localStorageProductId", "localStorageNetUnitPrice", "localStorageSubTotalUnit", "sales_person_code", "coupon_code", "is_active",
    ];
}
