<div class="card pricing style-2 full-height">
    @if(isset($ribbon)&& $ribbon)
        <div class="ribbon"><span>POPULAR</span></div>
    @endif
    <div class="plan-title waves-effect waves-block waves-light blue darken-4">

        <h5 class="white-text">
            <span class="plan">{{$plan->name}}</span>
        </h5>
    </div>
    <div class="price waves-effect waves-block waves-light  blue darken-2">
        <h4 class="white-text">
            <span class="currency">€</span>
            <span class="amount">{{$plan->price}}</span>
            <span class="period">/mo</span>
        </h4>
    </div>
    <div class="card-content">
        <ul class="collection">
            <li class="collection-item"><b>{{$plan->max_con>100?"unlimited":$plan->max_con}}</b> condominiums</li>
            <li class="collection-item"><b>{{$plan->max_user>100?"unlimited":$plan->max_user}}</b> User Accounts</li>
            <li class="collection-item"><b>{{$plan->max_ticket>100?"unlimited":$plan->max_ticket}}</b> Tickets</li>
            @if($plan->can_chat)
                <li data-tooltip="directly communicate with your User avoiding email communication"
                    data-delay="10"
                    data-position="top"
                    class="collection-item tooltipped">Chat<i
                        class="material-icons right">info_outline</i></li>
            @endif

        </ul>
        <div class="card-action">
            @auth
                @if($plan->price > 0 && Request::route()->getName() !== "subscribe.show" )
                    @if(\Illuminate\Support\Facades\Auth::user()->subscription()->plan_id == $plan->id)
                        <a class="btn waves-effect waves-light blue darken-4 col s12"
                           href="{{route("subscribe.cancel")}}">Cancel</a>
                    @else
                        <a class="btn waves-effect waves-light blue darken-4 col s12"
                           href="{{route("subscribe.show",$plan->id)}}">Select</a>
                    @endif
                @endif
            @endauth
        </div>

    </div>
</div>
