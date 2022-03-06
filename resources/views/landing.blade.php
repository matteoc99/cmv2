@extends("layouts.master")
@section("content")
<a class="anchor" id="top"></a>

<div class="section no-pad-top no-pad-bot" id="index-banner">
    <div class="parallax-container">
        <div class="parallax">

            <img src="img/mainBGv2.jpg">
            <div class="container" style="position: relative">
                <br><br>
                <div class="row center">
                    <h1 class="white-text half-transp-bg">@lang("landing.brandName")</h1>
                </div>
                <div class="row center">
                    <h4 class="white-text half-transp-bg">@lang("landing.catchPhrase")</h4>
                </div>
            </div>
        </div>
    </div>


</div>


<div class="container">
    <a class="anchor" id="features"></a>

    <div class="section">

        <!--   Icon Section   -->
        <div class="row">
            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center light-green-text"><i class="material-icons">access_time</i></h2>
                    <h5 class="center">@lang("landing.block1Title")</h5>

                    <p class="light justified">@lang("landing.block1Text")</p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center light-green-text"><i class="material-icons">group</i></h2>
                    <h5 class="center">@lang("landing.block2Title")</h5>

                    <p class="light justified">@lang("landing.block2Text")
                    </p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center light-green-text"><i class="material-icons">folder_shared</i></h2>
                    <h5 class="center">@lang("landing.block3Title")</h5>

                    <p class="light justified">@lang("landing.block3Text")</p>
                </div>
            </div>
        </div>

    </div>
    <br><br>
</div>
<div class="container">
    <a class="anchor" id="pricing"></a>

    <div class="divider"></div>

    <div class="section">
        <h3 class="center light-green-text">@lang("landing.pricing")</h3>
        @include("components.pricing",["size"=>" s12 m6 l3"])
    </div>
</div>
<div class="divider"></div>
<div class="container">
    <div class="row center">
        <h4 class="main-blue">@lang("landing.start4Free")</h4>
    </div>
    <div class="row center">
        <a href="{{route("register")}}"
           class="btn-large waves-effect waves-light light-green">@lang("landing.getStarted")</a>
    </div>
    <br><br>

</div>
@endsection
