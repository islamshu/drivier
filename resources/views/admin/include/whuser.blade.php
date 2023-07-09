@section('header')
    <link rel="stylesheet" href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.css')}}" />
    <style>
        .modal-body {
            height: 450px;
            overflow-y: auto;
        }
        .modal-body h4 {
            font-size: 15px;
            font-weight: bolder;
        }
    </style>
@endsection

@section('buttons')
    <a class="btn dark" data-toggle="modal" href="#responsive"> <i class="fa fa-plus-square"></i> </a>


    <div id="responsive" class="modal fade" tabindex="-1" data-width="760">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Add Warehouse Manager</h4>
        </div>
        <form action="{{ url(route('warehouses.store'))}}" method="POST">
            @csrf
            <div class="modal-body">


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" name="name" placeholder="Name">
                            <span class="help-block">Name</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <input type="text" class="form-control" autocomplete="off" name="email" placeholder="Email">
                            <span class="help-block">Email</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <span class="help-block">Password</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Warehouse</label>
                            <select class="bs-select form-control" name="warehouse_id" data-live-search="true" data-size="8">
                                @isset($warehouses)
                                    @foreach($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id}}">{{ $warehouse->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
                <button type="submit" class="btn red">Add Manager</button>
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