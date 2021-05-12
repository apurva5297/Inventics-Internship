@extends('layouts.main')

@section('title')
{{'SPIN CYCLES | Transaction Status'}}
@endsection

@section('stylesheets')
<style type="text/css">
  @media (min-width: 768px) {
    #payment_status{
      margin-left: 33.33333% !important;
   }
  }

  #payment_status{
    font-weight: bold;
    font-family: auto;
  }
  @media print {
    body * {
      visibility: hidden;
    }
    #section-to-print, #section-to-print * {
      visibility: visible;
    }
    #section-to-print {
      position: absolute;
      left: 0;
      top: 0;
    }
  }
  .services-list .service-icon::before{
    color:red;
  }
</style>
@endsection



@section('content')
<div class="theme-page">

  <div class="clearfix">

    <!--Section 2 --->
    <div class="row padding-bottom-100">
        <div class="column column-1-1">
          <div class="row mobile-paddings" id="section-to-print">
            <div class="column column-1-3" id="payment_status">
              <ul class="services-list services-icons margin-top-25 clearfix">
                <li class="column column-1-3">
                   <span class="service-icon big features-cc-camera"></span>
                   <p>Transaction was suspicious !</p>
                   <span>If your amount has been debited from your bank/wallet, please call our customer support at 8880004880</span>
                </li>
              </ul>

            </div>
          </div>
        </div>
    </div>
    <!--Section 2 end --->

  </div>
  <!--clearfix end -->
</div>
<!--theme page end -->

@endsection
@section('scripts')

<script>
function myFunction() {
  window.print();
}
</script>
@endsection

