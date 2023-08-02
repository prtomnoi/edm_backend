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
                                <label for="">Short Detail</label>
                                <textarea name="short_detail" class="form-control" placeholder="Short detail"></textarea>
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Detail</label>
                                <textarea name="detail" class="form-control" placeholder="Detail" id="editor"></textarea>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-3 mb-2">
                                  <label for="">Reward price 1</label>
                                  <input type="text" class="form-control" name="reward1" onkeypress="return chkNumber(event)" value="0" placeholder="Reward price 1">
                              </div>
                              <div class="form-group col-md-3 mb-2">
                                  <label for="">Reward price 2</label>
                                  <input type="text" class="form-control" name="reward2" onkeypress="return chkNumber(event)" value="0" placeholder="Reward price 2">
                              </div>
                              <div class="form-group col-md-3 mb-2">
                                    <label for="">Reward price 3</label>
                                    <input type="text" class="form-control" name="reward3" onkeypress="return chkNumber(event)" value="0" placeholder="Reward price 4">
                                </div>
                                <div class="form-group col-md-3 mb-2">
                                  <label for="">Reward price 4</label>
                                  <input type="text" class="form-control" name="reward4" onkeypress="return chkNumber(event)" value="0" placeholder="Reward price 4">
                              </div>
                            </div>
                            <div class="form-group col-4 mb-2">
                                <img id="example_image01" src="{{ asset('assets/noimage.jpg') }}" class="img-fluid"
                                    alt="" style="width:200px">
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
CKEDITOR.config.allowedContent = true;
        CKEDITOR.replace('editor', {
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
        });

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
