<div>
    @php
        $msg = session()->get('message');
        Session::forget('message');
    @endphp

<div class="row">
    <!-- Expense Overview -->
    <div class="col-md-12 col-lg-12 order-1 mb-4">
        <div class="card h-100">
            <div class="card-body px-0">
                <div class="tab-content p-0">
                    <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                        <!-- Bordered Table -->
                        <div class="card">
                            <div class="card-header">
                                <!-- Vertically Centered Modal -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="mt-3">
                                        <!-- Button trigger modal -->
                                        <h6>  صورت حساب مشتریان    </h6>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if($filtered) 
                                @if(!$filterBy)
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-bordered data-table ">
                                        <thead>
                                        <tr>
                                            <th class="w-px-30"> نمبر </th>
                                            <th> اسم مشتری </th>
                                            @foreach($CURRENCY as $currency)
                                                <th style="width: 80px">
                                                    {{$currency}}
                                                </th>
                                            @endforeach 
                                            <th class='w-px-30'>
                                                عملیات
                                            </th>
                                        </tr>
                                        </thead> 
                                        <tbody>
                                            @php $x = 1; @endphp
                                            @foreach($filtered as $account => $value)
                                            <tr>
                                                <td>{{ $x }}</td>
                                                <td wire:click="setFilter('{{$account}}')" class="cursor-pointer">{{ $account }}</td>
                                                @foreach($value as $money)
                                                <td>
                                                    <span style=" direction: ltr;"  class="badge {{$money > 0 ? 'text-success' : 'text-danger'}}">
                                                        {{number_format($money, 2)}}
                                                    </span>
                                                </td>
                                                @endforeach 
                                                <td>
                                                    <span wire:click="setFilter('{{$account}}')" class="badge bg-dark cursor-pointer">
                                                        تفصیل
                                                    </span>
                                                </td>
                                            </tr>
                                            @php $x++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table> 
                                </div>
                                @endif   
                                    @if($filterBy)
                                    <button class="d-print-none btn btn-warning btn-sm mb-2" wire:click="setFilter('')"> 
                                        برګشت
                                    </button>
                                    @endif
                                    @if($filterBy)
                                    <h4>
                                        صورت حساب (
                                            {{$filterBy}}
                                        ) 
                                    </h4> 
                                    <table class="table table-bordered ">
                                        <thead>
                                        <tr>
                                            <th class="w-px-30"> نمبر </th>
                                            <th class="w-px-100"> توضیجات </th>
                                            <th class="w-px-30"> نوعیت </th>
                                            <th class="w-px-100"> تاریخ </th>
                                            @foreach($CURRENCY as $currency)
                                                <th style="width: 80px">
                                                    {{$currency}}
                                                </th>
                                            @endforeach  
                                        </tr>
                                        </thead> 
                                        <tbody>
                                            @php $x = 1; @endphp
                                            @foreach($filtered as $account => $value)
                                            @php 
                                                $firstRec = $value[0];
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ $x }}
                                                </td> 
                                                <td>
                                                    {{ $firstRec['description'] }}
                                                </td> 
                                                <td>
                                                    {{ $firstRec['type'] }}
                                                </td> 
                                                <td>
                                                    {{ $firstRec['date'] }}
                                                </td> 
                                                @foreach($value as $row) 
                                                <td>
                                                    <span class="badge {{$row['money'] >= 0 ? 'text-success' : 'text-danger'}}" style="direction: ltr;">
                                                        {{number_format($row['money'], 2)}}
                                                    </span>
                                                </td> 
                                                @endforeach
                                            </tr> 
                                            @php $x++; @endphp
                                            @endforeach
                                            <tr class="bg-dark">
                                                <th class="text-white" colspan="4" style="width: 180px">
                                                    مجموع
                                                </th>
                                                @foreach($result as $r)
                                                <th class="text-white"  style="width: 80px;  direction: ltr;">
                                                    {{ $r }}
                                                </th>
                                                @endforeach 
                                            </tr>
                                        </tbody>
                                    </table>
 
                                </div>
                                @endif
                                @else 
                                <h4>
                                    صورت حساب یافت نشد
                                </h4>
                                @endif 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Bordered Table -->
        <!--/ Expense Overview -->
    </div>
</div>
</div>