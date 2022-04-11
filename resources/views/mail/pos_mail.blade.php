<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{url('public/logo', $general_setting->site_logo)}}" />
    <title>{{$general_setting->site_title}}</title>
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <style type="text/css">
        * {
            font-size: 14px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: capitalize;
        }
        .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor:pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }
        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }
        tr {border-bottom: 1px dotted #ddd;}
        td,th {padding: 7px 0;width: 50%;}

        table {width: 100%;}
        tfoot tr th:first-child {text-align: left;}

        .centered {
            text-align: center;
            align-content: center;
        }
        small{font-size:11px;}

        @media print {
            * {
                font-size:12px;
                line-height: 20px;
            }
            td,th {padding: 5px 0;}
            .hidden-print {
                display: none !important;
            }
            @page { margin: 1.5cm 0.5cm 0.5cm; }
            @page:first { margin-top: 0.5cm; }
            tbody::after {
                content: ''; display: block;
                page-break-after: always;
                page-break-inside: avoid;
                page-break-before: avoid;        
            }
        }
    </style>
  </head>
<body>

<div style="max-width:400px;margin:0 auto">
    @if(preg_match('~[0-9]~', url()->previous()))
        @php $url = '../../pos'; @endphp
    @else
        @php $url = url()->previous(); @endphp
    @endif
    
        
    <div id="receipt-data">
        <div class="centered">
            @if($general_setting->site_logo)
                <img src="{{url('public/logo', $general_setting->site_logo)}}" height="42" width="50" style="margin:10px 0;filter: brightness(0);">
            @endif
            
            <h2>{{$details['lims_biller_data']->company_name}}</h2>
            
            <p>{{trans('file.Address')}}: {{$details['lims_warehouse_data']->address ?? ''}}
                <br>{{trans('file.Phone Number')}}: {{$details['lims_warehouse_data']->phone ?? ''}}
            </p>
        </div>
        <p>{{trans('file.Date')}}: {{$details['lims_sale_data']->created_at}}<br>
            {{trans('file.reference')}}: {{$details['lims_sale_data']->reference_no}}<br>
            {{trans('file.customer')}}: {{$details['lims_customer_data']->name}}
        </p>
      
      
    </div>
</div>

<script type="text/javascript">
    localStorage.clear();
    function auto_print() {     
        window.print()
    }
    setTimeout(auto_print, 1000);
</script>

</body>
</html>
