@if($message->sender_id==\Illuminate\Support\Facades\Auth::user()->id)
    <div class="row">
        <div class="col s8 offset-s4">
            <!-- my message-->
            <div class="card" style="padding: 15px">
                <h5>{{\App\Models\User::where("id","=",$message->sender_id)->get()->first()->name()}}</h5>
                @foreach(explode("<br>",$message->message) as $msg)
                    <p style=" overflow-wrap: break-word; margin-bottom: 5px;margin-top: 5px">{{$msg}}</p>
                @endforeach
                @if($message->hasFile())
                    @if($message->hasImage())
                        <a href="{{$message->getFile()}}">
                            <img class="profile-pic " src="{{$message->getFile()}}">
                        </a>
                    @else
                        <a href="{{$message->getFile()}}"><i class="material-icons">file_download</i></a>
                    @endif
                @endif
                <p class="small">{{$message->created_at}}</p>
            </div>
        </div>
    </div>
@else
    @if(is_null($message->sender_id))
        <!-- status message-->
        <div class="row">
            <div class="col s8 offset-s2">
                <div class="card" style="padding: 15px">
                    @foreach(explode("<br>",$message->message) as $msg)
                        <p style=" overflow-wrap: break-word; margin-bottom: 5px;margin-top: 5px">{{$msg}}</p>
                    @endforeach
                        <p class="small">{{$message->created_at}}</p>
                </div>
            </div>
        </div>
    @else
        <!-- other messages-->
        <div class="row">
            <div class="col s8 ">
                <div class="card" style="padding: 15px">
                    <h5>{{\App\Models\User::where("id","=",$message->sender_id)->get()->first()->name()}}</h5>
                    @foreach(explode("<br>",$message->message) as $msg)
                        <p style=" overflow-wrap: break-word; margin-bottom: 5px;margin-top: 5px">{{$msg}}</p>
                    @endforeach
                    <p class="small">{{$message->created_at}}</p>
                </div>
            </div>
        </div>
    @endif
@endif

