<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HoldBill;
use Auth;

class HoldBillController extends Controller
{
    public function storeHoldBill(Request $request)
    {
        $loginID = Auth::user()->id;
        $holdbill = $request['data'];
        if ($holdbill[23] == null || '') {
            $dataCount =  HoldBill::where('user_id', $loginID)->count();
            if ($dataCount >= 2) {
                return "2";
            }
            $data = new HoldBill();
            $data->tbody_id = $holdbill[2];
            $data->customer_id = $holdbill[0];
            $data->customer_name = $holdbill[1];
            $data->user_id = Auth::user()->id;
            $data->hold_bill_no = 1;

            if ($holdbill[19]  != 0 || '') {
                $data->order_discount = $holdbill[19];
                $data->discount_method = $holdbill[22];
            } else {
                $data->order_discount = '';
                $data->discount_method = '';
            }

            // $data->discount_method = $holdbill[22];
            // $data->order_discount = $holdbill[19];
            $data->shipping_cost_val = $holdbill[18];
            $data->localStorageProductCode = json_encode($holdbill[3]);
            $data->order_tax_rate_select = $holdbill[20];
            $data->localStorageSaleUnit = json_encode($holdbill[14]);
            $data->localStorageTaxMethod = json_encode($holdbill[10]);
            $data->localStorageTaxRate = json_encode($holdbill[6]);
            $data->localStorageTaxValue = json_encode($holdbill[8]);
            $data->localStorageTempUnitName = json_encode($holdbill[15]);
            $data->localStorageSubTotal =  json_encode($holdbill[12]);
            $data->localStorageQty =  json_encode($holdbill[4]);
            $data->localStorageTaxName =  json_encode($holdbill[9]);
            $data->localStorageSaleUnitOperationValue =  json_encode($holdbill[17]);
            $data->localStorageSaleUnitOperator =  json_encode($holdbill[16]);
            $data->localStorageProductDiscount =  json_encode($holdbill[5]);
            $data->localStorageProductId =  json_encode($holdbill[13]);
            $data->localStorageNetUnitPrice =  json_encode($holdbill[7]);
            $data->localStorageSubTotalUnit =  json_encode($holdbill[11]);
            $data->sales_person_code =  $holdbill[25];
            $data->coupon_code =  ($holdbill[24]);
            $data->is_active = 1;
            $data->save();
            return "true";
        } else {
            $id = Auth::user()->id;
            $data = HoldBill::where('user_id', $id)->where('id', $holdbill[23])->first();
            $data->tbody_id = $holdbill[2];
            $data->customer_id = $holdbill[0];
            $data->customer_name = $holdbill[1];
            $data->user_id = Auth::user()->id;
            $data->hold_bill_no = 1;

            if ($holdbill[19]  != 0 || '') {
                $data->order_discount = $holdbill[19];
                $data->discount_method = $holdbill[22];
            } else {
                $data->order_discount = '';
                $data->discount_method = '';
            }
            $data->shipping_cost_val = $holdbill[18];
            $data->localStorageProductCode = json_encode($holdbill[3]);
            $data->order_tax_rate_select = $holdbill[20];
            $data->localStorageSaleUnit = json_encode($holdbill[14]);
            $data->localStorageTaxMethod = json_encode($holdbill[10]);
            $data->localStorageTaxRate = json_encode($holdbill[6]);
            $data->localStorageTaxValue = json_encode($holdbill[8]);
            $data->localStorageTempUnitName = json_encode($holdbill[15]);
            $data->localStorageSubTotal =  json_encode($holdbill[12]);
            $data->localStorageQty =  json_encode($holdbill[4]);
            $data->localStorageTaxName =  json_encode($holdbill[9]);
            $data->localStorageSaleUnitOperationValue =  json_encode($holdbill[17]);
            $data->localStorageSaleUnitOperator =  json_encode($holdbill[16]);
            $data->localStorageProductDiscount =  json_encode($holdbill[5]);
            $data->localStorageProductId =  json_encode($holdbill[13]);
            $data->localStorageNetUnitPrice =  json_encode($holdbill[7]);
            $data->localStorageSubTotalUnit =  json_encode($holdbill[11]);
            $data->sales_person_code =  ($holdbill[25]);
            $data->coupon_code =  ($holdbill[24]);
            $data->is_active = 1;
            $data->update();
            return "else true";
        }
    }
    public function holdBillClear()
    {
        $id = Auth::user()->id;
        $data = HoldBill::where('user_id', $id)->delete();
        return true;
    }
    public function holdBillData()
    {
        $id = Auth::user()->id;
        $data = HoldBill::where('user_id', $id)->select('customer_name', 'id', 'hold_bill_no', 'localStorageSubTotal')->get();
        foreach ($data as $key => $val) {

            $decode_amt =  json_decode($val['localStorageSubTotal']);
            $amount = array_sum($decode_amt);
            $val['localStorageSubTotal'] = $amount;
        }
        return $data;
    }
    public function holdBillDelete($id)
    {

        $user_id = Auth::user()->id;
        $data = HoldBill::where('id', $id)->where('user_id', $user_id)->delete();
        $message = "Hold Bill Deleted successfully.";
        return response(['message' => $message]);
    }
    public function holdBillGetData($id)
    {

        $data = HoldBill::where('id', $id)->first();
        return $data;
    }
}
