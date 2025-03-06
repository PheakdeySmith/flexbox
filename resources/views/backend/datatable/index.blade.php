@extends('backend.layouts.app')
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ps ps--active-y">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky"
            id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none me-2 ">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">DataTables</li>
                    </ol>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search"
                                    aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Type here..."
                                onfocus="focused(this)" onfocusout="defocused(this)" data-sharkid="__0"
                                data-sharklabel="dobDay">
                        </div>
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/authentication/signin/illustration.html"
                                class="nav-link text-body font-weight-bold px-0" target="_blank">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Sign In</span>
                            </a>
                        </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButton">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="{{ asset('backend/assets') }}/image/team-2.jpg"
                                                    class="avatar avatar-sm  me-3 " alt="user image">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New message</span> from Laur
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    13 minutes ago
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="{{ asset('backend/assets') }}/image/logo-spotify.svg"
                                                    class="avatar avatar-sm bg-gradient-dark  me-3 "
                                                    alt="logo spotify">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New album</span> by Travis Scott
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    1 day
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                                <svg width="12px" height="12px" viewBox="0 0 43 36"
                                                    version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <title>credit-card</title>
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <g transform="translate(-2169.000000, -745.000000)"
                                                            fill="#FFFFFF" fill-rule="nonzero">
                                                            <g transform="translate(1716.000000, 291.000000)">
                                                                <g transform="translate(453.000000, 454.000000)">
                                                                    <path class="color-background"
                                                                        d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                        opacity="0.593633743"></path>
                                                                    <path class="color-background"
                                                                        d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    Payment successfully completed
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    2 days
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h5 class="mb-0">Datatable Simple</h5>
                            <p class="text-sm mb-0">
                                A lightweight, extendable, dependency-free javascript HTML table plugin.
                            </p>
                        </div>
                        <div class="table-responsive">
                            <div
                                class="dataTable-wrapper dataTable-loading no-footer sortable fixed-height fixed-columns">
                                <div class="dataTable-top">
                                    <div class="dataTable-dropdown"><label><select class="dataTable-selector"
                                                data-sharkid="__1">
                                                <option value="5">5</option>
                                                <option value="10" selected="">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="25">25</option>
                                            </select> entries per page</label></div>
                                </div>
                                <div class="dataTable-container" style="height: 498.638px;">
                                    <table class="table table-flush dataTable-table" id="datatable-basic">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                    data-sortable="" style="width: 19.3785%;"><a
                                                        href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                        class="dataTable-sorter">Name</a></th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                    data-sortable="" style="width: 27.6478%;"><a
                                                        href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                        class="dataTable-sorter">Position</a></th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                    data-sortable="" style="width: 16.7056%;"><a
                                                        href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                        class="dataTable-sorter">Office</a></th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                    data-sortable="" style="width: 8.18577%;"><a
                                                        href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                        class="dataTable-sorter">Age</a></th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                    data-sortable="" style="width: 14.701%;"><a
                                                        href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                        class="dataTable-sorter">Start date</a></th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                    data-sortable="" style="width: 13.3645%;"><a
                                                        href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                        class="dataTable-sorter">Salary</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Tiger Nixon</td>
                                                <td class="text-sm font-weight-normal">System Architect</td>
                                                <td class="text-sm font-weight-normal">Edinburgh</td>
                                                <td class="text-sm font-weight-normal">61</td>
                                                <td class="text-sm font-weight-normal">2011/04/25</td>
                                                <td class="text-sm font-weight-normal">$320,800</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Garrett Winters</td>
                                                <td class="text-sm font-weight-normal">Accountant</td>
                                                <td class="text-sm font-weight-normal">Tokyo</td>
                                                <td class="text-sm font-weight-normal">63</td>
                                                <td class="text-sm font-weight-normal">2011/07/25</td>
                                                <td class="text-sm font-weight-normal">$170,750</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Ashton Cox</td>
                                                <td class="text-sm font-weight-normal">Junior Technical Author</td>
                                                <td class="text-sm font-weight-normal">San Francisco</td>
                                                <td class="text-sm font-weight-normal">66</td>
                                                <td class="text-sm font-weight-normal">2009/01/12</td>
                                                <td class="text-sm font-weight-normal">$86,000</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Cedric Kelly</td>
                                                <td class="text-sm font-weight-normal">Senior Javascript Developer
                                                </td>
                                                <td class="text-sm font-weight-normal">Edinburgh</td>
                                                <td class="text-sm font-weight-normal">22</td>
                                                <td class="text-sm font-weight-normal">2012/03/29</td>
                                                <td class="text-sm font-weight-normal">$433,060</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Airi Satou</td>
                                                <td class="text-sm font-weight-normal">Accountant</td>
                                                <td class="text-sm font-weight-normal">Tokyo</td>
                                                <td class="text-sm font-weight-normal">33</td>
                                                <td class="text-sm font-weight-normal">2008/11/28</td>
                                                <td class="text-sm font-weight-normal">$162,700</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Brielle Williamson</td>
                                                <td class="text-sm font-weight-normal">Integration Specialist</td>
                                                <td class="text-sm font-weight-normal">New York</td>
                                                <td class="text-sm font-weight-normal">61</td>
                                                <td class="text-sm font-weight-normal">2012/12/02</td>
                                                <td class="text-sm font-weight-normal">$372,000</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Herrod Chandler</td>
                                                <td class="text-sm font-weight-normal">Sales Assistant</td>
                                                <td class="text-sm font-weight-normal">San Francisco</td>
                                                <td class="text-sm font-weight-normal">59</td>
                                                <td class="text-sm font-weight-normal">2012/08/06</td>
                                                <td class="text-sm font-weight-normal">$137,500</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Rhona Davidson</td>
                                                <td class="text-sm font-weight-normal">Integration Specialist</td>
                                                <td class="text-sm font-weight-normal">Tokyo</td>
                                                <td class="text-sm font-weight-normal">55</td>
                                                <td class="text-sm font-weight-normal">2010/10/14</td>
                                                <td class="text-sm font-weight-normal">$327,900</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Colleen Hurst</td>
                                                <td class="text-sm font-weight-normal">Javascript Developer</td>
                                                <td class="text-sm font-weight-normal">San Francisco</td>
                                                <td class="text-sm font-weight-normal">39</td>
                                                <td class="text-sm font-weight-normal">2009/09/15</td>
                                                <td class="text-sm font-weight-normal">$205,500</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Sonya Frost</td>
                                                <td class="text-sm font-weight-normal">Software Engineer</td>
                                                <td class="text-sm font-weight-normal">Edinburgh</td>
                                                <td class="text-sm font-weight-normal">23</td>
                                                <td class="text-sm font-weight-normal">2008/12/13</td>
                                                <td class="text-sm font-weight-normal">$103,600</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="dataTable-bottom">
                                    <div class="dataTable-info">Showing 1 to 10 of 57 entries</div>
                                    <nav class="dataTable-pagination">
                                        <ul class="dataTable-pagination-list">
                                            <li class="pager"><a
                                                    href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                    data-page="1">‹</a></li>
                                            <li class="active"><a
                                                    href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                    data-page="1">1</a></li>
                                            <li class=""><a
                                                    href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                    data-page="2">2</a></li>
                                            <li class=""><a
                                                    href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                    data-page="3">3</a></li>
                                            <li class=""><a
                                                    href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                    data-page="4">4</a></li>
                                            <li class=""><a
                                                    href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                    data-page="5">5</a></li>
                                            <li class=""><a
                                                    href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                    data-page="6">6</a></li>
                                            <li class="pager"><a
                                                    href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                    data-page="2">›</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h5 class="mb-0">Datatable Search</h5>
                            <p class="text-sm mb-0">
                                A lightweight, extendable, dependency-free javascript HTML table plugin.
                            </p>
                        </div>
                        <div class="table-responsive">
                            <div
                                class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-height fixed-columns">
                                <div class="dataTable-top">
                                    <div class="dataTable-dropdown"><label><select class="dataTable-selector"
                                                data-sharkid="__2">
                                                <option value="5">5</option>
                                                <option value="10" selected="">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="25">25</option>
                                            </select> entries per page</label></div>
                                    <div class="dataTable-search"><input class="dataTable-input"
                                            placeholder="Search..." type="text" data-sharkid="__3"></div>
                                </div>
                                <div class="dataTable-container" style="height: 498.638px;">
                                    <table class="table table-flush dataTable-table" id="datatable-search">
                                        <thead class="thead-light">
                                            <tr>
                                                <th data-sortable="" style="width: 19.3785%;"><a
                                                        href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                        class="dataTable-sorter">Name</a></th>
                                                <th data-sortable="" style="width: 27.6478%;"><a
                                                        href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                        class="dataTable-sorter">Position</a></th>
                                                <th data-sortable="" style="width: 16.7056%;"><a
                                                        href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                        class="dataTable-sorter">Office</a></th>
                                                <th data-sortable="" style="width: 8.18577%;"><a
                                                        href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                        class="dataTable-sorter">Age</a></th>
                                                <th data-sortable="" style="width: 14.701%;"><a
                                                        href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                        class="dataTable-sorter">Start date</a></th>
                                                <th data-sortable="" style="width: 13.3645%;"><a
                                                        href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                        class="dataTable-sorter">Salary</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Tiger Nixon</td>
                                                <td class="text-sm font-weight-normal">System Architect</td>
                                                <td class="text-sm font-weight-normal">Edinburgh</td>
                                                <td class="text-sm font-weight-normal">61</td>
                                                <td class="text-sm font-weight-normal">2011/04/25</td>
                                                <td class="text-sm font-weight-normal">$320,800</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Garrett Winters</td>
                                                <td class="text-sm font-weight-normal">Accountant</td>
                                                <td class="text-sm font-weight-normal">Tokyo</td>
                                                <td class="text-sm font-weight-normal">63</td>
                                                <td class="text-sm font-weight-normal">2011/07/25</td>
                                                <td class="text-sm font-weight-normal">$170,750</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Ashton Cox</td>
                                                <td class="text-sm font-weight-normal">Junior Technical Author</td>
                                                <td class="text-sm font-weight-normal">San Francisco</td>
                                                <td class="text-sm font-weight-normal">66</td>
                                                <td class="text-sm font-weight-normal">2009/01/12</td>
                                                <td class="text-sm font-weight-normal">$86,000</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Cedric Kelly</td>
                                                <td class="text-sm font-weight-normal">Senior Javascript Developer
                                                </td>
                                                <td class="text-sm font-weight-normal">Edinburgh</td>
                                                <td class="text-sm font-weight-normal">22</td>
                                                <td class="text-sm font-weight-normal">2012/03/29</td>
                                                <td class="text-sm font-weight-normal">$433,060</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Airi Satou</td>
                                                <td class="text-sm font-weight-normal">Accountant</td>
                                                <td class="text-sm font-weight-normal">Tokyo</td>
                                                <td class="text-sm font-weight-normal">33</td>
                                                <td class="text-sm font-weight-normal">2008/11/28</td>
                                                <td class="text-sm font-weight-normal">$162,700</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Brielle Williamson</td>
                                                <td class="text-sm font-weight-normal">Integration Specialist</td>
                                                <td class="text-sm font-weight-normal">New York</td>
                                                <td class="text-sm font-weight-normal">61</td>
                                                <td class="text-sm font-weight-normal">2012/12/02</td>
                                                <td class="text-sm font-weight-normal">$372,000</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Herrod Chandler</td>
                                                <td class="text-sm font-weight-normal">Sales Assistant</td>
                                                <td class="text-sm font-weight-normal">San Francisco</td>
                                                <td class="text-sm font-weight-normal">59</td>
                                                <td class="text-sm font-weight-normal">2012/08/06</td>
                                                <td class="text-sm font-weight-normal">$137,500</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Rhona Davidson</td>
                                                <td class="text-sm font-weight-normal">Integration Specialist</td>
                                                <td class="text-sm font-weight-normal">Tokyo</td>
                                                <td class="text-sm font-weight-normal">55</td>
                                                <td class="text-sm font-weight-normal">2010/10/14</td>
                                                <td class="text-sm font-weight-normal">$327,900</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Colleen Hurst</td>
                                                <td class="text-sm font-weight-normal">Javascript Developer</td>
                                                <td class="text-sm font-weight-normal">San Francisco</td>
                                                <td class="text-sm font-weight-normal">39</td>
                                                <td class="text-sm font-weight-normal">2009/09/15</td>
                                                <td class="text-sm font-weight-normal">$205,500</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm font-weight-normal">Sonya Frost</td>
                                                <td class="text-sm font-weight-normal">Software Engineer</td>
                                                <td class="text-sm font-weight-normal">Edinburgh</td>
                                                <td class="text-sm font-weight-normal">23</td>
                                                <td class="text-sm font-weight-normal">2008/12/13</td>
                                                <td class="text-sm font-weight-normal">$103,600</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="dataTable-bottom">
                                    <div class="dataTable-info">Showing 1 to 10 of 57 entries</div>
                                    <nav class="dataTable-pagination">
                                        <ul class="dataTable-pagination-list">
                                            <li class="pager"><a
                                                    href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                    data-page="1">‹</a></li>
                                            <li class="active"><a
                                                    href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                    data-page="1">1</a></li>
                                            <li class=""><a
                                                    href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                    data-page="2">2</a></li>
                                            <li class=""><a
                                                    href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                    data-page="3">3</a></li>
                                            <li class=""><a
                                                    href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                    data-page="4">4</a></li>
                                            <li class=""><a
                                                    href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                    data-page="5">5</a></li>
                                            <li class=""><a
                                                    href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                    data-page="6">6</a></li>
                                            <li class="pager"><a
                                                    href="https://demos.creative-tim.com/soft-ui-dashboard-pro/pages/applications/datatables.html#"
                                                    data-page="2">›</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                made with <i class="fa fa-heart"></i> by
                                <a href="https://www.creative-tim.com/" class="font-weight-bold"
                                    target="_blank">Creative Tim</a>
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
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 720px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 304px;"></div>
        </div>
    </main>

@endsection
