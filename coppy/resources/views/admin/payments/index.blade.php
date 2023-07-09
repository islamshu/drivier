@extends('admin.layouts.app')

@section('title')
    @lang('app.allpayments')
@endsection


@section('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_html5.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_customer.css')}}">
    <link href="{{ asset('public/assets/css/ui-kit/tabs-accordian/custom-accordions.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/select2/select2.min.css') }}">

@endsection

@section('content')


    <div class="row" id="cancel-row">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div class="tab-content" id="justify-pills-tabContent">
                        <div class="tab-pane fade show active" id="justify-pills-home" role="tabpanel"
                             aria-labelledby="justify-pills-home-tab">
                            <div class="table-responsive mb-4">
                                <table id="html5-extension" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th> @lang('app.name') </th>
                                            <th> @lang('app.amount') </th>
                                            <th> @lang('app.action') </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($customers)
                                            @foreach( $customers as $customer)
                                            <tr>
                                                <td> {{$customer->name}} </td>
                                                <td> {{$customer->amount}} </td>
                                                <td>
                                                    <div class="dropdown custom-dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <i class="flaticon-dot-three"></i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="">
                                                            <a class="dropdown-item" href="{{route('customer.payments' , [$customer->id])}}">@lang('app.view')</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection


@push('script')
<script src="{{ asset('public/plugins/table/datatable/datatables.js')}}"></script>
<script src="{{ asset('public/plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('public/plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
<script src="{{ asset('public/plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
<script src="{{ asset('public/plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
<script>


    $('#html5-extension').DataTable( {
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        buttons: {
            buttons: [
                { extend: 'copy', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.copy')" },
                { extend: 'csv', className: 'btn btn-classic btn-success btn-sm mb-4', text: "@lang('app.csv')" },
                { extend: 'excel', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.excel')" },
                { extend: 'print', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.print')" }
            ]
        },
        "language": {
            "paginate": {
                "previous": "<i class='flaticon-arrow-left-1'></i>",
                "next": "<i class='flaticon-arrow-right'></i>"
            },
            "info": "@lang('app.paginate') _PAGE_ @lang('app.of') _PAGES_",
            "search" : "@lang('app.search')",
        }
    } );
</script>
@endpush