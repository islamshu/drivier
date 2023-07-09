@extends('admin.layouts.app')

@section('title')
@lang('app.view')
@endsection


@section('header')
<link href="{{ asset('public/assets/css/components/portlets/portlet.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/assets/css/ui-kit/tabs-accordian/custom-tabs.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/assets/css/ui-kit/tabs-accordian/custom-accordions.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/select2/select2.min.css') }}">
@endsection

@section('content')

@include('message')


<div class="widget portlet-widget">
    <div class="widget-content widget-content-area">
        <div class="portlet portlet-danger">
            <div class="portlet-title portlet-danger  d-flex justify-content-between">
                <div class="caption  align-self-center">

                    <ul class="nav nav-pills mb-3 mt-3 nav-fill" id="justify-pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="justify-pills-home-tab" data-toggle="pill" href="#justify-pills-home" role="tab" aria-controls="justify-pills-home" aria-selected="true">@lang('app.orders')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="justify-pills-profile-tab" data-toggle="pill" href="#justify-pills-profile" role="tab" aria-controls="justify-pills-profile" aria-selected="false">@lang('app.ratings')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="justify-pills-contact-tab" data-toggle="pill" href="#justify-pills-contact" role="tab" aria-controls="justify-pills-contact" aria-selected="false">@lang('app.company_info')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="justify-pills-attendances-tab" data-toggle="pill" href="#justify-pills-attendances" role="tab" aria-controls="justify-pills-attendances" aria-selected="false">@lang('app.attendances')</a>
                        </li>
                    </ul>
                </div>
                <div class="text-right padding-top-5px">
                    <div class="btn-group mr-2" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('app.status')<span class="caret"></span></button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a href="{{ url(route('drivers.status.change' , ['driver_id' => $driver->id , 'status_id' => 0]))}}" class="dropdown-item">
                                @lang('app.new') 
                                @if ($driver->active == 0)
                                    <i class="flaticon-double-check" style="color: green;"></i>
                                @endif
                            </a>
                            <a href="{{ url(route('drivers.status.change' , ['driver_id' => $driver->id , 'status_id' => 1]))}}" class="dropdown-item">
                                @lang('app.active') 
                                @if ($driver->active == 1)
                                    <i class="flaticon-double-check" style="color: green;"></i>
                                @endif
                            </a>
                            <a href="{{ url(route('drivers.status.change' , ['driver_id' => $driver->id , 'status_id' => 2]))}}" class="dropdown-item">
                                @lang('app.pending')
                                @if ($driver->active == 2)
                                    <i class="flaticon-double-check" style="color: green;"></i>
                                @endif
                            </a>
                            <a href="{{ url(route('drivers.status.change' , ['driver_id' => $driver->id , 'status_id' => 3]))}}" class="dropdown-item">
                                @lang('app.block')
                                @if ($driver->active == 3)
                                    <i class="flaticon-double-check" style="color: green;"></i>
                                @endif
                            </a>
                        </div>
                    </div>

                    <button class="btn btn-classic btn-danger" data-toggle="modal" data-target="#createDriver">
                        @lang('app.addAttendance')
                    </button>
                </div>
            </div>
            <div class="portlet-body portlet-common-body">

                <div class="tab-content" id="justify-pills-tabContent">
                    <div class="tab-pane fade show active" id="justify-pills-home" role="tabpanel" aria-labelledby="justify-pills-home-tab">
                        {{-- Driver Orders  --}}

                        <address class="mb-5">
                            <strong class="text-primary"> @lang('app.fname') :  {{ $driver->fname  }}</strong><br>
                            <strong class="text-primary"> @lang('app.lname') :  {{ $driver->lname  }}</strong><br>
                            <abbr title="Phone">@lang('app.email'):</abbr> {{ $driver->email ?? "N/A" }}<br>
                            <abbr title="Phone">@lang('app.phone'):</abbr> {{ $driver->phone }}
                        </address>
                        <hr>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>@lang('app.name')</th>
                                <th>@lang('app.company')</th>
                                <th>@lang('app.branch')</th>
                                <th>@lang('app.date')</th>
                                <th>@lang('app.status')</th>
                            </tr>
                            @isset($orders)
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->order_id}}</td>
                                    <td>{{ $order->name}}</td>
                                    <td>{{ $order->company->company_name}}</td>
                                    <td>{{ $order->customer->branch_name}}</td>
                                    <td>{{ $order->created_at}}</td>
                                    <td>
                                        @if ($order->status == 'unassigned')
                                            <span class="badge badge-dark"> {{ trans('app.unassigned')}} </span>
                                        @elseif ($order->status == 'assign_to_driver') 
                                            <span class="badge badge-dark"> {{ trans('app.assign_to_driver')}} </span>
                                        @elseif ($order->status == 'to_be_delivered') 
                                            <span class="badge badge-dark"> {{ trans('app.to_be_delivered')}} </span>
                                        @elseif ($order->status == 'rescheduled') 
                                            <span class="badge badge-dark"> {{ trans('app.rescheduled')}} </span>
                                        @elseif ($order->status == 'car_damage') 
                                            <span class="badge badge-dark"> {{ trans('app.car_damage')}} </span>
                                        @elseif ($order->status == 'delivered') 
                                            <span class="badge badge-dark"> {{ trans('app.delivered')}} </span>
                                        @elseif ($order->status == 'canceled') 
                                            <span class="badge badge-danger"> {{ trans('app.canceled')}} </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                        </table>
                    </div>

                    <div class="tab-pane fade" id="justify-pills-profile" role="tabpanel" aria-labelledby="justify-pills-profile-tab">
                        {{-- Driver Ratings --}}
                        @isset($orders)
                            <strong  class="text-primary">@lang('app.ratings')</strong>
                            <br>
                            <br>
                            <div id="accordion">
                                @foreach ($orders as $order)

                                <div class="card mb-1">
                                    <div class="card-header" id="headingOne{{ $order->id}}">
                                        <h5 class="mb-0 mt-0">
                                        <span class="" data-toggle="collapse" data-target="#collapse{{ $order->order_id}}" aria-expanded="true" aria-controls="collapseOne" role="menu">
                                            # {{ $order->order_id}}
                                        </span>
                                        </h5>
                                    </div>

                                    <div id="collapse{{ $order->order_id}}" class="collapse" aria-labelledby="headingOne{{ $order->id}}" data-parent="#accordion">
                                        <div class="card-body">
                                            
                                            @isset($order->ratings)
                                                
                                                <br>
                                                @foreach ($order->ratings as $item)
                                                    
                                                    <h4 class="mt-4">{{ $item->question->question_ar }}</h4>

                                                    @if ($item->rating == 1)
                                                        <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="font-size:20px"></span>
                                                    @elseif($item->rating == 2)
                                                        <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="font-size:20px"></span>
                                                    @elseif($item->rating == 3)
                                                        <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="font-size:20px"></span>
                                                    @elseif($item->rating == 4)
                                                        <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="font-size:20px"></span>
                                                    @elseif($item->rating == 5)
                                                        <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                                        <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                                    @endif
                                                    <br>
                                                @endforeach
                                            @endisset 
                                        </div>
                                    </div>
                                </div>

                                    
                                @endforeach
                            </div>
                            @endisset
                    </div>
                    <div class="tab-pane fade" id="justify-pills-contact" role="tabpanel" aria-labelledby="justify-pills-contact-tab">
                        {{-- Driver info --}}
                        @isset($driver)

                            <address class="mb-5">
                                <strong class="text-primary"> @lang('app.fname') :  {{ $driver->fname  }}</strong><br>
                                <strong class="text-primary"> @lang('app.lname') :  {{ $driver->lname  }}</strong><br>
                                <abbr title="Phone">@lang('app.email'):</abbr> {{ $driver->email ?? "N/A" }}<br>
                                <abbr title="Phone">@lang('app.phone'):</abbr> {{ $driver->phone }}
                            </address>
                            <address>
                                <strong class="text-primary">@lang('app.company_info')</strong><br>
                                <strong>
                                    @lang('app.salary') : 

                                    @if ($driver->type == 0)
                                        @lang('app.monthly_salary')
                                    @elseif ($driver->type == 1)
                                        @lang('app.daily')
                                    @else
                                        @lang('app.perorder')
                                    @endif
                                    / {{ $driver->salary }} @lang('app.ras')
                                </strong> <br> 
                                <strong>@lang('app.vehicle'): {{ $driver->vehicle->car_id .' | '. $driver->vehicle->carName . ' | ' . $driver->vehicle->reg_number }}</strong><br>
                                <strong>@lang('app.city'): {{ $driver->city->name   }}</strong><br>
                                <strong>@lang('app.state_num'): {{ $driver->state_num   }}</strong><br>
                                <strong>@lang('app.state_expire_date'): {{ $driver->state_expire_date   }}</strong><br>
                                <strong>@lang('app.bank_num'): {{ $driver->bank_num }}</strong><br>
                                <strong>@lang('app.nationality'): {{ $driver->country->name }}</strong><br>
                                <strong>@lang('app.birthdate'): {{ $driver->birthdate }}</strong><br>
                                <strong>@lang('app.birthdate_hijri'): {{ $driver->birthdate_hijri }}</strong><br>
                                <strong>@lang('app.license_num'): {{ $driver->license_num }}</strong><br>
                                <strong>@lang('app.license_expire_date'): {{ $driver->license_expire_date }}</strong><br>
                                <strong>@lang('app.person_name'): {{ $driver->person_name }}</strong><br>
                            </address>
                            
                            <address>
                                <strong class="text-primary">@lang('app.workingtime')</strong><br>
                                <strong>{{ $driver->days_to_work }}</strong><br>
                            </address>


                            <address>
                                <strong class="text-primary">@lang('app.required_files')</strong><br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6>@lang('app.driver_image')</h6>
                                        <img src="{{ url('/' . $driver->driver_image )}}" alt="" class="img-thumbnail">
                                    </div>
                                    <div class="col-md-3">
                                        <h6>@lang('app.license_image')</h6>
                                        <img src="{{ url('/' . $driver->license_image )}}" alt="" class="img-thumbnail">
                                    </div>
                                    <div class="col-md-3">
                                        <h6>@lang('app.car_image')</h6>
                                        <img src="{{ url('/' . $driver->car_image )}}" alt="" class="img-thumbnail">
                                    </div>
                                    <div class="col-md-3">
                                        <h6>@lang('app.state_image')</h6>
                                        <img src="{{ url('/' . $driver->state_image )}}" alt="" class="img-thumbnail">
                                    </div>
                                    <div class="col-md-3">
                                        <h6>@lang('app.insurance_image')</h6>
                                        <img src="{{ url('/' . $driver->insurance_image )}}" alt="" class="img-thumbnail">
                                    </div>
                                    <div class="col-md-3">
                                        <h6>@lang('app.car_isemara')</h6>
                                        <img src="{{ url('/' . $driver->car_isemara )}}" alt="" class="img-thumbnail">
                                    </div>
                                    <div class="col-md-3">
                                        <h6>@lang('app.bank_card')</h6>
                                        <img src="{{ url('/' . $driver->bank_card )}}" alt="" class="img-thumbnail">
                                    </div>
                                    <div class="col-md-3">
                                        <h6>@lang('app.account_number_image')</h6>
                                        <img src="{{ url('/' . $driver->account_number_image )}}" alt="" class="img-thumbnail">
                                    </div>
                                </div>
                            </address>
                        @endisset
                    </div>

                    <div class="tab-pane fade" id="justify-pills-attendances" role="tabpanel" aria-labelledby="justify-pills-attendances-tab">
                        {{-- Driver Performance  --}}

                        @isset($driver->attendances)
                            @foreach ($driver->attendances as $attendance)
                                <div class="alert alert-default">
                                    <strong>{{ $attendance->panishment->title}}</strong>
                                    
                                    <p>
                                        {{ $attendance->panishment->ftime }}
                                    </p>
                                </div>
                            @endforeach
                        @endisset
                        
                    </div>


                </div>
                
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="createDriver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title"> @lang('app.addAttendance')</h5>
          </div>
        <form  action="{{ url(route('addAttendance.store', [$driver->id])) }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>@lang('app.attendanceType')</label>
                    <select name="panishment_id" class="placeholder js-states form-control">
                        @isset($panishments)
                            @foreach ($panishments as $panishment)
                                <option value="{{ $panishment->id}}">{{ $panishment->title }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>

                {{-- <div class="form-group">
                    <label>@lang('app.attendanceNote')</label>
                    <textarea name="note" class="form-control" cols="30" rows="5"></textarea>
                </div>
                 --}}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('app.close')</button>
              <button type="submit" class="btn btn-primary">@lang('app.add')</button>
            </div>
        </form>
      </div>
    </div>
  </div>



@endsection

@push('script')
<script src="{{ asset('public/assets/js/ui-kit/ui-accordions.js')}}"></script>
<script src="{{ asset('public/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('public/plugins/select2/custom-select2.js') }}"></script>
@endpush