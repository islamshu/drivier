@section('header')
    <link href="{{ url('public/assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
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
    <a class="btn btn-circle purple" data-toggle="modal" href="#responsive"> <i class="fa fa-plus font-white"></i> </a>

    {{-- <button type="button" class="btn btn-circle purple">Purple</button> --}}

    <div id="responsive" class="modal fade" tabindex="-1" data-width="760">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Add Shelf</h4>
        </div>
        <form action="{{ url(route('manager.shelf.store'))}}"  method="POST" >
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-icon input-icon-lg right">
                    <i class=" icon-direction font-red-thunderbird"></i>
                    <input type="text" name="shelf" id="onScanShelf" class="form-control input-lg" placeholder="# Shelf"> </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
                <button type="submit" class="btn red">Add Shelf</button>
            </div>
        </form>
    </div>
@endsection



@push('script')
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}"></script>
    
@endpush