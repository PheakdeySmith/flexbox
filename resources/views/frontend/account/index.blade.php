@extends('frontend.layouts.app')

@section('content')
    <!--bread-crumb-->
    <div class="iq-breadcrumb" style="background-image: url({{ asset('frontend/assets') }}/images/background.webp);">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <nav aria-label="breadcrumb" class="text-center">
                        <h2 class="title">My Account</h2>
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">My Account</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> <!--bread-crumb-->

    <div class="section-padding service-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="acc-left-menu p-4 mb-5 mb-lg-0 mb-md-0">
                        <div class="product-menu">
                            <ul class="list-inline m-0 nav nav-tabs flex-column bg-transparent border-0" role="tablist">
                                <li class="pb-3 nav-item" role="presentation">
                                    <button class="nav-link active p-0 bg-transparent" data-bs-toggle="tab"
                                        data-bs-target="#dashboard" type="button" role="tab" aria-selected="true"><i
                                            class="fas fa-tachometer-alt"></i><span class="ms-2">Dashboard</span></button>
                                </li>
                                <li class="py-3 nav-item" role="presentation">
                                    <button class="nav-link p-0 bg-transparent" data-bs-toggle="tab"
                                        data-bs-target="#orders" type="button" role="tab" aria-selected="false"
                                        tabindex="-1"><i class="fas fa-list"></i><span
                                            class="ms-2">Orders</span></button>
                                </li>
                                <li class="py-3 nav-item" role="presentation">
                                    <button class="nav-link p-0 bg-transparent" data-bs-toggle="tab"
                                        data-bs-target="#downloads" type="button" role="tab" aria-selected="false"
                                        tabindex="-1"><i class="fas fa-download"></i><span
                                            class="ms-2">Downloads</span></button>
                                </li>
                                <li class="py-3 nav-item" role="presentation">
                                    <button class="nav-link p-0 bg-transparent" data-bs-toggle="tab"
                                        data-bs-target="#address" type="button" role="tab" aria-selected="false"
                                        tabindex="-1"><i class="fas fa-map-marker-alt"></i><span
                                            class="ms-2">Address</span></button>
                                </li>
                                <li class="py-3 nav-item" role="presentation">
                                    <button class="nav-link p-0 bg-transparent" data-bs-toggle="tab"
                                        data-bs-target="#account-details" type="button" role="tab"
                                        aria-selected="false" tabindex="-1"><i class="fas fa-user"></i><span
                                            class="ms-2">Account details</span></button>
                                </li>
                                <li class="pt-3 nav-item" role="presentation">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="nav-link p-0 bg-transparent" data-bs-toggle="tab"
                                            data-bs-target="#logout" type="submit" role="tab" aria-selected="false"
                                            tabindex="-1"><i class="fas fa-sign-out-alt"></i><span
                                                class="ms-2">Logout</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content" id="product-menu-content">
                        <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                            <div class="myaccount-content text-body p-4">
                                <p>Hello Jenny (not Jenny?
                                    <a href="#" onclick="document.getElementById('logout-form').submit();">Log out</a>
                                    )
                                </p>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <p>From your account dashboard you can view your <a href="javascript:void(1)">recent
                                        orders</a>,
                                    manage your <a href="javascript:void(3)">shipping and billing addresses</a>, and <a
                                        href="javascript:void(4)">edit your password and account details</a>.
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="orders" role="tabpanel">
                            <div class="orders-table text-body p-4">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="border-bottom">
                                                <th class="fw-bolder p-3">Order</th>
                                                <th class="fw-bolder p-3">Date</th>
                                                <th class="fw-bolder p-3">Status</th>
                                                <th class="fw-bolder p-3">Total</th>
                                                <th class="fw-bolder p-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border-bottom">
                                                <td class="text-primary fs-6">#32604</td>
                                                <td>October 28, 2022</td>
                                                <td>Cancelled</td>
                                                <td>$215.00 For 0 Items</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="iq-button">
                                                            <a href="javascript:void(0)"
                                                                class="btn text-uppercase position-relative">
                                                                <span class="button-text">pay</span>
                                                                <i class="fa-solid fa-play"></i>
                                                            </a>
                                                        </div>
                                                        <div class="iq-button">
                                                            <a href="javascript:void(0)"
                                                                class="btn text-uppercase position-relative">
                                                                <span class="button-text">view</span>
                                                                <i class="fa-solid fa-play"></i>
                                                            </a>
                                                        </div>
                                                        <div class="iq-button">
                                                            <a href="javascript:void(0)"
                                                                class="btn text-uppercase position-relative">
                                                                <span class="button-text">cancel</span>
                                                                <i class="fa-solid fa-play"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td class="text-primary fs-6">#32584</td>
                                                <td>October 27, 2022</td>
                                                <td>On Hold</td>
                                                <td>$522.00 For 0 Items</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="iq-button">
                                                            <a href="javascript:void(0)"
                                                                class="btn text-uppercase position-relative">
                                                                <span class="button-text">pay</span>
                                                                <i class="fa-solid fa-play"></i>
                                                            </a>
                                                        </div>
                                                        <div class="iq-button">
                                                            <a href="javascript:void(0)"
                                                                class="btn text-uppercase position-relative">
                                                                <span class="button-text">view</span>
                                                                <i class="fa-solid fa-play"></i>
                                                            </a>
                                                        </div>
                                                        <div class="iq-button">
                                                            <a href="javascript:void(0)"
                                                                class="btn text-uppercase position-relative">
                                                                <span class="button-text">cancel</span>
                                                                <i class="fa-solid fa-play"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td class="text-primary fs-6">#31756</td>
                                                <td>October 19, 2022</td>
                                                <td>Processing</td>
                                                <td>$243.00 For 0 Items</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="iq-button">
                                                            <a href="javascript:void(0)"
                                                                class="btn text-uppercase position-relative">
                                                                <span class="button-text">pay</span>
                                                                <i class="fa-solid fa-play"></i>
                                                            </a>
                                                        </div>
                                                        <div class="iq-button">
                                                            <a href="javascript:void(0)"
                                                                class="btn text-uppercase position-relative">
                                                                <span class="button-text">view</span>
                                                                <i class="fa-solid fa-play"></i>
                                                            </a>
                                                        </div>
                                                        <div class="iq-button">
                                                            <a href="javascript:void(0)"
                                                                class="btn text-uppercase position-relative">
                                                                <span class="button-text">cancel</span>
                                                                <i class="fa-solid fa-play"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td class="text-primary fs-6">#23663</td>
                                                <td>October 7, 2022</td>
                                                <td>Completed</td>
                                                <td>$123.00 For 0 Items</td>
                                                <td class="fs-6">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="iq-button">
                                                            <a href="javascript:void(0)"
                                                                class="btn text-uppercase position-relative">
                                                                <span class="button-text">view</span>
                                                                <i class="fa-solid fa-play"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td class="text-primary fs-6">#23612</td>
                                                <td>October 7, 2022</td>
                                                <td>Completed</td>
                                                <td>$64.00 For 0 Items</td>
                                                <td class="fs-6">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="iq-button">
                                                            <a href="javascript:void(0)"
                                                                class="btn text-uppercase position-relative">
                                                                <span class="button-text">view</span>
                                                                <i class="fa-solid fa-play"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary fs-6">#19243</td>
                                                <td>April 1, 2022</td>
                                                <td>Completed</td>
                                                <td>$159.00 For 0 Items</td>
                                                <td class="fs-6">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="iq-button">
                                                            <a href="javascript:void(0)"
                                                                class="btn text-uppercase position-relative">
                                                                <span class="button-text">view</span>
                                                                <i class="fa-solid fa-play"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="downloads" role="tabpanel">
                            <div class="orders-table text-body p-4">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="border-bottom">
                                                <th class="fw-bolder p-3">Product</th>
                                                <th class="fw-bolder p-3">Downloads Remaining</th>
                                                <th class="fw-bolder p-3">Expires</th>
                                                <th class="fw-bolder p-3">Download</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="p-3 fs-6">Electric Toothbrush</td>
                                                <td class="p-3">∞</td>
                                                <td class="p-3 fs-6">Never</td>
                                                <td class="p-3"><a
                                                        href="https://templates.iqonic.design/streamit-dist/frontend/html/shop/my-account.html#"
                                                        class="p-2 bg-primary text-white fs-6" download="">Product
                                                        Demo</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="address" role="tabpanel">
                            <div class="text-body p-4">
                                <p class="my-3">The following addresses will be used on the checkout page by default.</p>
                                <div class="d-flex align-items-center justify-content-between my-5 gap-2 flex-wrap">
                                    <h4 class="mb-0">Billing Address.</h4>
                                    <div class="iq-button">
                                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/shop/my-account.html#"
                                            class="btn text-uppercase position-relative" data-bs-toggle="collapse"
                                            data-bs-target="#edit-address-1" aria-expanded="false">
                                            <span class="button-text">Edit</span>
                                            <i class="fa-solid fa-play"></i>
                                        </a>
                                    </div>
                                </div>
                                <div id="edit-address-1" class="collapse">
                                    <div class="text-body mb-4">
                                        <form>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">First name&nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="first-name" value="John"
                                                    class="form-control" required="required">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">Last name&nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="last-name" value="deo"
                                                    class="form-control" required="required">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">Company name (optional)</label>
                                                <input type="text" name="last-name" value="Iqonic Design"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">Country / Region &nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <div class="mb-5">
                                                    <select
                                                        class="select2-basic-single js-states form-control select2-hidden-accessible"
                                                        aria-label="select country" required="required"
                                                        data-select2-id="select2-data-1-d6tk" tabindex="-1"
                                                        aria-hidden="true">
                                                        <option value="" selected=""
                                                            data-select2-id="select2-data-3-8iua">Choose a country
                                                        </option>
                                                        <option value="1">India</option>
                                                        <option value="2">United Kingdom</option>
                                                        <option value="3">United States</option>
                                                        <option value="4">Australia</option>
                                                        <option value="5">North Corea</option>
                                                    </select><span
                                                        class="select2 select2-container select2-container--default wide"
                                                        dir="ltr" data-select2-id="select2-data-2-45vb"
                                                        style="width: 100%;"><span class="selection"><span
                                                                class="select2-selection select2-selection--single"
                                                                role="combobox" aria-haspopup="true"
                                                                aria-expanded="false" tabindex="0"
                                                                aria-disabled="false"
                                                                aria-labelledby="select2-wfsv-container"
                                                                aria-controls="select2-wfsv-container"><span
                                                                    class="select2-selection__rendered"
                                                                    id="select2-wfsv-container" role="textbox"
                                                                    aria-readonly="true" title="Choose a country">Choose a
                                                                    country</span><span class="select2-selection__arrow"
                                                                    role="presentation"><b
                                                                        role="presentation"></b></span></span></span><span
                                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                </div>
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">Street address&nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="address"
                                                    placeholder="House number and street name" value="4517 Kentucky"
                                                    class="form-control mb-3 rounded-0" required="required">
                                                <input type="text" name="address"
                                                    placeholder="Apartment, suite, unit, etc. (optional)"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">Town / City&nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="city" value="Navsari"
                                                    class="form-control" required="required">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">State&nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <div class="mb-5">
                                                    <select
                                                        class="select2-basic-single js-states form-control select2-hidden-accessible"
                                                        aria-label="select state" data-select2-id="select2-data-4-88ry"
                                                        tabindex="-1" aria-hidden="true">
                                                        <option value="" selected=""
                                                            data-select2-id="select2-data-6-11cn">Choose a State</option>
                                                        <option value="1">Gujarat</option>
                                                        <option value="2">Delhi</option>
                                                        <option value="3">Goa</option>
                                                        <option value="4">Haryana</option>
                                                        <option value="5">Ladakh</option>
                                                    </select><span
                                                        class="select2 select2-container select2-container--default wide"
                                                        dir="ltr" data-select2-id="select2-data-5-mfbv"
                                                        style="width: 100%;"><span class="selection"><span
                                                                class="select2-selection select2-selection--single"
                                                                role="combobox" aria-haspopup="true"
                                                                aria-expanded="false" tabindex="0"
                                                                aria-disabled="false"
                                                                aria-labelledby="select2-vvd8-container"
                                                                aria-controls="select2-vvd8-container"><span
                                                                    class="select2-selection__rendered"
                                                                    id="select2-vvd8-container" role="textbox"
                                                                    aria-readonly="true" title="Choose a State">Choose a
                                                                    State</span><span class="select2-selection__arrow"
                                                                    role="presentation"><b
                                                                        role="presentation"></b></span></span></span><span
                                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                </div>
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">PIN code&nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="pin code" value="396321"
                                                    class="form-control" required="required">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">Phone&nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <input type="tel" name="number" value="1234567890"
                                                    class="form-control" required="required">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">Email address&nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" name="email" value="johndeo@gmail.com"
                                                    class="form-control" required="required">
                                            </div>
                                            <div class="form-group mb-5">
                                                <div class="iq-button">
                                                    <a href="https://templates.iqonic.design/streamit-dist/frontend/html/shop/my-account.html"
                                                        class="btn text-uppercase position-relative">
                                                        <span class="button-text">Save Address</span>
                                                        <i class="fa-solid fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="edit-address w-100">
                                        <tbody>
                                            <tr>
                                                <td class="label-name p-2">Name</td>
                                                <td class="seprator p-2"><span>:</span></td>
                                                <td class="p-2">john deo</td>
                                            </tr>
                                            <tr>
                                                <td class="label-name p-2">Company</td>
                                                <td class="seprator p-2"><span>:</span></td>
                                                <td class="p-2">Iqonic Design</td>
                                            </tr>
                                            <tr>
                                                <td class="label-name p-2">Country</td>
                                                <td class="seprator p-2"><span>:</span></td>
                                                <td class="p-2">India</td>
                                            </tr>
                                            <tr>
                                                <td class="label-name p-2">Address</td>
                                                <td class="seprator p-2"><span>:</span></td>
                                                <td class="p-2">4517 Washington Ave, Manchester.</td>
                                            </tr>
                                            <tr>
                                                <td class="label-name p-2">E-mail</td>
                                                <td class="seprator p-2"><span>:</span></td>
                                                <td class="p-2">johndeo@gmail.com</td>
                                            </tr>
                                            <tr>
                                                <td class="label-name p-2">Phone</td>
                                                <td class="seprator p-2"><span>:</span></td>
                                                <td class="p-2">1234567890</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex align-items-center justify-content-between my-5 gap-2 flex-wrap">
                                    <h4 class="mb-0">Shipping Address</h4>
                                    <div class="iq-button">
                                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/shop/my-account.html#"
                                            class="btn text-uppercase position-relative" data-bs-toggle="collapse"
                                            data-bs-target="#edit-address-2" aria-expanded="false">
                                            <span class="button-text">Edit</span>
                                            <i class="fa-solid fa-play"></i>
                                        </a>
                                    </div>
                                </div>
                                <div id="edit-address-2" class="collapse">
                                    <div class="text-body mb-4">
                                        <form>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">First name&nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="first-name" value="John"
                                                    class="form-control" required="required">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">Last name&nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="last-name" value="deo"
                                                    class="form-control" required="required">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">Company name (optional)</label>
                                                <input type="text" name="last-name" value="Iqonic Design"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">Country / Region &nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <div class="mb-5">
                                                    <select
                                                        class="select2-basic-single js-states select2-hidden-accessible"
                                                        aria-label="select country" required="required"
                                                        data-select2-id="select2-data-7-c4fi" tabindex="-1"
                                                        aria-hidden="true">
                                                        <option value="" selected=""
                                                            data-select2-id="select2-data-9-tvvc">Choose a country
                                                        </option>
                                                        <option value="1">India</option>
                                                        <option value="2">United Kingdom</option>
                                                        <option value="3">United States</option>
                                                        <option value="4">Australia</option>
                                                        <option value="5">North Corea</option>
                                                    </select><span
                                                        class="select2 select2-container select2-container--default wide"
                                                        dir="ltr" data-select2-id="select2-data-8-3uut"
                                                        style="width: 100%;"><span class="selection"><span
                                                                class="select2-selection select2-selection--single"
                                                                role="combobox" aria-haspopup="true"
                                                                aria-expanded="false" tabindex="0"
                                                                aria-disabled="false"
                                                                aria-labelledby="select2-u44g-container"
                                                                aria-controls="select2-u44g-container"><span
                                                                    class="select2-selection__rendered"
                                                                    id="select2-u44g-container" role="textbox"
                                                                    aria-readonly="true" title="Choose a country">Choose a
                                                                    country</span><span class="select2-selection__arrow"
                                                                    role="presentation"><b
                                                                        role="presentation"></b></span></span></span><span
                                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                </div>
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">Street address&nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="address"
                                                    placeholder="House number and street name" value="4517 Kentucky"
                                                    class="form-control mb-3 rounded-0" required="required">
                                                <input type="text" name="address"
                                                    placeholder="Apartment, suite, unit, etc. (optional)"
                                                    class="form-control mb-5 rounded-0">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">Town / City&nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="city" value="Navsari"
                                                    class="form-control" required="required">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">State&nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <div class="mb-5">
                                                    <select
                                                        class="select2-basic-single js-states select2-hidden-accessible"
                                                        aria-label="select state" data-select2-id="select2-data-10-qxvo"
                                                        tabindex="-1" aria-hidden="true">
                                                        <option value="" selected=""
                                                            data-select2-id="select2-data-12-xaqo">Choose a State
                                                        </option>
                                                        <option value="1">Gujarat</option>
                                                        <option value="2">Delhi</option>
                                                        <option value="3">Goa</option>
                                                        <option value="4">Haryana</option>
                                                        <option value="5">Ladakh</option>
                                                    </select><span
                                                        class="select2 select2-container select2-container--default wide"
                                                        dir="ltr" data-select2-id="select2-data-11-29a1"
                                                        style="width: 100%;"><span class="selection"><span
                                                                class="select2-selection select2-selection--single"
                                                                role="combobox" aria-haspopup="true"
                                                                aria-expanded="false" tabindex="0"
                                                                aria-disabled="false"
                                                                aria-labelledby="select2-tfpo-container"
                                                                aria-controls="select2-tfpo-container"><span
                                                                    class="select2-selection__rendered"
                                                                    id="select2-tfpo-container" role="textbox"
                                                                    aria-readonly="true" title="Choose a State">Choose a
                                                                    State</span><span class="select2-selection__arrow"
                                                                    role="presentation"><b
                                                                        role="presentation"></b></span></span></span><span
                                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                </div>
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">PIN code&nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="pin code" value="396321"
                                                    class="form-control" required="required">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">Phone&nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <input type="tel" name="number" value="1234567890"
                                                    class="form-control" required="required">
                                            </div>
                                            <div class="form-group mb-5">
                                                <label class="mb-2">Email address&nbsp; <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" name="email" value="johndeo@gmail.com"
                                                    class="form-control" required="required">
                                            </div>
                                            <div class="form-group">
                                                <div class="iq-button">
                                                    <a href="https://templates.iqonic.design/streamit-dist/frontend/html/shop/my-account.html"
                                                        class="btn text-uppercase position-relative">
                                                        <span class="button-text">Save Address</span>
                                                        <i class="fa-solid fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="edit-address w-100">
                                        <tbody>
                                            <tr>
                                                <td class="label-name p-2">Name</td>
                                                <td class="seprator p-2"><span>:</span></td>
                                                <td class="p-2">john deo</td>
                                            </tr>
                                            <tr>
                                                <td class="label-name p-2">Company</td>
                                                <td class="seprator p-2"><span>:</span></td>
                                                <td class="p-2">Iqonic Design</td>
                                            </tr>
                                            <tr>
                                                <td class="label-name p-2">Country</td>
                                                <td class="seprator p-2"><span>:</span></td>
                                                <td class="p-2">India</td>
                                            </tr>
                                            <tr>
                                                <td class="label-name p-2">Address</td>
                                                <td class="seprator p-2"><span>:</span></td>
                                                <td class="p-2">4517 Washington Ave, Manchester.</td>
                                            </tr>
                                            <tr>
                                                <td class="label-name p-2">E-mail</td>
                                                <td class="seprator p-2"><span>:</span></td>
                                                <td class="p-2">johndeo@gmail.com</td>
                                            </tr>
                                            <tr>
                                                <td class="label-name p-2">Phone</td>
                                                <td class="seprator p-2"><span>:</span></td>
                                                <td class="p-2">1234567890</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-details" role="tabpanel">
                            <div class="p-4 text-body">
                                <form action="{{ route('user.update', $user->id) }}" method="POST"
                                    class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    <!-- Hidden field to indicate the request is from the frontend -->
                                    <input type="hidden" name="from_frontend" value="1">

                                    <div class="form-group mb-5">
                                        <label class="mb-2">Name&nbsp; <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ $user->name }}"
                                            class="form-control" required="required">
                                    </div>
                                    <em class="d-block mb-5">This will be how your name will be displayed in the account
                                        section and in reviews</em>

                                    <div class="form-group mb-5">
                                        <label class="mb-2">Email address&nbsp; <span
                                                class="text-danger">*</span></label>
                                        <input type="email" name="email" value="{{ $user->email }}"
                                            class="form-control" required="required">
                                    </div>
                                    <div id="profile-edit">
                                        <h2>Password Change</h2>
                                        <!-- Your profile edit form here -->
                                    </div>

                                    <div class="form-group mb-5">
                                        <label class="mb-2">Current password (leave blank to leave unchanged)</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>

                                    <div class="form-group mb-5">
                                        <label class="mb-2">New password (leave blank to leave unchanged)</label>
                                        <input type="password" name="new_password" class="form-control">
                                    </div>

                                    <div class="form-group mb-5">
                                        <label class="mb-2">Confirm new password</label>
                                        <input type="password" name="new_password_confirmation" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <div class="iq-button">
                                            <button type="submit" class="btn text-uppercase position-relative">
                                                <span class="button-text">Save Changes</span>
                                                <i class="fa-solid fa-play"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade" id="logout" role="tabpanel">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



