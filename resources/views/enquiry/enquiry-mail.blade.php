@extends('layout.main') @section('content')
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
<style>
     .error{
            color: red;
        }
        .mce-item-table{
            width: 100% !important;
        }
        
          
        
</style>
<section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4><strong>{{trans('file.Enquiry Mail')}}</strong></h4>
                        </div>
                        <div class="card-body">
                            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                            {!! Form::open(['route' => 'enquiry.sentMail','name'=>'enquirySentMail','id'=>'enquirySentMail', 'method' => 'post', 'files' => true]) !!}
                            <input type="hidden" id="enquiry_id" name="enquiry_id" value="{{$data['id']}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('file.To')}} *</strong> </label>
                                        <input type="text" name="email" id="name" value="{{$data['email']}}" placeholder="example@example.com" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('file.Subject')}} *</label>
                                        <input type="text" name="subject" placeholder="example@example.com" value="{{$mailDetail[0]['subject']}}" required class="form-control">
                                        @if($errors->has('subject'))
                                        <span>
                                        <strong style="color: red;">{{ $errors->first('subject') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('file.BCC')}} *</label>
                                        <input type="text" name="bcc" placeholder="example@example.com" value="{{$mailDetail[0]['bcc']}}" required class="form-control">
                                        @if($errors->has('bcc'))
                                    <span>
                                        <strong style="color: red;">{{ $errors->first('bcc') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('file.CC')}} *</label>
                                        <input type="text" name="cc" value="{{$mailDetail[0]['cc']}}" required class="form-control">
                                        @if($errors->has('cc'))
                                            <span>
                                                <strong style="color: red;">{{ $errors->first('cc') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('file.Attachment')}} *</label>
                                        <input type="file" name="filenames[]" value="{{old('attachment')}}" required class="form-control" multiple>
                                        @if($errors->has('attachment'))
                                            <span>
                                                <strong style="color: red;">{{ $errors->first('attachment') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{trans('file.Product Details')}}</label>
                                        <textarea name="mail_content" class="form-control" rows="3">
                                            
                                            {{$mailDetail[0]['mail_content']}}

                                        </textarea>
                                    </div>
                                </div>
                                
                               
                                
                                <div class="col-md-6">
                                    <div class="form-group mt-4">
                                        <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-4">
                                    <input type="button" id="btnShowPopup" value="Preview" class="btn btn-primary" />
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
            
      
        <div id="MyPopup" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            &times;</button>
                        <h4 class="modal-title">
                        </h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['route' => 'enquiry.sentMail','name'=>'enquirySentMail','id'=>'enquirySentMail', 'method' => 'post', 'files' => true]) !!}
                            <input type="hidden" id="enquiry_id" name="enquiry_id" value="{{$data['id']}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>  
                            </div>
                            {!! Form::close() !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Close</button>
                    </div>
                </div>
            </div>
        </div>
</section>


@endsection

@push('scripts')
<script type="text/javascript">
   $(function () {
        $("#btnShowPopup").click(function () {
            var title = "Greetings";
            var body = "Welcome to ASPSnippets.com";
            var enquiry_name = "{{$data['name'] }}";
            var enquiry_email = "{{$data['email'] }}";
            var enquiry_cc = "{{$mailDetail[0]['cc'] }}";
            var mail_content = {!! json_encode($mailDetail[0]['mail_content']) !!};
           
            
            $("#MyPopup .modal-title").html(title);
            $("#MyPopup .modal-body").html(`
            Name: <strong>${enquiry_name}</strong><br>
            To:   <strong>${enquiry_email}</strong><br>
            CC:   <strong>${enquiry_cc}</strong>
            
            <strong>${mail_content}</strong>
            
            `);
            $("#MyPopup").modal("show");
           
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".hdtuto").remove();
          $(this).parents(".hdtuto").val('');
      });
    });
</script>

<script type="text/javascript">
    tinymce.init({
      selector: 'textarea',
      height: 130,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code wordcount'
      ],
      toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
      branding:false
    });
     $(document).ready(function(){
        $("#enquirySentMail").validate({
                    
                    rules: {
                    
                      
                        
                        'to': {
                            required: true,
                            email: true
                        },
                        'cc': {
                            required: true,
                           
                        },
                        'filenames': {
                            required: true,
                           
                        },
                    
                    },
                  
                }); 
     });
    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");
    $("ul#people #supplier-create-menu").addClass("active");
</script>
@endpush
