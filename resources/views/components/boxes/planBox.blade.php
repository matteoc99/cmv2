
        <div class="card pricing style-2 full-height">
            @if(isset($ribbon)&& $ribbon)
                <div class="ribbon"><span>@lang("plan.popular")</span></div>
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
                    <span class="period">/@lang("plan.monthAbbreviation")</span>
                </h4>
            </div>
            <div class="card-content">
                <ul class="collection">
                    <li class="collection-item black-text"><b>{{$plan->max_con>100000?"unlimited":$plan->max_con}}</b>
                        @lang("plan.condominia")
                    </li>
                    <li class="collection-item black-text"><b>{{$plan->max_user>100000?"unlimited":$plan->max_user}}</b>
                        @lang("plan.userAccounts")
                    </li>
                    <li class="collection-item black-text">
                        <b>{{$plan->max_ticket>100000?"unlimited":$plan->max_ticket}}</b> @lang("plan.tickets")
                    </li>
                    @if($plan->can_chat)
                        <li data-tooltip="@lang("plan.chatTooltip")"
                            data-delay="10"
                            data-position="top"
                            class="collection-item tooltipped black-text">@lang("plan.chat")<i
                                class="material-icons right black-text">info_outline</i></li>
                    @endif
                    @if($plan->can_documents)
                        <li data-tooltip="@lang("plan.documentTooltip")"
                            data-delay="10"
                            data-position="top"
                            class="collection-item tooltipped black-text"><b>{{$plan->max_gb}}
                                GB</b> @lang("plan.document")<i
                                class="material-icons right black-text">info_outline</i></li>
                    @endif

                </ul>
                @auth
                    <div class="card-action">
                        @if($plan->price > 0 && Request::route()->getName() !== "subscribe.show" )
                            @if(\Illuminate\Support\Facades\Auth::user()->subscription()->plan_id == $plan->id)
                                <a class="btn waves-effect waves-light blue darken-4 col s12"
                                   href="{{route("subscribe.cancel")}}">@lang("plan.cancel")</a>
                            @else
                                <a class="btn waves-effect waves-light blue darken-4 col s12"
                                   href="{{route("subscribe.show",$plan->id)}}">@lang("plan.select")</a>
                            @endif
                        @endif
                    </div>
                @endauth

            </div>
        </div>

