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
    <a class="btn btn-outline dark" data-toggle="modal" href="#responsive"> <i class="fa fa-plus-square"></i> </a>


    <div id="responsive" class="modal fade" tabindex="-1" data-width="760">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Create Supplier User</h4>
        </div>
        <form action="{{ url(route('supplier.store'))}}" method="POST">
            @csrf
            <div class="modal-body">


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="first_name" placeholder="First Name">
                            <span class="help-block">First Name</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                            <span class="help-block">Last Name</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                            <span class="help-block">Email</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-md-line-input">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <span class="help-block">Password</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Supplier</label>
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
                    <div class="col-md-6">

                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="phone" placeholder="Phone ">
                            <span class="help-block">Phone</span>
                        </div>
                    </div>

                    <div class="col-md-6">
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
                <button type="submit" class="btn red">Create Supplier User</button>
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
            })
        });
    </script>
@endpush