@extends('frontend.layouts.app')

@section('content')

<main class="container-lg min-vh-75">
    <div class="card bg-transparent border-0">
        <div class="card-header bg-transparent border-0 p-0 my-3">
            <h1 class="badge bg-bodys fs-5 fw-normal px-0 text-uppercase text-primary">Watch TV-Series</h1>
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
                            href="https://ww4.fmovies.co/film/paradise-season-1-1630858472/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/paradise-season-1-1630858472.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/paradise-season-1-1630858472.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/paradise-season-1-1630858472.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/paradise-season-1-1630858472.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/paradise-season-1-1630858472.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/paradise-season-1-1630858472.webp 2x">
                                <img src="./tv-series_files/paradise-season-1-1630858472.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/paradise-season-1-1630858472.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/paradise-season-1-1630858472.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/paradise-season-1-1630858472.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/paradise-season-1-1630858472.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Paradise - Season 1" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/paradise-season-1-1630858472.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/paradise-season-1-1630858472.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/paradise-season-1-1630858472.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Paradise - Season 1</h2>
                            </div><span class="mlbe">Eps<i>8</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/the-hunting-party-season-1-1630858466/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-hunting-party-season-1-1630858466.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-hunting-party-season-1-1630858466.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-hunting-party-season-1-1630858466.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-hunting-party-season-1-1630858466.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-hunting-party-season-1-1630858466.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-hunting-party-season-1-1630858466.webp 2x">
                                <img src="./tv-series_files/the-hunting-party-season-1-1630858466.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/the-hunting-party-season-1-1630858466.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-hunting-party-season-1-1630858466.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-hunting-party-season-1-1630858466.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-hunting-party-season-1-1630858466.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="The Hunting Party - Season 1" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-hunting-party-season-1-1630858466.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-hunting-party-season-1-1630858466.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-hunting-party-season-1-1630858466.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">The Hunting Party - Season 1</h2>
                            </div><span class="mlbe">Eps<i>5</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/all-american-season-7-1630858384/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/all-american-season-7-1630858384.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/all-american-season-7-1630858384.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/all-american-season-7-1630858384.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/all-american-season-7-1630858384.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/all-american-season-7-1630858384.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/all-american-season-7-1630858384.webp 2x">
                                <img src="./tv-series_files/all-american-season-7-1630858384.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/all-american-season-7-1630858384.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/all-american-season-7-1630858384.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/all-american-season-7-1630858384.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/all-american-season-7-1630858384.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="All American - Season 7" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/all-american-season-7-1630858384.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/all-american-season-7-1630858384.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/all-american-season-7-1630858384.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">All American - Season 7</h2>
                            </div><span class="mlbe">Eps<i>5</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/american-dad-season-21-1630857891/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/american-dad-season-21-1630857891.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/american-dad-season-21-1630857891.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/american-dad-season-21-1630857891.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/american-dad-season-21-1630857891.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/american-dad-season-21-1630857891.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/american-dad-season-21-1630857891.webp 2x">
                                <img src="./tv-series_files/american-dad-season-21-1630857891.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/american-dad-season-21-1630857891.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/american-dad-season-21-1630857891.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/american-dad-season-21-1630857891.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/american-dad-season-21-1630857891.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="American Dad! - Season 21" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/american-dad-season-21-1630857891.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/american-dad-season-21-1630857891.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/american-dad-season-21-1630857891.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">American Dad! - Season 21</h2>
                            </div><span class="mlbe">Eps<i>19</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/rescue-hi-surf-season-1-1630857877/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/rescue-hi-surf-season-1-1630857877.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/rescue-hi-surf-season-1-1630857877.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/rescue-hi-surf-season-1-1630857877.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/rescue-hi-surf-season-1-1630857877.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/rescue-hi-surf-season-1-1630857877.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/rescue-hi-surf-season-1-1630857877.webp 2x">
                                <img src="./tv-series_files/rescue-hi-surf-season-1-1630857877.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/rescue-hi-surf-season-1-1630857877.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/rescue-hi-surf-season-1-1630857877.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/rescue-hi-surf-season-1-1630857877.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/rescue-hi-surf-season-1-1630857877.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Rescue: HI-Surf - Season 1" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/rescue-hi-surf-season-1-1630857877.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/rescue-hi-surf-season-1-1630857877.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/rescue-hi-surf-season-1-1630857877.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Rescue: HI-Surf - Season 1</h2>
                            </div><span class="mlbe">Eps<i>16</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/the-neighborhood-season-7-1630857825/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-neighborhood-season-7-1630857825.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-neighborhood-season-7-1630857825.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-neighborhood-season-7-1630857825.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-neighborhood-season-7-1630857825.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-neighborhood-season-7-1630857825.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-neighborhood-season-7-1630857825.webp 2x">
                                <img src="./tv-series_files/the-neighborhood-season-7-1630857825.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/the-neighborhood-season-7-1630857825.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-neighborhood-season-7-1630857825.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-neighborhood-season-7-1630857825.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-neighborhood-season-7-1630857825.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="The Neighborhood - Season 7" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-neighborhood-season-7-1630857825.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-neighborhood-season-7-1630857825.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-neighborhood-season-7-1630857825.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">The Neighborhood - Season 7</h2>
                            </div><span class="mlbe">Eps<i>13</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/ncis-season-22-1630857787/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/ncis-season-22-1630857787.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/ncis-season-22-1630857787.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/ncis-season-22-1630857787.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/ncis-season-22-1630857787.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/ncis-season-22-1630857787.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/ncis-season-22-1630857787.webp 2x">
                                <img src="./tv-series_files/ncis-season-22-1630857787.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/ncis-season-22-1630857787.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/ncis-season-22-1630857787.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/ncis-season-22-1630857787.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/ncis-season-22-1630857787.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="NCIS - Season 22" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/ncis-season-22-1630857787.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/ncis-season-22-1630857787.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/ncis-season-22-1630857787.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">NCIS - Season 22</h2>
                            </div><span class="mlbe">Eps<i>14</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/the-white-lotus-season-3-1630858467/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-white-lotus-season-3-1630858467.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-white-lotus-season-3-1630858467.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-white-lotus-season-3-1630858467.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-white-lotus-season-3-1630858467.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-white-lotus-season-3-1630858467.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-white-lotus-season-3-1630858467.webp 2x">
                                <img src="./tv-series_files/the-white-lotus-season-3-1630858467.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/the-white-lotus-season-3-1630858467.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-white-lotus-season-3-1630858467.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-white-lotus-season-3-1630858467.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-white-lotus-season-3-1630858467.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="The White Lotus - Season 3" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-white-lotus-season-3-1630858467.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-white-lotus-season-3-1630858467.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-white-lotus-season-3-1630858467.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">The White Lotus - Season 3</h2>
                            </div><span class="mlbe">Eps<i>3</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/family-guy-season-23-1630858460/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/family-guy-season-23-1630858460.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/family-guy-season-23-1630858460.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/family-guy-season-23-1630858460.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/family-guy-season-23-1630858460.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/family-guy-season-23-1630858460.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/family-guy-season-23-1630858460.webp 2x">
                                <img src="./tv-series_files/family-guy-season-23-1630858460.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/family-guy-season-23-1630858460.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/family-guy-season-23-1630858460.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/family-guy-season-23-1630858460.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/family-guy-season-23-1630858460.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Family Guy - Season 23" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/family-guy-season-23-1630858460.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/family-guy-season-23-1630858460.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/family-guy-season-23-1630858460.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Family Guy - Season 23</h2>
                            </div><span class="mlbe">Eps<i>3</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/last-week-tonight-with-john-oliver-season-12-1630858459/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/last-week-tonight-with-john-oliver-season-12-1630858459.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/last-week-tonight-with-john-oliver-season-12-1630858459.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/last-week-tonight-with-john-oliver-season-12-1630858459.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/last-week-tonight-with-john-oliver-season-12-1630858459.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/last-week-tonight-with-john-oliver-season-12-1630858459.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/last-week-tonight-with-john-oliver-season-12-1630858459.webp 2x">
                                <img src="./tv-series_files/last-week-tonight-with-john-oliver-season-12-1630858459.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/last-week-tonight-with-john-oliver-season-12-1630858459.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/last-week-tonight-with-john-oliver-season-12-1630858459.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/last-week-tonight-with-john-oliver-season-12-1630858459.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/last-week-tonight-with-john-oliver-season-12-1630858459.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Last Week Tonight with John Oliver - Season 12" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/last-week-tonight-with-john-oliver-season-12-1630858459.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/last-week-tonight-with-john-oliver-season-12-1630858459.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/last-week-tonight-with-john-oliver-season-12-1630858459.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Last Week Tonight with John Oliver -
                                    Season 12</h2>
                            </div><span class="mlbe">Eps<i>3</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/call-the-midwife-season-14-1630858329/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/call-the-midwife-season-14-1630858329.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/call-the-midwife-season-14-1630858329.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/call-the-midwife-season-14-1630858329.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/call-the-midwife-season-14-1630858329.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/call-the-midwife-season-14-1630858329.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/call-the-midwife-season-14-1630858329.webp 2x">
                                <img src="./tv-series_files/call-the-midwife-season-14-1630858329.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/call-the-midwife-season-14-1630858329.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/call-the-midwife-season-14-1630858329.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/call-the-midwife-season-14-1630858329.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/call-the-midwife-season-14-1630858329.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Call the Midwife - Season 14" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/call-the-midwife-season-14-1630858329.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/call-the-midwife-season-14-1630858329.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/call-the-midwife-season-14-1630858329.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Call the Midwife - Season 14</h2>
                            </div><span class="mlbe">Eps<i>8</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/the-equalizer-season-5-1630857816/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-equalizer-season-5-1630857816.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-equalizer-season-5-1630857816.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-equalizer-season-5-1630857816.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-equalizer-season-5-1630857816.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-equalizer-season-5-1630857816.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-equalizer-season-5-1630857816.webp 2x">
                                <img src="./tv-series_files/the-equalizer-season-5-1630857816.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/the-equalizer-season-5-1630857816.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-equalizer-season-5-1630857816.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-equalizer-season-5-1630857816.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-equalizer-season-5-1630857816.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="The Equalizer - Season 5" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-equalizer-season-5-1630857816.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-equalizer-season-5-1630857816.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-equalizer-season-5-1630857816.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">The Equalizer - Season 5</h2>
                            </div><span class="mlbe">Eps<i>10</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/tracker-season-2-1630857815/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/tracker-season-2-1630857815.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/tracker-season-2-1630857815.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/tracker-season-2-1630857815.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/tracker-season-2-1630857815.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/tracker-season-2-1630857815.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/tracker-season-2-1630857815.webp 2x">
                                <img src="./tv-series_files/tracker-season-2-1630857815.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/tracker-season-2-1630857815.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/tracker-season-2-1630857815.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/tracker-season-2-1630857815.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/tracker-season-2-1630857815.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Tracker - Season 2" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/tracker-season-2-1630857815.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/tracker-season-2-1630857815.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/tracker-season-2-1630857815.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Tracker - Season 2</h2>
                            </div><span class="mlbe">Eps<i>11</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/krapopolis-season-2-1630857702/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/krapopolis-season-2-1630857702.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/krapopolis-season-2-1630857702.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/krapopolis-season-2-1630857702.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/krapopolis-season-2-1630857702.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/krapopolis-season-2-1630857702.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/krapopolis-season-2-1630857702.webp 2x">
                                <img src="./tv-series_files/krapopolis-season-2-1630857702.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/krapopolis-season-2-1630857702.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/krapopolis-season-2-1630857702.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/krapopolis-season-2-1630857702.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/krapopolis-season-2-1630857702.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Krapopolis - Season 2" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/krapopolis-season-2-1630857702.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/krapopolis-season-2-1630857702.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/krapopolis-season-2-1630857702.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Krapopolis - Season 2</h2>
                            </div><span class="mlbe">Eps<i>12</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/1923-season-2-1630858494/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/1923-season-2-1630858494.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/1923-season-2-1630858494.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/1923-season-2-1630858494.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/1923-season-2-1630858494.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/1923-season-2-1630858494.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/1923-season-2-1630858494.webp 2x">
                                <img src="./tv-series_files/1923-season-2-1630858494.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/1923-season-2-1630858494.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/1923-season-2-1630858494.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/1923-season-2-1630858494.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/1923-season-2-1630858494.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="1923 - Season 2" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/1923-season-2-1630858494.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/1923-season-2-1630858494.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/1923-season-2-1630858494.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">1923 - Season 2</h2>
                            </div><span class="mlbe">Eps<i>2</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/mayfair-witches-season-2-1630858234/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/mayfair-witches-season-2-1630858234.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/mayfair-witches-season-2-1630858234.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/mayfair-witches-season-2-1630858234.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/mayfair-witches-season-2-1630858234.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/mayfair-witches-season-2-1630858234.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/mayfair-witches-season-2-1630858234.webp 2x">
                                <img src="./tv-series_files/mayfair-witches-season-2-1630858234.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/mayfair-witches-season-2-1630858234.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/mayfair-witches-season-2-1630858234.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/mayfair-witches-season-2-1630858234.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/mayfair-witches-season-2-1630858234.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Mayfair Witches - Season 2" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/mayfair-witches-season-2-1630858234.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/mayfair-witches-season-2-1630858234.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/mayfair-witches-season-2-1630858234.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Mayfair Witches - Season 2</h2>
                            </div><span class="mlbe">Eps<i>8</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/saturday-night-live-season-50-1630857698/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/saturday-night-live-season-50-1630857698.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/saturday-night-live-season-50-1630857698.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/saturday-night-live-season-50-1630857698.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/saturday-night-live-season-50-1630857698.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/saturday-night-live-season-50-1630857698.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/saturday-night-live-season-50-1630857698.webp 2x">
                                <img src="./tv-series_files/saturday-night-live-season-50-1630857698.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/saturday-night-live-season-50-1630857698.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/saturday-night-live-season-50-1630857698.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/saturday-night-live-season-50-1630857698.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/saturday-night-live-season-50-1630857698.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Saturday Night Live - Season 50" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/saturday-night-live-season-50-1630857698.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/saturday-night-live-season-50-1630857698.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/saturday-night-live-season-50-1630857698.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Saturday Night Live - Season 50</h2>
                            </div><span class="mlbe">Eps<i>12</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/ncis-sydney-season-2-1630858411/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/ncis-sydney-season-2-1630858411.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/ncis-sydney-season-2-1630858411.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/ncis-sydney-season-2-1630858411.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/ncis-sydney-season-2-1630858411.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/ncis-sydney-season-2-1630858411.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/ncis-sydney-season-2-1630858411.webp 2x">
                                <img src="./tv-series_files/ncis-sydney-season-2-1630858411.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/ncis-sydney-season-2-1630858411.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/ncis-sydney-season-2-1630858411.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/ncis-sydney-season-2-1630858411.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/ncis-sydney-season-2-1630858411.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="NCIS: Sydney - Season 2" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/ncis-sydney-season-2-1630858411.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/ncis-sydney-season-2-1630858411.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/ncis-sydney-season-2-1630858411.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">NCIS: Sydney - Season 2</h2>
                            </div><span class="mlbe">Eps<i>4</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/fire-country-season-3-1630857814/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/fire-country-season-3-1630857814.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/fire-country-season-3-1630857814.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/fire-country-season-3-1630857814.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/fire-country-season-3-1630857814.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/fire-country-season-3-1630857814.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/fire-country-season-3-1630857814.webp 2x">
                                <img src="./tv-series_files/fire-country-season-3-1630857814.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/fire-country-season-3-1630857814.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/fire-country-season-3-1630857814.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/fire-country-season-3-1630857814.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/fire-country-season-3-1630857814.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Fire Country - Season 3" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/fire-country-season-3-1630857814.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/fire-country-season-3-1630857814.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/fire-country-season-3-1630857814.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Fire Country - Season 3</h2>
                            </div><span class="mlbe">Eps<i>13</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/s-w-a-t-season-8-1630857813/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/s-w-a-t-season-8-1630857813.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/s-w-a-t-season-8-1630857813.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/s-w-a-t-season-8-1630857813.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/s-w-a-t-season-8-1630857813.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/s-w-a-t-season-8-1630857813.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/s-w-a-t-season-8-1630857813.webp 2x">
                                <img src="./tv-series_files/s-w-a-t-season-8-1630857813.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/s-w-a-t-season-8-1630857813.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/s-w-a-t-season-8-1630857813.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/s-w-a-t-season-8-1630857813.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/s-w-a-t-season-8-1630857813.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="SWAT - Season 8" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/s-w-a-t-season-8-1630857813.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/s-w-a-t-season-8-1630857813.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/s-w-a-t-season-8-1630857813.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">SWAT - Season 8</h2>
                            </div><span class="mlbe">Eps<i>13</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/yellowjackets-season-3-1630858442/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/yellowjackets-season-3-1630858442.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/yellowjackets-season-3-1630858442.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/yellowjackets-season-3-1630858442.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/yellowjackets-season-3-1630858442.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/yellowjackets-season-3-1630858442.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/yellowjackets-season-3-1630858442.webp 2x">
                                <img src="./tv-series_files/yellowjackets-season-3-1630858442.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/yellowjackets-season-3-1630858442.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/yellowjackets-season-3-1630858442.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/yellowjackets-season-3-1630858442.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/yellowjackets-season-3-1630858442.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Yellowjackets - Season 3" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/yellowjackets-season-3-1630858442.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/yellowjackets-season-3-1630858442.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/yellowjackets-season-3-1630858442.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Yellowjackets - Season 3</h2>
                            </div><span class="mlbe">Eps<i>4</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/severance-season-2-1630858320/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/severance-season-2-1630858320.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/severance-season-2-1630858320.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/severance-season-2-1630858320.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/severance-season-2-1630858320.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/severance-season-2-1630858320.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/severance-season-2-1630858320.webp 2x">
                                <img src="./tv-series_files/severance-season-2-1630858320.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/severance-season-2-1630858320.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/severance-season-2-1630858320.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/severance-season-2-1630858320.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/severance-season-2-1630858320.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Severance - Season 2" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/severance-season-2-1630858320.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/severance-season-2-1630858320.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/severance-season-2-1630858320.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Severance - Season 2</h2>
                            </div><span class="mlbe">Eps<i>7</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/animal-control-season-3-1630858229/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/animal-control-season-3-1630858229.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/animal-control-season-3-1630858229.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/animal-control-season-3-1630858229.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/animal-control-season-3-1630858229.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/animal-control-season-3-1630858229.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/animal-control-season-3-1630858229.webp 2x">
                                <img src="./tv-series_files/animal-control-season-3-1630858229.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/animal-control-season-3-1630858229.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/animal-control-season-3-1630858229.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/animal-control-season-3-1630858229.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/animal-control-season-3-1630858229.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Animal Control - Season 3" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/animal-control-season-3-1630858229.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/animal-control-season-3-1630858229.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/animal-control-season-3-1630858229.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Animal Control - Season 3</h2>
                            </div><span class="mlbe">Eps<i>8</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/elsbeth-season-2-1630857870/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/elsbeth-season-2-1630857870.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/elsbeth-season-2-1630857870.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/elsbeth-season-2-1630857870.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/elsbeth-season-2-1630857870.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/elsbeth-season-2-1630857870.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/elsbeth-season-2-1630857870.webp 2x">
                                <img src="./tv-series_files/elsbeth-season-2-1630857870.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/elsbeth-season-2-1630857870.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/elsbeth-season-2-1630857870.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/elsbeth-season-2-1630857870.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/elsbeth-season-2-1630857870.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Elsbeth - Season 2" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/elsbeth-season-2-1630857870.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/elsbeth-season-2-1630857870.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/elsbeth-season-2-1630857870.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Elsbeth - Season 2</h2>
                            </div><span class="mlbe">Eps<i>13</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/matlock-season-1-1630857837/" class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/matlock-season-1-1630857837.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/matlock-season-1-1630857837.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/matlock-season-1-1630857837.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/matlock-season-1-1630857837.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/matlock-season-1-1630857837.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/matlock-season-1-1630857837.webp 2x">
                                <img src="./tv-series_files/matlock-season-1-1630857837.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/matlock-season-1-1630857837.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/matlock-season-1-1630857837.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/matlock-season-1-1630857837.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/matlock-season-1-1630857837.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Matlock - Season 1" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/matlock-season-1-1630857837.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/matlock-season-1-1630857837.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/matlock-season-1-1630857837.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Matlock - Season 1</h2>
                            </div><span class="mlbe">Eps<i>13</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/georgie-and-mandy-s-first-marriage-season-1-1630857809/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/georgie-and-mandy-s-first-marriage-season-1-1630857809.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/georgie-and-mandy-s-first-marriage-season-1-1630857809.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/georgie-and-mandy-s-first-marriage-season-1-1630857809.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/georgie-and-mandy-s-first-marriage-season-1-1630857809.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/georgie-and-mandy-s-first-marriage-season-1-1630857809.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/georgie-and-mandy-s-first-marriage-season-1-1630857809.webp 2x">
                                <img src="./tv-series_files/georgie-and-mandy-s-first-marriage-season-1-1630857809.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/georgie-and-mandy-s-first-marriage-season-1-1630857809.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/georgie-and-mandy-s-first-marriage-season-1-1630857809.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/georgie-and-mandy-s-first-marriage-season-1-1630857809.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/georgie-and-mandy-s-first-marriage-season-1-1630857809.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Georgie and Mandy&#39;s First Marriage - Season 1" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/georgie-and-mandy-s-first-marriage-season-1-1630857809.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/georgie-and-mandy-s-first-marriage-season-1-1630857809.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/georgie-and-mandy-s-first-marriage-season-1-1630857809.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Georgie and Mandy's First Marriage -
                                    Season 1</h2>
                            </div><span class="mlbe">Eps<i>12</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/chicago-fire-season-13-1630857683/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/chicago-fire-season-13-1630857683.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/chicago-fire-season-13-1630857683.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/chicago-fire-season-13-1630857683.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/chicago-fire-season-13-1630857683.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/chicago-fire-season-13-1630857683.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/chicago-fire-season-13-1630857683.webp 2x">
                                <img src="./tv-series_files/chicago-fire-season-13-1630857683.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/chicago-fire-season-13-1630857683.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/chicago-fire-season-13-1630857683.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/chicago-fire-season-13-1630857683.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/chicago-fire-season-13-1630857683.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Chicago Fire - Season 13" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/chicago-fire-season-13-1630857683.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/chicago-fire-season-13-1630857683.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/chicago-fire-season-13-1630857683.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Chicago Fire - Season 13</h2>
                            </div><span class="mlbe">Eps<i>14</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/chicago-p-d-season-12-1630857684/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/chicago-p-d-season-12-1630857684.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/chicago-p-d-season-12-1630857684.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/chicago-p-d-season-12-1630857684.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/chicago-p-d-season-12-1630857684.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/chicago-p-d-season-12-1630857684.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/chicago-p-d-season-12-1630857684.webp 2x">
                                <img src="./tv-series_files/chicago-p-d-season-12-1630857684.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/chicago-p-d-season-12-1630857684.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/chicago-p-d-season-12-1630857684.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/chicago-p-d-season-12-1630857684.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/chicago-p-d-season-12-1630857684.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Chicago PD - Season 12" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/chicago-p-d-season-12-1630857684.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/chicago-p-d-season-12-1630857684.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/chicago-p-d-season-12-1630857684.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Chicago PD - Season 12</h2>
                            </div><span class="mlbe">Eps<i>14</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/chicago-med-season-10-1630857685/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/chicago-med-season-10-1630857685.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/chicago-med-season-10-1630857685.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/chicago-med-season-10-1630857685.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/chicago-med-season-10-1630857685.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/chicago-med-season-10-1630857685.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/chicago-med-season-10-1630857685.webp 2x">
                                <img src="./tv-series_files/chicago-med-season-10-1630857685.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/chicago-med-season-10-1630857685.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/chicago-med-season-10-1630857685.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/chicago-med-season-10-1630857685.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/chicago-med-season-10-1630857685.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Chicago Med - Season 10" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/chicago-med-season-10-1630857685.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/chicago-med-season-10-1630857685.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/chicago-med-season-10-1630857685.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Chicago Med - Season 10</h2>
                            </div><span class="mlbe">Eps<i>14</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/abbott-elementary-season-4-1630857903/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/abbott-elementary-season-4-1630857903.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/abbott-elementary-season-4-1630857903.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/abbott-elementary-season-4-1630857903.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/abbott-elementary-season-4-1630857903.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/abbott-elementary-season-4-1630857903.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/abbott-elementary-season-4-1630857903.webp 2x">
                                <img src="./tv-series_files/abbott-elementary-season-4-1630857903.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/abbott-elementary-season-4-1630857903.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/abbott-elementary-season-4-1630857903.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/abbott-elementary-season-4-1630857903.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/abbott-elementary-season-4-1630857903.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Abbott Elementary - Season 4" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/abbott-elementary-season-4-1630857903.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/abbott-elementary-season-4-1630857903.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/abbott-elementary-season-4-1630857903.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Abbott Elementary - Season 4</h2>
                            </div><span class="mlbe">Eps<i>15</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/harley-quinn-season-5-1630858308/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/harley-quinn-season-5-1630858308.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/harley-quinn-season-5-1630858308.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/harley-quinn-season-5-1630858308.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/harley-quinn-season-5-1630858308.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/harley-quinn-season-5-1630858308.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/harley-quinn-season-5-1630858308.webp 2x">
                                <img src="./tv-series_files/harley-quinn-season-5-1630858308.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/harley-quinn-season-5-1630858308.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/harley-quinn-season-5-1630858308.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/harley-quinn-season-5-1630858308.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/harley-quinn-season-5-1630858308.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Harley Quinn - Season 5" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/harley-quinn-season-5-1630858308.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/harley-quinn-season-5-1630858308.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/harley-quinn-season-5-1630858308.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Harley Quinn - Season 5</h2>
                            </div><span class="mlbe">Eps<i>7</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/invincible-season-3-1630858421/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/invincible-season-3-1630858421.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/invincible-season-3-1630858421.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/invincible-season-3-1630858421.webp 2x"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/invincible-season-3-1630858421.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/invincible-season-3-1630858421.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/invincible-season-3-1630858421.webp 2x">
                                <img src="./tv-series_files/invincible-season-3-1630858421.jpg"
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/invincible-season-3-1630858421.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/invincible-season-3-1630858421.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/invincible-season-3-1630858421.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/invincible-season-3-1630858421.jpg 2x"
                                    class="lazy card-img img-fluid entered loaded" width="156" height="234"
                                    alt="Invincible - Season 3" data-ll-status="loaded"
                                    srcset="https://img.cdno.my.id/thumb/w_156/h_234/invincible-season-3-1630858421.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/invincible-season-3-1630858421.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/invincible-season-3-1630858421.jpg 2x">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Invincible - Season 3</h2>
                            </div><span class="mlbe">Eps<i>6</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/school-spirits-season-2-1630858436/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/school-spirits-season-2-1630858436.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/school-spirits-season-2-1630858436.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/school-spirits-season-2-1630858436.webp 2x">
                                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxwYXRoIGZpbGw9IiMzNzM0MzUiIGQ9Ik0wIDBoMmUydjNlMkgweiIvPjwvc3ZnPg=="
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/school-spirits-season-2-1630858436.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/school-spirits-season-2-1630858436.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/school-spirits-season-2-1630858436.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/school-spirits-season-2-1630858436.jpg 2x"
                                    class="lazy card-img img-fluid" width="156" height="234"
                                    alt="School Spirits - Season 2">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">School Spirits - Season 2</h2>
                            </div><span class="mlbe">Eps<i>7</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/prime-target-season-1-1630858510/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/prime-target-season-1-1630858510.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/prime-target-season-1-1630858510.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/prime-target-season-1-1630858510.webp 2x">
                                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxwYXRoIGZpbGw9IiMzNzM0MzUiIGQ9Ik0wIDBoMmUydjNlMkgweiIvPjwvc3ZnPg=="
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/prime-target-season-1-1630858510.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/prime-target-season-1-1630858510.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/prime-target-season-1-1630858510.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/prime-target-season-1-1630858510.jpg 2x"
                                    class="lazy card-img img-fluid" width="156" height="234"
                                    alt="Prime Target - Season 1">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Prime Target - Season 1</h2>
                            </div><span class="mlbe">Eps<i>7</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/mythic-quest-season-4-1630858422/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/mythic-quest-season-4-1630858422.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/mythic-quest-season-4-1630858422.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/mythic-quest-season-4-1630858422.webp 2x">
                                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxwYXRoIGZpbGw9IiMzNzM0MzUiIGQ9Ik0wIDBoMmUydjNlMkgweiIvPjwvc3ZnPg=="
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/mythic-quest-season-4-1630858422.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/mythic-quest-season-4-1630858422.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/mythic-quest-season-4-1630858422.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/mythic-quest-season-4-1630858422.jpg 2x"
                                    class="lazy card-img img-fluid" width="156" height="234"
                                    alt="Mythic Quest - Season 4">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Mythic Quest - Season 4</h2>
                            </div><span class="mlbe">Eps<i>6</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/hudson-rex-season-7-1630858301/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/hudson-rex-season-7-1630858301.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/hudson-rex-season-7-1630858301.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/hudson-rex-season-7-1630858301.webp 2x">
                                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxwYXRoIGZpbGw9IiMzNzM0MzUiIGQ9Ik0wIDBoMmUydjNlMkgweiIvPjwvc3ZnPg=="
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/hudson-rex-season-7-1630858301.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/hudson-rex-season-7-1630858301.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/hudson-rex-season-7-1630858301.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/hudson-rex-season-7-1630858301.jpg 2x"
                                    class="lazy card-img img-fluid" width="156" height="234"
                                    alt="Hudson &amp; Rex - Season 7">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Hudson &amp; Rex - Season 7</h2>
                            </div><span class="mlbe">Eps<i>7</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/will-trent-season-3-1630858260/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/will-trent-season-3-1630858260.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/will-trent-season-3-1630858260.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/will-trent-season-3-1630858260.webp 2x">
                                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxwYXRoIGZpbGw9IiMzNzM0MzUiIGQ9Ik0wIDBoMmUydjNlMkgweiIvPjwvc3ZnPg=="
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/will-trent-season-3-1630858260.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/will-trent-season-3-1630858260.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/will-trent-season-3-1630858260.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/will-trent-season-3-1630858260.jpg 2x"
                                    class="lazy card-img img-fluid" width="156" height="234"
                                    alt="Will Trent - Season 3">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Will Trent - Season 3</h2>
                            </div><span class="mlbe">Eps<i>8</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/the-rookie-season-7-1630858259/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-rookie-season-7-1630858259.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-rookie-season-7-1630858259.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-rookie-season-7-1630858259.webp 2x">
                                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxwYXRoIGZpbGw9IiMzNzM0MzUiIGQ9Ik0wIDBoMmUydjNlMkgweiIvPjwvc3ZnPg=="
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/the-rookie-season-7-1630858259.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/the-rookie-season-7-1630858259.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/the-rookie-season-7-1630858259.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/the-rookie-season-7-1630858259.jpg 2x"
                                    class="lazy card-img img-fluid" width="156" height="234"
                                    alt="The Rookie - Season 7">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">The Rookie - Season 7</h2>
                            </div><span class="mlbe">Eps<i>8</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/night-court-season-3-1630857969/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/night-court-season-3-1630857969.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/night-court-season-3-1630857969.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/night-court-season-3-1630857969.webp 2x">
                                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxwYXRoIGZpbGw9IiMzNzM0MzUiIGQ9Ik0wIDBoMmUydjNlMkgweiIvPjwvc3ZnPg=="
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/night-court-season-3-1630857969.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/night-court-season-3-1630857969.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/night-court-season-3-1630857969.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/night-court-season-3-1630857969.jpg 2x"
                                    class="lazy card-img img-fluid" width="156" height="234"
                                    alt="Night Court - Season 3">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">Night Court - Season 3</h2>
                            </div><span class="mlbe">Eps<i>10</i></span>
                        </a></div>
                </div>
                <div class="col">
                    <div class="card bg-transparent border-0 h-100"><a
                            href="https://ww4.fmovies.co/film/st-denis-medical-season-1-1630857956/"
                            class="rounded poster">
                            <picture>
                                <source type="image/webp"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/st-denis-medical-season-1-1630857956.webp 1x, https://img.cdno.my.id/thumb/w_234/h_351/st-denis-medical-season-1-1630857956.webp 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/st-denis-medical-season-1-1630857956.webp 2x">
                                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxwYXRoIGZpbGw9IiMzNzM0MzUiIGQ9Ik0wIDBoMmUydjNlMkgweiIvPjwvc3ZnPg=="
                                    data-src="https://img.cdno.my.id/thumb/w_312/h_468/st-denis-medical-season-1-1630857956.jpg"
                                    data-srcset="https://img.cdno.my.id/thumb/w_156/h_234/st-denis-medical-season-1-1630857956.jpg 1x, https://img.cdno.my.id/thumb/w_234/h_351/st-denis-medical-season-1-1630857956.jpg 1.5x, https://img.cdno.my.id/thumb/w_312/h_468/st-denis-medical-season-1-1630857956.jpg 2x"
                                    class="lazy card-img img-fluid" width="156" height="234"
                                    alt="St Denis Medical - Season 1">
                            </picture>
                            <div class="card-body item-title">
                                <h2 class="card-title text-light fs-6 m-0">St Denis Medical - Season 1</h2>
                            </div><span class="mlbe">Eps<i>13</i></span>
                        </a></div>
                </div>
            </div>
            <div class="text-center py-3 m-auto">
                <ul class="pagination justify-content-center m-0">
                    <li class="page-item active"><a href="https://ww4.fmovies.co/tv-series/1/#" aria-current="page"
                            aria-label="Page 1" class="page-link border-primary shadow" role="button">1</a></li>
                    <li class="page-item"><a href="https://ww4.fmovies.co/tv-series/page/2/" aria-label="Page 2"
                            class="page-link border-primary shadow bg-footer1" role="button">2</a></li>
                    <li class="page-item"><a href="https://ww4.fmovies.co/tv-series/page/3/" aria-label="Page 3"
                            class="page-link border-primary shadow bg-footer1" role="button">3</a></li>
                    <li class="page-item"><a href="https://ww4.fmovies.co/tv-series/page/4/" aria-label="Page 4"
                            class="page-link border-primary shadow bg-footer1" role="button">4</a></li>
                    <li class="page-item"><a href="https://ww4.fmovies.co/tv-series/page/5/" aria-label="Page 5"
                            class="page-link border-primary shadow bg-footer1" role="button">5</a></li>
                    <li class="page-item"><a href="https://ww4.fmovies.co/tv-series/page/2/" aria-label="Next"
                            class="page-link border-primary shadow bg-footer1" role="button"><span
                                aria-hidden="true">Next »</span></a></li>
                    <li class="page-item"><a href="https://ww4.fmovies.co/tv-series/page/239/" aria-label="Last"
                            class="page-link border-primary shadow bg-footer1" role="button"><span
                                aria-hidden="true">»»</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</main>

@endsection
