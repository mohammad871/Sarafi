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
                                        <h6>  پروفایل من    </h6>
                                        <hr>
                                    </div>

                                </div>
                            </div>

                            <div class="card-body">
                                <form method="post" wire:submit.prevent="update">
                                    @csrf
                                    @php $user = session()->get('user'); @endphp

                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <div class="row g-2">
                                                <div class="col mb-0">
                                                    <label for="username" class="form-label">نام کابری</label>
                                                    <input
                                                        id="username"
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="نام کاربری"
                                                        name="name"
                                                        value="{{ $user->name }}"
                                                        wire:model.defer="data.name"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-0">
                                                    <label for="oldPassword" class="form-label">پسورد قبلی</label>
                                                    <input
                                                        required
                                                        id="oldPassword"
                                                        type="password"
                                                        class="form-control"
                                                        placeholder="پسورد قبلی"
                                                        name="oldPassword"
                                                        wire:model.defer="data.oldPassword"
                                                    />
                                                    @error("oldPassword")
                                                    <div class="text-danger small">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-0">
                                                    <label for="newPassword" class="form-label">پسورد جدید</label>
                                                    <input
                                                        type="password"
                                                        class="form-control"
                                                        placeholder="پسورد جدید"
                                                        name="new-password"
                                                        wire:model.defer="data.newPassword"
                                                    />

                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-0">
                                                    <label for="newRePassword" class="form-label">تکرار پسورد جدید</label>
                                                    <input
                                                        id="newRePassword"
                                                        type="password"
                                                        class="form-control"
                                                        placeholder="تکرار پسورد جدید"
                                                        name="new-re-password"
                                                        wire:model.defer="data.newRePassword"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 text-center">
                                            <img src="{{ asset('storage/img/'.$data['profile_photo_path']) }}" alt="" class="w-50">

                                            <input type="file" class="form-control mt-2" wire:model.defer="profile_photo_path">
                                        </div>
                                    </div>


                                    <button class="btn btn-primary mt-3" type="submit">ذخیره تغیرات</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


