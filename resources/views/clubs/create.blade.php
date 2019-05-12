<div class="modal fade" id="myModal-Clubs-create" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a new Club</h4>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">

                <ul></ul>

            </div>
            <form id="form">
                {{ csrf_field() }}
                <div id="add-clubs" class="js--add-clubs">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Club Name</label>
                        <div>
                            <input class="form-control" name="club_name" id="club_name" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">City Name</label>
                        <div>
                            <input class="form-control" name="city" id="city" type="text" value="">
                        </div>
                    </div>
                    <br />
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="js--ajax-form-create-clubs-close btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-primary js--store-clubs">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>