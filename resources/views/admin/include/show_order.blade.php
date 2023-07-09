
@section('buttons')
    <!-- show Order Details -->
    <div id="showOrderModal" class="modal  fade" tabindex="-1"  style="height: 90%;"  data-width="90%" >
        <div class="modal-header bg-red">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <div class="row">
                <div class="col-md-3">
                    <p>order : {{ str_replace("'" , "" , $order->order_id)}} </p>
                    <p>Ref ## {{ $order->reference_id}} </p>
                </div>
                <div class="col-md-3">
                    <div class="created-date"  style="display:inline-block;margin-right:5px;">
                        <svg  viewBox="0 0 24 24" style="display: inline-block; color: rgb(255, 255, 255); fill: rgba(23, 2, 2, 1); height: 24px; width: 24px; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; font-size: 24px; margin: 8px;">
                            <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>
                        </svg>
                    </div>

                    <div style="display:inline-block;color:white;">
                        <span>CREATED:</span><br>
                        <span> {{ $order->created_date}} </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="pickup-status"  style="display:inline-block;margin-right:5px;">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAABsCAYAAACPZlfNAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTM4IDc5LjE1OTgyNCwgMjAxNi8wOS8xNC0wMTowOTowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTcgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjYzMEY0OTE0RURDMTExRTY4QTAxODg2QkY0REMzMjNDIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjYzMEY0OTE1RURDMTExRTY4QTAxODg2QkY0REMzMjNDIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NjMwRjQ5MTJFREMxMTFFNjhBMDE4ODZCRjREQzMyM0MiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NjMwRjQ5MTNFREMxMTFFNjhBMDE4ODZCRjREQzMyM0MiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6pfexvAAAJCUlEQVR42uxd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" alt="">
                    </div>

                    <div style="display:inline-block;color:white;">
                        <span>PICK UP:</span><br>
                        <span> ASAP </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="pickup-status"  style="display:inline-block;margin-right:5px;">
                        <img class="" src="{{ Avatar::create("$order->customer_name")->setTheme('grayscale-dark') }}" alt="">
                    </div>

                    <div style="display:inline-block;color:white;">
                        <span> <small>Customer</small> </span><br>
                        <span> {{ $order->customer_name}} </span>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div style="color:white;">
                        <span>{{ $order->status == 'completed' ?  'DeLivered' : ($order->status == 'in_transit' ? 'In Transit' : $order->status) }}</span><br>
                        <span> <small> {{ $order->deliverd_date == 'N/A' ? 'N/A' : 'about ' . \Carbon\Carbon::createFromTimeStamp(strtotime($order->deliverd_date))->diffForHumans() }}</small> </span>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <div style="display:inline-block;color:white;">
                        <span> <small>COURIER COMPANY/DRIVER</small> </span><br>
                        <span> {{ $order->courier_name . " / " . $order->driver_name}} </span>
                    </div>
                    <div class="pickup-status"  style="display:inline-block;margin-right:5px;">
                        <img class="" src="{{ Avatar::create("$order->courier_name")->setTheme('grayscale-dark') }}" alt="">
                    </div>
                </div>
            </div>
            
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#BRIEF" data-toggle="tab"> BRIEF</a>
                </li>
                <li>
                    <a href="#CUSTOMER" data-toggle="tab"> CUSTOMER </a>
                </li>
                <li >
                    <a href="#COURIER" data-toggle="tab"> COURIER </a>
                </li>
                <li>
                    <a href="#HISTORY" data-toggle="tab"> HISTORY </a>
                </li>
                <li>
                    <a href="#MAP" data-toggle="tab"> MAP </a>
                </li>
            </ul>
        </div>
        <div class="modal-body">
            <div class="tab-content">
                <div class="tab-pane active" id="BRIEF">
                    <div class="row">
                        <div class="clearfix"></div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <div class="info-box-img"  style="display:inline-block;margin-right:5px;">
                                    <img class="img-circle img-responsive" src="{{ Avatar::create("$order->sender_name")->setTheme('colorful') }}" alt="">
                                </div>
                                <div style="display:inline-block;">
                                    <span class="uppercase"> Sender</span><br>
                                    <h6 class="info-box-title"> {{ $order->sender_name}} </h6>
                                    <span class="font-grey"> {{ str_replace('"' , '' , $order->customer->phone) }} </span>
                                        <div class="clearfix"></div>
                                        
                                        <div class="info-box-circle"  style="display:inline-block;margin-right:5px;">
                                            <svg viewBox="0 0 24 24" style="display: inline-block; color: rgb(255, 255, 255); fill: rgb(255, 255, 255); height: 24px; width: 24px; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; font-size: 24px; margin: 8px">
                                                <path d="M20 6h-4V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-6 0h-4V4h4v2z"></path>
                                            </svg>
                                        </div>
                                        <div style="display:inline-block;">
                                            <span> <small>Saudi Arabia {{ $order->from_city }}</small> </span><br>
                                            <span> <strong>{{ $order->from_city }}, {{ $order->from_city }},</strong> </span>
                                        </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <div class="info-box-img"  style="display:inline-block;margin-right:5px;">
                                    <img class="img-circle img-responsive" src="{{ Avatar::create("$order->recipient")->toBase64() }}" alt="">
                                </div>
                                <div style="display:inline-block;">
                                    <span class="uppercase"> RECIPIENT</span><br>
                                    <h6 class="info-box-title"> {{ $order->recipient}} </h6>
                                    <span class="font-grey"> N/A </span>
                                        <div class="clearfix"></div>
                                        
                                        <div class="info-box-circle"  style="display:inline-block;margin-right:5px;">
                                            <svg viewBox="0 0 24 24" style="display: inline-block; color: rgb(255, 255, 255); fill: rgb(255, 255, 255); height: 24px; width: 24px; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; font-size: 24px; margin: 8px">
                                                <path d="M20 6h-4V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-6 0h-4V4h4v2z"></path>
                                            </svg>
                                        </div>
                                        <div style="display:inline-block;">
                                            <span> <small>Saudi Arabia {{ $order->to_city }}</small> </span><br>
                                            <span> <strong>{{ $order->delivery_address }}</strong> </span>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="clearfix"></div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <h6 class="uppercase text-center">ITEM DETAILS</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="pickup-status"  style="display:inline-block;margin-right:5px;">
                                            <img class="img-responsive" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTM4IDc5LjE1OTgyNCwgMjAxNi8wOS8xNC0wMTowOTowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTcgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjBDQjBDQUFDRTYwMDExRTZCQkE4QUJFQzdFOEJERkY0IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjBDQjBDQUFERTYwMDExRTZCQkE4QUJFQzdFOEJERkY0Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MENCMENBQUFFNjAwMTFFNkJCQThBQkVDN0U4QkRGRjQiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MENCMENBQUJFNjAwMTFFNkJCQThBQkVDN0U4QkRGRjQiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4zuvFBAAAGTElEQVR42uyd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" alt="">
                                        </div>
                    
                                        <div style="display:inline-block;">
                                            <span> <small>Chargeable Weight</small> </span><br>
                                            <span> {{ str_replace("Parcel up to" , "",$order->weight_category)}} </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="pickup-status"  style="display:inline-block;margin-right:5px;">
                                            <img class="img-responsive" src="{{ Avatar::create("PC")->setTheme('grayscale-dark') }}" alt="">
                                        </div>
                    
                                        <div style="display:inline-block;">
                                            <span> <small>Box Count</small> </span><br>
                                            <span> {{ $order->actual_service_charge}} / 1 </span>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text-left">
                                        <div class="pickup-status"  style="display:inline-block;margin-right:5px;">
                                            <img class="img-responsive" src="data:image/png;base64,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" alt="">
                                        </div>
                                        <div style="display:inline-block;">
                                            <span> <small>Service Type</small> </span><br>
                                            <span style="color:#bbc200;"> {{ $order->service_type}} </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="created-date"   style="display:inline-block;background-color:#4CAF50;margin-right:5px;">
                                            <svg viewBox="0 0 24 24" style="display: inline-block; color: rgb(255, 255, 255); fill: rgb(255, 255, 255); height: 24px; width: 24px; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; font-size: 24px; margin: 8px;">
                                                <path d="M21 2H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h7l-2 3v1h8v-1l-2-3h7c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 12H3V4h18v10z"></path>
                                            </svg>
                                        </div>
                    
                                        <div style="display:inline-block;">
                                            <span> <small>Received Via :</small> </span><br>
                                            <span class="uppercase" style="color:#7cb342 ;font-weight:bold;"> {{ $order->uploads == 1 ? "EXCEL IMPORT" : "Web or API" }} </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="pickup-status"  style="display:inline-block;margin-right:5px;">
                                            <img class="img-responsive" src="{{ Avatar::create("$")->setTheme('colorful') }}" alt="">
                                        </div>
                    
                                        <div style="display:inline-block;">
                                            <span> <small>Item Value</small> </span><br>
                                            <span class="uppercase" style="color:#7cb342 ;font-weight:bold;"> 0.00 SAR  </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="display:inline-block;">
                                            <span> <small>Item Description / Special Instructions :</small> </span><br>
                                            <span class="uppercase" style="font-weight:bold; font-size:12px;"> {{ $order->description }} </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div style="display:inline-block;">
                                            <span> <small>Attachments</small> </span><br>
                                            <span class="uppercase" style="font-weight:bold;"> N/A</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <h6 class="uppercase text-center">PAYMENT INFO</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="pickup-status"  style="display:inline-block;margin-right:5px;">
                                            <img class="img-responsive" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTM4IDc5LjE1OTgyNCwgMjAxNi8wOS8xNC0wMTowOTowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTcgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkRBMEU1RTk1RTVGRTExRTY5QzEzRjlFMDdGQjQ4MTNBIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkRBMEU1RTk2RTVGRTExRTY5QzEzRjlFMDdGQjQ4MTNBIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6REEwRTVFOTNFNUZFMTFFNjlDMTNGOUUwN0ZCNDgxM0EiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6REEwRTVFOTRFNUZFMTFFNjlDMTNGOUUwN0ZCNDgxM0EiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6/Tk5jAAAHqklEQVR42txb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" alt="">
                                        </div>
                    
                                        <div style="display:inline-block;">
                                            <span> <small>Payment Method</small> </span><br>
                                            <span class="uppercase" style="color:rgb(33, 150, 243) ;font-weight:bold;"> {{ $order->payment_type }} </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="pickup-status"  style="display:inline-block;margin-right:5px;">
                                            <img class="img-responsive" src="{{ Avatar::create("$order->recipient")->setTheme('colorful') }}" alt="">
                                        </div>
                    
                                        <div style="display:inline-block;">
                                            <span> <small>Service Charges Paid By</small> </span><br>
                                            <span class="uppercase" style="color:#7cb342 ;font-weight:bold;"> {{ $order->payer == 'RECIPIENT' ?  $order->recipient : $order->payer}}  </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <table>
                                            <tr>
                                                <th style="font-size:11px;">PUBLIC SERVICE FEE</th>
                                                <th style="font-size:11px;">0.00 SAR</th>
                                            </tr>
                                            <tr>
                                                <th style="font-size:11px;">ACTUAL SERVICE FEE</th>
                                                <th style="font-size:11px;">0.00 SAR</th>
                                            </tr>
                                            <tr>
                                                <th style="font-size:11px;">CASH ON DELIVERY</th>
                                                <th style="font-size:11px;">{{ $order->COD_amount ?  $order->COD_amount : "0.00 "}} SAR <span class="font-red"> {{ $order->Cod_Status == 'cod_to_be_collected' ? 'NOT PAID' : 'PAID'}} </span> </th>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-4 text-center">                    
                                        <span class="uppercase" style="font-weight:bold;"> TOTAL: </span><br>
                                            <span class="uppercase" style="font-weight:bold;"> {{ $order->COD_amount ?  $order->COD_amount : "0.00 "}} SAR  </span>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    
                </div>
                <div class="tab-pane" id="CUSTOMER">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-box" style="line-height:5px;">
                                <p>Name</p>
                                    <p class="font-red-flamingo">{{ $order->customer->name}}</p>
                                <p>Login</p>
                                    <p class="font-red-flamingo">{{ $order->customer->email}}</p>
                                <p>Email</p>
                                    <p class="font-red-flamingo">{{ $order->customer->email}}</p>
                                <p>Phone</p>
                                    <p class="font-red-flamingo">{{ $order->customer->phone}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box" style="line-height:5px;">
                                <p>Company</p>
                                    <p class="font-red-flamingo">{{ $order->company}}</p>
                                <p>Status</p>
                                    <p class="font-green-soft">{{ $order->customer->active == 0 ? 'Active' : 'Inactive'}}</p>
                                <p>Credit Balance</p>
                                    <p class="font-red-flamingo">0.00 SAR</p>
                                <p>Authorities</p>
                                    <p class="font-red-flamingo">ROLE_CUSTOMER</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="COURIER">
                    <div class="info-box">COURIER</div>
                </div>
                <div class="tab-pane" id="HISTORY">
                    <div class="info-box">HISTORY</div>
                </div>
                <div class="tab-pane" id="MAP">
                    <div class="info-box">MAP</div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('script')
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}"></script>
@endpush