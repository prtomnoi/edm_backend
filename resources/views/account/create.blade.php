@extends('../layout')

@section('title', "$name_page Management")

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Add {{ @$name_page }} </h5>

                        <form action="{{ route("$folder.store") }}" method="post" enctype="multipart/form-data" onsubmit="return checkValue();">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="">Email <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="">Password <span class="text-danger">*</span></label>
                                        <input type="password" id="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="">Confirm password <span class="text-danger">*</span></label>
                                        <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Confirm Password" autocomplete="off">
                                    </div>
                                </div>
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
    function checkValue() {
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();
        if(name == "" || email == "" || password == "" || confirm_password == ""){
            toastr.error("Sorry, please complete the information.");
            return false;
        }
        if (password != confirm_password) {
            toastr.error('Please enter the same password.');
            return false;
        }
    }
    </script>
@endsection
