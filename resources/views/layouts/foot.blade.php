
    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                <script>
                    document.write(new Date().getFullYear());
                </script> @
                <a href="./" target="_blank" class="footer-link fw-bolder">Mohammad ❤ Alamkhail</a>
                Made by

            </div>
    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset("vendor/libs/jquery/jquery.js") }}"></script>
    <script src="{{ asset("vendor/libs/popper/popper.js") }}"></script>
    <script src="{{ asset("vendor/js/bootstrap.js") }}"></script>
    <script src="{{ asset("vendor/libs/perfect-scrollbar/perfect-scrollbar.js") }}"></script>

    <script src="{{ asset("vendor/js/menu.js") }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset("vendor/libs/apex-charts/apexcharts.js") }}"></script>

    <!-- Main JS -->
    <script src="{{ asset("js/main.js") }}"></script>

    <!-- Page JS -->
    <script src="{{ asset("js/dashboards-analytics.js") }}"></script>

    {{-- Data table js links --}}
{{--    <script src="{{ asset('js/data-bootstrap.js') }}"></script>--}}
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable.js') }}"></script>
    <script src="{{ asset('vendor/libs/persian-datepicker/dist/kamadatepicker.min.js') }}"></script>

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/toast.js') }}"></script>

    <script>

        window.addEventListener("show-form",function() {
            let a=document.querySelectorAll(".text-danger.small"),b=new bootstrap.Modal("#modal");b.show(),a.forEach(a=>{a.innerText=""})}),window.addEventListener("hide-form",function(){dataTable(),document.querySelectorAll(".text-danger.small").forEach(a=>{a.innerText=""})}),window.addEventListener("render-exchange",a=>{let b=a.detail.data;document.querySelector("#exchangedMoney").value=b}),$(document).ready(function(){dataTable()})
            window.addEventListener("message",c=>{if(toastr.options={closeButton:!0,progressBar:!0},null!=c.detail){let a=c.detail.type,b=c.detail.text;"success"===a?toastr.success(b):"error"===a?toastr.error(b):"info"===a?toastr.info(b):"warning"===a?toastr.warning(b):toastr.info("Invalid type of toaster ("+a+") ")}
        })

        window.addEventListener("init-datatable", ()=> {
            dataTable();
        })

   </script>
    <div class="loading" wire:loading>
        <div class="fa-5x ms-2" >
            <i class="fas fa-spinner fa-pulse"></i>
        </div>
    </div>
    
    @yield("scripts")

</body>
</html>

