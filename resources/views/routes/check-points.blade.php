<script type="text/javascript">
    $(document).ready(function() {
                //Input fields increment limitation
        var maxField = 5;

        //Add button selector
        var addButton_1 = $('.add_check_point_new');
        //Input field wrapper
        var wrapper_1 = $('.add_check_point');



        //New input field html
        var fieldHTML_1 = '<div class="form-group"><label for="post_code_finish" class="col-sm-3 control-label">Check Point #<span></span></label><div class="col-sm-3"><input type="text" class="form-control" value=""  name="post_code[]"></div><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div>';

        //Initial field counter is 1
        var x = 1;
        var count_check_points = '<?php echo $count_check_points; ?>';

        function setCheckpointIndexes(){
            $(".posts [for='post_code_finish'] span").each(function(postIndex){
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
                count_check_points++;

                // Add field html
                var fNode = $(fieldHTML_1);
                $("[for='post_code_finish'] span", fNode).append(count_check_points + "");
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
            count_check_points--;
            setCheckpointIndexes();
        });

    });
</script>
<div class="modal fade" id="myModal-Routes-Manager" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Check Points for route {{ $route_info->route_name }}</h4>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>

            <form class="form-horizontal posts">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="post_code_start" class="col-sm-3 control-label">START</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="post_code_start" value="251" name="post_code[]" placeholder="251" disabled>
                        </div>
                    </div>
                    @foreach($check_points as $post)
                    <div class="form-group">
                        <label for="post_code_finish" class="col-sm-3 control-label">Check Point #<span>{{ $count_number++ }}</span></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" value="{{ $post->post_code }}"  name="post_code[]">
                        </div>
                        <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                    </div>
                    @endforeach
                    <div class="add_check_point"></div>
                    <div class="form-group">
                        <label for="post_code_finish" class="col-sm-3 control-label">FINISH</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="post_code_start" value="252" name="post_code[]" placeholder="252" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                           <a href="javascript:void(0);" class="add_check_point_new btn bg-olive margin" title="Add field"><img src="/images/add-icon.png"/> Add a new check point</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-default js--ajax-form-edit-check-points-close">Cancel</button>
                    <button type="submit" data-id="{{ $route_info->id }}" class="btn bg-primary margin pull-right js--store-check-points ">Save</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>