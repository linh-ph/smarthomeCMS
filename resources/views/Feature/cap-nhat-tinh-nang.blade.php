@extends('layout')

    @section('js')
    <!-- third party js -->
    <!-- third party js ends -->
    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>
    <!-- Datatables init -->
    @if(!isset($capNhat))
    @elseif ($capNhat == 1)
        <script>
            swal.fire("Cập nhật thất bại!","" , "error")
        </script>
    @endif
    @endsection
    @section('css')
    <!-- third party css -->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
    @endsection

    @section('main-content')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3 header-title">Cập nhật tính năng</h4>
                        <form action="{{ route('tinh-nang.xl-cap-nhat',$cnTinhNang->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên tính năng</label>
                                <input type="text" class="form-control" value="{{ $cnTinhNang->name }}" 
                                id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="status_feature">Trạng thái</label>
                                <input type="text" class="form-control" value="{{ $cnTinhNang->status }}" 
                                id="status_feature" name="status">
                            </div>
                           <button type="submit" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-content-save" ></i> Lưu</button>
                           
                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
            <!-- end col -->

        </div>
    @endsection