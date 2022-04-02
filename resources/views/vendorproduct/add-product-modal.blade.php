<!-- Button trigger modal -->
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="exampleModalLabel">@lang('file.Add Product')</h5>
          <button type="button" class=" btn btn-light" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
        </div>
        <div class="modal-body">
            <form id="add-product-form" name="product-form" onsubmit="addProduct(event)">
                <input type="hidden" name="starting_date" id="starting_date" class="form-control" />
                <input type="hidden" name="last_date" id="last_date" class="form-control" />
                <div class="row m-0">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.Product Type')}} *</strong> </label>
                            <div class="input-group">
                                <select name="type" required class="form-control selectpicker" id="productType">
                                <option value="">--Select--</option>
                                    @foreach($productType as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                    <!-- <option value="standard">Standard</option>
                                    <option value="combo">Combo</option>
                                    <option value="digital">Digital</option>
                                    <option value="service">Service</option> -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.Product Name')}} *</strong> </label>
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="name" required>
                            <span class="validation-msg" id="name-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.Product Code')}} *</strong> </label>
                            <div class="input-group">
                                <input type="text" name="code" class="form-control" id="code" aria-describedby="code" required>
                                <div class="input-group-append">
                                    <button id="genbutton" type="button" class="btn btn-sm btn-default" title="{{trans('file.Generate')}}"><i class="fa fa-refresh"></i></button>
                                </div>
                            </div>
                            <span class="validation-msg" id="code-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6" id="attribute_div">
                        <div class="form-group">
                            <label>{{trans('file.Attribute')}} *</strong> </label>
                            
                            <div id="attribute_img" >
                                
                            </div> 
                        </div>
                    </div>

                    <div id="digital" class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.Attach File')}} *</strong> </label>
                            <div class="input-group">
                                <input type="file" name="file" class="form-control">
                            </div>
                            <span class="validation-msg"></span>
                        </div>
                    </div>
                    <div id="combo" class="col-md-6 mb-1">
                        <label>{{trans('file.add_product')}}</label>
                        <div class="search-box input-group mb-3">
                            <button class="btn btn-secondary"><i class="fa fa-barcode"></i></button>
                            <input type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="Please type product code and select..." class="form-control" />
                        </div>
                        <label>{{trans('file.Combo Products')}}</label>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover order-list">
                                <thead>
                                    <tr>
                                        <th>{{trans('file.product')}}</th>
                                        <th>{{trans('file.Quantity')}}</th>
                                        <th>{{trans('file.Unit Price')}}</th>
                                        <th><i class="dripicons-trash"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.Brand')}}</strong> </label>
                            <div class="input-group">
                                <select name="brand_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Brand...">
                                @foreach($lims_brand_list as $brand)
                                    <option value="{{$brand->id}}">{{$brand->title}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.category')}} *</strong> </label>
                            <div class="input-group">
                            <select name="category_id" required class="selectpicker form-control" data-live-search="true" title="Select Category...">
                                @foreach($lims_category_list as $category)
                                    @if($category->parent_id == '' || null)
                                        <option value="{{$category->id}}" class="option_parent">{{$category->name}}</option>
                                        @foreach($lims_category_list as $subcategory)
                                        @if($category->id == $subcategory->parent_id)
                                        <option value="{{$subcategory->id}}" class="option_sub">&nbsp - {{$subcategory->name}}</option>    
                                        @endif    
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                            </div>
                            <span class="validation-msg"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.sku')}} *</strong> </label>
                            <input type="text" name="sku" required class="form-control">
                            <span class="validation-msg"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Family {{trans('file.name')}} *</strong> </label>
                            <input type="text" name="family_name" required class="form-control">
                            <span class="validation-msg"></span>
                        </div>
                    </div>
                    
                    <div id="unit" class="col-md-12 p-0">
                        <hr>
                        <div class="row m-0">
                            <div class="col-md-4 mt-3 ">
                                    <label>{{trans('file.Product Unit')}} *</strong> </label>
                                    <div class="input-group">
                                        <select required class="form-control selectpicker" name="unit_id">
                                        <option value="" disabled selected>Select Product Unit...</option>
                                        @foreach($lims_unit_list as $unit)
                                            @if($unit->base_unit==null)
                                                <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                    <span class="validation-msg"></span>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label>{{trans('file.Sale Unit')}}</strong> </label>
                                <div class="input-group">
                                    <select class="form-control selectpicker" name="sale_unit_id">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="">
                                    <label>{{trans('file.Purchase Unit')}}</strong> </label>
                                    <div class="input-group">
                                        <select class="form-control selectpicker" name="purchase_unit_id">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Common {{trans('file.name')}} *</strong> </label>
                            <input type="text" name="common_name" required class="form-control">
                            <span class="validation-msg"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="form-group">
                            <label>{{trans('file.size')}} *</strong> </label>
                            <input type="number" min="0" onkeypress="return isNumber(event)" name="size" required class="form-control" step="any">
                            <span class="validation-msg"></span>
                        </div>
                    </div>                
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{trans('file.Product Image')}}</strong> </label> <i class="dripicons-question" data-toggle="tooltip" title="{{trans('file.You can upload multiple image. Only .jpeg, .jpg, .png, .gif file can be uploaded. First image will be base image.')}}"></i>
                            <div id="imageUpload" class="dropzone"></div>
                            <span class="validation-msg" id="image-error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{trans('file.Product Details')}}</label>
                            <textarea name="product_details" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-right pt-3">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="{{trans('file.submit')}}" id="submit-btn" class="btn btn-primary">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>