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
                                        <h6>  مشتریان    </h6>
                                        <hr>
                                    </div>
                                </div>
                                <!-- Button trigger modal -->
                                <button
                                    type="button"
                                    class="btn btn-primary mb-3"
                                    wire:click="create"
                                >
                                    جمع قرض مشتری
                                </button>

                                <div class="container-fluid">
                                    @if(!empty($msg))
                                        <div class="col-lg-3 col-md-6 col-12 alert alert-success alert-dismissible fade show">
                                            <button class="btn-close" data-bs-dismiss="alert"></button>
                                            {{ $msg }}
                                        </div>
                                @endif
                                    <!-- Customer add Modal -->
                                    <div data-bs-backdrop="static" data-bs-keyboard="false" wire:ignore.self class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-onboarding" role="document">

                                                    <form method="post" wire:submit.prevent="{{ $showDeleteModal ? 'destroy' : 'store' }}" class="modal-content">
                                                        @if(!$showDeleteModal)
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalCenterTitle">
                                                                    <h5 class="modal-title" id="modalCenterTitle"> سند جمع / قرض مشتری   </h5>
                                                                </h5>
                                                                <a
                                                                    type="button"
                                                                    class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"
                                                                ></a>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row g-2">
                                                                    @if(!empty($error))
                                                                    <div class="small bg-gray p-3 text-white rounded-2">
                                                                            {!! $error['error'] !!}
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                <div class="row g-2">
                                                                    <div class="col mb-0">
                                                                        <label for="emailWithTitle" class="form-label">انتخاب مشتری</label>
                                                                        <input
                                                                            autocomplete="off"
                                                                            type="text"
                                                                            list="customers"
                                                                            id="emailWithTitle"
                                                                            class="form-control"
                                                                            placeholder="لطفاً مشتری را انتخاب کنید!"
                                                                            name="name"
                                                                            wire:model.defer="data.name"
                                                                        />
                                                                        <datalist id="customers">
                                                                            @foreach($customers as $customer)
                                                                            <option value="{{ $customer->name }}">
                                                                            @endforeach
                                                                        </datalist>
                                                                        @error('name')
                                                                        <div class="small text-danger">
                                                                            {{ $message }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col mb-0" wire:ignore>
                                                                        <label for="datepicker-customer" class="form-label">تاریخ</label>
                                                                        <input
                                                                            autocomplete="off"
                                                                            type="text"
                                                                            id="datepicker-customer"
                                                                            class="form-control hijri-date"
                                                                            placeholder="تاریخ" 
                                                                            wire:model.defer="data.date"
                                                                        />
                                                                        @error('date')
                                                                        <div class="small text-danger">
                                                                            {{ $message }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row g-2">
                                                                    <div class="col mb-0">
                                                                        <label for="dobWithTitle" class="form-label"> نوع معامله</label>
                                                                        <select name="type" class="form-control" wire:model.defer="data.type">
                                                                            <option value="">نوع معامله</option>
                                                                            <option>جمع</option>
                                                                            <option>قرض</option>
                                                                        </select>
                                                                        @error('type')
                                                                        <div class="small text-danger">
                                                                            {{ $message }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col mb-0">
                                                                        <label for="dobWithTitle" class="form-label"> ---واحد پولی --- </label>
                                                                        <select name="currency" class="form-control" wire:model.defer="data.currency">
                                                                            <option value="">واحد پولی</option>
                                                                            @foreach($CURRENCY as $c)
                                                                                <option>{{ $c }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('currency')
                                                                        <div class="small text-danger">
                                                                            {{ $message }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row g-2">
                                                                    <div class="col mb-0">
                                                                        <label for="emailWithTitle" class="form-label">جزئیات</label>
                                                                        <input
                                                                            type="text"
                                                                            id="emailWithTitle"
                                                                            class="form-control"
                                                                            placeholder=""
                                                                            name="description"
                                                                            wire:model.defer="data.description"
                                                                        />
                                                                        @error('description')
                                                                        <div class="small text-danger">
                                                                            {{ $message }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col mb-0">
                                                                        <label for="emailWithTitle" class="form-label">مبلغ</label>
                                                                        <input
                                                                            type="number"
                                                                            id="emailWithTitle"
                                                                            class="form-control"
                                                                            placeholder=""
                                                                            name="money"
                                                                            min="0"
                                                                            wire:model.defer="data.money"
                                                                        />
                                                                        @error('money')
                                                                        <div class="small text-danger">
                                                                            {{ $message }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                    کنسل کردن
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">
                                                                        ثبت کردن
                                                                </button>
                                                            </div>
                                                        @else
                                                            <div class="modal-header text-end">
                                                                <h5 class="text-end">آیا می خواهید حساب مورد نظر حذف شود؟</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                                    نخیر
                                                                </button>
                                                                <button type="submit"  class="btn btn-primary" data-bs-dismiss="modal">
                                                                    بله
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-bordered {{ count($customerCalculation) != 0 ? 'data-table' : '' }}">
                                        <thead>
                                        <tr>
                                            <th> نمبر </th>
                                            <th> اسم مشتری </th>
                                            <th> تاریخ  </th>
                                            <td> واحد پولی </td>
                                            <th> نوع معامله </th>
                                            <th> جزییات  </th>
                                            <th>مبلغ  </th>
                                            <th>  عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($customerCalculation as $calculation)
                                            <tr>
                                                <td> {{ $calculation->deal_id }} </td>
                                                <td> {{ $calculation->name }} </td>
                                                <td> {{ $calculation->date }} </td>
                                                <td> {{ $calculation->currency }} </td>
                                                <td> {{ $calculation->type }} </td>
                                                <td> {{ $calculation->description }} </td>
                                                <td style="direction: ltr;" class="text-center">
                                                    @php
                                                        $class = 'danger';
                                                        if($calculation->type == "جمع"):
                                                            $class = 'success';
                                                        endif;
                                                    @endphp
                                                        <span class="badge text-{{ $class }}">{{ $calculation->money }}</span>
                                                </td>
                                                <td>
                                                    <button
                                                        type="button"
                                                        class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a wire:click="confirmDelete({{ $calculation->deal_id }})" class="dropdown-item" href="javascript:void(0);">پاکردن</a></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">
                                                    <div class="bg-warning text-white p-4 py-2 rounded-2">
                                                        جمع / قرض مشتری یافت نشد!
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
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



@section("scripts") 

<script>  
    window.addEventListener("hide-form", ()=> {
        $("#modal").modal("hide");
    })
    window.addEventListener("show-form", ()=> { 
        const selector = "datepicker-customer";
        initHiriDate(selector); 

        let options = { year: 'numeric', month: '2-digit', day: '2-digit' };
        let today = new Date().toLocaleDateString('fa-af-u-nu-latn', options);

        setTimeout(() => {              
            $('.hijri-date').val(today);      
            @this.setHijri(today)
        }, 500);

        $(document).on("change", ".hijri-date", function(e) {
            let targetValue = e.target.value;
            if(targetValue) {
                @this.setHijri(targetValue)
            }
        })
    })

</script>

@endsection