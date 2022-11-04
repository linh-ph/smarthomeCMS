@extends('layout')

@section('js')
<!-- third party js -->
<script src="{{asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{asset('assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{asset('assets/libs/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{asset('assets/libs/datatables/buttons.html5.min.js') }}"></script>
<script src="{{asset('assets/libs/datatables/buttons.flash.min.js') }}"></script>
<script src="{{asset('assets/libs/datatables/buttons.print.min.js') }}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.select.min.js') }}"></script>
<script src="{{asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{asset('assets/libs/pdfmake/vfs_fonts.js') }}"></script>
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Sweet alert init js-->
<script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>
<!-- third party js ends -->
@if(session('success'))
    <script>
        swal.fire("{{ session('success') }}","" , "success")
    </script>
@endif
@if(session('error'))
    <script>
        swal.fire("{{ session('error') }}","" , "error")
    </script>
@endif
 <!-- Datatables init -->
<!-- <script src="{{asset('assets/js/pages/datatables.init.js') }}"></script> -->
<script type="text/javascript">
$(document).ready(function() {
    $("#linh-vuc-datatable").DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            }
        },
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        }
    });
});
</script>
@endsection

@section('css')
<!-- third party css -->
<link href="{{asset('assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- third party css end -->
@endsection

@section('main-content')
<h1>Danh sách quản trị viên đã xóa</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <br/>
                    <br/>
                    <br/>
                    <table id="linh-vuc-datatable" class="table dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
	                            <th>Họ và tên</th>
	                            <th>Tên đăng nhập</th>
	                            <th>Số điện thoại</th>
	                            <th>Email</th>
	                            <th>Ngày tạo</th>
                                <th></th>                                 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quanTriVien as $QuanTriVien)
                                <tr>
                                    <td>{{ $QuanTriVien->id }}</td>
                                    <td>{{ $QuanTriVien->name }}</td>
                                    <td>{{ $QuanTriVien->username }}</td>
                                    <td>{{ $QuanTriVien->phone }}</td>
                                    <td>{{ $QuanTriVien->email }}</td>
                                    <td>{{ $QuanTriVien->created_at }}</td>
                                    <td>
                                        <button onclick="Restore({{$QuanTriVien->id}})" type="button" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-backup-restore"></i></button>
                                        <button onclick="Xoa({{$QuanTriVien->id}})" type="button" class="btn btn-danger waves-effect waves-light"><i class=" mdi mdi-delete"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
            </div>
            <script>
                function Xoa($id) {
                    Swal.fire({
                        title: 'Bạn có muốn xóa vĩnh viễn không?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok. Xóa nó!',
                        cancelButtonText:'Không'
                        }).then((result) => {
                        if (result.value) {
                            $url = 'delete/'+$id;
                            open($url,"_self") 
                        }
                    })
                };
                function Restore($id){
                    Swal.fire({
                        title: 'Bạn có muốn phục hồi quản trị viên không?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok. Phục hồi!',
                        cancelButtonText:'Không'
                        }).then((result) => {
                        if (result.value) {
                            $url = 'restore/'+$id;
                            open($url,"_self") 
                        }
                    })
                };
            </script>
@endsection