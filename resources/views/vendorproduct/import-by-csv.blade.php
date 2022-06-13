@extends('layout.main') @section('content')

<section>
    <div class="container-fluid"> 
        <div class="card card-body">
            <div class="row m-0">
                <div class="card-body">
                    <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('file.vendor')}} </label>
                                        <select required name="vendor_id" class="selectpicker form-control" data-live-search="true" id="vendor_id" data-live-search-style="begins" title="Select vendor...">
                                          <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""></label>
                                        <input type="submit" value="{{trans('file.export')}}" class="btn btn-primary btn-block btn-lg" id="submit-button">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::open(['route' => 'vendorproducts.import', 'method' => 'post', 'files' => true, 'class' => 'vendorproduct-form']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('file.Upload CSV File')}} *</label>
                                        <input type="file" name="file" class="form-control" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""></label>
                                        <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary btn-block btn-lg" id="submit-button">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script>
</script>
@endpush
