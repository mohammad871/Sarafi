
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->

                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">کهاته جمع /قرض مشتریان</h1>
                                </div>
                                <form method="post" wire:submit.prevent="login">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label for="" class="fw-bold mb-2">نام کاربری</label>
                                        <input type="username" autofocus class="form-control form-control-user"
                                               placeholder="نام کاربری را وارد کنید......"
                                               wire:model.defer="data.username"
                                        >
                                        @error('username')
                                        <div class="small text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="fw-bold mb-2">پسورد</label>
                                        <input type="password" class="form-control form-control-user"
                                               placeholder="پسورد را وارد کنید......"
                                               wire:model.defer="data.password"
                                        >
                                        @error('password')
                                        <div class="small text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        <i class="fas fa-sign-out-alt"></i>
                                        داخل شدن
                                    </button>
                                    <hr>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-block bg-login-image text-center">
                            <img src="{{ asset('img/exchange.jpg') }}" alt="" class="w-100">
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

