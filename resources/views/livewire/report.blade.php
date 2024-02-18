<div class="container px-0">
    <form method="post" wire:submit.prevent="report">
        @csrf
        <div class="row g-2">
            <div class="col mb-0" wire:ignore>
                <label for="start" class="form-label">از تاریخ (تاریخ شروع)</label>
                <input
                    name="start-date"
                    type="text"
                    id="start"
                    class="form-control hijri-date"
                    wire:model="start_date"
                />
                @error('start_date')
                <div class="small text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col mb-0" wire:ignore>
                <label for="end" class="form-label">تا تاریخ (تاریخ ختم)</label>
                <input
                    name="end-date"
                    type="text"
                    id="end"
                    class="form-control  hijri-date"
                    wire:model="end_date"
                />
                @error('end_date')
                <div class="small text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col" style="margin-top: 41px;">
                <button class="btn btn-primary btn-sm">
                    <i class="bx bx-search-alt "></i>
                    جستجو
                </button>
            </div>
        </div>
    </form>

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
                                        <table class="table table-bordered">  
                                            <thead>
                                                <tr>
                                                    <th>اسم حساب</th>
                                                    @foreach($exists as $c)
                                                        <th>{{ $c }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>                                       
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

</div>

@section("scripts") 

<script>
            initHiriDate("start"); 
        initHiriDate("end");  
        let options = { year: 'numeric', month: '2-digit', day: '2-digit' };
        let today = new Date().toLocaleDateString('fa-af-u-nu-latn', options);

        setTimeout(() => {              
            $('.hijri-date').val(today);      
            @this.setHijri('start', today)
            @this.setHijri('end', today)
        }, 500);

        $(document).on("change", ".hijri-date", function(e) {
            let targetValue = e.target.value;
            if(targetValue) {
                @this.setHijri(e.target.getAttribute("id"), targetValue)
            }
        }) 

</script>

@endsection