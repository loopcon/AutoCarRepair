@if($mslots->count())
    <div class="afternoon-slot-sec-main">
        <h4><span>slots</span>Morning Slot</h4>
        <div class="row m-0">
            @foreach($mslots as $slot)
                <div class="col-12 col-sm-3">
                    <a class="btn afternoon-slot-btn slot-btn" data-id="{{$slot->time}}">{{$slot->time}}</a>
                </div>
            @endforeach
        </div>
    </div>
@endif
@if($aslots->count())
    <div class="afternoon-slot-sec-main">
        <h4><span>slots</span>Afternoon Slot</h4>
        <div class="row m-0">
            @foreach($aslots as $slot)
                <div class="col-12 col-sm-3">
                    <a class="btn afternoon-slot-btn slot-btn" data-id="{{$slot->time}}">{{$slot->time}}</a>
                </div>
            @endforeach
        </div>
    </div>
@endif
@if($eslots->count())
    <div class="evening-slot-sec-main">
        <h4><span>slots</span>Evening Slot</h4>
        <div class="row">
            @foreach($eslots as $slot)
                <div class="col-12 col-sm-3">
                    <a class="btn evening-slot-btn slot-btn" data-id="{{$slot->time}}">{{$slot->time}}</a>
                </div>
            @endforeach
        </div>
    </div>
@endif