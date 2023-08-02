@extends('../layout')

@section('title', 'หน้าหลัก')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">{{@$name_page}} Mangement</h5>
                        <a href="{{ route("$folder.create") }}" class="btn btn-primary mb-3"> <i class="ti ti-plus"></i> Add
                            data</a>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle" id="myTable">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">#</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Image</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Title</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Created</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Status</h6>
                                        </th>
                                        <th class="border-bottom-0 text-center">
                                            <h6 class="fw-semibold mb-0">Action</h6>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- BEGIN member -->
                                    @if(@$items)
                                    @foreach(@$items as $key=>$item)
                                      <tr>
                                        
                                          <td style="width:5%;">{{$key+1}}</td>
                                          <td style="width:10%;"><a href="{{$item->image}}" target="_blank"><img src="{{$item->image}}" alt="" style="width:100%;"></a></td>
                                          <td style="width:50%;">{{$item->name}}</td>
                                          <td style="width:15%;">{{ Helper::dateThai($item->created_at) }}</td>
                                          <td style="width:10%;">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" onclick="status('{{$item->id}}');" @if($item->status == "published") checked @endif>
                                            </div>
                                        </td>
                                          <td class="text-center" style="width:10%;">
                                              <a href="{{route("$folder.edit",$item->id)}}" class="btn btn-warning"><i class="ti ti-pencil"></i> Edit</a>
                                              <a href="javascript:void(0)" onclick="destroy('{{$item->id}}')" class="btn btn-danger"><i class="ti ti-trash"></i> Delete</a>
                                          </td>
                                      </tr>
                                    @endforeach
                                    @endif
                                    <!-- END member  -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
      var fullUrl = window.location.origin + window.location.pathname;
      function destroy(id) {
        Swal.fire({
            title: "Delete",
            text: "Do you want to delete your item ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: `Cancel`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',
                    url: `/{{$folder}}/${id}`,
                    data: {
                      _token: '{{ csrf_token() }}',
                    },
                    dataType: 'json',
                    success: function(data) {
                      Swal.fire({
                          icon: 'success',
                          title: data.message,
                          text: data.desc,
                          showCancelButton: false,
                          confirmButtonText: 'Close',
                      }).then((result) => {
                          location.reload();
                      });
                    },
                    error: function(data) {
                      Swal.fire({
                          icon: 'error',
                          title: data.responseJSON.message,
                          text: data.responseJSON.desc,
                          showCancelButton: false,
                          confirmButtonText: 'Close',
                      });
                    }
                });
            }
        });
      }

      function status(ids) {
        const $this = $(this),
            id = ids;
        $.ajax({
            type: 'get',
            url: fullUrl + '/status/' + id,
            success: function(res) {
                if (res == false) {
                    $(this).prop('checked', false)
                }
            }
        });
    }
    </script>
@endsection