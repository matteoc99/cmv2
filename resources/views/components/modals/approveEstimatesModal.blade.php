
<div id="approveEstimatesModal" class="modal">
    <div class="modal-content">
        @foreach($estimates as $estimate)
            <div class="row">
                @include("components.boxes.approvableEstimateBox",["estimate"=>$estimate])
            </div>
        @endforeach
    </div>
</div>
