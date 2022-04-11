<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\PosCustomerNotification;
use App\Sale;
use App\Product_Sale;
use App\Biller;
use App\Customer;
use App\Payment;
use App\Warehouse;
use NumberToWords\NumberToWords;
use Barryvdh\DomPDF\Facade as PDF;
class PosNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Log::info('called queue job successfully');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    // public function handle()
    // {
    //     // Log::info('called queue job successfully');
        
    //     $lims_sale_data =Sale::where('mail_status','=',0)
    //     ->join('customers','customers.id','=','sales.customer_id')
    //     ->select('customers.email','sales.*')
        
    //     ->take(3)->get();
    //     foreach( $lims_sale_data as $key=>$val)
    //     {
            
            
          
    //         // print_r($val['id']);
    //         $lims_sale_data = Sale::find($val['id']);
    //         $lims_product_sale_data = Product_Sale::where('sale_id', $val['id'])->get();
    //         $lims_biller_data = Biller::find($val->biller_id);
    //         $lims_warehouse_data = Warehouse::find($val->warehouse_id);
    //         $lims_customer_data = Customer::find($val->customer_id);
    //         $lims_payment_data = Payment::where('sale_id', $val['id'])->get();

    //         $numberToWords = new NumberToWords();

    //     if(\App::getLocale() == 'ar' || \App::getLocale() == 'hi' || \App::getLocale() == 'vi' || \App::getLocale() == 'en-gb')
    //         $numberTransformer = $numberToWords->getNumberTransformer('en');
    //     else
    //         $numberTransformer = $numberToWords->getNumberTransformer(\App::getLocale());

    //     $numberInWords = $numberTransformer->toWords($val->grand_total);
           
    //         $pdf = PDF::loadView('pos_mail_notification_PDF.pos_mail_notification',compact('lims_sale_data','lims_product_sale_data','lims_biller_data','lims_warehouse_data','lims_customer_data','lims_payment_data','numberInWords'));
    //         $filePath = 'uploads/PosNotificationPDF/';
    //         $path = public_path($filePath); 
    //         if(!file_exists($path))
    //         {
    //             mkdir($path, 0777, true);
    //         }
    //         $fileName =   $lims_customer_data['name'].'_'.$val['id'].'.'. 'pdf' ;
    //         $pdf_path       =   $filePath.$fileName;
    //         $pdf->save($path . '/' . $fileName);


    //         $details = [
    //             'attachment'=>$path.'/'.$fileName,
    //             'lims_sale_data'=>$lims_sale_data,
    //             'lims_biller_data'=>$lims_biller_data,
    //             'lims_warehouse_data'=>$lims_warehouse_data,
    //             'lims_customer_data'=>$lims_customer_data,
    //             ];

    //             Log::info($lims_customer_data['email']);

    //         // Mail::to($lims_customer_data['email'])->send(new \App\Mail\PosNotification($details));
            
    //         $saleData = Sale::find($val['id']);
    //         $saleData->mail_status = 1;
    //         $saleData->save();

    //         $pos_customer = new PosCustomerNotification();
    //         $pos_customer->sale_id = $val['id'];
    //         $pos_customer->customer_id = $val->customer_id;
    //         $pos_customer->file_path = $pdf_path;
    //         $pos_customer->is_active = 1;
    //         $pos_customer->save();



    //     }
    // }
}
