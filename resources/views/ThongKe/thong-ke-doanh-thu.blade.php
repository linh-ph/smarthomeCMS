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
            <div class="col-md-3 col-xl-3">
            </div>
            <div class="col-md-6 col-xl-6">
                    <div class="card-box" style="margin-top: 20%">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-sm bg-light rounded">
                                    <i class="fas fa-file-invoice-dollar avatar-title font-22 text-success"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark my-1"><span data-plugin="counterup">{{$lichSuMuaCredit}}</span></h3>

                                    <p class="text-muted mb-1 text-truncate">Thống kê doanh thu trong tháng</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h6 class="text-uppercase">Mục tiêu <span class="float-right">13%</span></h6>
                            <div class="progress progress-sm m-0">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="49" aria-valuemin="0" aria-valuemax="100" style="width: 13%">
                                    <span class="sr-only">13% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-box-->
                </div>
                <div class="col-md-3 col-xl-3">
                </div>
        </div>

            <!-- <div class="col-md-6 col-xl-6">
                <div class="card-box" style="margin-top: 20%">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-sm bg-light rounded">
                                <i class="fe-shopping-cart avatar-title font-22 text-success"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">1576</span></h3>
                                <p class="text-muted mb-1 text-truncate">January's Sales</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h6 class="text-uppercase">Mục tiêu <span class="float-right">49%</span></h6>
                        <div class="progress progress-sm m-0">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="49" aria-valuemin="0" aria-valuemax="100" style="width: 49%">
                                <span class="sr-only">49% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>




        
    @endsection