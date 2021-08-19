@extends('Layout.ProductPage.Product')
@section('content')
<div class="page-content">
    <div class="holder mt-0 holder-coming-soon">
        <div class="container coming-soon-block">
            <div class="countdown-box-login">
                <a href="javascript:;" data-src="#countdownLogin" class="modal-info-link"><i class="icon-user"></i></a>
            </div>
            <div class="countdown-box-coming-soon d-flex justify-content-center align-items-center">
                <svg id="morphing" xmlns="http://www.w3.org/2000/svg" width="600" height="600" viewBox="0 0 600 600">
                    <g transform="translate(50,50)">
                        <path class="p"
                              d="M93.5441 2.30824C127.414 -1.02781 167.142 -4.63212 188.625 21.7114C210.22 48.1931 199.088 86.5178 188.761 119.068C179.736 147.517 162.617 171.844 136.426 186.243C108.079 201.828 73.804 212.713 44.915 198.152C16.4428 183.802 6.66731 149.747 1.64848 118.312C-2.87856 89.9563 1.56309 60.9032 19.4066 38.3787C37.3451 15.7342 64.7587 5.14348 93.5441 2.30824Z" />
                    </g>
                </svg>
                <div class="countdown js-countdown" data-countdown="2021/07/01"></div>
            </div>
            <h2 class="countdown-box-title">WE'RE COMING SOON</h2>
            <p class="countdown-box-text mx-auto">Under Construction basically lets you take your website offline while you work on it.</p>
            <div class="countdown-box-subscribe-form">
                <form action="#">
                    <div class="row">
                        <div class="col-sm"><input type="text" class="form-control form-control--xl" placeholder="Enter e-mail address"></div>
                        <div class="col-sm-auto mt-15 mt-sm-0">
                            <button type="submit" class="btn btn--xl">Notify</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection()
