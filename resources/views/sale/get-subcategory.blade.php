@foreach($subcategories as $subcategory)
    <div class="col-md-3 subcategory-img" data-category="{{$subcategory->id}}">
        <div class="card shadow" style="overflow: hidden">
            @if($subcategory->image)
            <img src="{{url('public/images/category', $subcategory->image)}}" class="card-img-top"/>
            @else
                <img  src="{{url('public/images/product/zummXD2dvAtI.png')}}" class="card-img-top"/>
            @endif
            <div class="card-body p-2 text-center">
                <h5 class="card-title m-0">{{$subcategory->name}}</h5> 
            </div>
        </div>
    </div>
@endforeach
@if(count($subcategories) == 0) 
<p class="text-center mx-auto">No data avaialable</p>
@endif