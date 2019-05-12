<script>
    $(document).ready(function() {
        if (typeof($.fn.inputmask) == 'function') {
            $(".time").inputmask("h:s:s",{ "placeholder": "hh:mm:ss" });
        }
    });
</script>
<div class="modal fade" id="myModal-Participants-Stages-edit" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Stage <strong>{{ $participants_stage->stage->stage_name }}</strong></h4>
                Participant: {{ $participants_stage->participant->participant_name }}
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
                                <option value="{{ $stage->id }}" @if($stage->id == $participants_stage->stages_id) selected @endif>{{ $stage->stage_name }}</option>
                            @endforeach
                        </select>
                        <br />
                    </div>
                    <div class="form-group">
                        <label><strong>Category</strong></label>
                        <select id="categories_id" name="categories_id" class="form-control">
                            <option value="">-- select --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $participants_stage->categories_id) selected @endif>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <br />
                    </div>
                    <div class="form-group">
                        <label><strong>Start Time</strong></label>
                        <input class="form-control time" name="start_time" id="start_time" value="{{ $participants_stage->start_time }}" placeholder="hh:mm:ss" oninput="setCustomValidity('')" type="text">
                        <br />
                    </div>

                    <div class="form-group">
                        <label><strong>Finish Time</strong></label>
                        <input class="form-control time" name="finish_time" id="finish_time" value="{{ $participants_stage->finish_time }}"  placeholder="hh:mm:ss" oninput="setCustomValidity('')" type="text">
                        <br />
                    </div>
                    <div class="form-group">
                        <label><strong>Abandon</strong></label>
                        <select id="abandon" name="abandon" class="form-control">
                                <option value="0" @if(0 == $participants_stage->abandon) selected @endif>No</option>
                                <option value="1" @if(1 == $participants_stage->abandon) selected @endif>Yes</option>
                        </select>
                        <br />
                    </div>
                    <div class="form-group">
                        <label><strong>Missed Posts</strong></label>
                        <input class="form-control" name="missed_posts" id="missed_posts" value="{{ $participants_stage->missed_posts }}" type="text">
                        <br />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="js--ajax-form-create-participants-stages-close btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-primary js--ajax-form-participants-stages-update" data-participants-id="{{ $participants_stage->participants_id }}" data-stages-id="{{ $participants_stage->stages_id }}">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
