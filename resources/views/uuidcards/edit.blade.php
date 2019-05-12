<div class="modal fade" id="myModal-UUID-Cards-edit" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit a UUID CARD</h4>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">

                <ul></ul>

            </div>
            <form id="form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">UUID CARD</label>
                        <div>
                            <input type="text" name="uuid_name" value="{{ $uuidcard->uuid_name }}" class="form-control input-lg" placeholder="">
                        </div>
                        <span class="text-error errors_name"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="js--ajax-form-edit-uuid-cards-close btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-primary js--ajax-form-edit-uuid-cards-update" data-id="{{ $uuidcard->id }}">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>