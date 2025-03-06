<header class="container-fluid bg-header shadow">
    <nav class="navbar navbar-expand-lg">
        <div class="container-xxxl"><a class="navbar-brand me-lg-5" href="{{ route('frontend.home') }}"><svg
                    width="140" height="40" viewBox="0 0 138 40">
                    <title>Fmovies</title>
                    <path fill="#00acc1" fill-rule="evenodd"
                        d="M5.309.0H132.69C135.625.0 138 2.387 138 5.332v29.336c0 2.945-2.375 5.332-5.309 5.332H5.31C2.375 40 0 37.613.0 34.668V5.332C0 2.387 2.375.0 5.309.0zm0 0">
                    </path>
                    <path fill="#fefefe"
                        d="M9.902 5.922h12.313v5.617H17.19v5.367h4.457v5.332H17.19v11.805H9.902zm36.516.0v28.121h-6.367l-.02-18.984L37.5 34.043h-4.457l-2.672-18.559-.016 18.559h-6.37V5.922h9.406c.265 1.7.554 3.703.867 5.988l1.031 7.14 1.66-13.128zM65.945 22.406c0 2.828-.066 4.824-.199 5.996a6.726 6.726.0 01-1.238 3.223c-.7.973-1.64 1.719-2.828 2.242-1.184.52-2.563.781-4.137.781-1.5.0-2.84-.25-4.031-.738-1.192-.492-2.153-1.23-2.871-2.21a6.705 6.705.0 01-1.297-3.216c-.137-1.16-.207-3.187-.207-6.078v-4.812c0-2.828.066-4.824.203-5.996a6.648 6.648.0 011.238-3.223c.695-.973 1.637-1.719 2.824-2.242 1.184-.52 2.563-.781 4.141-.781 1.496.0 2.836.25 4.027.742 1.192.488 2.153 1.226 2.871 2.207a6.705 6.705.0 011.297 3.215c.137 1.16.207 3.187.207 6.078zm-7.289-9.238c0-1.305-.07-2.14-.21-2.508-.145-.36-.434-.543-.868-.543-.371.0-.656.149-.855.442-.196.293-.297 1.164-.297 2.609v13.125c0 1.629.066 2.637.195 3.016.129.386.43.574.902.574.485.0.797-.219.934-.656.133-.438.2-1.489.2-3.141zM85.95 5.922l-3.688 28.121h-11.02L67.02 5.922h7.675c.868 7.754 1.5 14.316 1.895 19.68.39-5.422.789-10.235 1.2-14.438l.48-5.242zM94.496 5.922v28.121h-7.289V5.922zM97.402 5.922h12.137v5.617h-4.848v5.367h4.528v5.332h-4.528v6.188h5.344v5.617H97.402zm30.094 8.531h-6.758v-2.078c0-.973-.09-1.598-.258-1.863-.171-.266-.457-.395-.855-.395-.438.0-.77.176-.992.54-.223.355-.336.894-.336 1.62.0.938.129 1.645.383 2.118.246.468.933 1.043 2.058 1.718 3.227 1.938 5.262 3.532 6.098 4.77.844 1.238 1.262 3.234 1.262 5.984.0 2.004-.235 3.48-.7 4.434-.468.949-1.363 1.742-2.703 2.383-1.332.644-2.882.964-4.66.964-1.945.0-3.601-.37-4.98-1.113-1.375-.742-2.274-1.683-2.703-2.828-.426-1.148-.637-2.777-.637-4.883V23.98h6.758v3.422c0 1.055.093 1.73.285 2.032.187.3.523.449 1.008.449.484.0.843-.188 1.078-.574.238-.38.355-.946.355-1.696.0-1.652-.226-2.734-.672-3.238-.468-.512-1.601-1.363-3.402-2.563-1.805-1.203-2.996-2.078-3.586-2.625-.586-.542-1.074-1.296-1.457-2.257-.383-.961-.578-2.188-.578-3.68.0-2.152.27-3.727.82-4.723.547-.996 1.426-1.773 2.645-2.336 1.222-.562 2.691-.84 4.418-.84 1.886.0 3.492.31 4.824.919 1.328.617 2.207 1.386 2.637 2.324.43.93.648 2.511.648 4.746zm0 0">
                    </path>
                </svg>
            </a><button id="m-src" type="button" class="input-group-text btn btn-primary d-block d-sm-none">
                <svg width="16" height="16" fill="currentcolor" class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5.0 10-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 001.415-1.414l-3.85-3.85a1.007 1.007.0 00-.115-.1zM12 6.5a5.5 5.5.0 11-11 0 5.5 5.5.0 0111 0z">
                    </path>
                </svg>
            </button>
            <button id="nav-menu" class="navbar-toggler bg-primary lh-base" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation"><svg class="svg-inline" viewBox="0 0 512 512">
                    <path fill="currentcolor"
                        d="M16 288h416a16 16 0 0016-16v-32a16 16 0 00-16-16H16A16 16 0 000 240v32a16 16 0 0016 16z"
                        class="fa-secondary"></path>
                    <path fill="currentcolor"
                        d="M432 384H16A16 16 0 000 4e2v32a16 16 0 0016 16h416a16 16 0 0016-16v-32a16 16 0 00-16-16zm0-320H16A16 16 0 000 80v32a16 16 0 0016 16h416a16 16 0 0016-16V80a16 16 0 00-16-16z"
                        class="fa-primary"></path>
                </svg></button>
            <form class="form-inline" id="m-form"><input class="form-control" type="search" maxlength="100"
                    id="nav-search-m" name="search" placeholder="Search" aria-label="Search"></form>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle px-3"
                            href="{{ route('frontend.home') }}#" id="navGenre" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Genres</a>
                        <ul class="dropdown-menu text-capitalize p-2" aria-labelledby="navGenre">
                            <li><a href="https://ww4.fmovies.co/genre/action/" class="dropdown-item"
                                    title="Action">Action</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/adventure/" class="dropdown-item"
                                    title="Adventure">Adventure</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/animation/" class="dropdown-item"
                                    title="Animation">Animation</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/biography/" class="dropdown-item"
                                    title="Biography">Biography</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/comedy/" class="dropdown-item"
                                    title="Comedy">Comedy</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/comedy/" class="dropdown-item"
                                    title="Comedy ">Comedy</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/costume/" class="dropdown-item"
                                    title="Costume">Costume</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/crime/" class="dropdown-item"
                                    title="Crime">Crime</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/documentary/" class="dropdown-item"
                                    title="Documentary">Documentary</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/drama/" class="dropdown-item"
                                    title="Drama">Drama</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/family/" class="dropdown-item"
                                    title="Family">Family</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/fantasy/" class="dropdown-item"
                                    title="Fantasy">Fantasy</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/film-noir/" class="dropdown-item"
                                    title="Film-Noir">Film-Noir</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/game-show/" class="dropdown-item"
                                    title="Game-Show">Game-Show</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/history/" class="dropdown-item"
                                    title="History">History</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/horror/" class="dropdown-item"
                                    title="Horror">Horror</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/kungfu/" class="dropdown-item"
                                    title="Kungfu">Kungfu</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/music/" class="dropdown-item"
                                    title="Music">Music</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/musical/" class="dropdown-item"
                                    title="Musical">Musical</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/mystery/" class="dropdown-item"
                                    title="Mystery">Mystery</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/mythological/" class="dropdown-item"
                                    title="Mythological">Mythological</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/news/" class="dropdown-item"
                                    title="News">News</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/psychological/" class="dropdown-item"
                                    title="Psychological">Psychological</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/reality/" class="dropdown-item"
                                    title="Reality">Reality</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/reality-tv/" class="dropdown-item"
                                    title="Reality-TV">Reality-TV</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/romance/" class="dropdown-item"
                                    title="Romance">Romance</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/sci-fi/" class="dropdown-item"
                                    title="Sci-Fi">Sci-Fi</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/science-fiction/" class="dropdown-item"
                                    title="Science Fiction">Science
                                    Fiction</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/short/" class="dropdown-item"
                                    title="Short">Short</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/sitcom/" class="dropdown-item"
                                    title="Sitcom">Sitcom</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/sport/" class="dropdown-item"
                                    title="Sport">Sport</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/talk-show/" class="dropdown-item"
                                    title="Talk-Show">Talk-Show</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/thriller/" class="dropdown-item"
                                    title="Thriller">Thriller</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/tv-movie/" class="dropdown-item"
                                    title="TV Movie">TV
                                    Movie</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/tv-show/" class="dropdown-item"
                                    title="TV Show">TV
                                    Show</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/war/" class="dropdown-item"
                                    title="War">War</a></li>
                            <li><a href="https://ww4.fmovies.co/genre/western/" class="dropdown-item"
                                    title="Western">Western</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle px-3"
                            href="https://ww4.fmovies.co/home/#" id="navCountry" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Country</a>
                        <ul class="dropdown-menu text-capitalize p-2" aria-labelledby="navCountry">
                            <li><a href="https://ww4.fmovies.co/country/australia/" class="dropdown-item"
                                    title="Australia">Australia</a></li>
                            <li><a href="https://ww4.fmovies.co/country/united-states/" class="dropdown-item"
                                    title="United States">United
                                    States</a></li>
                            <li><a href="https://ww4.fmovies.co/country/italy/" class="dropdown-item"
                                    title="Italy">Italy</a></li>
                            <li><a href="https://ww4.fmovies.co/country/switzerland/" class="dropdown-item"
                                    title="Switzerland">Switzerland</a></li>
                            <li><a href="https://ww4.fmovies.co/country/united-kingdom/" class="dropdown-item"
                                    title="United Kingdom">United
                                    Kingdom</a></li>
                            <li><a href="https://ww4.fmovies.co/country/france/" class="dropdown-item"
                                    title="France">France</a></li>
                            <li><a href="https://ww4.fmovies.co/country/japan/" class="dropdown-item"
                                    title="Japan">Japan</a></li>
                            <li><a href="https://ww4.fmovies.co/country/canada/" class="dropdown-item"
                                    title="Canada">Canada</a></li>
                            <li><a href="https://ww4.fmovies.co/country/ireland/" class="dropdown-item"
                                    title="Ireland">Ireland</a></li>
                            <li><a href="https://ww4.fmovies.co/country/denmark/" class="dropdown-item"
                                    title="Denmark">Denmark</a></li>
                            <li><a href="https://ww4.fmovies.co/country/czech-republic/" class="dropdown-item"
                                    title="Czech Republic">Czech
                                    Republic</a></li>
                            <li><a href="https://ww4.fmovies.co/country/germany/" class="dropdown-item"
                                    title="Germany">Germany</a></li>
                            <li><a href="https://ww4.fmovies.co/country/hungary/" class="dropdown-item"
                                    title="Hungary">Hungary</a></li>
                            <li><a href="https://ww4.fmovies.co/country/romania/" class="dropdown-item"
                                    title="Romania">Romania</a></li>
                            <li><a href="https://ww4.fmovies.co/country/south-korea/" class="dropdown-item"
                                    title="South Korea">South
                                    Korea</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('frontend.movie') }}">Movies</a>
                    </li>
                    <li class="nav-item"><a class="nav-link px-3"
                            href="{{ route('frontend.tv_serie') }}">TV-Series</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="https://ww4.fmovies.co/top-imdb/">Top
                            IMDb</a></li>
                </ul>
                <div id="search-bar" class="d-none d-sm-block w-xl-20 me-2">
                    <form class="d-flex">
                        <div class="input-group"><input id="nav-search" name="search"
                                class="form-control text-dark border-0" type="search" placeholder="Search"
                                aria-label="Search" data-sharkid="__0">
                            <button id="m-search" type="button" class="input-group-text text-dark border-0"><svg
                                    width="16" height="16" fill="currentcolor" class="bi bi-search"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5.0 10-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 001.415-1.414l-3.85-3.85a1.007 1.007.0 00-.115-.1zM12 6.5a5.5 5.5.0 11-11 0 5.5 5.5.0 0111 0z">
                                    </path>
                                </svg></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</header>
