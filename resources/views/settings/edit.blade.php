<div class="modal fade" id="myModal-Settings-edit" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Settings</h4>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
            <form id="form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Organizer Name</label>
                        <div>
                            <input class="form-control" name="organizer_name" id="organizer_name" type="text" value="{{ $settings->organizer_name }}">
                        </div>
                        <br />
                    </div>

                    <div class="form-group">
                        <label for="competition_type">Type of Competition</label>
                        <select id="competition_type" name="competition_type" class="form-control">
                                <option value="1" @if($settings->competition_type  == 1) selected @endif>Standard Competition</option>
                                <option value="2" @if($settings->competition_type  == 2) selected @endif>Relay Competition</option>
                        </select>
                        <br/>
                        <p class="text-red">Remember, if you change the Type of Competition, all data will be lost, because you change the configuration of the software.</p>
                        <p class="text-red">Note: UUID CARDS will be not deleted.</p>
                        <br />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="js--ajax-form-edit-settings-close btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-primary js--ajax-form-edit-settings-update" data-id="{{ $settings->id }}">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
