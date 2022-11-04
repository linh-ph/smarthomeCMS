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
	    swal.fire("{{ session('success') }}", "", "success")
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
	<h1>Danh sách người dùng</h1>
	<div class="row">
	    <div class="col-12">
	        <div class="card">
	            <div class="card-body">
	                <div class="row">
	                    <div class="col-sm-12 col-md-6">
	                        <a href="{{route('nguoi-dung.them-moi')}}" class="btn btn-info waves-effect waves-light">
	                            <i class="mdi mdi-plus-box"></i> Thêm người dùng
	                        </a>
	                    </div>
	                    <div class="col-sm-12 col-md-6" style="text-align: right;">
	                        <a href="{{route('nguoi-dung.thung-rac')}}" class="btn btn-info waves-effect waves-light">
	                            <i class="mdi mdi-delete-empty"></i> Thùng rác
	                        </a>
	                    </div>
	                </div>
	                <br />
	                <br />
	                <br />
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
	                        @foreach($users as $user)
	                        <tr>
	                            <td>{{ $user->id }}</td>
	                            <td>{{ $user->name }}</td>
	                            <td>{{ $user->username }}</td>
	                            <td>{{ $user->phone }}</td>
	                            <td>{{ $user->email }}</td>
	                            <td>{{ $user->created_at }}</td>
	                            <td>
	                                <button onclick="capNhat({{$user->id}})" type="button" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-pen"></i></button>
	                                <button onclick="Xoa({{$user->id}})" type="button" class="btn btn-danger waves-effect waves-light"><i class=" mdi mdi-delete"></i></button>
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
	            title: 'Bạn có chắc chắn muốn xóa người dùng này không?',
	            type: 'warning',
	            showCancelButton: true,
	            confirmButtonColor: '#3085d6',
	            cancelButtonColor: '#d33',
	            confirmButtonText: 'Ok. Xóa nó!',
	            cancelButtonText: 'Không'
	        }).then((result) => {
	            if (result.value) {
	                $url = 'nguoi-dung/xoa/' + $id;
	                open($url, "_self")
	            }
	        })
	    };

	    function capNhat($id) {
	        $url = 'nguoi-dung/cap-nhat/' + $id;
	        open($url, "_self");
	    }
	</script>
	@endsection