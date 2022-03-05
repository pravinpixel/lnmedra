@extends('layout.vendor')
@section('content') 
@if(session()->has('not_permitted'))
    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
@if(session()->has('message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
@endif 
    <div class="container-fluid">
        <div class="col-md-8 mb-3 mt-4 mx-auto">
            <div class="row align-items-center">
            <div class="col text-end">Choose the date period</div>
            <div class="col d-flex p-0">
                <input type="date" name="" id="" class="form-control mx-1">
                <input type="date" name="" id="" class="form-control mx-1">
                <input type="submit" name="" value="Submit" id="" class="btn btn-defult w-100">
            </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="wrapper count-title text-center">
                    <div class="icon"><i class="dripicons-graph-bar" style="color: #0095ff"></i></div>
                    <div class="name"><strong style="color: #0095ff">Sales</strong></div>
                    <div class="count-number revenue-data">134500</div>
                </div>
            </div>
            <div class="col">
                <div class="wrapper count-title text-center">
                    <div class="icon"><i class="dripicons-return" style="color: #0095ff"></i></div>
                    <div class="name"><strong style="color: #0095ff">Purchase</strong></div>
                    <div class="count-number return-data">250500</div>
                </div>
            </div>
            <div class="col">
                <div class="wrapper count-title text-center">
                    <div class="icon"><i class="dripicons-media-loop" style="color: #0095ff"></i></div>
                    <div class="name"><strong style="color: #0095ff">Expense</strong></div>
                    <div class="count-number purchase_return-data">50000</div>
                </div>
            </div> 
        </div>
        <div class="row card">
            <div class="d-flex justify-content-between align-items-center p-3 ">
                <h3 class="m-0">Product Listing</h3>
                <div class="float-end">
                    <a href="" class="btn btn-primary">Add Product</a>
                <a href="" class="btn btn-secondary">Export</a>
                </div>
            </div>
            <table class="table custom table-hover bg-white">
                <thead>
                    <tr>
                        <th> Sl. No </th>
                        <th> Product Name </th>
                        <th> Product Type </th>
                        <th> Brand </th>
                        <th> Category </th>
                        <th> Quantity </th>
                        <th> Unit Price </th>
                        <th> Status </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                    @for ($key=0;$key<10;$key++)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td class="text-center">product {{ $key+1 }}</td> 
                            <td class="text-center">Type {{ $key+1 }}</td> 
                            <td class="text-center">Brand {{ $key+1 }}</td> 
                            <td class="text-center">Category {{ $key+1 }}</td> 
                            <td class="text-center">240</td> 
                            <td class="text-center">{{ $key+1 }}000</td> 
                            <td class="text-center">
                                @if ($key == 3 || $key == 6)
                                    <span class="badge badge-warning">Inactive </span>
                                @else
                                    <span class="badge badge-success">Active</span>
                                @endif
                            </td> 
                            <td class="text-center">
                                <i class="fa fa-pencil text-info me-1 mr-2 btn btn-light"></i>
                                <i class="fa fa-trash text-danger btn btn-light"></i>
                            </td> 
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    // Show and hide color-switcher
    $(".color-switcher .switcher-button").on('click', function() {
        $(".color-switcher").toggleClass("show-color-switcher", "hide-color-switcher", 300);
    });

    // Color Skins
    $('a.color').on('click', function() {
        /*var title = $(this).attr('title');
        $('#style-colors').attr('href', 'css/skin-' + title + '.css');
        return false;*/
        $.get('setting/general_setting/change-theme/' + $(this).data('color'), function(data) {
        });
        var style_link= $('#custom-style').attr('href').replace(/([^-]*)$/, $(this).data('color') );
        $('#custom-style').attr('href', style_link);
    });

    $(".date-btn").on("click", function() {
        $(".date-btn").removeClass("active");
        $(this).addClass("active");
        var start_date = $(this).data('start_date');
        var end_date = $(this).data('end_date');
        $.get('dashboard-filter/' + start_date + '/' + end_date, function(data) {
            dashboardFilter(data);
        });
    });

    function dashboardFilter(data){
        $('.revenue-data').hide();
        $('.revenue-data').html(parseFloat(data[0]).toFixed(2));
        $('.revenue-data').show(500);

        $('.return-data').hide();
        $('.return-data').html(parseFloat(data[1]).toFixed(2));
        $('.return-data').show(500);

        $('.profit-data').hide();
        $('.profit-data').html(parseFloat(data[2]).toFixed(2));
        $('.profit-data').show(500);

        $('.purchase_return-data').hide();
        $('.purchase_return-data').html(parseFloat(data[3]).toFixed(2));
        $('.purchase_return-data').show(500);
    }
</script>
@endpush
