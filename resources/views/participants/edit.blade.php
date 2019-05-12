<div class="modal fade" id="myModal-Participants-edit" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit {{ $participant->name }}</h4>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">

                <ul></ul>

            </div>
            <form id="form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Participant Name</label>
                        <div>
                            <input class="form-control" name="participant_name" id="name" type="text" value="{{ $participant->participant_name }}">
                        </div>
                        <br /><br />
                        <div class="div-left-input">
                            <label><strong>Club Name</strong></label>
                            <select id="clubs_id" name="clubs_id" class="form-control">
                                @foreach($clubs as $club)
                                    <option value="{{ $club->id }}" @if($club->id == $participant->clubs_id) selected @endif>{{ $club->club_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br /><br />
                        <div class="div-left-input">
                            <label><strong>UUID Card</strong></label>
                            <select id="uuidcards_id" name="uuidcards_id" class="form-control">
                                @foreach($uuidcards as $uuidcard)
                                    <option value="{{ $uuidcard->id }}" @if($uuidcard->id == $participant->uuidcards_id) selected @endif>No. #{{ $uuidcard->id }} ({{ $uuidcard->uuid_name }})</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="text-error errors_name"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="js--ajax-form-edit-participants-close btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-primary js--ajax-form-edit-participants-update" data-id="{{ $participant->id }}">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
