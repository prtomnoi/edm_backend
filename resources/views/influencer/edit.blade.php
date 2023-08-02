@extends('../layout')

@section('title', "$name_page Management")

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Update {{ @$name_page }} </h5>

                        <form action="{{ route("$folder.update",$row->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group mb-2">
                                <label for="">Influencer Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Influencer Name"  value="{{@$row->name}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Title" value="{{@$row->title}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Subscribe</label>
                                <input type="text" class="form-control" name="subscribe" onkeypress="return chkNumber(event)" value="{{@$row->subscribe}}" placeholder="Subscribe">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 mb-2">
                                    <label for="">Facebook</label>
                                    <input type="text" class="form-control" name="facebook" value="{{@$row->facebook}}" placeholder="Facebook">
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label for="">Twitter</label>
                                    <input type="text" class="form-control" name="twitter" value="{{@$row->twitter}}" placeholder="Twitter">
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                      <label for="">Youtube</label>
                                      <input type="text" class="form-control" name="youtube" value="{{@$row->youtube}}" placeholder="Youtube">
                                  </div>
                                  <div class="form-group col-md-6 mb-2">
                                    <label for="">Instagram</label>
                                    <input type="text" class="form-control" name="instagram" value="{{@$row->instagram}}" placeholder="Instagram">
                                </div>
                            </div>
                            
                            <div class="form-group col-2 mb-2">
                                <img id="example_image02" src="@if($row->icon){{asset("$row->icon")}}@else {{asset("assets/noimage.jpg")}}@endif"   alt="" style="width:200px">
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Icon</label>
                                <input type="file" name="icon" accept="image/png, image/gif, image/jpeg" onchange="readURL02(this);" class="form-control">
                            </div>

                            <div class="form-group col-4 mb-2">
                                <img id="example_image01" src="@if($row->image){{asset("$row->image")}}@else {{asset("assets/noimage.jpg")}}@endif"  alt="" style="width:200px">
                            </div>
                            <div class="form-group mb-2">
                                <label for="">File</label>
                                <input type="file" name="image" accept="image/png, image/gif, image/jpeg" onchange="readURL01(this);" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Status</label>
                                <select name="status" class="form-control">
                                    <option value="draft" @if($row->status == "draft") selected @endif>Draft</option>
                                    <option value="published" @if($row->status == "published") selected @endif>Published</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{route("$folder.index")}}" class="btn btn-warning">Back</a>
                        
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
<script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'editor' );

  function readURL01(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#example_image01').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURL02(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#example_image02').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection