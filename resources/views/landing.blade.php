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
                    <h1 class="white-text half-transp-bg">Condominium Manager</h1>
                </div>
                <div class="row center">
                    <h4 class="white-text half-transp-bg">The All-In-One Condominium Administration Tool</h4>
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
                    <h5 class="center">Speeds Up Administration Tasks</h5>

                    <p class="light justified">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id semper
                        ante.
                        Fusce ultrices nec libero viverra tincidunt. Pellentesque auctor aliquet nulla, in imperdiet
                        lacus tincidunt quis.
                        Fusce facilisis cursus eros, eu consectetur justo elementum sed. Curabitur id eros sit amet
                        tellus dignissim lacinia euismod at nunc.
                        Integer egestas vulputate ornare. Vivamus interdum nulla neque, quis sollicitudin mi pulvinar
                        et.
                        Ut et scelerisque ex. Cras nunc nisl, vestibulum eu diam a</p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center light-green-text"><i class="material-icons">group</i></h2>
                    <h5 class="center">User Experience Focused</h5>

                    <p class="light justified">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id semper
                        ante.
                        Fusce ultrices nec libero viverra tincidunt. Pellentesque auctor aliquet nulla, in imperdiet
                        lacus tincidunt quis.
                        Fusce facilisis cursus eros, eu consectetur justo elementum sed. Curabitur id eros sit amet
                        tellus dignissim lacinia euismod at nunc.
                        Integer egestas vulputate ornare. Vivamus interdum nulla neque, quis sollicitudin mi pulvinar
                        et.
                        Ut et scelerisque ex. Cras nunc nisl, vestibulum eu diam a
                    </p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center light-green-text"><i class="material-icons">folder_shared</i></h2>
                    <h5 class="center">Easy to Organize Work</h5>

                    <p class="light justified">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id semper
                        ante.
                        Fusce ultrices nec libero viverra tincidunt. Pellentesque auctor aliquet nulla, in imperdiet
                        lacus tincidunt quis.
                        Fusce facilisis cursus eros, eu consectetur justo elementum sed. Curabitur id eros sit amet
                        tellus dignissim lacinia euismod at nunc.
                        Integer egestas vulputate ornare. Vivamus interdum nulla neque, quis sollicitudin mi pulvinar
                        et.
                        Ut et scelerisque ex. Cras nunc nisl, vestibulum eu diam a</p>
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
        <h3 class="center light-green-text">Pricing</h3>
        @include("components.pricing")
    </div>
</div>
<div class="divider"></div>
<div class="container">
    <div class="row center">
        <h4 class="main-blue">Start now for Free and Upgrade your plan based on your needs</h4>
    </div>
    <div class="row center">
        <a href="{{route("register")}}"
           class="btn-large waves-effect waves-light light-green">Get Started for Free</a>
    </div>
    <br><br>

</div>
@endsection
