<div class="modal fade" id="myModal-Participants-create" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a new Participant</h4>
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
                            <input class="form-control" name="participant_name" id="participant_name" type="text" value="">
                        </div>
                        <br />
                        <div class="div-left-input">
                            <label><strong>Club Name</strong></label>
                            <select id="clubs_id" name="clubs_id" class="form-control">
                                <option value="" selected>Please select</option>
                                @foreach($clubs as $club)
                                    <option value="{{ $club->id }}">{{ $club->club_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br />
                        <div class="div-left-input">
                            <label><strong>UUID Card</strong></label>
                            <select id="uuidcards_id" name="uuidcards_id" class="form-control">
                                @foreach($uuidCards as $uuidcard)
                                    <option value="{{ $uuidcard->id }}"> No. #{{ $uuidcard->id }} - {{ $uuidcard->uuid_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="text-error errors_name"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="js--ajax-form-create-participants-close btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-primary js--store-participants">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
