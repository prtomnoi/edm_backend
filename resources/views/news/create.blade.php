@extends('../layout')

@section('title', 'New Management')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Add News </h5>

                    <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group mb-2">
                         <label for="">Title</label>
                         <input type="text" class="form-control" name="title" placeholder="Title">
                      </div>
                      <div class="form-group mb-2">
                        <label for="">Detail</label>
                        <textarea name="detail" class="form-control"  placeholder="Detail" id="editor"></textarea>
                     </div>
                      <div class="form-group mb-2">
                        <label for="">Provider</label>
                        <select name="provider_id" class="form-control">
                          @foreach($providers as $provider)
                              <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                          @endforeach
                      </select>
                       </div>
                       <div class="form-group col-4 mb-2">
                          <img id="example_image01" src="{{asset("assets/noimage.jpg")}}" class="img-fluid" alt="" style="width:100%">
                      </div>
                      <div class="form-group mb-2">
                        <label for="">File</label>
                        <input type="file" name="image" accept="image/png, image/gif, image/jpeg" onchange="readURL01(this);" class="form-control">
                      </div>
                      <div class="form-group mb-2">
                        <label for="">Status</label>
                        <select name="status" class="form-control">
                          <option value="draft">Draft</option>
                          <option value="published">Published</option>
                      </select>
                      </div>
                      
                     
                 
                    
                 
                      <button type="submit" class="btn btn-success">Create</button>
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
</script>
  @endsection
