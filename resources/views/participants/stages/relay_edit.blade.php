<div class="modal fade" id="myModal-Participants-Stages-edit" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit</h4>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
            <form id="form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="text-red">IMPORTANT: If you edit the participants stage and those participants have Time/Missed Posts/etc records those data will be lost and you need to import again the participants data.</div>
                    <br />
                    <div class="box box-success bg-gray">
                    <div class="form-group box-body">
                        <label><strong>Stage</strong></label>
                        <select id="stages_id" name="stages_id" class="form-control">
                            <option value="">-- select --</option>
                            @foreach($stages as $stage)
                                <option value="{{ $stage->id }}" @if($stage->id == $stagesID) selected @endif>{{ $stage->stage_name }}</option>
                            @endforeach
                        </select>
                        <br />
                    </div>
                    </div>
                    <br />
                    <div class="box box-success bg-gray">
                        <div class="form-group box-body">
                            <label><strong>Category</strong></label>
                            <select id="relay_category_id" name="relay_category_id" class="form-control enroll-participant-stage">
                                <option value="">-- select --</option>
                                @foreach($relay_categories as $category)
                                    <option value="{{ $category->id }}" @if($category->id == $participant_category_selected) selected @endif>{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            <br />
                        </div>
                    </div>
                    <br />
                    <h4>Participants </h4>
                    @foreach($relay_partipant_manager as $relay_partipant)
                    <div class="box box-primary bg-gray">
                        <div class="form-group box-body">
                            <div class="box-header with-border">
                                <h5 class="box-title">{{ $relay_partipant->participant_stage->participant_name }}</h5>
                            </div>
                            <input type="hidden" name="relay_participant_id[]" value="{{ $relay_partipant->relay_participant_id }}">
                            <input type="hidden" name="uuidcards_id[]" value="{{ $relay_partipant->uuidcards_id }}">
                            <input type="hidden" name="relay_participant_managers_id[]" value="{{ $relay_partipant->relay_participant_managers_id }}">
                            <br />
                            <label><strong>Route</strong></label>
                            <select id="routes_id" name="routes_id[]" class="form-control js--routes-selector">
                                <option value="">-- select --</option>
                                @foreach($routes_based_on_category_selected as $route_selected)
                                    <option value="{{ $route_selected->route->id }}" @if($route_selected->route->id == $relay_partipant->routes_id) selected @endif>{{ $route_selected->route->route_name }}</option>
                                @endforeach
                            </select>
                            <br />
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="js--ajax-form-create-participants-stages-close btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-primary js--ajax-form-relay-participants-stages-update js--add-value-participants-stages-id js--add-value-id" data-participants-id="{{ $participantID }}" data-id="{{ $stagesID  }}">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('.enroll-participant-stage').change(function(){
        var category_id = $(this).val();
        if(category_id.length !== 0){
            var $routes_selector = $('.js--routes-selector');
            participants_id_stages = {{ $participant->id }}
            $.ajax({
                type: 'POST',
                url: "/participants/"  + participants_id_stages +  "/stages/category/"+ category_id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'participants-id': participants_id_stages,
                    'category-id': category_id,
                },
                success: function(data) {
                    // reset selector state
                    $routes_selector.html('<option value="">-- select --</option>');
                    $.each(data.routes, function(index, item) {
                        $routes_selector.append('<option value="'+item.relay_route_id+'" >'+item.relay_route_name+'</option>');
                    });
                },
                error: function (data) {
                    // reset selector state
                    $routes_selector.html('<option value="">-- select --</option>');
                }
            });
        } else {
            var $routes_selector = $('.js--routes-selector');
            $routes_selector.html('<option value="">-- select --</option>');

        }
    });
</script>
