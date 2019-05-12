<div class="modal fade" id="myModal-Clubs-edit" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit {{ $club->clubs_name }}</h4>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">

                <ul></ul>

            </div>
            <form id="form">
                {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Club Name</label>
                            <div>
                                <input class="form-control" name="club_name" id="club_name" type="text" value="{{ $club->club_name }}">
                            </div>
                            <br />
                            <div class="stage_date div-left-input">
                                <label><strong>City Name</strong></label>
                                <input class="form-control" type="text" class="city" id="city" name="city" value="{{ $club->city }}">
                            </div>
                            <span class="text-error errors_name"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="js--ajax-form-edit-clubs-close btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" id="save" class="btn btn-primary js--ajax-form-edit-clubs-update" data-id="{{ $club->id }}">Save</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>
