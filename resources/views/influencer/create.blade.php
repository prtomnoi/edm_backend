@extends('../layout')

@section('title', "$name_page Management")

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Add {{ @$name_page }} </h5>

                        <form action="{{ route("$folder.store") }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Title">
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Subscribe</label>
                                <input type="text" class="form-control" name="subscribe" onkeypress="return chkNumber(event)" value="0" placeholder="Subscribe">
                            </div>
                            <div class="row">
                              <div class="form-group col-md-6 mb-2">
                                  <label for="">Facebook</label>
                                  <input type="text" class="form-control" name="facebook" value="" placeholder="Facebook">
                              </div>
                              <div class="form-group col-md-6 mb-2">
                                  <label for="">Twitter</label>
                                  <input type="text" class="form-control" name="twitter" value="" placeholder="Twitter">
                              </div>
                              <div class="form-group col-md-6 mb-2">
                                    <label for="">Youtube</label>
                                    <input type="text" class="form-control" name="youtube" value="" placeholder="Youtube">
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                  <label for="">Instagram</label>
                                  <input type="text" class="form-control" name="instagram" value="" placeholder="Instagram">
                              </div>
                            </div>

                            <div class="form-group col-4 mb-2">
                                <img id="example_image02" src="{{ asset('assets/noimage.jpg') }}" class="img-fluid" alt="" style="width:100%">
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Icon</label>
                                <input type="file" name="icon" accept="image/png, image/gif, image/jpeg" onchange="readURL02(this);" class="form-control">
                            </div>

                            <div class="form-group col-4 mb-2">
                                <img id="example_image01" src="{{ asset('assets/noimage.jpg') }}" class="img-fluid" alt="" style="width:100%">
                            </div>
                            <div class="form-group mb-2">
                                <label for="">File</label>
                                <input type="file" name="image" accept="image/png, image/gif, image/jpeg"
                                    onchange="readURL01(this);" class="form-control">
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
