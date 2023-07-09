@section('header')
    <link href="{{ url('public/assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.css')}}" />
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
            <h4 class="modal-title">Create Vehicle</h4>
        </div>
        <form action="{{ url(route('vehicles.store'))}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-md-line-input has-info">
                            <select class="form-control" name="manufacturer">
                                <option value="0">Select</option>
                                <option value="ATk">ATk </option>
                                <option value="Bajaj">Bajaj  </option>
                                <option value="Benelli Motors">Benelli Motors </option>
                                <option value="Beta">Beta  </option>
                                <option value="Borile">Borile  </option>
                                <option value="Buell">Buell </option>
                                <option value="Cagiva">Cagiva  </option>
                                <option value="Can Am">Can Am </option>
                                <option value="CCM">CCM </option>
                                <option value="American V-Twins">American V-Twins</option>
                            </select>
                            <label >Make</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-md-line-input has-info">
                            <select class="form-control" name="model">
                                <option value="0">Select</option>
                                <option value="Vehicle Make">Vehicle Make</option>
                                <option value="American V-Twins">American V-Twins</option>
                                <option value="ATk">ATk </option>
                                <option value="Bajaj">Bajaj</option>
                                <option value="Benelli Motors">Benelli Motors</option>
                                <option value="Beta">Beta</option>
                                <option value="Borile">Borile </option>
                                <option value="Buell">Buell</option>
                                <option value="Cagiva">Cagiva </option>
                                <option value="Vehicle Model">Vehicle Model</option>
                            </select>
                            <label >Model</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-md-line-input has-info">
                            <select class="form-control" name="color">
                                <option value="0">Select</option>
                                <option value="Red">Red </option>
                                <option value="Black">Black</option>
                                <option value="Blue">Blue </option>
                                <option value="Green">Green</option>
                                <option value="Beige">Beige</option>
                                <option value="Brown">Brown</option>
                                <option value="Gold">Gold  </option>
                                <option value="Grey">Grey </option>
                                <option value="Orange">Orange  </option>
                                <option value="Pink">Pink </option>
                            </select>
                            <label >Color</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-md-line-input has-info">
                            <select class="form-control" name="vehicle_type">
                                <option value="0">Select</option>
                                <option value="Sedan">Sedan </option>
                                <option value="Minivan">Minivan</option>
                                <option value="Panelvan">Panelvan  </option>
                                <option value="Bajaj">Bajaj</option>
                                <option value="Light Truck">Light Truck</option>
                                <option value="Refrigerated Truck">Refrigerated Truck</option>
                                <option value="Recovery Truck">Recovery Truck </option>
                                <option value="Towing">Towing </option>
                                <option value="Relocation">Relocation </option>
                                <option value="Bike">Bike </option>
                            </select>
                            <label >Vehcle Type</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-md-line-input has-info">
                            <select class="form-control" name="body_type">
                                <option value="0">Select</option>
                                <option value="convertible">convertible  </option>
                                <option value="4×4">4×4</option>
                                <option value="Box van">Box van  </option>
                                <option value="Chassis Cab">Chassis Cab</option>
                                <option value="Combi Van">Combi Van</option>
                                <option value="Coupe">Coupe </option>
                                <option value="Curtain Side">Curtain Side </option>
                                <option value="Dropside">Dropside  </option>
                                <option value="Estate">Estate  </option>
                                <option value="Bike">Bike </option>
                            </select>
                            <label >Body Type</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Courier</label>
                            <select class="bs-select form-control" name="courier_id" data-live-search="true" data-size="8">
                                @isset($couriers)
                                    @foreach($couriers as $courier)
                                        <option value="{{ $courier->id}}">{{ $courier->courier_name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="year" placeholder="Register Year ">
                            <span class="help-block">Register Year</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="reg_number" placeholder="Register Number ">
                            <span class="help-block">Register Number</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="capacity" placeholder="Weight in capacity on Kg ">
                            <span class="help-block">Weight in capacity on Kg</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-line-input has-info">
                            <select class="form-control" name="active">
                                <option value="0">Active</option>
                                <option value="1">Inactive</option>
                            </select>
                            <label >Status</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
                <button type="submit" class="btn red">Create Vehicle</button>
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