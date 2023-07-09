@section('header')
    <link rel="stylesheet" href="{{ asset('public/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" />
    <link rel="stylesheet" href="{{ asset('public/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" />
    <link rel="stylesheet" href="{{ asset('public/assets/global/plugins/bootstrap-select/css/bootstrap-select.css')}}" />
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
    <a class="btn btn-outline dark" data-toggle="modal" href="#addressModal"> <i class="fa fa-plus-square"></i> </a>


    <div id="addressModal" class="modal fade" tabindex="-1" data-width="760">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Add New Address</h4>
        </div>
        <form action="{{ url(route('address.store'))}}" method="POST">
            @csrf
            <div class="modal-body">

            


                {{-- <div class="form-group">
                    <label>Product Code</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-2x fa-barcode" style="color:#555;"></i></span>
                        <input type="text" class="form-control" name="product_code" placeholder="Product Code" aria-describedby="sizing-addon1"> </div>
                </div> --}}


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" autocomplete="off" name="name" placeholder="Name">
                            <span class="help-block">Name</span>
                        </div>
                        
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="city" placeholder="City">
                            <span class="help-block">City</span>
                        </div>
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="building" placeholder="Building">
                            <span class="help-block">Building</span>
                        </div>
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="apartment" placeholder="Apartment">
                            <span class="help-block">Apartment</span>
                        </div>
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="floor" placeholder="Floor">
                            <span class="help-block">Floor</span>
                        </div>    
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="markland" placeholder="Markland">
                            <span class="help-block">Markland</span>
                        </div>  
                    </div>
                    <div class="col-md-6">
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
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="street" placeholder="Street">
                            <span class="help-block">Street</span>
                        </div>
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="country" placeholder="Country">
                            <span class="help-block">Country</span>
                        </div>
                        <div class="form-group form-md-line-input has-info">
                            <select class="form-control" name="address_type">
                                <option value="0">Residential</option>
                                <option value="1">Business</option>
                            </select>
                            <label >Address Type</label>
                        </div>   
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="region" placeholder="Neighborhood">
                            <span class="help-block">Neighborhood</span>
                        </div> 
                        <div class="form-group form-md-line-input">
                            <textarea  class="form-control" name="address" placeholder="Address"></textarea>
                            <span class="help-block">Address</span>
                        </div> 
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
                <button type="submit" class="btn red">Create Address</button>
            </div>
        </form>
    </div>
@endsection



@push('script')
    <script src="{{ asset('public/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}"></script>
    <script src="{{ asset('public/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}"></script>
    <script src="{{ asset('public/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    
    <script>
        $(function() {
            $(".bs-select").selectpicker({
                iconBase: "fa",
                tickIcon: "fa-check"
            });
        });
    </script>
@endpush