@extends('frontend.layouts.app')

@section('content')


<main class="container-lg min-vh-75">
    <div class="card bg-transparent border-0">
        <div class="card-header bg-transparent border-0 p-0 my-3">
            <h1 class="badge bg-bodys fs-5 fw-normal text-uppercase text-primary">Watch Movies</h1>
            <div class="float-end"><button class="btn btn-primary btn-sm text-uppercase" type="button"
                    data-bs-toggle="collapse" data-bs-target="#filter" aria-expanded="false" aria-controls="filter">
                    Filter</button></div>
            <div class="card bg-dark collapse" id="filter">
                <div class="card-body row">
                    <div class="col-sm-2">
                        <h5 class="card-title">Sort by</h5>
                        <div class="d-grid gap-2"><input type="radio" class="btn-check" name="options" id="option1"
                                autocomplete="off" checked="">
                            <label class="btn btn-primary" for="option1">Latest Release</label>
                            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
                            <label class="btn btn-primary" for="option2">Recent Update</label>
                            <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
                            <label class="btn btn-primary" for="option3">Most Favorite</label>
                            <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off">
                            <label class="btn btn-primary" for="option4">Most Rating</label>
                            <input type="radio" class="btn-check" name="options" id="option5" autocomplete="off">
                            <label class="btn btn-primary" for="option5">Top IMDb</label>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">Film Type</h5>
                                <div class="alert alert-secondary border-0">
                                    <div class="form-check form-check-inline"><input class="form-check-input"
                                            type="radio" name="type" id="filmType1" value="all">
                                        <label class="form-check-label" for="filmType1">All</label>
                                    </div>
                                    <div class="form-check form-check-inline"><input class="form-check-input"
                                            type="radio" name="type" id="filmType2" value="movies">
                                        <label class="form-check-label" for="filmType2">Movies</label>
                                    </div>
                                    <div class="form-check form-check-inline"><input class="form-check-input"
                                            type="radio" name="type" id="filmType3" value="series">
                                        <label class="form-check-label" for="filmType3">TV-Series</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <h5 class="card-title">Release</h5>
                                <div class="alert alert-secondary border-0">
                                    <div class="form-check form-check-inline"><input class="form-check-input"
                                            type="radio" name="year" id="filmYear1" value="all">
                                        <label class="form-check-label" for="filmYear1">All</label>
                                    </div>
                                    <div class="form-check form-check-inline"><input class="form-check-input"
                                            type="radio" name="year" id="filmYear2" value="2025">
                                        <label class="form-check-label" for="filmYear2">2025</label>
                                    </div>
                                    <div class="form-check form-check-inline"><input class="form-check-input"
                                            type="radio" name="year" id="filmYear3" value="2024">
                                        <label class="form-check-label" for="filmYear3">2024</label>
                                    </div>
                                    <div class="form-check form-check-inline"><input class="form-check-input"
                                            type="radio" name="year" id="filmYear4" value="2023">
                                        <label class="form-check-label" for="filmYear4">2023</label>
                                    </div>
                                    <div class="form-check form-check-inline"><input class="form-check-input"
                                            type="radio" name="year" id="filmYear5" value="2022">
                                        <label class="form-check-label" for="filmYear5">2022</label>
                                    </div>
                                    <div class="form-check form-check-inline"><input class="form-check-input"
                                            type="radio" name="year" id="filmYear6" value="2021">
                                        <label class="form-check-label" for="filmYear6">2021</label>
                                    </div>
                                    <div class="form-check form-check-inline"><input class="form-check-input"
                                            type="radio" name="year" id="filmYear7" value="old">
                                        <label class="form-check-label" for="filmYear7">Older</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col px-0">
                            <h5 class="card-title">Genre</h5>
                            <div class="alert alert-secondary border-0">
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre0" value="0">
                                    <label class="form-check-label" for="filmGenre">Action</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre1" value="1">
                                    <label class="form-check-label" for="filmGenre">Adventure</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre2" value="2">
                                    <label class="form-check-label" for="filmGenre">Animation</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre3" value="3">
                                    <label class="form-check-label" for="filmGenre">Biography</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre4" value="4">
                                    <label class="form-check-label" for="filmGenre">Comedy</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre5" value="5">
                                    <label class="form-check-label" for="filmGenre">Comedy</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre6" value="6">
                                    <label class="form-check-label" for="filmGenre">Costume</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre7" value="7">
                                    <label class="form-check-label" for="filmGenre">Crime</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre8" value="8">
                                    <label class="form-check-label" for="filmGenre">Documentary</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre9" value="9">
                                    <label class="form-check-label" for="filmGenre">Drama</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre10" value="10">
                                    <label class="form-check-label" for="filmGenre">Family</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre11" value="11">
                                    <label class="form-check-label" for="filmGenre">Fantasy</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre12" value="12">
                                    <label class="form-check-label" for="filmGenre">Film-Noir</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre13" value="13">
                                    <label class="form-check-label" for="filmGenre">Game-Show</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre14" value="14">
                                    <label class="form-check-label" for="filmGenre">History</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre15" value="15">
                                    <label class="form-check-label" for="filmGenre">Horror</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre16" value="16">
                                    <label class="form-check-label" for="filmGenre">Kungfu</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre17" value="17">
                                    <label class="form-check-label" for="filmGenre">Music</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre18" value="18">
                                    <label class="form-check-label" for="filmGenre">Musical</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre19" value="19">
                                    <label class="form-check-label" for="filmGenre">Mystery</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre20" value="20">
                                    <label class="form-check-label" for="filmGenre">Mythological</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre21" value="21">
                                    <label class="form-check-label" for="filmGenre">News</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre22" value="22">
                                    <label class="form-check-label" for="filmGenre">Psychological</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre23" value="23">
                                    <label class="form-check-label" for="filmGenre">Reality</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre24" value="24">
                                    <label class="form-check-label" for="filmGenre">Reality-TV</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre25" value="25">
                                    <label class="form-check-label" for="filmGenre">Romance</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre26" value="26">
                                    <label class="form-check-label" for="filmGenre">Sci-Fi</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre27" value="27">
                                    <label class="form-check-label" for="filmGenre">Science Fiction</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre28" value="28">
                                    <label class="form-check-label" for="filmGenre">Short</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre29" value="29">
                                    <label class="form-check-label" for="filmGenre">Sitcom</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre30" value="30">
                                    <label class="form-check-label" for="filmGenre">Sport</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre31" value="31">
                                    <label class="form-check-label" for="filmGenre">Talk-Show</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre32" value="32">
                                    <label class="form-check-label" for="filmGenre">Thriller</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre33" value="33">
                                    <label class="form-check-label" for="filmGenre">TV Movie</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre34" value="34">
                                    <label class="form-check-label" for="filmGenre">TV Show</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre35" value="35">
                                    <label class="form-check-label" for="filmGenre">War</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="genres[]" id="filmGenre36" value="36">
                                    <label class="form-check-label" for="filmGenre">Western</label>
                                </div>
                            </div>
                        </div>
                        <div class="col px-0">
                            <h5 class="card-title">Country</h5>
                            <div class="alert alert-secondary border-0">
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries0" value="0">
                                    <label class="form-check-label" for="filmCountries">Afghanistan</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries1" value="1">
                                    <label class="form-check-label" for="filmCountries">Algeria</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries2" value="2">
                                    <label class="form-check-label" for="filmCountries">Angola</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries3" value="3">
                                    <label class="form-check-label" for="filmCountries">Argentina</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries4" value="4">
                                    <label class="form-check-label" for="filmCountries">Asia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries5" value="5">
                                    <label class="form-check-label" for="filmCountries">Australia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries6" value="6">
                                    <label class="form-check-label" for="filmCountries">Austria</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries7" value="7">
                                    <label class="form-check-label" for="filmCountries">Bahamas</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries8" value="8">
                                    <label class="form-check-label" for="filmCountries">Belgium</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries9" value="9">
                                    <label class="form-check-label" for="filmCountries">Bosnia &amp;
                                        Herzegovina</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries10" value="10">
                                    <label class="form-check-label" for="filmCountries">Brazil</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries11" value="11">
                                    <label class="form-check-label" for="filmCountries">British Virgin
                                        Islands</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries12" value="12">
                                    <label class="form-check-label" for="filmCountries">Bulgaria</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries13" value="13">
                                    <label class="form-check-label" for="filmCountries">Cambodia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries14" value="14">
                                    <label class="form-check-label" for="filmCountries">Cameroon</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries15" value="15">
                                    <label class="form-check-label" for="filmCountries">Canada</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries16" value="16">
                                    <label class="form-check-label" for="filmCountries">Cayman Islands</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries17" value="17">
                                    <label class="form-check-label" for="filmCountries">Chile</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries18" value="18">
                                    <label class="form-check-label" for="filmCountries">China</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries19" value="19">
                                    <label class="form-check-label" for="filmCountries">Colombia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries20" value="20">
                                    <label class="form-check-label" for="filmCountries">Congo - Kinshasa</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries21" value="21">
                                    <label class="form-check-label" for="filmCountries">Costa Rica</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries22" value="22">
                                    <label class="form-check-label" for="filmCountries">Croatia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries23" value="23">
                                    <label class="form-check-label" for="filmCountries">Cuba</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries24" value="24">
                                    <label class="form-check-label" for="filmCountries">Cyprus</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries25" value="25">
                                    <label class="form-check-label" for="filmCountries">Czech Republic</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries26" value="26">
                                    <label class="form-check-label" for="filmCountries">Czechia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries27" value="27">
                                    <label class="form-check-label" for="filmCountries">Denmark</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries28" value="28">
                                    <label class="form-check-label" for="filmCountries">Dominican Republic</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries29" value="29">
                                    <label class="form-check-label" for="filmCountries">Ecuador</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries30" value="30">
                                    <label class="form-check-label" for="filmCountries">Egypt</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries31" value="31">
                                    <label class="form-check-label" for="filmCountries">El Salvador</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries32" value="32">
                                    <label class="form-check-label" for="filmCountries">Estonia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries33" value="33">
                                    <label class="form-check-label" for="filmCountries">Ethiopia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries34" value="34">
                                    <label class="form-check-label" for="filmCountries">Euro</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries35" value="35">
                                    <label class="form-check-label" for="filmCountries">Finland</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries36" value="36">
                                    <label class="form-check-label" for="filmCountries">France</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries37" value="37">
                                    <label class="form-check-label" for="filmCountries">Georgia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries38" value="38">
                                    <label class="form-check-label" for="filmCountries">Germany</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries39" value="39">
                                    <label class="form-check-label" for="filmCountries">Ghana</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries40" value="40">
                                    <label class="form-check-label" for="filmCountries">Gibraltar</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries41" value="41">
                                    <label class="form-check-label" for="filmCountries">Greece</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries42" value="42">
                                    <label class="form-check-label" for="filmCountries">Guatemala</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries43" value="43">
                                    <label class="form-check-label" for="filmCountries">Honduras</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries44" value="44">
                                    <label class="form-check-label" for="filmCountries">Hong Kong</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries45" value="45">
                                    <label class="form-check-label" for="filmCountries">HongKong</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries46" value="46">
                                    <label class="form-check-label" for="filmCountries">Hungary</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries47" value="47">
                                    <label class="form-check-label" for="filmCountries">Iceland</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries48" value="48">
                                    <label class="form-check-label" for="filmCountries">India</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries49" value="49">
                                    <label class="form-check-label" for="filmCountries">Indonesia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries50" value="50">
                                    <label class="form-check-label" for="filmCountries">International</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries51" value="51">
                                    <label class="form-check-label" for="filmCountries">Iran</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries52" value="52">
                                    <label class="form-check-label" for="filmCountries">Ireland</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries53" value="53">
                                    <label class="form-check-label" for="filmCountries">Isle of Man</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries54" value="54">
                                    <label class="form-check-label" for="filmCountries">Israel</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries55" value="55">
                                    <label class="form-check-label" for="filmCountries">Italy</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries56" value="56">
                                    <label class="form-check-label" for="filmCountries">Ivory Coast</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries57" value="57">
                                    <label class="form-check-label" for="filmCountries">Japan</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries58" value="58">
                                    <label class="form-check-label" for="filmCountries">Jordan</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries59" value="59">
                                    <label class="form-check-label" for="filmCountries">Kazakhstan</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries60" value="60">
                                    <label class="form-check-label" for="filmCountries">Kenya</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries61" value="61">
                                    <label class="form-check-label" for="filmCountries">Korea</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries62" value="62">
                                    <label class="form-check-label" for="filmCountries">Kosovo</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries63" value="63">
                                    <label class="form-check-label" for="filmCountries">Latvia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries64" value="64">
                                    <label class="form-check-label" for="filmCountries">Lebanon</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries65" value="65">
                                    <label class="form-check-label" for="filmCountries">Libya</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries66" value="66">
                                    <label class="form-check-label" for="filmCountries">Lithuania</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries67" value="67">
                                    <label class="form-check-label" for="filmCountries">Luxembourg</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries68" value="68">
                                    <label class="form-check-label" for="filmCountries">Macao SAR China</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries69" value="69">
                                    <label class="form-check-label" for="filmCountries">Malaysia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries70" value="70">
                                    <label class="form-check-label" for="filmCountries">Mali</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries71" value="71">
                                    <label class="form-check-label" for="filmCountries">Malta</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries72" value="72">
                                    <label class="form-check-label" for="filmCountries">Mexico</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries73" value="73">
                                    <label class="form-check-label" for="filmCountries">Moldova</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries74" value="74">
                                    <label class="form-check-label" for="filmCountries">Mongolia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries75" value="75">
                                    <label class="form-check-label" for="filmCountries">Morocco</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries76" value="76">
                                    <label class="form-check-label" for="filmCountries">Nepal</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries77" value="77">
                                    <label class="form-check-label" for="filmCountries">Netherlands</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries78" value="78">
                                    <label class="form-check-label" for="filmCountries">New Zealand</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries79" value="79">
                                    <label class="form-check-label" for="filmCountries">Nigeria</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries80" value="80">
                                    <label class="form-check-label" for="filmCountries">Northern Ireland</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries81" value="81">
                                    <label class="form-check-label" for="filmCountries">Norway</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries82" value="82">
                                    <label class="form-check-label" for="filmCountries">Pakistan</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries83" value="83">
                                    <label class="form-check-label" for="filmCountries">Palestinian
                                        Territories</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries84" value="84">
                                    <label class="form-check-label" for="filmCountries">Panama</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries85" value="85">
                                    <label class="form-check-label" for="filmCountries">Paraguay</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries86" value="86">
                                    <label class="form-check-label" for="filmCountries">Peru</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries87" value="87">
                                    <label class="form-check-label" for="filmCountries">Philippines</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries88" value="88">
                                    <label class="form-check-label" for="filmCountries">Poland</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries89" value="89">
                                    <label class="form-check-label" for="filmCountries">Portugal</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries90" value="90">
                                    <label class="form-check-label" for="filmCountries">Puerto Rico</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries91" value="91">
                                    <label class="form-check-label" for="filmCountries">Qatar</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries92" value="92">
                                    <label class="form-check-label" for="filmCountries">Romania</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries93" value="93">
                                    <label class="form-check-label" for="filmCountries">Russia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries94" value="94">
                                    <label class="form-check-label" for="filmCountries">Saudi Arabia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries95" value="95">
                                    <label class="form-check-label" for="filmCountries">Senegal</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries96" value="96">
                                    <label class="form-check-label" for="filmCountries">Serbia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries97" value="97">
                                    <label class="form-check-label" for="filmCountries">Singapore</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries98" value="98">
                                    <label class="form-check-label" for="filmCountries">Slovakia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries99" value="99">
                                    <label class="form-check-label" for="filmCountries">Slovenia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries100" value="100">
                                    <label class="form-check-label" for="filmCountries">South Africa</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries101" value="101">
                                    <label class="form-check-label" for="filmCountries">South Korea</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries102" value="102">
                                    <label class="form-check-label" for="filmCountries">Soviet Union</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries103" value="103">
                                    <label class="form-check-label" for="filmCountries">Spain</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries104" value="104">
                                    <label class="form-check-label" for="filmCountries">St Helena</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries105" value="105">
                                    <label class="form-check-label" for="filmCountries">St Kitts &amp; Nevis</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries106" value="106">
                                    <label class="form-check-label" for="filmCountries">Sweden</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries107" value="107">
                                    <label class="form-check-label" for="filmCountries">Switzerland</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries108" value="108">
                                    <label class="form-check-label" for="filmCountries">Taiwan</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries109" value="109">
                                    <label class="form-check-label" for="filmCountries">Tanzania</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries110" value="110">
                                    <label class="form-check-label" for="filmCountries">Thailand</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries111" value="111">
                                    <label class="form-check-label" for="filmCountries">Trinidad &amp;
                                        Tobago</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries112" value="112">
                                    <label class="form-check-label" for="filmCountries">Tunisia</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries113" value="113">
                                    <label class="form-check-label" for="filmCountries">Turkey</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries114" value="114">
                                    <label class="form-check-label" for="filmCountries">Uganda</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries115" value="115">
                                    <label class="form-check-label" for="filmCountries">Ukraine</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries116" value="116">
                                    <label class="form-check-label" for="filmCountries">United Arab Emirates</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries117" value="117">
                                    <label class="form-check-label" for="filmCountries">United Kingdom</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries118" value="118">
                                    <label class="form-check-label" for="filmCountries">United States</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries119" value="119">
                                    <label class="form-check-label" for="filmCountries">Uruguay</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries120" value="120">
                                    <label class="form-check-label" for="filmCountries">US</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries121" value="121">
                                    <label class="form-check-label" for="filmCountries">Venezuela</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries122" value="122">
                                    <label class="form-check-label" for="filmCountries">Vietnam</label>
                                </div>
                                <div class="form-check form-check-inline"><input class="form-check-input"
                                        type="radio" name="countries[]" id="filmCountries123" value="123">
                                    <label class="form-check-label" for="filmCountries">West Germany</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="row row-cols-2 row-cols-sm-4 row-cols-lg-6 row-cols-xl-8 g-4 mb-4">
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/a-complete-unknown-1630858198/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/a-complete-unknown-1630858198.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/a-complete-unknown-1630858198.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/a-complete-unknown-1630858198.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/a-complete-unknown-1630858198.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/a-complete-unknown-1630858198.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/a-complete-unknown-1630858198.webp 2x">
                                <img src="./movie_files/a-complete-unknown-1630858198.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/a-complete-unknown-1630858198.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/a-complete-unknown-1630858198.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/a-complete-unknown-1630858198.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/a-complete-unknown-1630858198.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="A Complete Unknown" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/a-complete-unknown-1630858198.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/a-complete-unknown-1630858198.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/a-complete-unknown-1630858198.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">A Complete Unknown</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/presence-1630858348/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/presence-1630858348.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/presence-1630858348.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/presence-1630858348.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/presence-1630858348.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/presence-1630858348.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/presence-1630858348.webp 2x">
                                <img src="./movie_files/presence-1630858348.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/presence-1630858348.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/presence-1630858348.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/presence-1630858348.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/presence-1630858348.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Presence" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/presence-1630858348.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/presence-1630858348.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/presence-1630858348.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Presence</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/the-last-showgirl-1630858291/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-last-showgirl-1630858291.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-last-showgirl-1630858291.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-last-showgirl-1630858291.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-last-showgirl-1630858291.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-last-showgirl-1630858291.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-last-showgirl-1630858291.webp 2x">
                                <img src="./movie_files/the-last-showgirl-1630858291.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/the-last-showgirl-1630858291.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-last-showgirl-1630858291.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-last-showgirl-1630858291.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-last-showgirl-1630858291.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="The Last Showgirl" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-last-showgirl-1630858291.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-last-showgirl-1630858291.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-last-showgirl-1630858291.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">The Last Showgirl</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/venom-the-last-dance-1630857833/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/venom-the-last-dance-1630857833.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/venom-the-last-dance-1630857833.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/venom-the-last-dance-1630857833.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/venom-the-last-dance-1630857833.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/venom-the-last-dance-1630857833.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/venom-the-last-dance-1630857833.webp 2x">
                                <img src="./movie_files/venom-the-last-dance-1630857833.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/venom-the-last-dance-1630857833.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/venom-the-last-dance-1630857833.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/venom-the-last-dance-1630857833.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/venom-the-last-dance-1630857833.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Venom: The Last Dance" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/venom-the-last-dance-1630857833.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/venom-the-last-dance-1630857833.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/venom-the-last-dance-1630857833.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Venom: The Last Dance</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/babygirl-1630858197/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/babygirl-1630858197.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/babygirl-1630858197.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/babygirl-1630858197.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/babygirl-1630858197.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/babygirl-1630858197.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/babygirl-1630858197.webp 2x">
                                <img src="./movie_files/babygirl-1630858197.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/babygirl-1630858197.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/babygirl-1630858197.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/babygirl-1630858197.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/babygirl-1630858197.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Babygirl" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/babygirl-1630858197.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/babygirl-1630858197.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/babygirl-1630858197.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Babygirl</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/nosferatu-1630858195/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/nosferatu-1630858195.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/nosferatu-1630858195.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/nosferatu-1630858195.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/nosferatu-1630858195.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/nosferatu-1630858195.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/nosferatu-1630858195.webp 2x">
                                <img src="./movie_files/nosferatu-1630858195.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/nosferatu-1630858195.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/nosferatu-1630858195.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/nosferatu-1630858195.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/nosferatu-1630858195.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Nosferatu" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/nosferatu-1630858195.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/nosferatu-1630858195.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/nosferatu-1630858195.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Nosferatu</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/the-brutalist-1630858152/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-brutalist-1630858152.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-brutalist-1630858152.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-brutalist-1630858152.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-brutalist-1630858152.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-brutalist-1630858152.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-brutalist-1630858152.webp 2x">
                                <img src="./movie_files/the-brutalist-1630858152.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/the-brutalist-1630858152.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-brutalist-1630858152.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-brutalist-1630858152.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-brutalist-1630858152.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="The Brutalist" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-brutalist-1630858152.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-brutalist-1630858152.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-brutalist-1630858152.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">The Brutalist</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/better-man-1630858196/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/better-man-1630858196.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/better-man-1630858196.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/better-man-1630858196.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/better-man-1630858196.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/better-man-1630858196.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/better-man-1630858196.webp 2x">
                                <img src="./movie_files/better-man-1630858196.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/better-man-1630858196.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/better-man-1630858196.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/better-man-1630858196.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/better-man-1630858196.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Better Man" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/better-man-1630858196.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/better-man-1630858196.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/better-man-1630858196.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Better Man</h2>
                            </div><span class="mlbq">CAM</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/den-of-thieves-2-pantera-1630858378/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/den-of-thieves-2-pantera-1630858378.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/den-of-thieves-2-pantera-1630858378.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/den-of-thieves-2-pantera-1630858378.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/den-of-thieves-2-pantera-1630858378.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/den-of-thieves-2-pantera-1630858378.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/den-of-thieves-2-pantera-1630858378.webp 2x">
                                <img src="./movie_files/den-of-thieves-2-pantera-1630858378.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/den-of-thieves-2-pantera-1630858378.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/den-of-thieves-2-pantera-1630858378.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/den-of-thieves-2-pantera-1630858378.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/den-of-thieves-2-pantera-1630858378.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Den of Thieves 2: Pantera" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/den-of-thieves-2-pantera-1630858378.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/den-of-thieves-2-pantera-1630858378.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/den-of-thieves-2-pantera-1630858378.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Den of Thieves 2: Pantera</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/youre-cordially-invited-1630858377/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/youre-cordially-invited-1630858377.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/youre-cordially-invited-1630858377.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/youre-cordially-invited-1630858377.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/youre-cordially-invited-1630858377.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/youre-cordially-invited-1630858377.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/youre-cordially-invited-1630858377.webp 2x">
                                <img src="./movie_files/youre-cordially-invited-1630858377.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/youre-cordially-invited-1630858377.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/youre-cordially-invited-1630858377.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/youre-cordially-invited-1630858377.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/youre-cordially-invited-1630858377.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="You&#39;re Cordially Invited" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/youre-cordially-invited-1630858377.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/youre-cordially-invited-1630858377.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/youre-cordially-invited-1630858377.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">You're Cordially Invited</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/sunray-fallen-soldier-1630858376/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/sunray-fallen-soldier-1630858376.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/sunray-fallen-soldier-1630858376.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/sunray-fallen-soldier-1630858376.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/sunray-fallen-soldier-1630858376.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/sunray-fallen-soldier-1630858376.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/sunray-fallen-soldier-1630858376.webp 2x">
                                <img src="./movie_files/sunray-fallen-soldier-1630858376.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/sunray-fallen-soldier-1630858376.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/sunray-fallen-soldier-1630858376.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/sunray-fallen-soldier-1630858376.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/sunray-fallen-soldier-1630858376.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Sunray: Fallen Soldier" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/sunray-fallen-soldier-1630858376.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/sunray-fallen-soldier-1630858376.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/sunray-fallen-soldier-1630858376.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Sunray: Fallen Soldier</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/one-thing-left-to-do-1630858375/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/one-thing-left-to-do-1630858375.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/one-thing-left-to-do-1630858375.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/one-thing-left-to-do-1630858375.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/one-thing-left-to-do-1630858375.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/one-thing-left-to-do-1630858375.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/one-thing-left-to-do-1630858375.webp 2x">
                                <img src="./movie_files/one-thing-left-to-do-1630858375.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/one-thing-left-to-do-1630858375.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/one-thing-left-to-do-1630858375.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/one-thing-left-to-do-1630858375.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/one-thing-left-to-do-1630858375.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="One Thing Left to Do" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/one-thing-left-to-do-1630858375.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/one-thing-left-to-do-1630858375.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/one-thing-left-to-do-1630858375.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">One Thing Left to Do</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/the-fish-thief-a-great-lakes-mystery-1630858374/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-fish-thief-a-great-lakes-mystery-1630858374.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-fish-thief-a-great-lakes-mystery-1630858374.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-fish-thief-a-great-lakes-mystery-1630858374.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-fish-thief-a-great-lakes-mystery-1630858374.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-fish-thief-a-great-lakes-mystery-1630858374.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-fish-thief-a-great-lakes-mystery-1630858374.webp 2x">
                                <img src="./movie_files/the-fish-thief-a-great-lakes-mystery-1630858374.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/the-fish-thief-a-great-lakes-mystery-1630858374.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-fish-thief-a-great-lakes-mystery-1630858374.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-fish-thief-a-great-lakes-mystery-1630858374.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-fish-thief-a-great-lakes-mystery-1630858374.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="The Fish Thief: A Great Lakes Mystery" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-fish-thief-a-great-lakes-mystery-1630858374.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-fish-thief-a-great-lakes-mystery-1630858374.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-fish-thief-a-great-lakes-mystery-1630858374.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">The Fish Thief: A Great Lakes Mystery
                                </h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/dark-night-of-the-soul-1630858373/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/dark-night-of-the-soul-1630858373.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/dark-night-of-the-soul-1630858373.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/dark-night-of-the-soul-1630858373.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/dark-night-of-the-soul-1630858373.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/dark-night-of-the-soul-1630858373.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/dark-night-of-the-soul-1630858373.webp 2x">
                                <img src="./movie_files/dark-night-of-the-soul-1630858373.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/dark-night-of-the-soul-1630858373.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/dark-night-of-the-soul-1630858373.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/dark-night-of-the-soul-1630858373.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/dark-night-of-the-soul-1630858373.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Dark Night of the Soul" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/dark-night-of-the-soul-1630858373.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/dark-night-of-the-soul-1630858373.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/dark-night-of-the-soul-1630858373.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Dark Night of the Soul</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/buffalo-kids-1630858372/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/buffalo-kids-1630858372.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/buffalo-kids-1630858372.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/buffalo-kids-1630858372.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/buffalo-kids-1630858372.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/buffalo-kids-1630858372.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/buffalo-kids-1630858372.webp 2x">
                                <img src="./movie_files/buffalo-kids-1630858372.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/buffalo-kids-1630858372.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/buffalo-kids-1630858372.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/buffalo-kids-1630858372.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/buffalo-kids-1630858372.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Buffalo Kids" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/buffalo-kids-1630858372.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/buffalo-kids-1630858372.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/buffalo-kids-1630858372.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Buffalo Kids</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/dawn-chorus-1630858371/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/dawn-chorus-1630858371.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/dawn-chorus-1630858371.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/dawn-chorus-1630858371.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/dawn-chorus-1630858371.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/dawn-chorus-1630858371.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/dawn-chorus-1630858371.webp 2x">
                                <img src="./movie_files/dawn-chorus-1630858371.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/dawn-chorus-1630858371.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/dawn-chorus-1630858371.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/dawn-chorus-1630858371.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/dawn-chorus-1630858371.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Dawn Chorus" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/dawn-chorus-1630858371.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/dawn-chorus-1630858371.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/dawn-chorus-1630858371.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Dawn Chorus</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/september-5-1630858370/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/september-5-1630858370.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/september-5-1630858370.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/september-5-1630858370.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/september-5-1630858370.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/september-5-1630858370.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/september-5-1630858370.webp 2x">
                                <img src="./movie_files/september-5-1630858370.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/september-5-1630858370.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/september-5-1630858370.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/september-5-1630858370.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/september-5-1630858370.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="September 5" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/september-5-1630858370.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/september-5-1630858370.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/september-5-1630858370.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">September 5</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/nickel-boys-1630858369/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/nickel-boys-1630858369.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/nickel-boys-1630858369.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/nickel-boys-1630858369.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/nickel-boys-1630858369.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/nickel-boys-1630858369.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/nickel-boys-1630858369.webp 2x">
                                <img src="./movie_files/nickel-boys-1630858369.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/nickel-boys-1630858369.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/nickel-boys-1630858369.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/nickel-boys-1630858369.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/nickel-boys-1630858369.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Nickel Boys" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/nickel-boys-1630858369.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/nickel-boys-1630858369.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/nickel-boys-1630858369.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Nickel Boys</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/monster-on-a-plane-1630858368/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/monster-on-a-plane-1630858368.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/monster-on-a-plane-1630858368.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/monster-on-a-plane-1630858368.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/monster-on-a-plane-1630858368.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/monster-on-a-plane-1630858368.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/monster-on-a-plane-1630858368.webp 2x">
                                <img src="./movie_files/monster-on-a-plane-1630858368.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/monster-on-a-plane-1630858368.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/monster-on-a-plane-1630858368.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/monster-on-a-plane-1630858368.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/monster-on-a-plane-1630858368.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Monster on a Plane" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/monster-on-a-plane-1630858368.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/monster-on-a-plane-1630858368.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/monster-on-a-plane-1630858368.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Monster on a Plane</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/tom-green-i-got-a-mule-1630858367/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/tom-green-i-got-a-mule-1630858367.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/tom-green-i-got-a-mule-1630858367.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/tom-green-i-got-a-mule-1630858367.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/tom-green-i-got-a-mule-1630858367.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/tom-green-i-got-a-mule-1630858367.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/tom-green-i-got-a-mule-1630858367.webp 2x">
                                <img src="./movie_files/tom-green-i-got-a-mule-1630858367.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/tom-green-i-got-a-mule-1630858367.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/tom-green-i-got-a-mule-1630858367.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/tom-green-i-got-a-mule-1630858367.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/tom-green-i-got-a-mule-1630858367.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Tom Green: I Got a Mule!" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/tom-green-i-got-a-mule-1630858367.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/tom-green-i-got-a-mule-1630858367.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/tom-green-i-got-a-mule-1630858367.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Tom Green: I Got a Mule!</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/silvio-1630858366/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/silvio-1630858366.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/silvio-1630858366.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/silvio-1630858366.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/silvio-1630858366.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/silvio-1630858366.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/silvio-1630858366.webp 2x">
                                <img src="./movie_files/silvio-1630858366.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/silvio-1630858366.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/silvio-1630858366.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/silvio-1630858366.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/silvio-1630858366.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Silvio" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/silvio-1630858366.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/silvio-1630858366.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/silvio-1630858366.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Silvio</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/plastic-people-1630858365/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/plastic-people-1630858365.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/plastic-people-1630858365.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/plastic-people-1630858365.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/plastic-people-1630858365.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/plastic-people-1630858365.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/plastic-people-1630858365.webp 2x">
                                <img src="./movie_files/plastic-people-1630858365.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/plastic-people-1630858365.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/plastic-people-1630858365.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/plastic-people-1630858365.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/plastic-people-1630858365.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Plastic People" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/plastic-people-1630858365.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/plastic-people-1630858365.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/plastic-people-1630858365.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Plastic People</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/tatami-1630858364/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/tatami-1630858364.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/tatami-1630858364.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/tatami-1630858364.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/tatami-1630858364.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/tatami-1630858364.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/tatami-1630858364.webp 2x">
                                <img src="./movie_files/tatami-1630858364.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/tatami-1630858364.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/tatami-1630858364.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/tatami-1630858364.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/tatami-1630858364.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Tatami" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/tatami-1630858364.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/tatami-1630858364.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/tatami-1630858364.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Tatami</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/three-kilometres-to-the-end-of-the-world-1630858363/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/three-kilometres-to-the-end-of-the-world-1630858363.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/three-kilometres-to-the-end-of-the-world-1630858363.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/three-kilometres-to-the-end-of-the-world-1630858363.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/three-kilometres-to-the-end-of-the-world-1630858363.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/three-kilometres-to-the-end-of-the-world-1630858363.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/three-kilometres-to-the-end-of-the-world-1630858363.webp 2x">
                                <img src="./movie_files/three-kilometres-to-the-end-of-the-world-1630858363.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/three-kilometres-to-the-end-of-the-world-1630858363.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/three-kilometres-to-the-end-of-the-world-1630858363.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/three-kilometres-to-the-end-of-the-world-1630858363.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/three-kilometres-to-the-end-of-the-world-1630858363.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Three Kilometres to the End of the World" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/three-kilometres-to-the-end-of-the-world-1630858363.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/three-kilometres-to-the-end-of-the-world-1630858363.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/three-kilometres-to-the-end-of-the-world-1630858363.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Three Kilometres to the End of the World
                                </h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/zombie-strain-1630858362/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/zombie-strain-1630858362.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/zombie-strain-1630858362.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/zombie-strain-1630858362.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/zombie-strain-1630858362.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/zombie-strain-1630858362.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/zombie-strain-1630858362.webp 2x">
                                <img src="./movie_files/zombie-strain-1630858362.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/zombie-strain-1630858362.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/zombie-strain-1630858362.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/zombie-strain-1630858362.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/zombie-strain-1630858362.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Zombie Strain" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/zombie-strain-1630858362.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/zombie-strain-1630858362.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/zombie-strain-1630858362.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Zombie Strain</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/100kg-vampire-1630858361/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/100kg-vampire-1630858361.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/100kg-vampire-1630858361.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/100kg-vampire-1630858361.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/100kg-vampire-1630858361.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/100kg-vampire-1630858361.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/100kg-vampire-1630858361.webp 2x">
                                <img src="./movie_files/100kg-vampire-1630858361.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/100kg-vampire-1630858361.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/100kg-vampire-1630858361.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/100kg-vampire-1630858361.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/100kg-vampire-1630858361.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="100KG Vampire" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/100kg-vampire-1630858361.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/100kg-vampire-1630858361.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/100kg-vampire-1630858361.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">100KG Vampire</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/a-vineyard-christmas-1630858360/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/a-vineyard-christmas-1630858360.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/a-vineyard-christmas-1630858360.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/a-vineyard-christmas-1630858360.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/a-vineyard-christmas-1630858360.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/a-vineyard-christmas-1630858360.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/a-vineyard-christmas-1630858360.webp 2x">
                                <img src="./movie_files/a-vineyard-christmas-1630858360.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/a-vineyard-christmas-1630858360.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/a-vineyard-christmas-1630858360.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/a-vineyard-christmas-1630858360.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/a-vineyard-christmas-1630858360.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="A Vineyard Christmas" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/a-vineyard-christmas-1630858360.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/a-vineyard-christmas-1630858360.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/a-vineyard-christmas-1630858360.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">A Vineyard Christmas</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/the-sand-castle-1630858359/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-sand-castle-1630858359.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-sand-castle-1630858359.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-sand-castle-1630858359.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-sand-castle-1630858359.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-sand-castle-1630858359.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-sand-castle-1630858359.webp 2x">
                                <img src="./movie_files/the-sand-castle-1630858359.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/the-sand-castle-1630858359.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-sand-castle-1630858359.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-sand-castle-1630858359.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-sand-castle-1630858359.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="The Sand Castle" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-sand-castle-1630858359.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-sand-castle-1630858359.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-sand-castle-1630858359.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">The Sand Castle</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/oh-canada-1630858358/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/oh-canada-1630858358.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/oh-canada-1630858358.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/oh-canada-1630858358.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/oh-canada-1630858358.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/oh-canada-1630858358.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/oh-canada-1630858358.webp 2x">
                                <img src="./movie_files/oh-canada-1630858358.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/oh-canada-1630858358.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/oh-canada-1630858358.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/oh-canada-1630858358.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/oh-canada-1630858358.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Oh, Canada" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/oh-canada-1630858358.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/oh-canada-1630858358.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/oh-canada-1630858358.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Oh, Canada</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/honor-student-1630858356/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/honor-student-1630858356.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/honor-student-1630858356.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/honor-student-1630858356.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/honor-student-1630858356.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/honor-student-1630858356.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/honor-student-1630858356.webp 2x">
                                <img src="./movie_files/honor-student-1630858356.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/honor-student-1630858356.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/honor-student-1630858356.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/honor-student-1630858356.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/honor-student-1630858356.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Honor Student" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/honor-student-1630858356.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/honor-student-1630858356.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/honor-student-1630858356.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Honor Student</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/the-intruder-1630858355/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-intruder-1630858355.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-intruder-1630858355.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-intruder-1630858355.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-intruder-1630858355.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-intruder-1630858355.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-intruder-1630858355.webp 2x">
                                <img src="./movie_files/the-intruder-1630858355.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/the-intruder-1630858355.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-intruder-1630858355.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-intruder-1630858355.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-intruder-1630858355.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="The Intruder" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-intruder-1630858355.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-intruder-1630858355.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-intruder-1630858355.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">The Intruder</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/brave-the-dark-1630858354/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/brave-the-dark-1630858354.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/brave-the-dark-1630858354.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/brave-the-dark-1630858354.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/brave-the-dark-1630858354.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/brave-the-dark-1630858354.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/brave-the-dark-1630858354.webp 2x">
                                <img src="./movie_files/brave-the-dark-1630858354.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/brave-the-dark-1630858354.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/brave-the-dark-1630858354.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/brave-the-dark-1630858354.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/brave-the-dark-1630858354.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Brave the Dark" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/brave-the-dark-1630858354.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/brave-the-dark-1630858354.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/brave-the-dark-1630858354.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Brave the Dark</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/my-divorce-party-1630858357/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/my-divorce-party-1630858357.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/my-divorce-party-1630858357.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/my-divorce-party-1630858357.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/my-divorce-party-1630858357.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/my-divorce-party-1630858357.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/my-divorce-party-1630858357.webp 2x">
                                <img src="./movie_files/my-divorce-party-1630858357.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/my-divorce-party-1630858357.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/my-divorce-party-1630858357.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/my-divorce-party-1630858357.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/my-divorce-party-1630858357.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="My Divorce Party" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/my-divorce-party-1630858357.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/my-divorce-party-1630858357.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/my-divorce-party-1630858357.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">My Divorce Party</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/bad-hombres-1630858352/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/bad-hombres-1630858352.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/bad-hombres-1630858352.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/bad-hombres-1630858352.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/bad-hombres-1630858352.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/bad-hombres-1630858352.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/bad-hombres-1630858352.webp 2x">
                                <img src="./movie_files/bad-hombres-1630858352.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/bad-hombres-1630858352.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/bad-hombres-1630858352.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/bad-hombres-1630858352.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/bad-hombres-1630858352.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Bad Hombres" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/bad-hombres-1630858352.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/bad-hombres-1630858352.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/bad-hombres-1630858352.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Bad Hombres</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/forever-home-1630858351/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/forever-home-1630858351.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/forever-home-1630858351.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/forever-home-1630858351.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/forever-home-1630858351.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/forever-home-1630858351.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/forever-home-1630858351.webp 2x">
                                <img src="./movie_files/forever-home-1630858351.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/forever-home-1630858351.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/forever-home-1630858351.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/forever-home-1630858351.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/forever-home-1630858351.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Forever Home" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/forever-home-1630858351.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/forever-home-1630858351.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/forever-home-1630858351.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Forever Home</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/digger-1630858350/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/digger-1630858350.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/digger-1630858350.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/digger-1630858350.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/digger-1630858350.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/digger-1630858350.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/digger-1630858350.webp 2x">
                                <img src="./movie_files/digger-1630858350.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/digger-1630858350.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/digger-1630858350.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/digger-1630858350.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/digger-1630858350.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Digger" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/digger-1630858350.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/digger-1630858350.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/digger-1630858350.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Digger</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/grafted-1630858349/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/grafted-1630858349.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/grafted-1630858349.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/grafted-1630858349.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/grafted-1630858349.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/grafted-1630858349.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/grafted-1630858349.webp 2x">
                                <img src="./movie_files/grafted-1630858349.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/grafted-1630858349.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/grafted-1630858349.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/grafted-1630858349.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/grafted-1630858349.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Grafted" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/grafted-1630858349.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/grafted-1630858349.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/grafted-1630858349.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Grafted</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/never-look-away-1630858347/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/never-look-away-1630858347.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/never-look-away-1630858347.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/never-look-away-1630858347.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/never-look-away-1630858347.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/never-look-away-1630858347.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/never-look-away-1630858347.webp 2x">
                                <img src="./movie_files/never-look-away-1630858347.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/never-look-away-1630858347.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/never-look-away-1630858347.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/never-look-away-1630858347.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/never-look-away-1630858347.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Never Look Away" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/never-look-away-1630858347.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/never-look-away-1630858347.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/never-look-away-1630858347.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Never Look Away</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/hanzo-the-razor-the-snare-1630858346/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/hanzo-the-razor-the-snare-1630858346.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/hanzo-the-razor-the-snare-1630858346.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/hanzo-the-razor-the-snare-1630858346.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/hanzo-the-razor-the-snare-1630858346.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/hanzo-the-razor-the-snare-1630858346.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/hanzo-the-razor-the-snare-1630858346.webp 2x">
                                <img src="./movie_files/hanzo-the-razor-the-snare-1630858346.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/hanzo-the-razor-the-snare-1630858346.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/hanzo-the-razor-the-snare-1630858346.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/hanzo-the-razor-the-snare-1630858346.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/hanzo-the-razor-the-snare-1630858346.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Hanzo the Razor: The Snare" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/hanzo-the-razor-the-snare-1630858346.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/hanzo-the-razor-the-snare-1630858346.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/hanzo-the-razor-the-snare-1630858346.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Hanzo the Razor: The Snare</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/empty-nets-1630858345/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/empty-nets-1630858345.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/empty-nets-1630858345.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/empty-nets-1630858345.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/empty-nets-1630858345.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/empty-nets-1630858345.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/empty-nets-1630858345.webp 2x">
                                <img src="./movie_files/empty-nets-1630858345.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/empty-nets-1630858345.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/empty-nets-1630858345.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/empty-nets-1630858345.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/empty-nets-1630858345.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Empty Nets" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/empty-nets-1630858345.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/empty-nets-1630858345.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/empty-nets-1630858345.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Empty Nets</h2>
                            </div><span class="mlbq">HD</span>
                        </a></div>
                </div>
            </div>
            <div class="text-center py-3 m-auto">
                <ul class="pagination justify-content-center m-0">
                    <li class="page-item active"><a href="https://ww4.fmovies.co/movies/1/#" aria-current="page"
                            aria-label="Page 1" class="page-link border-primary shadow" role="button">1</a></li>
                    <li class="page-item"><a href="https://ww4.fmovies.co/movies/page/2/" aria-label="Page 2"
                            class="page-link border-primary shadow bg-footer1" role="button">2</a></li>
                    <li class="page-item"><a href="https://ww4.fmovies.co/movies/page/3/" aria-label="Page 3"
                            class="page-link border-primary shadow bg-footer1" role="button">3</a></li>
                    <li class="page-item"><a href="https://ww4.fmovies.co/movies/page/4/" aria-label="Page 4"
                            class="page-link border-primary shadow bg-footer1" role="button">4</a></li>
                    <li class="page-item"><a href="https://ww4.fmovies.co/movies/page/5/" aria-label="Page 5"
                            class="page-link border-primary shadow bg-footer1" role="button">5</a></li>
                    <li class="page-item"><a href="https://ww4.fmovies.co/movies/page/2/" aria-label="Next"
                            class="page-link border-primary shadow bg-footer1" role="button"><span
                                aria-hidden="true">Next »</span></a></li>
                    <li class="page-item"><a href="https://ww4.fmovies.co/movies/page/635/" aria-label="Last"
                            class="page-link border-primary shadow bg-footer1" role="button"><span
                                aria-hidden="true">»»</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</main>

@endsection
