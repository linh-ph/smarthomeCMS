@extends('layout')

@section('js')
<!-- third party js -->
<!-- third party js ends -->
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Sweet alert init js-->
<script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>
<!-- Datatables init -->
@if(session('success'))
<script>
    swal.fire("{{ session('success') }}", "", "success")
</script>
@endif
@if(session('error'))
<script>
    swal.fire("{{ session('error') }}", "", "error")
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
                <h4 class="mb-3 header-title">Cập nhật thông tin người dùng</h4>
                <form action="{{ route('nguoi-dung.xl-cap-nhat',$user->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input value="{{ $user->name }}" type="text" class="form-control" id="name" name="name" placeholder="Nhập tên người dùng" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="{{ $user->email }}" type="text" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                    </div>
                    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-content-save"></i> Lưu</button>

                </form>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>
    <!-- end col -->

</div>
@endsection