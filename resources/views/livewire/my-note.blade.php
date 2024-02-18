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
                                        <h6> یاداشت من </h6>
                                        <hr>
                                    </div>
                                </div>

                                <nav class="navbar navbar-example navbar-expand-lg bg-footer-theme">
                                    <div class="container-fluid">
                                        @if(!empty($msg))
                                            <div class="col-lg-3 col-md-6 col-12 alert alert-success alert-dismissible fade show">
                                                <button class="btn-close" data-bs-dismiss="alert"></button>
                                                {{ $msg }}
                                            </div>
                                    @endif
                                    <!-- Vertically Centered Modal -->
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mt-3">
                                                <!-- Button trigger modal -->
                                                <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                    wire:click="create"
                                                >
                                                    یاداشت جدید
                                                </button>
                                            </div>
                                        </div>

                                        <!-- items add Modal -->
                                        <div data-bs-backdrop="static" data-bs-keyboard="false" wire:ignore.self class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-onboarding" role="document">
                                                <form method="post" class="modal-content" wire:submit.prevent="
                                                    @php
                                                        if($showDeleteModal)
                                                            echo "destroy";
                                                        else {
                                                            echo $showEditModal ? 'update' : 'store';
                                                        }
                                                    @endphp
                                                    ">
                                                    @csrf

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">
                                                            @if($showDeleteModal)
                                                                حذف یاداشت
                                                            @elseif($showEditModal)
                                                                تغیرات در یاداشت
                                                            @else
                                                                یاداشت جدید
                                                            @endif
                                                        </h5>
                                                        <button
                                                            type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"
                                                        ></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if(!$showDeleteModal)
                                                        <span class="small">عنوان</span>
                                                        <input type="text" class="mb-2 mt-1 form-control" wire:model.defer="data.title">
                                                        <span class="small">نوت</span>
                                                        <textarea wire:model.defer="data.note" placeholder="یاداشت جدید را اضافه نماید" name="note" id="text-note" cols="30" rows="5" class="form-control mt-1"></textarea>
                                                        @error('note')
                                                        <div class="small text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                        @else
                                                            <h6>
                                                            آیا می خواهید یاداشت انتخاب شده حذف شود؟
                                                            </h6>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                                نخیر
                                                                <i class="bx bx-x"></i>
                                                            </button>
                                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                                                                بله
                                                                <i class="bx bx-trash"></i>
                                                            </button>
                                                        @endif
                                                    </div>

                                                    @if(!$showDeleteModal)
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                            کنسل کردن
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            ثبت کردن
                                                        </button>
                                                    </div>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>

                        <div class="row m-2 mt-5">
                            @forelse($notes as $note)
                            <div class="col-md-3 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div wire:click="confirmDelete({{ $note->id }})" style="font-size: 32px; right: 5px; top: -12px; cursor: pointer;" class="position-absolute">
                                            &times;
                                        </div>
                                        <h3 class="card-title mb-2 lead fw-bold">
                                            {{ $note->title ?? 'بدون عنوان' }}
                                        </h3>
                                        <span class="fw-semibold d-block mb-1 small">
                                            {!! \Illuminate\Support\Str::limit($note->note, 40) !!}
                                        </span>
                                        <small class="text-success fw-semibold"><i class="bx bx-calendar-check"></i>
                                            {{ $note->created_at }}
                                        </small>
                                        <div wire:click="edit({{ $note->id }})" style="font-size: 32px; left: 20px; bottom: 14px; cursor: pointer;" class="position-absolute">
                                            <i class="bx bx-edit"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="bg-warning p-2 py-3 rounded-2">
                                    یاداشت یافت نشد!
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

