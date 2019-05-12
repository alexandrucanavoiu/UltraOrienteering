<script>
    $(document).ready(function() {
        if (typeof($.fn.inputmask) == 'function') {
            $(".time").inputmask("h:s:s",{ "placeholder": "hh:mm:ss" });
        }
    });
</script>
<div class="modal fade" id="myModal-Participants-Stages-Management-edit" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Stage <strong>{{ $participants_stage->stage->stage_name }}</strong></h4>
                <h4>Participant: <strong>{{ $participants_stage->participant_stage->participant_name }}</strong></h4>
                <h4>Category: <strong>{{ $participants_stage->category->category_name }} / Route: {{ $participants_stage->route->route_name }}</strong></h4>
                <h4>UUID CARD: <strong>Nr #{{ $participants_stage->uuidcard->id }} /  {{ $participants_stage->uuidcard->uuid_name }}</strong></h4>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
            <form id="form">
                {{ csrf_field() }}
                <div class="modal-body">
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
                    <button type="button" class="js--ajax-form-create-participants-stages-management-close btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-primary js--update-relay-participant-management-stages js--add-value-id"  data-id="{{ $participants_stage->id }}">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
