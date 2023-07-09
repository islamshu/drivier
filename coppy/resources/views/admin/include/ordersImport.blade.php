@section('header')
    <link rel="stylesheet" href="{{ asset('public/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" />
    <link rel="stylesheet" href="{{ asset('public/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" />
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
    <a class="btn purple" data-toggle="modal" href="#importOrders"> <i class="fa fa-upload font-white" ></i> </a>

    <div id="importOrders" class="modal fade" tabindex="-1" data-width="760">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Import Orders</h4>
        </div>
        <form action="{{ url(route('admin.orders.import'))}}" enctype="multipart/form-data" method="POST" >
            @csrf
            <div class="modal-body">
                <span class="btn green fileinput-button">
                    <i class="fa fa-plus"></i>
                    <span> Select CSV File</span>
                    <input type="file" name="customerfile" > </span>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
                <button type="submit" class="btn red">Import</button>
            </div>
        </form>
    </div>
@endsection



@push('script')
    <script src="{{ asset('public/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}"></script>
    <script src="{{ asset('public/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}"></script>
@endpush