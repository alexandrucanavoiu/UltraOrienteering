<script type="text/javascript">
    $(document).ready(function() {
        //Input fields increment limitation
        var maxField = 30;

        //Add button selector
        var addButton_1 = $('.add_new_participant');
        //Input field wrapper
        var wrapper_1 = $('.add_participant');
        var count_check_points = 2;



        //New input field html
        var fieldHTML_1 = '<div class="added box box-primary bg-gray"><div class="form-group box-body"> <label for="name">(<span>2</span>) Participant Name </label><div> <input class="form-control" name="participant_name[]" id="participant_name" type="text" value=""></div> <br /><div class="div-left-input"> <label><strong>UUID Card</strong></label> <select id="uuidcards_id" name="uuidcards_id[]" class="form-control participant_name"> @foreach($uuidCards as $uuidcard)<option value="{{ $uuidcard->id }}"> No. #{{ $uuidcard->id }} - {{ $uuidcard->uuid_name }}</option> @endforeach </select></div></div><a href="javascript:void(0);" class="remove_button text-red" title="Remove field"><li class="fa  fa-remove"></li> Remove *</div>';

        //Initial field counter is 1
        var x = 1;

        function setCheckpointIndexes(){
            $("#form label[for='name'] span").each(function(postIndex){
                var elem = $(this);
                elem.html(postIndex + 1);
            });
        };

        //Once add button is clicked
        $(addButton_1).click(function() {

            //Check maximum number of input fields
            if(x < maxField){

                //Increment field counter
                x++;

                // Add field html
                //$(wrapper_1).append(fieldHTML_1);
                var fNode = $(fieldHTML_1);
                $("[for='added'] span", fNode).append(count_check_points + "");
                $(wrapper_1).append(fNode);
            }
            setCheckpointIndexes();
        });


        $(document).on('click', '.remove_button', function(e) {
            //Once remove button is clicked
            e.preventDefault();

            //Remove field html
             $(this).parent('div').remove();
            //Decrement field counter
            x--;
            setCheckpointIndexes();
        });

    });
</script>
<div class="modal fade" id="myModal-Participants-create" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a new Participants</h4>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">

                <ul></ul>

            </div>
            <form id="form">
                {{ csrf_field() }}

                <div class="modal-body">
                    <div class="added box box-primary bg-gray">
                    <div class="form-group box-body">
                        <div class="div-left-input">
                            <label><strong>Club Name</strong></label>
                            <select id="clubs_id" name="clubs_id" class="form-control">
                                <option value="" selected>Please select</option>
                                @foreach($clubs as $club)
                                    <option value="{{ $club->id }}">{{ $club->club_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="added box box-primary bg-gray">
                        <div class="form-group box-body">
                            <label for="name">(<span>1</span>) Participant Name </label>
                            <div>
                                <input class="form-control" name="participant_name[]" id="participant_name" type="text" value="">
                            </div>
                            <br />
                            <div class="div-left-input">
                                <label><strong>UUID Card</strong></label>
                                <select id="uuidcards_id" name="uuidcards_id[]" class="form-control participant_name">
                                    @foreach($uuidCards as $uuidcard)
                                        <option value="{{ $uuidcard->id }}"> No. #{{ $uuidcard->id }} - {{ $uuidcard->uuid_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br />
                    </div>
                    <div class="added box box-primary bg-gray">
                        <div class="form-group box-body">
                            <label for="name">(<span>2</span>) Participant Name </label>
                            <div>
                                <input class="form-control" name="participant_name[]" id="participant_name" type="text" value="">
                            </div>
                            <br />
                            <div class="div-left-input">
                                <label><strong>UUID Card</strong></label>
                                <select id="uuidcards_id" name="uuidcards_id[]" class="form-control participant_name">
                                    @foreach($uuidCards as $uuidcard)
                                        <option value="{{ $uuidcard->id }}"> No. #{{ $uuidcard->id }} - {{ $uuidcard->uuid_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br />
                    </div>
                    <div class="add_participant"></div>
                </div>

                <div class="modal-footer">
                    <a href="javascript:void(0);" class="add_new_participant btn bg-olive margin" title="Add field"><img src="/images/add-icon.png"/> Add a new participant</a>
                    <button type="button" class="js--ajax-form-create-participants-close btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-primary js--store-relay-participants">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
