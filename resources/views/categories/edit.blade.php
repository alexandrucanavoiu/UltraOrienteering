<div class="modal fade" id="myModal-Categories-edit" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Category</h4>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">

                <ul></ul>

            </div>
            <form id="form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <div>
                            <input class="form-control" name="category_name" id="category_name" type="text" value="{{ $category->category_name }}">
                        </div>
                        <br />
                    </div>

                    <div class="form-group">
                        <div>associate this category with a route:</div>
                        <br />
                    </div>

                    <div class="form-group">
                        <label for="name">Route Name</label>
                        <select id="routes_id" name="routes_id" class="form-control">
                            <option value="">-- select a route --</option>
                            @foreach($routes as $route)
                                <option value="{{ $route->id }}" @if($route->id  == $category->routes_id) selected @endif>{{ $route->route_name }}</option>
                            @endforeach
                        </select>
                        <br />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="js--ajax-form-edit-categories-close btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-primary js--ajax-form-edit-categories-update" data-id="{{ $category->id }}">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
