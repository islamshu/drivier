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
    <a class="btn btn-outline dark" data-toggle="modal" href="#responsive"> <i class="fa fa-plus-square"></i> </a>


    <div id="responsive" class="modal fade" tabindex="-1" data-width="760">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Create Customer</h4>
        </div>
        <form action="{{ url(route('courier.store'))}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" autocomplete="off" name="name" placeholder="Customer Name">
                            <span class="help-block">Name</span>
                        </div>
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                            <span class="help-block">Email</span>
                        </div>
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="country" placeholder="Country">
                            <span class="help-block">Country</span>
                        </div>
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="city" placeholder="City">
                            <span class="help-block">City</span>
                        </div>
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="area" placeholder="Area">
                            <span class="help-block">Area</span>
                        </div>     
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="street" placeholder="Street">
                            <span class="help-block">Street</span>
                        </div>   
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="landmark" placeholder="Landmark">
                            <span class="help-block">Landmark</span>
                        </div>  
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="prefix" placeholder="Prefix">
                                    <span class="help-block">Prefix</span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone">
                                    <span class="help-block">Phone</span>
                                </div>
                            </div>
                        </div>
                        
    
                        <div class="form-group form-md-line-input has-info">
                            <select class="form-control" name="address_type">
                                <option value="0">Personal</option>
                                <option value="1">Business</option>
                            </select>
                            <label >Address Type</label>
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