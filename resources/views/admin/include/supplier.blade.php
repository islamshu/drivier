@section('header')
    <link rel="stylesheet" href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" />
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


    <!-- import courier excel -->
    {{-- <a class="btn purple" data-toggle="modal" href="#importCourier"> <i class="fa fa-upload font-white" ></i> </a>

    <div id="importCourier" class="modal fade" tabindex="-1" data-width="760">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Import Couriers</h4>
        </div>
        <form action="{{ url(route('admin.courier.import'))}}" enctype="multipart/form-data" method="POST" >
            @csrf
            <div class="modal-body">
                <span class="btn green fileinput-button">
                    <i class="fa fa-plus"></i>
                    <span> Select CSV File</span>
                    <input type="file" name="courierfile" > </span>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
                <button type="submit" class="btn red">Import</button>
            </div>
        </form>
    </div> --}}

    <!-- create Supplier --> 
    <a class="btn dark" data-toggle="modal" href="#responsive"> <i class="fa fa-plus-square" ></i> </a>


    <div id="responsive" class="modal fade" tabindex="-1" data-width="760">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Create Supplier</h4>
        </div>
        <form action="{{ url(route('courier.store'))}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" autocomplete="off" name="courier_name" placeholder="Courier Name">
                        </div>
                        
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" autocomplete="off" name="email" placeholder="Email">
                        </div>
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" autocomplete="off" name="contact_phone" placeholder="Contact Number">
                            <span class="help-block">Contact Number</span>
                        </div>
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control"  name="courier_addrss" placeholder="Address">
                            <span class="help-block">Address</span>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="number_of_fleet" placeholder="# of Fleet">
                                    <span class="help-block"># of Fleet</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="number_of_drivers" placeholder="# of Drivers">
                                    <span class="help-block"># of Drivers</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="legal_name" placeholder="Legal Name ( Optional )">
                        </div>
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="courier_contact" placeholder="Courier Contact ( Optional ">
                        </div>
                        <div class="form-group form-md-line-input has-info">
                            <select class="form-control" name="status">
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
                <button type="submit" class="btn red">Create Supplier</button>
            </div>
        </form>
    </div>
@endsection



@push('script')
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}"></script>
@endpush