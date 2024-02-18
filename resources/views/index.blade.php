@extends('layouts.master')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row mt-3">
            <!-- Expense Overview -->
            <div class="col-md-12 col-lg-12 order-1 mb-4">
                <div class="card h-100">
                    <div class="card-body px-0">
                        <div class="tab-content p-0">
                            <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                                <!-- Bordered Table -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-bordered" id="indexTable">
                                                <thead>
                                                <tr>
                                                    <th>اسم حساب</th>
                                                    @foreach($exists as $c)
                                                        <th>{{ $c }}</th>
                                                    @endforeach
                                                </tr>
                                                </thead>
                                                <tbody>    
                                                <tr>
                                                    <td>
                                                        <i class="bx bx-minus text-danger me-3"></i> <strong> قرض مشتریان </strong>
                                                    </td>
                                                    @foreach($debt as $d)
                                                        <td>
                                                            <span class="badge text-danger" style="direction: ltr;">
                                                            {{ number_format($d,2) }}
                                                            </span>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i class="bx bx-plus-circle text-info me-3"></i> <strong> جمع مشتریان </strong>
                                                    </td>
                                                    @foreach($remainCustomer as $remain)
                                                        <td>
                                                        <span class="badge text-success">
                                                        {{ number_format($remain, 2) }}
                                                        </span>
                                                        </td>
                                                    @endforeach
                                                </tr>     

                                                <tr>
                                                    <td>
                                                        <i class="bx bx-file text-info me-3"></i> <strong> مجموع </strong>
                                                    </td> 

                                                    @foreach($remainCustomer as $key => $val)
                                                        <td>
                                                            <span class="badge text-dark" style="direction: ltr;">
                                                            {{ number_format($val + $debt[$key], 2) }}
                                                            </span>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Bordered Table -->
                <!--/ Expense Overview -->
            </div>
        </div>

        <!-- / Content -->
@endsection

@section("scripts")

<script>
    const firstRow = $("#indexTable").find("tr:nth-child(1) td:not(:first-child)");
    const secondRow = $("#indexTable").find("tr:nth-child(2) td:not(:first-child)");
    
    firstRow.each((i, el)=> {
        console.log(el.textContent)
        const total = parseFloat(el.textContent) + parseFloat(secondRow[i].textContent)
        console.log(total)
    })


</script>

@endsection
