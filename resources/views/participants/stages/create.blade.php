<div class="modal fade" id="myModal-Participants-Stages-create" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Enroll <strong>{{ $participant->participant_name }}</strong> to a new Stage</h4>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
            <form id="form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label><strong>Stage</strong></label>
                        <select id="stages_id" name="stages_id" class="form-control">
                            <option value="">-- select --</option>
                            @foreach($stages as $stage)
                                <option value="{{ $stage->id }}">{{ $stage->stage_name }}</option>
                            @endforeach
                        </select>
                        <br />
                    </div>
                    <div class="form-group">
                        <label><strong>Category</strong></label>
                        <select id="categories_id" name="categories_id" class="form-control">
                            <option value="">-- select --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <br />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="js--ajax-form-create-participants-stages-close btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-primary js--ajax-form-participants-stages-create" data-id="{{ $participant->id }}">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
