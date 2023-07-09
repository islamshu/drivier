@section('header')
    <link rel="stylesheet" href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.css')}}" />
    <link href="{{ url('public/assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .modal-body {
            max-height: calc(100vh - 212px);
            overflow-y: auto;
        }
        .modal-body h4 {
            font-size: 15px;
            font-weight: bolder;
        }
    </style>
@endsection

@section('buttons')


    <a class="btn btn-outline dark" data-toggle="modal" href="#responsive"> <i class="fa fa-plus-square"></i> </a>


    <div id="responsive" class="modal fade" tabindex="-1" data-width="760">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Create Driver</h4>
        </div>
        <form action="{{ url(route('drivers.store'))}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="fname" placeholder="First Name ">
                            <span class="help-block">First Name</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="lname" placeholder="Last Name ">
                            <span class="help-block">Last Name</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Vehicle</label>
                            <select class="bs-select form-control" name="vehicle_id" data-live-search="true" data-size="8">
                                @isset($vehicles)
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id}}">{{ $vehicle->manufacturer }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-md-line-input">
                            <input type="email" class="form-control" name="email" placeholder="Email Address ">
                            <span class="help-block">Email Address</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-md-line-input">
                            <input type="password" class="form-control" name="password" placeholder="Password ">
                            <span class="help-block">Password</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Courier</label>
                            <select class="bs-select form-control" name="courier_name" data-live-search="true" data-size="8">
                                @isset($couriers)
                                    @foreach($couriers as $courier)
                                        <option value="{{ $courier->courier_name}}">{{ $courier->courier_name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="phone" placeholder="Phone">
                            <span class="help-block">Phone</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="birthday" placeholder="Birthday ">
                            <span class="help-block">Birthday</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input has-info">
                            <select class="form-control" name="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <label >Gender</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input has-info">
                            <select class="form-control" name="active">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <label >Status</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
                <button type="submit" class="btn red">Create Supplier User</button>
            </div>
        </form>
    </div>
@endsection



@push('script')
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    
    <script>
        $(function() {
            $(".bs-select").selectpicker({
                iconBase: "fa",
                tickIcon: "fa-check"
            })
        });
    </script>
@endpush