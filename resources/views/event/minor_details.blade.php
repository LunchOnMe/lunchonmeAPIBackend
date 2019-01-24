<div class="row padding-40">
    <div class="col-md-4">
        <strong>Event takes place at</strong><br>
        {{ $event['location']['value'] }}
    </div>
    <div class="col-md-4">
        <strong>300</strong> <br>
        out of {{ $event['attendance_limit'] }} attending <br>
        <a class="btn btn-primary btn-sm" href="#">List Attendants</a>
    </div>
    <div class="col-md-4"></div>
</div>
