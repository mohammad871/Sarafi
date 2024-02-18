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

                                    <!-- Vertically Centered Modal -->
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mt-3">
                                                <!-- Button trigger modal -->
                                                <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                    wire:click="create"
                                                >
                                                    مشتری جدید
                                                </button>

                                                <!-- Customer add Modal -->
                                                <div data-bs-backdrop="static" data-bs-keyboard="false" wire:ignore.self class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-onboarding" role="document">
                                                        <form method="post" wire:submit.prevent="
                                                                                @php
                                                                                    if($showDeleteModal)
                                                                                        echo "destroy";
                                                                                    else {
                                                                                        echo $showEditModal ? 'update' : 'store';
                                                                                    }
                                                                                @endphp
                                                        " class="modal-content">
                                                            @if(!$showDeleteModal)
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalCenterTitle">
                                                                        @if(!$showEditModal)
                                                                        مشتری جدید
                                                                        @else
                                                                        ویرایش مشتری
                                                                        @endif
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
                                                                        <div class="col mb-0">
                                                                            <label for="emailWithTitle" class="form-label">اسم مشتری</label>
                                                                            <input
                                                                                type="text"
                                                                                id="emailWithTitle"
                                                                                class="form-control"
                                                                                placeholder="اسم مشتری"
                                                                                name="name"
                                                                                wire:model.defer="data.name"
                                                                            />
                                                                            @error('name')
                                                                            <div class="small text-danger">
                                                                                {{ $message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col mb-0">
                                                                            <label for="dobWithTitle" class="form-label">آدرس  </label>
                                                                            <input
                                                                                type="text"
                                                                                id="dobWithTitle"
                                                                                class="form-control"
                                                                                placeholder="آدرس"
                                                                                name="address"
                                                                                wire:model.defer="data.address"
                                                                            />
                                                                            @error('address')
                                                                            <div class="small text-danger">
                                                                                {{ $message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="row g-2">
                                                                        <div class="col mb-0">
                                                                            <label for="emailWithTitle" class="form-label"> شماره تماس</label>
                                                                            <input
                                                                                type="number"
                                                                                id="emailWithTitle"
                                                                                class="form-control"
                                                                                placeholder=" شماره تماس"
                                                                                name="phone"
                                                                                wire:model.defer="data.phone"
                                                                            />
                                                                            @error('phone')
                                                                            <div class="small text-danger">
                                                                                {{ $message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col mb-0">
                                                                            <label for="dobWithTitle" class="form-label"> نمبر تذکره </label>
                                                                            <input
                                                                                type="number"
                                                                                id="dobWithTitle"
                                                                                class="form-control"
                                                                                placeholder=" نمبر تذکره"
                                                                                name="tazkira"
                                                                                wire:model.defer="data.tazkira"
                                                                            />
                                                                            @error('tazkira')
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
                                                                    @if(!$showEditModal)
                                                                    ثبت کردن
                                                                    @else
                                                                    ذخیره تغیرات
                                                                    @endif
                                                                </button>
                                                            </div>
                                                            @else
                                                                <div class="modal-header">
                                                                    <h5>
                                                                        آیا می خواهید
                                                                        <strong>
                                                                            ({{ $customer->name }})
                                                                        </strong>
                                                                        حذف شود؟
                                                                    </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                                        نخیر
                                                                        <i class="bx bx-x"></i>
                                                                    </button>
                                                                    <button type="submit"  class="btn btn-primary" data-bs-dismiss="modal">
                                                                        بله
                                                                        <i class="bx bx-trash"></i>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-bordered {{ count($customers) != 0 ? 'data-table' : '' }}">
                                        <thead>
                                        <tr>
                                            <th>شماره</th>
                                            <th> اسم مشتری   </th>
                                            <th>آدرس  </th>
                                            <th> شماره تماس </th>
                                            <th> نمبر تذکره  </th>
                                            <th> عملیات </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($customers as $customer)
                                            <tr>
                                                <td>{{ $customer->id }}</td>
                                                <td>
                                                    {{ $customer->name }}
                                                </td>
                                                <td>{{ $customer->address }}</td>

                                                <td>{{ $customer->phone }}</td>
                                                <td>{{ $customer->tazkira }}</td>
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
                                                        <li><a wire:click="edit({{ $customer->id }})" class="dropdown-item" href="javascript:void(0);" >تصحیح</a></li>
                                                        <li><a wire:click="confirmDelete({{ $customer->id }})" class="dropdown-item" href="javascript:void(0);">پاکردن</a></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">
                                                    <div class="bg-warning text-white p-4 py-2 rounded-2">
                                                        مشتری موجود نیست!!!
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


