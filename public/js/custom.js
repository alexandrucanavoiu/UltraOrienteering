function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
}

// Alocate ID
$(document).on("click", ".js--add-value-id", function () {
    get_the_id_value = $(this).data('id');
});

$(document).on("click", ".js--add-value-participants-stages-id", function () {
    participants_id = $(this).data('participants-id');
});

$(document).on("click", ".js--add-value-stages-id", function () {
    participant_stages_id = $(this).data('stages-id');
});

// Settings

$(document).on("click", "#myModal-Settings-edit .close, .js--ajax-form-edit-settings-close, .js--ajax-form-create-settings-close", function(e)
{
    $('#myModal-Settings-edit').remove();
    $('.modal-backdrop').remove();
    $('.sidebar-mini').removeClass('modal-open');
    $('.sidebar-mini').css("padding-right", "");

});

$(document).on("click", ".js--edit-settings", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/settings/edit",
        dataType: 'html',
        success: function (view) {
            $('#myModal-Settings-edit').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-Settings-edit').length > 0 )
            {
                $('#myModal-Settings-edit').remove();
            }
            $('body').append(view);
            $('#myModal-Settings-edit').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});

$("body").delegate('.js--ajax-form-edit-settings-update', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var organizer_name = $("input[name='organizer_name']").val();
    var competition_type = $("#competition_type").val();
    formData.append("_token", _token);
    formData.append("organizer_name", organizer_name);
    formData.append("competition_type", competition_type);
    var request = new XMLHttpRequest();
    request.open("POST", "/settings/update");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);

    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                $('.modal-backdrop').remove();
                $(".settings-organizer-name-" + data.id).html(data.organizer_name);
                $(".settings-competition-" + data.id).html(data.competition_type);
                $('#myModal-Settings-edit').modal('toggle');
                $('#myModal-Settings-edit').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                toastr.success(data.success);
            }else{
                printErrorMsg(data.error);
            }
        }
    }
});

// UUIDs

$(document).on("click", "#myModal-UUID-Cards-edit .close, .js--ajax-form-edit-uuid-cards-close", function(e)
{
    $('#myModal-UUID-Cards-edit').remove();
    $('.modal-backdrop').remove();
    $('.sidebar-mini').removeClass('modal-open');
    $('.sidebar-mini').css("padding-right", "");

});

$(document).on("click", ".js--edit-uuid-cards", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/uuid-cards/" + $(this).data('id') + "/edit",
        dataType: 'html',
        success: function (view) {
            $('#myModal-UUID-Cards-edit').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-UUID-Cards-edit').length > 0 )
            {
                $('#myModal-UUID-Cards-edit').remove();
            }
            $('body').append(view);
            $('#myModal-UUID-Cards-edit').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});

$("body").delegate('.js--ajax-form-edit-uuid-cards-update', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var uuid_name = $("input[name='uuid_name']").val();

    formData.append("_token", _token);
    formData.append("uuid_name", uuid_name);
    var request = new XMLHttpRequest();
    request.open("POST", "/uuid-cards/"  + $(this).data('id') +  "/update");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);

    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                $('.modal-backdrop').remove();
                $(".uuid-cards-" + data.id).html(uuid_name);
                $('#myModal-UUID-Cards-edit').modal('toggle');
                $('#myModal-UUID-Cards-edit').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                toastr.success(data.success);
            }else{
                printErrorMsg(data.error);
            }
        }
    }
});

$('#myModal-UUID-Cards-drop').on('click', '#confirm-delete', function() {
    $.ajax({
        type: 'GET',
        url: "/uuid-cards/clean-all",
        data: {
            '_token': $('input[name=_token]').val(),
        },
        success: function(data) {
            location.href = "/uuid-cards"
        },
        error: function (data) {
            var data2 = JSON.parse(data.responseText);
            $('#myModal-UUID-Cards-drop').modal('toggle');
            $('#myModal-UUID-Cards-drop').hide();
            toastr.warning(data2.warning);
        }
    });
});

// Stages

$(document).on("click", "#myModal-Stages-edit .close, .js--ajax-form-edit-stages-close, .js--ajax-form-create-stages-close, #myModal-Stages-create .close", function(e)
{
    $('#myModal-Stages-edit').remove();
    $('#myModal-Stages-create').remove();
    $('.modal-backdrop').remove();
    $('.sidebar-mini').removeClass('modal-open');
    $('.sidebar-mini').css("padding-right", "");

});

$(document).on("click", ".js--create-stages", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/stages/create",
        dataType: 'html',
        success: function (view) {
            $('#myModal-Stages-create').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-Stages-create').length > 0 )
            {
                $('#myModal-Stages-create').remove();
            }
            $('body').append(view);
            $('#myModal-Stages-create').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});

$("body").delegate('.js--store-stages', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();

    var _token = $("input[name='_token']").val();
    var stage_name = $("input[name='stage_name']").val();


    formData.append("_token", _token);
    formData.append("stage_name", stage_name);
    var request = new XMLHttpRequest();
    request.open("POST", "/stages/create");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                toastr.success(data.success);
                $('#myModal-Stages-create').modal('toggle');
                $('#myModal-Stages-create').remove();
                $('.modal-backdrop').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                var check_count = data.check_count;
                if(check_count > 0){
                    $('.dataTables_empty ').remove();
                    $('.dataTables_info').remove();
                    $('.no-stages').removeClass('show').addClass('hide');
                }
                $(".stages tbody").append($(' <tr class="stages-tr stages-list-' + data.id + '"><td class="stage-name-' + data.id + '">' + data.stage_name + '</td><td class="center"><a class="btn btn-primary btn-flat margin js--edit-stages" data-id="' + data.id + '" data-toggle="modal" data-target="edit-stages" href="#">Edit</a> <a  href="" data-id="' + data.id + '" class="delete btn btn-danger btn-flat margin js--add-value-id" data-toggle="modal" data-target="#myModal-Stages-delete">Delete</a></td></tr>'));


            }else{
                printErrorMsg(data.error);
                $("#myModal-Stages-create").scrollTop( 0 );
            }
        }
    }

});

$(document).on("click", ".js--edit-stages", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/stages/" + $(this).data('id') + "/edit",
        dataType: 'html',
        success: function (view) {
            $('#myModal-Stages-edit').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-Stages-edit').length > 0 )
            {
                $('#myModal-Stages-edit').remove();
            }
            $('body').append(view);
            $('#myModal-Stages-edit').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});

$("body").delegate('.js--ajax-form-edit-stages-update', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var stage_name = $("input[name='stage_name']").val();


    formData.append("_token", _token);
    formData.append("stage_name", stage_name);
    var request = new XMLHttpRequest();
    request.open("POST", "/stages/"  + $(this).data('id') +  "/update");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);

    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                $('.modal-backdrop').remove();
                $(".stage-name-" + data.id).html(data.stage_name);
                $('#myModal-Stages-edit').modal('toggle');
                $('#myModal-Stages-edit').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                toastr.success(data.success);
            }else{
                printErrorMsg(data.error);
            }
        }
    }
});

$('#myModal-Stages-delete').on('click', '#confirm-delete', function() {
    $.ajax({
        type: 'get',
        url: "/stages/"  + get_the_id_value +  "/delete",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': get_the_id_value,
        },
        success: function(data) {
            $(".stages-list-" + get_the_id_value).remove();
            var check_count = data.check_count;
            if(check_count == 0){
                $('.clubs-box-table').remove();
                $('.dataTables_empty ').remove();
                $('.dataTables_info').remove();
                $('.no-stages').removeClass('hide').addClass('show');
            }
            $('#myModal-Stages-delete').modal('toggle');
            $('#myModal-Stages-delete').hide();
            toastr.success(data.success);
        },
        error: function (data) {
            var data2 = JSON.parse(data.responseText);
            $('#myModal-Stages-delete').modal('toggle');
            $('#myModal-Stages-delete').hide();
            toastr.warning(data2.warning);
        }
    });
});

// Routes

$(document).on("click", "#myModal-Routes-edit .close, .js--ajax-form-edit-routes-close, .js--ajax-form-create-routes-close, #myModal-Routes-create .close", function(e)
{
    $('#myModal-Routes-edit').remove();
    $('#myModal-Routes-create').remove();
    $('.modal-backdrop').remove();
    $('.sidebar-mini').removeClass('modal-open');
    $('.sidebar-mini').css("padding-right", "");

});

$(document).on("click", ".js--create-routes", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/routes/create",
        dataType: 'html',
        success: function (view) {
            $('#myModal-Routes-create').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-Routes-create').length > 0 )
            {
                $('#myModal-Routes-create').remove();
            }
            $('body').append(view);
            $('#myModal-Routes-create').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});

$("body").delegate('.js--store-routes', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var route_name = $("input[name='route_name']").val();
    formData.append("_token", _token);
    formData.append("route_name", route_name);
    var request = new XMLHttpRequest();
    request.open("POST", "/routes/create");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                toastr.success(data.success);
                $('#myModal-Routes-create').modal('toggle');
                $('#myModal-Routes-create').remove();
                $('.modal-backdrop').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                var check_count = data.check_count;
                if(check_count > 0){
                    $('.dataTables_empty ').remove();
                    $('.dataTables_info').remove();
                    $('.no-routes').removeClass('show').addClass('hide');
                }
                $(".routes tbody").append($('<tr class="routes-list-' + data.id + '"><td class="route-name-' + data.id + '">' + data.route_name + '</td><td class="route-check-points-' + data.id + ' center"><button type="button" class="btn bg-olive btn-flat margin check-point-manager" data-id="' + data.id + '" data-toggle="modal" data-target="#myModal-Routes-Manager">Check Points</button></td><td class="center"><button type="button" class="btn btn-primary btn-flat margin js--edit-routes" data-id="' + data.id + '" data-toggle="modal" data-target="edit-routes">Edit</button><button type="button" class="delete btn btn-danger btn-flat margin js--add-value-id" data-id="' + data.id + '" data-toggle="modal" data-target="#myModal-Routes-delete">Delete</button></td></tr>'));
            }else{
                printErrorMsg(data.error);
                $("#myModal-Stages-create").scrollTop( 0 );
            }
        }
    }

});

$(document).on("click", ".js--edit-routes", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/routes/" + $(this).data('id') + "/edit",
        dataType: 'html',
        success: function (view) {
            $('#myModal-Routes-edit').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-Routes-edit').length > 0 )
            {
                $('#myModal-Routes-edit').remove();
            }
            $('body').append(view);
            $('#myModal-Routes-edit').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});

$("body").delegate('.js--ajax-form-edit-routes-update', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var route_name = $("input[name='route_name']").val();


    formData.append("_token", _token);
    formData.append("route_name", route_name);
    var request = new XMLHttpRequest();
    request.open("POST", "/routes/"  + $(this).data('id') +  "/update");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);

    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                $('.modal-backdrop').remove();
                $(".route-name-" + data.id).html(data.route_name);
                $('#myModal-Routes-edit').modal('toggle');
                $('#myModal-Routes-edit').remove();
                $('.sidebar-mini').removeClass('modal-open');
                toastr.success(data.success);
            }else{
                printErrorMsg(data.error);
            }
        }
    }
});

$('#myModal-Routes-delete').on('click', '#confirm-delete', function() {
    $.ajax({
        type: 'get',
        url: "/routes/"  + get_the_id_value +  "/delete",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': get_the_id_value,
        },
        success: function(data) {
            $(".routes-list-" + get_the_id_value).remove();
            var check_count = data.check_count;
            if(check_count == 0){
                $('.clubs-box-table').remove();
                $('.dataTables_empty ').remove();
                $('.dataTables_info').remove();
                $('.no-routes').removeClass('hide').addClass('show');
            }
            $('#myModal-Routes-delete').modal('toggle');
            $('#myModal-Routes-delete').hide();
            toastr.success(data.success);
        },
        error: function (data) {
            var data2 = JSON.parse(data.responseText);
            $('#myModal-Routes-delete').modal('toggle');
            $('#myModal-Routes-delete').hide();
            toastr.warning(data2.warning);
        }
    });
});


// RouteManager Check Points

$(document).on("click", ".check-point-manager", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/routes/"  + $(this).data('id') +  "/check-points",
        dataType: 'html',
        success: function (view) {
            $('#myModal-Routes-Manager').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-Routes-Manager').length > 0 )
            {
                $('#myModal-Routes-Manager').remove();
            }
            $('body').append(view);
            $('#myModal-Routes-Manager').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});

$("body").delegate('.js--store-check-points', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    //var post_code = $("input[name='post_code[]']").val();
    var post_code = $(".posts input[name='post_code[]']").map(function(){return $(this).val();}).get();
    console.log(post_code);
    formData.append("_token", _token);
    formData.append("post_code", post_code);
    var request = new XMLHttpRequest();
    request.open("POST", "/routes/"  + $(this).data('id') +  "/check-points");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            //console.log(request.responseText);
            var data = JSON.parse(request.responseText);
            //console.log(data);
            if($.isEmptyObject(data.error)){
                toastr.success(data.success);
                $('#myModal-Routes-Manager').modal('toggle');
                $('#myModal-Routes-Manager').remove();
                $('.modal-backdrop').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
            }else{
                printErrorMsg(data.error);
                $("#myModal-Routes-Manager").scrollTop( 0 );
            }
        }
    }

});

$(document).on("click", "#myModal-Routes-Manager .close, .js--ajax-form-edit-check-points-close", function(e)
{
    $('#myModal-Routes-Manager').remove();
    $('.modal-backdrop').remove();
    $('.sidebar-mini').removeClass('modal-open');
    $('.sidebar-mini').css("padding-right", "");

});

// Categories

$(document).on("click", "#myModal-Categories-edit .close, .js--ajax-form-edit-categories-close, .js--ajax-form-create-categories-close, #myModal-Categories-create .close", function(e)
{
    $('#myModal-Categories-edit').remove();
    $('#myModal-Categories-create').remove();
    $('.modal-backdrop').remove();
    $('.sidebar-mini').removeClass('modal-open');
    $('.sidebar-mini').css("padding-right", "");

});

$(document).on("click", ".js--create-categories", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/categories/create",
        dataType: 'html',
        success: function (view) {
            $('#myModal-Categories-create').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-Categories-create').length > 0 )
            {
                $('#myModal-Categories-create').remove();
            }
            $('body').append(view);
            $('#myModal-Categories-create').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});

$("body").delegate('.js--store-categories', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var category_name = $("input[name='category_name']").val();
    var routes_id = $("#routes_id").val();
    formData.append("_token", _token);
    formData.append("category_name", category_name);
    formData.append("routes_id", routes_id);
    var request = new XMLHttpRequest();
    request.open("POST", "/categories/create");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                toastr.success(data.success);
                $('#myModal-Categories-create').modal('toggle');
                $('#myModal-Categories-create').remove();
                $('.modal-backdrop').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                var check_count = data.check_count;
                if(check_count > 0){
                    $('.dataTables_empty ').remove();
                    $('.dataTables_info').remove();
                    $('.no-categories').removeClass('show').addClass('hide');
                }
                $(".categories tbody").append($('<tr class="categories-list-' + data.id + '"><td class="category-name-' + data.id + ' center">' + data.category_name +'</td><td class="route-name-' + data.id + ' center">' + data.route_name + '</td><td class="center"><button type="button" class="btn bg-primary btn-flat margin js--edit-categories" data-id="' + data.id + '" data-toggle="modal" data-target="edit-categories">Edit</button><button type="button" class="delete btn btn-danger btn-flat margin js--add-value-id" data-id="' + data.id + '" data-toggle="modal" data-target="#myModal-Categories-delete">Delete</button></td></tr>'));
            }else{
                printErrorMsg(data.error);
                $("#myModal-Stages-create").scrollTop( 0 );
            }
        }
    }

});

$("body").delegate('.js--store-relay-categories', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var category_name = $("input[name='category_name']").val();
    var routes_id = $('#routes_id').val();
    formData.append("_token", _token);
    formData.append("category_name", category_name);
    formData.append("routes_id", routes_id);
    var request = new XMLHttpRequest();
    request.open("POST", "/categories/create");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                toastr.success(data.success);
                $('#myModal-Categories-create').modal('toggle');
                $('#myModal-Categories-create').remove();
                $('.modal-backdrop').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                var check_count = data.check_count;
                if(check_count > 0){
                    $('.dataTables_empty ').remove();
                    $('.dataTables_info').remove();
                    $('.no-categories').removeClass('show').addClass('hide');
                }
                $(".categories tbody").append($('<tr class="categories-list-' + data.id + '"><td class="category-name-' + data.id + ' center">' + data.category_name +'</td><td class="route-name-' + data.id + ' center">' + data.route_name + '</td><td class="center"><button type="button" class="btn bg-primary btn-flat margin js--edit-categories" data-id="' + data.id + '" data-toggle="modal" data-target="edit-categories">Edit</button><button type="button" class="delete btn btn-danger btn-flat margin js--add-value-id" data-id="' + data.id + '" data-toggle="modal" data-target="#myModal-Categories-delete">Delete</button></td></tr>'));
            }else{
                printErrorMsg(data.error);
                $("#myModal-Stages-create").scrollTop( 0 );
            }
        }
    }

});

$(document).on("click", ".js--edit-categories", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/categories/" + $(this).data('id') + "/edit",
        dataType: 'html',
        success: function (view) {
            $('#myModal-Categories-edit').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-Categories-edit').length > 0 )
            {
                $('#myModal-Categories-edit').remove();
            }
            $('body').append(view);
            $('#myModal-Categories-edit').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});

$("body").delegate('.js--ajax-form-edit-categories-update', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var category_name = $("input[name='category_name']").val();
    var routes_id = $("#routes_id").val();
    formData.append("_token", _token);
    formData.append("category_name", category_name);
    formData.append("routes_id", routes_id);
    var request = new XMLHttpRequest();
    request.open("POST", "/categories/"  + $(this).data('id') +  "/update");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);

    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                $('.modal-backdrop').remove();
                $(".category-name-" + data.id).html(data.category_name);
                $(".route-name-" + data.id).html(data.route_name);
                $('#myModal-Categories-edit').modal('toggle');
                $('#myModal-Categories-edit').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                toastr.success(data.success);
            }else{
                printErrorMsg(data.error);
            }
        }
    }
});

$("body").delegate('.js--ajax-form-edit-relay-categories-update', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var category_name = $("input[name='category_name']").val();
    var routes_id = $("#routes_id").val();
    formData.append("_token", _token);
    formData.append("category_name", category_name);
    formData.append("routes_id", routes_id);
    var request = new XMLHttpRequest();
    request.open("POST", "/categories/"  + $(this).data('id') +  "/update");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);

    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                $('.modal-backdrop').remove();
                $(".category-name-" + data.id).html(data.category_name);
                $(".route-name-" + data.id).html(data.route_name);
                $('#myModal-Categories-edit').modal('toggle');
                $('#myModal-Categories-edit').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                toastr.success(data.success);
            }else{
                printErrorMsg(data.error);
            }
        } else {
            printErrorMsg(data.error);
        }
    }
});

$('#myModal-Categories-delete').on('click', '#confirm-delete', function() {
    $.ajax({
        type: 'get',
        url: "/categories/"  + get_the_id_value +  "/delete",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': get_the_id_value,
        },
        success: function(data) {
            $(".categories-list-" + get_the_id_value).remove();
            var check_count = data.check_count;
            if(check_count == 0){
                $('.clubs-box-table').remove();
                $('.dataTables_empty ').remove();
                $('.dataTables_info').remove();
                $('.no-categories').removeClass('hide').addClass('show');
            }
            $('#myModal-Categories-delete').modal('toggle');
            $('#myModal-Categories-delete').hide();
            toastr.success(data.success);
            rowCount = $('.categories tr').length;
            if(rowCount === 1){
                url_rowCount = "/categories";
                $(location).attr('href',url_rowCount);
            }
        },
        error: function (data) {
            var data2 = JSON.parse(data.responseText);
            $('#myModal-Categories-delete').modal('toggle');
            $('#myModal-Categories-delete').hide();
            toastr.warning(data2.warning);
        }
    });
});

// Clubs

$(document).on("click", "#myModal-Clubs-edit .close, .js--ajax-form-edit-clubs-close, .js--ajax-form-create-clubs-close, #myModal-Clubs-create .close", function(e)
{
    $('#myModal-Clubs-edit').remove();
    $('#myModal-Clubs-create').remove();
    $('.modal-backdrop').remove();
    $('.sidebar-mini').removeClass('modal-open');
    $('.sidebar-mini').css("padding-right", "");

});

$(document).on("click", ".js--create-clubs", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/clubs/create",
        dataType: 'html',
        success: function (view) {
            $('#myModal-Clubs-create').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-Clubs-create').length > 0 )
            {
                $('#myModal-Clubs-create').remove();
            }
            $('body').append(view);
            $('#myModal-Clubs-create').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});

$("body").delegate('.js--store-clubs', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();

    var _token = $("input[name='_token']").val();
    var club_name = $("input[name='club_name']").val();
    var city = $("input[name='city']").val();


    formData.append("_token", _token);
    formData.append("club_name", club_name);
    formData.append("city",city);

    var request = new XMLHttpRequest();
    request.open("POST", "/clubs/create");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                toastr.success(data.success);
                $('#myModal-Clubs-create').modal('toggle');
                $('#myModal-Clubs-create').remove();
                $('.modal-backdrop').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                var check_count = data.check_count;
                if(check_count > 0){
                    $('.dataTables_empty ').remove();
                    $('.dataTables_info').remove();
                    $('.no-clubs').removeClass('show').addClass('hide');
                }
                $("#clubs-list_wrapper tbody").append($('<tr class="clubs-list-' + data.id + '" role="row"><td class="sorting_1"><div class="club-name-' + data.id + '">' + data.club_name + '</div></td><td class=" center"><div class="city-' + data.city + '">' + data.city + '</div></td><td class=" center"><a class="btn bg-primary btn-flat margin js--edit-clubs" data-id="' + data.id + '" data-toggle="modal" data-target="edit-clubs" href="#">Edit</a> <a href="" data-id="' + data.id + '" class="delete btn btn-danger btn-flat margin js--add-value-id" data-toggle="modal" data-target="#myModal-Clubs-delete">Delete</a></td></tr>'));


            }else{
                printErrorMsg(data.error);
                $("#myModal-Clubs-create").scrollTop( 0 );
            }
        }
    }

});

$(document).on("click", ".js--edit-clubs", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/clubs/" + $(this).data('id') + "/edit",
        dataType: 'html',
        success: function (view) {
            $('#myModal-Clubs-edit').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-Clubs-edit').length > 0 )
            {
                $('#myModal-Clubs-edit').remove();
            }
            $('body').append(view);
            $('#myModal-Clubs-edit').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});

$("body").delegate('.js--ajax-form-edit-clubs-update', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var club_name = $("input[name='club_name']").val();
    var city = $("input[name='city']").val();


    formData.append("_token", _token);
    formData.append("club_name", club_name);
    formData.append("city", city);
    var request = new XMLHttpRequest();
    request.open("POST", "/clubs/"  + $(this).data('id') +  "/update");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);

    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                $('.modal-backdrop').remove();
                $(".club-name-" + data.id).html(data.club_name);
                $(".city-" + data.id).html(data.city);
                $('#myModal-Clubs-edit').modal('toggle');
                $('#myModal-Clubs-edit').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                toastr.success(data.success);
            }else{
                printErrorMsg(data.error);
            }
        }
    }
});

$('#myModal-Clubs-delete').on('click', '#confirm-delete', function() {
    $.ajax({
        type: 'get',
        url: "/clubs/"  + get_the_id_value +  "/delete",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': get_the_id_value,
        },
        success: function(data) {
            $(".clubs-list-" + get_the_id_value).remove();
            var check_count = data.check_count;
            if(check_count == 0){
                $('.clubs-box-table').remove();
                $('.dataTables_empty ').remove();
                $('.dataTables_info').remove();
                $('.no-clubs').removeClass('hide').addClass('show');
            }
            $('#myModal-Clubs-delete').modal('toggle');
            $('#myModal-Clubs-delete').hide();
            toastr.success(data.success);
        },
        error: function (data) {
            var data2 = JSON.parse(data.responseText);
            $('#myModal-Clubs-delete').modal('toggle');
            $('#myModal-Clubs-delete').hide();
            toastr.warning(data2.warning);
        }
    });
});

// Participants

$(document).on("click", "#myModal-Participants-edit .close, .js--ajax-form-edit-participants-close, .js--ajax-form-create-participants-close, #myModal-Participants-create .close", function(e)
{
    $('#myModal-Participants-edit').remove();
    $('#myModal-Participants-create').remove();
    $('.modal-backdrop').remove();
    $('.sidebar-mini').removeClass('modal-open');
    $('.sidebar-mini').css("padding-right", "");

});

$(document).on("click", ".js--create-participants", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/participants/create",
        dataType: 'html',
        success: function (view) {
            $('#myModal-Participants-create').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-Participants-create').length > 0 )
            {
                $('#myModal-Participants-create').remove();
            }
            $('body').append(view);
            $('#myModal-Participants-create').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});

$("body").delegate('.js--store-participants', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();

    var _token = $("input[name='_token']").val();
    var participant_name = $("input[name='participant_name']").val();
    var clubs_id = $("#clubs_id").val();
    var uuidcards_id = $("#uuidcards_id").val();

    formData.append("_token", _token);
    formData.append("participant_name", participant_name);
    formData.append("clubs_id",clubs_id);
    formData.append("uuidcards_id",uuidcards_id);

    var request = new XMLHttpRequest();
    request.open("POST", "/participants/create");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                toastr.success(data.success);
                $('#myModal-Participants-create').modal('toggle');
                $('#myModal-Participants-create').remove();
                $('.modal-backdrop').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                var check_count = data.check_count;
                if(check_count > 0){
                    $('.dataTables_empty ').remove();
                    $('.dataTables_info').remove();
                    $('.no-participants').removeClass('show').addClass('hide');
                }
                $("#participants-list_wrapper tbody").append($('<tr class="participants-list-' + data.id + '" role="row"><td class="sorting_1"><div class="participant-name-' + data.id + '">' + data.participant_name + '</div></td><td class=" center"><div class="participant-uuid-' + data.id + '">#' + data.uuidcard_id + ' (' + data.uuidcard_name + ')</div></td><td class=" center"><div class="participant-club-' + data.id + '">' + data.club_name + '</div></td><td class=" center"><a href="/participants/' + data.id + '/stages" class="btn bg-olive btn-flat margin"> Manage Stages</a></td><td class=" center"><a class="btn bg-primary btn-flat margin js--edit-participants" data-id="' + data.id + '" data-toggle="modal" data-target="edit-participants" href="#">Edit</a> <a href="" data-id="' + data.id + '" class="delete btn btn-danger btn-flat margin js--add-value-id" data-toggle="modal" data-target="#myModal-Participants-delete">Delete</a></td></tr>'));


            }else{
                printErrorMsg(data.error);
                $("#myModal-Participants-create").scrollTop( 0 );
            }
        }
    }

});

$(document).on("click", ".js--edit-participants", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/participants/" + $(this).data('id') + "/edit",
        dataType: 'html',
        success: function (view) {
            $('#myModal-Participants-edit').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-Participants-edit').length > 0 )
            {
                $('#myModal-Participants-edit').remove();
            }
            $('body').append(view);
            $('#myModal-Participants-edit').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});

$("body").delegate('.js--ajax-form-edit-participants-update', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var participant_name = $("input[name='participant_name']").val();
    var clubs_id = $("#clubs_id").val();
    var uuidcards_id = $("#uuidcards_id").val();

    formData.append("_token", _token);
    formData.append("participant_name", participant_name);
    formData.append("clubs_id", clubs_id);
    formData.append("uuidcards_id", uuidcards_id);
    var request = new XMLHttpRequest();
    request.open("POST", "/participants/"  + $(this).data('id') +  "/update");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);

    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                $('.modal-backdrop').remove();
                $(".participant-name-" + data.id).html(data.participant_name);
                $(".participant-uuid-" + data.id).html('#'+data.uuid_id+' ('+data.uuid_card+')');
                $(".participant-club-" + data.id).html(data.club_name);
                $('#myModal-Participants-edit').modal('toggle');
                $('#myModal-Participants-edit').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                toastr.success(data.success);
            }else{
                printErrorMsg(data.error);
            }
        }
    }
});

$('#myModal-Participants-delete').on('click', '#confirm-delete', function() {
    $.ajax({
        type: 'get',
        url: "/participants/"  + get_the_id_value +  "/delete",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': get_the_id_value,
        },
        success: function(data) {
            $(".participants-list-" + get_the_id_value).remove();
            var check_count_participants = data.check_count_participants;
            if(check_count_participants == 0){
                $('.participants-box-table').remove();
                $('.dataTables_empty ').remove();
                $('.dataTables_info').remove();
                $('.no-participants').removeClass('hide').addClass('show');
            }
            $('#myModal-Participants-delete').modal('toggle');
            $('#myModal-Participants-delete').hide();
            toastr.success(data.success);
        },
        error: function (data) {
            var data2 = JSON.parse(data.responseText);
            $('#myModal-Participants-delete').modal('toggle');
            $('#myModal-Participants-delete').hide();
            toastr.warning(data2.warning);
        }
    });
});


$("body").delegate('.js--store-relay-participants', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();

    var _token = $("input[name='_token']").val();
    var clubs_id = $("#clubs_id").val();
    var participant_name = $("input[name='participant_name[]']").map(function(){return $(this).val();}).get();
    var uuidcards_id = $("select[name='uuidcards_id[]']").map(function(){return $(this).val();}).get();

    formData.append("_token", _token);
    formData.append("clubs_id", clubs_id);
    formData.append("participant_name", participant_name);
    formData.append("uuidcards_id", uuidcards_id);

    var request = new XMLHttpRequest();
    request.open("POST", "/participants/create");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                toastr.success(data.success);
                $('#myModal-Participants-create').modal('toggle');
                $('#myModal-Participants-create').remove();
                $('.modal-backdrop').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                var check_count = data.check_count;
                if(check_count > 0){
                    $('.dataTables_empty ').remove();
                    $('.dataTables_info').remove();
                    $('.no-participants').removeClass('show').addClass('hide');
                }
                $("#participants-list_wrapper tbody").append($('<tr class="participants-list-' + data.id + '" role="row"><td class="sorting_1"><div class="participant-name-' + data.id + '">' + data.participant_name + '</div></td><td><div class="participant-club-' + data.id + '">' + data.club_name + '</div></td><td class=" center"><a href="/participants/' + data.id + '/stages" class="btn bg-olive btn-flat margin">Manage Stages</a></td><td class=" center"><a class="btn bg-primary btn-flat margin js--edit-participants" data-id="' + data.id + '" data-toggle="modal" data-target="edit-participants" href="#">Edit</a> <a href="" data-id="' + data.id + '" class="delete btn btn-danger btn-flat margin js--add-value-id" data-toggle="modal" data-target="#myModal-Participants-delete">Delete</a></td></tr>'));


            }else{
                printErrorMsg(data.error);
                $("#myModal-Participants-create").scrollTop( 0 );
            }
        }
    }

});


$("body").delegate('.js--ajax-form-edit-relay-participants-update', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var clubs_id = $("#clubs_id").val();
    var participant_name = $("input[name='participant_name[]']").map(function(){return $(this).val();}).get();
    var uuidcards_id = $("select[name='uuidcards_id[]']").map(function(){return $(this).val();}).get();

    formData.append("_token", _token);
    formData.append("clubs_id", clubs_id);
    formData.append("participant_name", participant_name);
    formData.append("uuidcards_id", uuidcards_id);
    var request = new XMLHttpRequest();
    request.open("POST", "/participants/"  + $(this).data('id') +  "/update");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);

    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                $('.modal-backdrop').remove();
                $(".participant-name-" + data.id).html(data.participant_name);
                $(".participant-club-" + data.id).html(data.club_name);
                $('#myModal-Participants-edit').modal('toggle');
                $('#myModal-Participants-edit').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                toastr.success(data.success);
            }else{
                printErrorMsg(data.error);
            }
        }
    }
});


// Participants Manage Stages


$(document).on("click", "#myModal-Participants-Stages-edit .close, .js--ajax-form-edit-participants-stages-close, .js--ajax-form-create-participants-stages-close, #myModal-Participants-Stages-create .close", function(e)
{
    $('#myModal-Participants-Stages-edit').remove();
    $('#myModal-Participants-Stages-create').remove();
    $('.modal-backdrop').remove();
    $('.sidebar-mini').removeClass('modal-open');
    $('.sidebar-mini').css("padding-right", "");

});

$(document).on("click", ".js--create-participants-stages", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/participants/"+ $(this).data('id') +"/stages/create",
        dataType: 'html',
        success: function (view) {
            $('#myModal-Participants-Stages-create').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-Participants-Stages-create').length > 0 )
            {
                $('#myModal-Participants-Stages-create').remove();
            }
            $('body').append(view);
            $('#myModal-Participants-Stages-create').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});

$("body").delegate('.js--ajax-form-participants-stages-create', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();

    var _token = $("input[name='_token']").val();
    var stages_id = $("#stages_id").val();
    var categories_id = $("#categories_id").val();

    formData.append("_token", _token);
    formData.append("stages_id", stages_id);
    formData.append("categories_id",categories_id);

    var request = new XMLHttpRequest();
    request.open("POST", "/participants/"+ $(this).data('id') +"/stages/create");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                toastr.success(data.success);
                $('#myModal-Participants-Stages-create').modal('toggle');
                $('#myModal-Participants-Stages-create').remove();
                $('.modal-backdrop').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                var check_count = data.check_count;
                if(check_count > 0){
                    $('.no-participants-stages').removeClass('show').addClass('hide');
                }
                $(".participants-stages-count").html(data.check_count);
                $(".participants-stages tbody").append($('<tr class="participants-stages-' + data.id + '"><td class="stage-name-' + data.id + ' center">' + data.stage_name + '</td><td class="categoy-name-' + data.id + ' center">' + data.category_name + '</td><td class="total-time-' + data.id + ' center">' + data.total_time + '</td><td class="missed-posts-' + data.id + ' center">' + data.missed_posts + '</td><td class="missed-posts-' + data.id + ' center">' + data.abandon + '</td><td class="center"><button type="button" class="btn bg-primary btn-flat margin js--edit-participant-stages js--add-value-participants-stages-id js--add-value-id"  data-participants-id="' + data.participants_id + '" data-stages-id="' + data.stages_id + '" data-toggle="modal" data-target="#myModal-Participants-Stages-edit">Edit</button><button type="button" class="delete btn bg-danger btn-flat margin js--add-value-participants-stages-id js--add-value-id js--add-value-participants-stages-id js--add-value-stages-id" data-id="' + data.id + '" data-participants-id="' + data.participants_id + '" data-stages-id="' + data.stages_id + '" data-toggle="modal" data-target="#myModal-Participants-Stages-delete">Delete</button></td></tr>'));


            }else{
                printErrorMsg(data.error);
                $("#myModal-Clubs-create").scrollTop( 0 );
            }
        }
    }

});

$("body").delegate('.js--ajax-form-relay-participants-stages-create', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();

    var _token = $("input[name='_token']").val();
    var stages_id = $("#stages_id").val();
    var relay_category_id = $("#relay_category_id").val();
    var relay_participant_id = $("input[name='relay_participant_id[]']").map(function(){return $(this).val();}).get();
    var uuidcards_id = $("input[name='uuidcards_id[]']").map(function(){return $(this).val();}).get();
    var relay_participant_managers_id = $("input[name='relay_participant_managers_id[]']").map(function(){return $(this).val();}).get();
    var routes_id = $("select[name='routes_id[]']").map(function(){return $(this).val();}).get();
    participant_id = $(this).data('id');
    console.log(participant_id);

    formData.append("_token", _token);
    formData.append("stages_id", stages_id);
    formData.append("relay_category_id", relay_category_id);
    formData.append("routes_id", routes_id);
    formData.append("relay_participant_id",relay_participant_id);
    formData.append("uuidcards_id",uuidcards_id);
    formData.append("relay_participant_managers_id",relay_participant_managers_id);

    var request = new XMLHttpRequest();
    request.open("POST", "/participants/"+ $(this).data('id') +"/stages/create");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                toastr.success(data.success);
                location.href = "/participants/"+ participant_id +"/stages";
            }else{
                printErrorMsg(data.error);
                $("#myModal-Participants-Stages-create").scrollTop( 0 );
            }
        }
    }

});

$(document).on("click", ".js--edit-participant-stages", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/participants/"+ participants_id +"/stages/"+ $(this).data('stages-id') +"/edit",
        dataType: 'html',
        success: function (view) {
            $('#myModal-Participants-Stages-edit').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-Participants-Stages-edit').length > 0 )
            {
                $('#myModal-Participants-Stages-edit').remove();
            }
            $('body').append(view);
            $('#myModal-Participants-Stages-edit').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});

$(document).on("click", ".js--edit-relay-participant-stages", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/participants/"+ participants_id +"/stages/"+ $(this).data('stages-id') +"/edit",
        dataType: 'html',
        success: function (view) {
            $('#myModal-Participants-Stages-edit').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-Participants-Stages-edit').length > 0 )
            {
                $('#myModal-Participants-Stages-edit').remove();
            }
            $('body').append(view);
            $('#myModal-Participants-Stages-edit').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});


$("body").delegate('.js--ajax-form-participants-stages-update', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var stages_id = $("#stages_id").val();
    var categories_id = $("#categories_id").val();
    var start_time = $("input[name='start_time']").val();
    var finish_time = $("input[name='finish_time']").val();
    var abandon = $("#abandon").val();
    var missed_posts = $("input[name='missed_posts']").val();

    formData.append("_token", _token);
    formData.append("stages_id", stages_id);
    formData.append("categories_id", categories_id);
    formData.append("start_time", start_time);
    formData.append("finish_time", finish_time);
    formData.append("abandon", abandon);
    formData.append("missed_posts", missed_posts);
    var request = new XMLHttpRequest();
    request.open("POST", "/participants/"+ $(this).data('participants-id') +"/stages/"+ $(this).data('stages-id') +"/update");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);

    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                $('.modal-backdrop').remove();
                $(".stage-name-" + data.id).html(data.stage_name);
                $(".categoy-name-" + data.id).html(data.category_name);
                $(".total-time-" + data.id).html(data.total_time);
                $(".missed-posts-" + data.id).html(data.missed_posts);
                $(".abandon-" + data.id).html(data.abandon);
                $('#myModal-Participants-Stages-edit').modal('toggle');
                $('#myModal-Participants-Stages-edit').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                toastr.success(data.success);
            }else{
                printErrorMsg(data.error);
                $("#myModal-Participants-Stages-edit").scrollTop( 0 );
            }
        }
    }
});

$("body").delegate('.js--ajax-form-relay-participants-stages-update', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();

    var _token = $("input[name='_token']").val();
    var stages_id = $("#stages_id").val();
    var relay_category_id = $("#relay_category_id").val();
    var relay_participant_id = $("input[name='relay_participant_id[]']").map(function(){return $(this).val();}).get();
    var uuidcards_id = $("input[name='uuidcards_id[]']").map(function(){return $(this).val();}).get();
    var relay_participant_managers_id = $("input[name='relay_participant_managers_id[]']").map(function(){return $(this).val();}).get();
    var routes_id = $("select[name='routes_id[]']").map(function(){return $(this).val();}).get();

    formData.append("_token", _token);
    formData.append("stages_id", stages_id);
    formData.append("relay_category_id", relay_category_id);
    formData.append("routes_id", routes_id);
    formData.append("relay_participant_id",relay_participant_id);
    formData.append("uuidcards_id",uuidcards_id);
    formData.append("relay_participant_managers_id",relay_participant_managers_id);

    var request = new XMLHttpRequest();
    request.open("POST", "/participants/"+ participants_id +"/stages/"+ $(this).data('id') +"/update");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                toastr.success(data.success);
                location.href = "/participants/"+data.relay_participant_id+"/stages";
            }else{
                printErrorMsg(data.error);
                $("#myModal-Participants-Stages-edit").scrollTop( 0 );
            }
        }
    }

});

$(document).on("click", "#myModal-Participants-Stages-Management-edit .close, .js--ajax-form-create-participants-stages-management-close", function(e)
{
    $('#myModal-Participants-Stages-Management-edit').remove();
    $('.modal-backdrop').remove();
    $('.sidebar-mini').removeClass('modal-open');
    $('.sidebar-mini').css("padding-right", "");

});

$(document).on("click", ".js--edit-relay-participant-management-stages", function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/participants/relay-stages/"+ $(this).data('id') +"/edit",
        dataType: 'html',
        success: function (view) {
            $('#myModal-Participants-Stages-Management-editt').remove();
            $('.modal-backdrop').remove();
            if( $('#myModal-Participants-Stages-Management-edit').length > 0 )
            {
                $('#myModal-Participants-Stages-Management-edit').remove();
            }
            $('body').append(view);
            $('#myModal-Participants-Stages-Management-edit').modal('show');
        },
        error: function (data) {
            //Error message here
        }
    });
});

$("body").delegate('.js--update-relay-participant-management-stages', 'click',function(e){
    e.preventDefault();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var start_time = $("input[name='start_time']").val();
    var finish_time = $("input[name='finish_time']").val();
    var abandon = $("#abandon").val();
    var missed_posts = $("input[name='missed_posts']").val();

    formData.append("_token", _token);
    formData.append("start_time", start_time);
    formData.append("finish_time", finish_time);
    formData.append("abandon", abandon);
    formData.append("missed_posts", missed_posts);
    var request = new XMLHttpRequest();
    request.open("POST", "/participants/relay-stages/"+ get_the_id_value +"/edit");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);

    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            var data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.error)){
                $('.modal-backdrop').remove();
                $(".total-time-" + data.id).html(data.total_time);
                $(".missed-posts-" + data.id).html(data.missed_posts);
                $(".abandon-" + data.id).html(data.abandon);
                $('#myModal-Participants-Stages-Management-edit').modal('toggle');
                $('#myModal-Participants-Stages-Management-edit').remove();
                $('.sidebar-mini').removeClass('modal-open');
                $('.sidebar-mini').css("padding-right", "");
                toastr.success(data.success);
            }else{
                printErrorMsg(data.error);
                $("#myModal-Participants-Stages-Management-edit").scrollTop( 0 );
            }
        }
    }
});

$('#myModal-Participants-Stages-delete').on('click', '#confirm-delete', function() {
    $.ajax({
        type: 'POST',
        url: "/participants/"  + participants_id +  "/stages/"+  participant_stages_id +"/delete",
        data: {
            '_token': $('input[name=_token]').val(),
            'participants-id': participants_id,
            'stages-id':  participant_stages_id,
        },
        success: function(data) {
            $(".participants-stages-" + data.id).remove();
            var check_count = data.check_count;
            if(check_count == 0){
                $('.no-participants-stages').removeClass('hide').addClass('show');
            }
            $(".participants-stages-count").html(data.check_count);
            $('#myModal-Participants-Stages-delete').modal('toggle');
            $('#myModal-Participants-Stages-deletee').hide();
            toastr.success(data.success);
        },
        error: function (data) {
            var data2 = JSON.parse(data.responseText);
            $('#myModal-Participants-Stages-delete').modal('toggle');
            $('#myModal-Participants-Stages-delete').hide();
            toastr.warning(data2.warning);
        }
    });
});

$('#myModal-Relay-Participants-Stages-delete').on('click', '#confirm-delete', function() {
    $.ajax({
        type: 'POST',
        url: "/participants/"  + participants_id +  "/stages/"+ get_the_id_value +"/delete",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': get_the_id_value,
            'participants-id': participants_id,
        },
        success: function(data) {
            $(".participants-stages-" + get_the_id_value).remove();
            var check_count = data.check_count;
            if(check_count == 0){
                $('.no-stages').removeClass('hide').addClass('show');
            }
            $(".participants-stages-count").html(data.check_count);
            $('#myModal-Relay-Participants-Stages-delete').modal('toggle');
            $('#myModal-Relay-Participants-Stages-delete').hide();
            toastr.success(data.success);
        },
        error: function (data) {
            var data2 = JSON.parse(data.responseText);
            $('#myModal-Relay-Participants-Stages-delete').modal('toggle');
            $('#myModal-Relay-Participants-Stages-delete').hide();
            toastr.warning(data2.warning);
        }
    });
});