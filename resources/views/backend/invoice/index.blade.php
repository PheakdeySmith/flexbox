@extends('backend.layouts.app')
@section('content')

<main class="main-content max-height-vh-100 h-100 ps ps--active-y">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 border-radius-xl position-sticky mt-4 top-1 z-index-sticky shadow-none"
        id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-3 text-dark" href="javascript:;">
                            <svg width="12px" height="12px" class="mb-1" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#252f40"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Account</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Invoice</li>
                </ol>
                <h6 class="font-weight-bolder">Invoice</h6>
            </nav>
            <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none me-auto">
                <a href="javascript:;" class="nav-link p-0 text-body">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse me-md-0 me-sm-4 mt-sm-0 mt-2" id="navbar">
                <ul class="navbar-nav justify-content-end ms-auto">
                    <li class="nav-item d-xl-none ps-3 pe-0 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link p-0 text-body" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid mt-4">
        <div class="row align-items-center">
            <div class="col-lg-4 col-sm-8">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab"
                                href="https://demos.creative-tim.com/soft-ui-dashboard-pro/examples/pages/account/settings.html"
                                role="tab" aria-selected="true">
                                Messages
                            </a>
                        </li>`
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab"
                                href="https://demos.creative-tim.com/soft-ui-dashboard-pro/examples/pages/account/billing.html"
                                role="tab" aria-selected="false">
                                Social
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab"
                                href="https://demos.creative-tim.com/soft-ui-dashboard-pro/examples/pages/account/invoice.html"
                                role="tab" aria-selected="false">
                                Notifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab"
                                href="https://demos.creative-tim.com/soft-ui-dashboard-pro/examples/pages/account/security.html"
                                role="tab" aria-selected="false">
                                Backup
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid my-3 py-3">
        <div class="row">
            <div class="col-md-8 col-sm-10 mx-auto">
                <form class="" action="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/account/index.html"
                    method="post">
                    <div class="card my-sm-5">
                        <div class="card-header text-center">
                            <div class="row justify-content-between">
                                <div class="col-md-4 text-start">
                                    <img class="mb-2 w-25 p-2" src="{{ asset('backend/assets') }}/image/logo-ct.webp" alt="Logo">
                                    <h6>
                                        St. Independence Embankment, 050105 Bucharest, Romania
                                    </h6>
                                    <p class="d-block text-secondary">tel: +4 (074) 1090873</p>
                                </div>
                                <div class="col-lg-3 col-md-7 text-md-end text-start mt-5">
                                    <h6 class="d-block mt-2 mb-0">Billed to: John Doe</h6>
                                    <p class="text-secondary">4006 Locust View Drive<br>
                                        San Francisco CA<br>
                                        California
                                    </p>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-md-between">
                                <div class="col-md-4 mt-auto">
                                    <h6 class="mb-0 text-start text-secondary">
                                        Invoice no
                                    </h6>
                                    <h5 class="text-start mb-0">
                                        #0453119
                                    </h5>
                                </div>
                                <div class="col-lg-5 col-md-7 mt-auto">
                                    <div class="row mt-md-5 mt-4 text-md-end text-start">
                                        <div class="col-md-6">
                                            <h6 class="text-secondary mb-0">Invoice date:</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-dark mb-0">06/03/2019</h6>
                                        </div>
                                    </div>
                                    <div class="row text-md-end text-start">
                                        <div class="col-md-6">
                                            <h6 class="text-secondary mb-0">Due date:</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-dark mb-0">11/03/2019</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table text-right">
                                            <thead class="bg-default">
                                                <tr>
                                                    <th scope="col" class="pe-2 text-start ps-2">Item</th>
                                                    <th scope="col" class="pe-2">Qty</th>
                                                    <th scope="col" class="pe-2" colspan="2">Rate</th>
                                                    <th scope="col" class="pe-2">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-start">Premium Support</td>
                                                    <td class="ps-4">1</td>
                                                    <td class="ps-4" colspan="2">$ 9.00</td>
                                                    <td class="ps-4">$ 9.00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start">Soft UI Design System PRO</td>
                                                    <td class="ps-4">3</td>
                                                    <td class="ps-4" colspan="2">$ 100.00</td>
                                                    <td class="ps-4">$ 300.00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start">Parts for service</td>
                                                    <td class="ps-4">1</td>
                                                    <td class="ps-4" colspan="2">$ 89.00</td>
                                                    <td class="ps-4">$ 89.00</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th class="h5 ps-4" colspan="2">Total</th>
                                                    <th colspan="1" class="text-right h5 ps-4">$ 698</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mt-md-5 mt-4">
                            <div class="row">
                                <div class="col-lg-5 text-left">
                                    <h5>Thank you!</h5>
                                    <p class="text-secondary text-sm">If you encounter any issues related to the invoice
                                        you can contact us at:</p>
                                    <h6 class="text-secondary mb-0">
                                        email:
                                        <span class="text-dark">support@creative-tim.com</span>
                                    </h6>
                                </div>
                                <div class="col-lg-7 text-md-end mt-md-0 mt-3">
                                    <button class="btn bg-gradient-info mt-lg-7 mb-0" onclick="window.print()"
                                        type="button" name="button">Print</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>2025,
                            made with <i class="fa fa-heart" aria-hidden="true"></i> by
                            <a href="https://www.creative-tim.com/" class="font-weight-bold" target="_blank">Creative
                                Tim</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/" class="nav-link text-muted"
                                    target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                    target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                    target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                    target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <div class="ps__rail-x" style="left: 0px; bottom: -47px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 47px; height: 800px; right: 0px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 30px; height: 509px;"></div>
    </div>
</main>

@endsection
