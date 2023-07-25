@extends('../layout')

@section('title', 'หน้าหลัก')

@section('content')
      <div class="container-fluid">
        <div class="row">
        
            <div class="col-lg-12 d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body p-4">
                  <h5 class="card-title fw-semibold mb-4">News Mangement</h5>
                  <a href="{{ route('news.create') }}"  class="btn btn-primary mb-3"> <i class="ti ti-plus"></i> Add data</a>
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
                              <h6 class="fw-semibold mb-0">Provider</h6>
                            </th>
                            <th class="border-bottom-0">
                              <h6 class="fw-semibold mb-0">Created</h6>
                            </th>
                            <th class="border-bottom-0">
                              <h6 class="fw-semibold mb-0">Status</h6>
                            </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Action</h6>
                          </th>
                        
                        </tr>
                      </thead>
                      <tbody>
                          <!-- BEGIN member -->
                        <tr>
                           <td>{member.num}</td>
                           <td>{member.branch}</td>
                           <td>{member.code} / {member.name}</td>
                           <td>{member.phone}</td>
                           <td>{member.jobdate}</td>
                           <td>
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                             
                            </div>
                           </td>
                           <td>
                              <a href="javascript:void(0)" onclick="edit_branch('{member.id}')" class="btn btn-warning"><i class="ti ti-pencil"></i> Edit</a>
                              <a href="javascript:void(0)" onclick="delete_data('{member.id}', 'employee_result')" class="btn btn-danger"><i class="ti ti-trash"></i> Delete</a>
                          </td>
                        </tr>              
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