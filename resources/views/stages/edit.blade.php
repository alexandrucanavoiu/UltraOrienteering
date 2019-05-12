<div class="modal fade" id="myModal-Stages-edit" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit {{ $stage->stage_name }} Stage</h4>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">

                <ul></ul>

            </div>
            <form id="form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Stage Name</label>
                        <div>
                            <input class="form-control" name="stage_name" id="stage_name" value="{{ $stage->stage_name }}" type="text" value="">
                        </div>
                        <br />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="js--ajax-form-edit-stages-close btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-primary js--ajax-form-edit-stages-update" data-id="{{ $stage->id }}">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
