@extends('frontend.layouts.app')

@section('content')

<main class="container-md">
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-10">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-3">
                    <li class="breadcrumb-item"><a href="https://ww4.fmovies.co/24/">Home</a></li>
                    <li class="breadcrumb-item"><a href="https://ww4.fmovies.co/movies/">Movies</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="https://ww4.fmovies.co/film/captain-america-brave-new-world-1630858461/"
                            class="text-light">Captain America: Brave
                            New World</a></li>
                </ol>
            </nav>
            <div class="card bg-dark mb-3 mov-info">
                <div class="card-header row g-0 p-0">
                    <div class="col-12" id="mid" data-mid="1630858461" data-mode="movie"><a id="play-now"
                            role="button" class="d-block cover" data-bs-toggle="collapse"
                            href="https://ww4.fmovies.co/film/captain-america-brave-new-world-1630858461/#play-btn">
                            <picture>
                                <source media="(min-width: 1200px)"
                                    data-srcset="https://img.cdno.my.id/cover/w_1200/h_500/captain-america-brave-new-world-1630858461.jpg"
                                    srcset="https://img.cdno.my.id/cover/w_1200/h_500/captain-america-brave-new-world-1630858461.jpg">
                                <source media="(min-width: 992px)"
                                    data-srcset="https://img.cdno.my.id/cover/w_936/h_390/captain-america-brave-new-world-1630858461.jpg"
                                    srcset="https://img.cdno.my.id/cover/w_936/h_390/captain-america-brave-new-world-1630858461.jpg">
                                <source media="(min-width: 768px)"
                                    data-srcset="https://img.cdno.my.id/cover/w_696/h_290/captain-america-brave-new-world-1630858461.jpg"
                                    srcset="https://img.cdno.my.id/cover/w_696/h_290/captain-america-brave-new-world-1630858461.jpg">
                                <source media="(min-width: 576px)"
                                    data-srcset="https://img.cdno.my.id/cover/w_643/h_268/captain-america-brave-new-world-1630858461.jpg"
                                    srcset="https://img.cdno.my.id/cover/w_643/h_268/captain-america-brave-new-world-1630858461.jpg">
                                <source media="(max-width: 575px)"
                                    data-srcset="https://img.cdno.my.id/cover/w_351/h_146/captain-america-brave-new-world-1630858461.jpg 1x,https://img.cdno.my.id/cover/w_672/h_280/captain-america-brave-new-world-1630858461.jpg 2x,"
                                    srcset="https://img.cdno.my.id/cover/w_351/h_146/captain-america-brave-new-world-1630858461.jpg 1x,https://img.cdno.my.id/cover/w_672/h_280/captain-america-brave-new-world-1630858461.jpg 2x,">
                                <img id="cover-img" alt="Watch Captain America: Brave New World"
                                    class="lazy card-img-top img-fluid entered loaded"
                                    src="{{ asset('frontend/assets') }}/image/captain-america-brave-new-world-1630858461.jpg"
                                    data-src="https://img.cdno.my.id/cover/w_1200/h_500/captain-america-brave-new-world-1630858461.jpg"
                                    width="1200" height="500" data-ll-status="loaded">
                            </picture>
                        </a></div>
                    <div class="col-12 collapse" id="play-btn">
                        <div class="card border-0 rounded-0 bg-footer2">
                            <div class="card-body">
                                <div class="row">
                                    <div id="srv-list" class="d-grid gap-2 col-4 col-md-2 mx-auto"><button
                                            id="srv-1" class="btn btn-dark server" type="button">Server
                                            1</button>
                                        <button id="srv-2" class="btn btn-dark server" type="button">Server
                                            2</button>
                                        <button id="srv-5" class="btn btn-dark server" type="button">Server
                                            3</button>
                                    </div>
                                    <div class="col-8 col-md-10 ps-0">
                                        <div class="card border-0 rounded-0 bg-transparent">
                                            <div id="eps-list" class="card-body p-0"><button id="ep-1" type="button"
                                                    class="btn btn-dark m-1 ms-0 episode" data-bs-toggle="tooltip"
                                                    title="Episode 1">
                                                    Episode
                                                    1</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-2 d-none d-lg-block"><img
                                src="{{ asset('frontend/assets') }}/image/captain-america-brave-new-world-1630858461(1).jpg"
                                data-src="https://img.cdno.my.id/thumb/w_200/h_300/captain-america-brave-new-world-1630858461.jpg"
                                width="200" height="300" class="lazy img-fluid rounded entered loaded"
                                alt="Captain America: Brave New World" data-ll-status="loaded">
                            <div class="d-grid gap-2 mt-2"><button class="btn btn-primary"
                                    type="button">Trailer</button></div>
                        </div>
                        <div class="col-12 col-lg-7 border-sm-end">
                            <h1 class="card-title fs-4">Captain America:
                                Brave New World</h1>
                            <div class="fst-italic lh-sm">
                                <p>After meeting with newly elected U.S.
                                    President Thaddeus Ross, Sam finds
                                    himself
                                    in the middle of an international
                                    incident. He must discover the
                                    reason behind a
                                    nefarious global plot before the
                                    true mastermind has the entire world
                                    seeing
                                    red.</p>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <p class="mb-1"><strong>Genre:
                                        </strong><a href="https://ww4.fmovies.co/genre/action/">Action</a>,
                                        <a href="https://ww4.fmovies.co/genre/thriller/">Thriller</a>,
                                        <a href="https://ww4.fmovies.co/genre/science-fiction/">Science
                                            Fiction</a>
                                    </p>
                                    <p class="mb-1"><strong>Actor:
                                        </strong><a href="https://ww4.fmovies.co/actor/anthony-mackie/">Anthony
                                            Mackie</a>,
                                        <a href="https://ww4.fmovies.co/actor/harrison-ford/">Harrison
                                            Ford</a>, <a href="https://ww4.fmovies.co/actor/danny-ramirez/">Danny
                                            Ramirez</a>, <a href="https://ww4.fmovies.co/actor/shira-haas/">Shira
                                            Haas</a>, <a href="https://ww4.fmovies.co/actor/tim-blake-nelson/">Tim
                                            Blake
                                            Nelson</a>, <a href="https://ww4.fmovies.co/actor/carl-lumbly/">Carl
                                            Lumbly</a>, <a
                                            href="https://ww4.fmovies.co/actor/giancarlo-esposito/">Giancarlo
                                            Esposito</a>, <a href="https://ww4.fmovies.co/actor/liv-tyler/">Liv
                                            Tyler</a>, <a href="https://ww4.fmovies.co/actor/xosha-roquemore/">Xosha
                                            Roquemore</a>, <a
                                            href="https://ww4.fmovies.co/actor/johannes-haukur-johannesson/">Johannes
                                            Haukur Johannesson</a>, <a
                                            href="https://ww4.fmovies.co/actor/william-mark-mccullough/">William
                                            Mark McCullough</a>, <a
                                            href="https://ww4.fmovies.co/actor/takehiro-hira/">Takehiro
                                            Hira</a>, <a href="https://ww4.fmovies.co/actor/harsh-nayyar/">Harsh
                                            Nayyar</a>, <a href="https://ww4.fmovies.co/actor/rick-espaillat/">Rick
                                            Espaillat</a>,
                                        <a href="https://ww4.fmovies.co/actor/todd-allen-durkin/">Todd
                                            Allen
                                            Durkin</a>, <a href="https://ww4.fmovies.co/actor/dustin-lewis/">Dustin
                                            Lewis</a>, <a
                                            href="https://ww4.fmovies.co/actor/rachael-markarian/">Rachael
                                            Markarian</a>, <a
                                            href="https://ww4.fmovies.co/actor/phuong-kubacki/">Phuong
                                            Kubacki</a>,
                                        <a href="https://ww4.fmovies.co/actor/alan-boell/">Alan
                                            Boell</a>, <a href="https://ww4.fmovies.co/actor/ava-hill/">Ava
                                            Hill</a>, <a
                                            href="https://ww4.fmovies.co/actor/marissa-chanel-hampton/">Marissa
                                            Chanel Hampton</a>, <a
                                            href="https://ww4.fmovies.co/actor/katerina-eichenberger/">Katerina
                                            Eichenberger</a>, <a
                                            href="https://ww4.fmovies.co/actor/mark-pettit/">Mark
                                            Pettit</a>, <a
                                            href="https://ww4.fmovies.co/actor/john-mark-bowman/">John
                                            Mark
                                            Bowman</a>, <a href="https://ww4.fmovies.co/actor/katina-rankin/">Katina
                                            Rankin</a>, <a href="https://ww4.fmovies.co/actor/john-cihangir/">John
                                            Cihangir</a>, <a href="https://ww4.fmovies.co/actor/eric-mbanda/">Eric
                                            Mbanda</a>, <a href="https://ww4.fmovies.co/actor/koji-nishiyama/">Koji
                                            Nishiyama</a>, <a
                                            href="https://ww4.fmovies.co/actor/david-atkinson/">David
                                            Atkinson</a>,
                                        <a href="https://ww4.fmovies.co/actor/john-dixon/">John
                                            Dixon</a>, <a href="https://ww4.fmovies.co/actor/josh-robin/">Josh
                                            Robin</a>, <a
                                            href="https://ww4.fmovies.co/actor/sharon-tazewell/">Sharon
                                            Tazewell</a>, <a href="https://ww4.fmovies.co/actor/pete-burris/">Pete
                                            Burris</a>, <a
                                            href="https://ww4.fmovies.co/actor/diesel-madkins/">Diesel
                                            Madkins</a>,
                                        <a href="https://ww4.fmovies.co/actor/matthew-cornwell/">Matthew
                                            Cornwell</a>, <a
                                            href="https://ww4.fmovies.co/actor/sandra-aparicio/">Sandra
                                            Aparicio</a>, <a
                                            href="https://ww4.fmovies.co/actor/ricky-robles-cruz/">Ricky
                                            Robles
                                            Cruz</a>, <a href="https://ww4.fmovies.co/actor/erika-keck/">Erika
                                            Keck</a>, <a href="https://ww4.fmovies.co/actor/hector-banos/">Hector
                                            Banos</a>, <a href="https://ww4.fmovies.co/actor/bill-stinchcomb/">Bill
                                            Stinchcomb</a>, <a
                                            href="https://ww4.fmovies.co/actor/gabriela-amarchand/">Gabriela
                                            Amarchand</a>, <a
                                            href="https://ww4.fmovies.co/actor/ariana-lugo/">Ariana
                                            Lugo</a>, <a href="https://ww4.fmovies.co/actor/ben-vazquez/">Ben
                                            Vazquez</a>, <a href="https://ww4.fmovies.co/actor/cris-ruiz/">Cris
                                            Ruiz</a>, <a
                                            href="https://ww4.fmovies.co/actor/jacqueline-loucks/">Jacqueline
                                            Loucks</a>, <a
                                            href="https://ww4.fmovies.co/actor/jarrett-michael-collins/">Jarrett
                                            Michael Collins</a>, <a
                                            href="https://ww4.fmovies.co/actor/yaz-takahashi/">Yaz
                                            Takahashi</a>, <a
                                            href="https://ww4.fmovies.co/actor/tomoko-karina/">Tomoko
                                            Karina</a>, <a
                                            href="https://ww4.fmovies.co/actor/robert-tretsch/">Robert
                                            Tretsch</a>,
                                        <a href="https://ww4.fmovies.co/actor/travis-powers/">Travis
                                            Powers</a>, <a href="https://ww4.fmovies.co/actor/will-holland/">Will
                                            Holland</a>, <a
                                            href="https://ww4.fmovies.co/actor/chealon-miller/">Chealon
                                            Miller</a>,
                                        <a href="https://ww4.fmovies.co/actor/trevor-feinstein/">Trevor
                                            Feinstein</a>, <a
                                            href="https://ww4.fmovies.co/actor/sebastian-stan/">Sebastian
                                            Stan</a>
                                    </p>
                                    <p class="mb-1"><strong>Director:
                                        </strong>Julius Onah</p>
                                    <p class="mb-1"><strong>Country:
                                        </strong><a href="https://ww4.fmovies.co/country/united-states/">United
                                            States</a>
                                    </p>
                                </div>
                                <div class="col-md-5">
                                    <p class="mb-1"><strong>Duration:</strong>
                                        119 min</p>
                                    <p class="mb-1"><strong>Quality:</strong>
                                        <span class="badge bg-warning text-dark">CAM</span>
                                    </p>
                                    <p class="mb-1"><strong>Release:</strong>
                                        <a href="https://ww4.fmovies.co/release/2025/">2025</a>
                                    </p>
                                    <p class="mb-1"><strong>IMDb:</strong>
                                        -</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="d-grid gap-2"><button class="btn btn-primary" type="button">Stream in
                                    HD</button>
                                <button class="btn btn-primary" type="button">Download in
                                    HD</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-0 bg-footer1"><strong class="me-1">Keywords:</strong>-</div>
            </div>
            <div class="badge bg-primary fs-5 my-3 text-dark">Related
                Movies</div>
            <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-4 mb-4">
                <div class="col">
                    <div class="card bg-transparent border-0"><a
                            href="https://ww4.fmovies.co/film/the-incredible-hulk-3342/"
                            class="position-relative overflow-hidden rounded poster"><img
                                src="{{ asset('frontend/assets') }}/image/the-incredible-hulk-3342.jpg"
                                data-src="https://img.cdno.my.id/thumb/w_200/h_300/the-incredible-hulk-3342.jpg"
                                class="lazy card-img img-fluid entered loaded" width="200" height="300"
                                alt="The Incredible Hulk" data-ll-status="loaded">
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">The
                                    Incredible Hulk</h2>
                            </div><span class="badge bg-warning position-absolute top-3 end-3 text-dark">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0"><a
                            href="https://ww4.fmovies.co/film/the-bricklayer-1630856359/"
                            class="position-relative overflow-hidden rounded poster"><img
                                src="{{ asset('frontend/assets') }}/image/the-bricklayer-1630856359.jpg"
                                data-src="https://img.cdno.my.id/thumb/w_200/h_300/the-bricklayer-1630856359.jpg"
                                class="lazy card-img img-fluid entered loaded" width="200" height="300"
                                alt="The Bricklayer" data-ll-status="loaded">
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">The
                                    Bricklayer</h2>
                            </div><span class="badge bg-warning position-absolute top-3 end-3 text-dark">CAM</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0"><a
                            href="https://ww4.fmovies.co/film/the-355-1630852517/"
                            class="position-relative overflow-hidden rounded poster"><img
                                src="{{ asset('frontend/assets') }}/image/the-355-1630852517.jpg"
                                data-src="https://img.cdno.my.id/thumb/w_200/h_300/the-355-1630852517.jpg"
                                class="lazy card-img img-fluid entered loaded" width="200" height="300"
                                alt="The 355" data-ll-status="loaded">
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">The
                                    355</h2>
                            </div><span class="badge bg-warning position-absolute top-3 end-3 text-dark">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0"><a
                            href="https://ww4.fmovies.co/film/point-blank-28983/"
                            class="position-relative overflow-hidden rounded poster"><img
                                src="{{ asset('frontend/assets') }}/image/point-blank-28983.jpg"
                                data-src="https://img.cdno.my.id/thumb/w_200/h_300/point-blank-28983.jpg"
                                class="lazy card-img img-fluid entered loaded" width="200" height="300"
                                alt="Point Blank" data-ll-status="loaded">
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Point
                                    Blank</h2>
                            </div><span class="badge bg-warning position-absolute top-3 end-3 text-dark">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0"><a
                            href="https://ww4.fmovies.co/film/patriot-games-8191/"
                            class="position-relative overflow-hidden rounded poster"><img
                                src="{{ asset('frontend/assets') }}/image/patriot-games-8191.jpg"
                                data-src="https://img.cdno.my.id/thumb/w_200/h_300/patriot-games-8191.jpg"
                                class="lazy card-img img-fluid entered loaded" width="200" height="300"
                                alt="Patriot Games" data-ll-status="loaded">
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Patriot
                                    Games</h2>
                            </div><span class="badge bg-warning position-absolute top-3 end-3 text-dark">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0"><a
                            href="https://ww4.fmovies.co/film/cowboys-and-aliens-6649/"
                            class="position-relative overflow-hidden rounded poster"><img
                                src="{{ asset('frontend/assets') }}/image/cowboys-and-aliens-6649.jpg"
                                data-src="https://img.cdno.my.id/thumb/w_200/h_300/cowboys-and-aliens-6649.jpg"
                                class="lazy card-img img-fluid entered loaded" width="200" height="300"
                                alt="Cowboys and Aliens" data-ll-status="loaded">
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Cowboys
                                    and Aliens</h2>
                            </div><span class="badge bg-warning position-absolute top-3 end-3 text-dark">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0"><a href="https://ww4.fmovies.co/film/eagle-eye-4968/"
                            class="position-relative overflow-hidden rounded poster"><img
                                src="{{ asset('frontend/assets') }}/image/eagle-eye-4968.jpg"
                                data-src="https://img.cdno.my.id/thumb/w_200/h_300/eagle-eye-4968.jpg"
                                class="lazy card-img img-fluid entered loaded" width="200" height="300"
                                alt="Eagle Eye" data-ll-status="loaded">
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Eagle
                                    Eye</h2>
                            </div><span class="badge bg-warning position-absolute top-3 end-3 text-dark">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0"><a
                            href="https://ww4.fmovies.co/film/captain-america-the-first-avenger-3352/"
                            class="position-relative overflow-hidden rounded poster"><img
                                src="{{ asset('frontend/assets') }}/image/captain-america-the-first-avenger-3352.jpg"
                                data-src="https://img.cdno.my.id/thumb/w_200/h_300/captain-america-the-first-avenger-3352.jpg"
                                class="lazy card-img img-fluid entered loaded" width="200" height="300"
                                alt="Captain America: The First Avenger" data-ll-status="loaded">
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Captain
                                    America: The First Avenger</h2>
                            </div><span class="badge bg-warning position-absolute top-3 end-3 text-dark">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0"><a
                            href="https://ww4.fmovies.co/film/a-different-man-1630857668/"
                            class="position-relative overflow-hidden rounded poster"><img
                                src="{{ asset('frontend/assets') }}/image/a-different-man-1630857668.jpg"
                                data-src="https://img.cdno.my.id/thumb/w_200/h_300/a-different-man-1630857668.jpg"
                                class="lazy card-img img-fluid entered loaded" width="200" height="300"
                                alt="A Different Man" data-ll-status="loaded">
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">A
                                    Different Man</h2>
                            </div><span class="badge bg-warning position-absolute top-3 end-3 text-dark">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0"><a
                            href="https://ww4.fmovies.co/film/twisted-metal-season-1-1630855689/"
                            class="position-relative overflow-hidden rounded poster"><img
                                src="{{ asset('frontend/assets') }}/image/twisted-metal-season-1-1630855689.jpg"
                                data-src="https://img.cdno.my.id/thumb/w_200/h_300/twisted-metal-season-1-1630855689.jpg"
                                class="lazy card-img img-fluid entered loaded" width="200" height="300"
                                alt="Twisted Metal - Season 1" data-ll-status="loaded">
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Twisted
                                    Metal - Season 1</h2>
                            </div><span class="mlbe text-dark">Eps<i>10</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0"><a
                            href="https://ww4.fmovies.co/film/indiana-jones-and-the-dial-of-destiny-1630855396/"
                            class="position-relative overflow-hidden rounded poster"><img
                                src="{{ asset('frontend/assets') }}/image/indiana-jones-and-the-dial-of-destiny-1630855396.jpg"
                                data-src="https://img.cdno.my.id/thumb/w_200/h_300/indiana-jones-and-the-dial-of-destiny-1630855396.jpg"
                                class="lazy card-img img-fluid entered loaded" width="200" height="300"
                                alt="Indiana Jones and the Dial of Destiny" data-ll-status="loaded">
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Indiana
                                    Jones and the Dial of Destiny
                                </h2>
                            </div><span class="badge bg-warning position-absolute top-3 end-3 text-dark">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0"><a
                            href="https://ww4.fmovies.co/film/cabin-girl-1630855453/"
                            class="position-relative overflow-hidden rounded poster"><img
                                src="{{ asset('frontend/assets') }}/image/cabin-girl-1630855453.jpg"
                                data-src="https://img.cdno.my.id/thumb/w_200/h_300/cabin-girl-1630855453.jpg"
                                class="lazy card-img img-fluid entered loaded" width="200" height="300"
                                alt="Cabin Girl" data-ll-status="loaded">
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Cabin
                                    Girl</h2>
                            </div><span class="badge bg-warning position-absolute top-3 end-3 text-dark">HD</span>
                        </a></div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection