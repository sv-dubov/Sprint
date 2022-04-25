$(document).ready(function () {
    getUsers();
});

$(document).on('click', '#addUser', function () {
    $('#addUserModal').modal('show');
    $('#user_add_form')[0].reset();
    $('.modal-title').html('Add user');
    $('#type').val('add_user');
    $('#user_id').val('');
});

$(document).on('click', '.update', function () {
    let user_id = $(this).attr("data-id");
    let first_name = $(this).attr("data-first_name");
    let last_name = $(this).attr("data-last_name");
    let role = $(this).attr("data-role");
    let status = $(this).attr("data-status");

    $('#type').val('edit_user');
    $('#user_id').val(user_id);
    $('#first_name').val(first_name);
    $('#last_name').val(last_name);
    $('#role').val(role);
    if (status == 1) {
        $('#status').prop('checked', true);
    } else {
        $('#status').prop('checked', false);
    }
    $('#addUserModal').modal('show');
    $('.modal-title').html('Edit user');
});

// add/edit
$(document).on('click', '#btn-add', function (e) {
    e.preventDefault();
    validateNames();
    let data = $('#user_add_form').serialize();
    $.ajax({
        url: "backend/save.php",
        type: "POST",
        data: data,
        dataType: "JSON",
        success: function (dataResult) {
            if (dataResult.statusCode === 200) {
                if (dataResult.type == 'add_user')
                    $('#usersList').append(renderTableTemplate(dataResult));
                else if (dataResult.type == 'edit_user')
                    $('#' + dataResult.id).replaceWith(renderTableTemplate(dataResult));
                $('#btn-add').button('reset');
                $('#user_add_form')[0].reset();
                $('#addUserModal').modal('hide');
            } else if (dataResult.statusCode === 201) {
                alert(dataResult);
            }
            checkboxTooltip();
        }
    })
});

$(document).on('click', '.delete', function () {
    $('.modal-title-delete').html('Delete user');
    let id = $(this).attr("data-id");
    $('#id_d').val(id);
});

$(document).on('click', '#delete_single', function () {
    $.ajax({
        url: "backend/save.php",
        type: "POST",
        cache: false,
        data: {
            type: 'single_delete',
            id: $("#id_d").val()
        },
        success: function (dataResult) {
            $('#deleteUserModal').modal('hide');
            $("#" + dataResult).remove();
        }
    });
});

$(document).on("click", "#btn-actions", function (e) {
    e.preventDefault();
    let action_value = $('#actions').val();
    let action2_value = $('#actions2').val();
    let user = [];
    $(".user_checkbox:checked").each(function () {
        user.push($(this).data('user-id'));
    });
    if (user.length < 1) {
        $('.info-body').html('Please, select records');
        $('#warningModal').modal('show');
    } else {
        if (action_value == null && action2_value == null) {
            $('.info-body').html('Please, select action');
            $('#warningModal').modal('show');
        }
        if (action_value == 1 || action2_value == 1) {
            let selected_values = user.join(",");
            $.ajax({
                url: "backend/save.php",
                type: "POST",
                cache: false,
                data: {
                    type: 'multiple_set_active',
                    id: selected_values
                },
                success: function (dataResult) {
                    $('#selectAll').prop('checked', false);
                    let ids = dataResult.split(",");
                    for (let i = 0; i < ids.length; i++) {
                        $("tr[data-tr-id='" + ids[i] + "']").find("#circle").removeClass('not-active-circle').addClass('active-circle');
                    }
                    let checkbox = $('table tbody input[type="checkbox"]');
                    checkbox.each(function () {
                        this.checked = false;
                    });
                }
            });
        } else if (action_value == 2 || action2_value == 2) {
            let selected_values = user.join(",");
            $.ajax({
                url: "backend/save.php",
                type: "POST",
                cache: false,
                data: {
                    type: 'multiple_set_inactive',
                    id: selected_values
                },
                success: function (dataResult) {
                    $('#selectAll').prop('checked', false);
                    let ids = dataResult.split(",");
                    for (let i = 0; i < ids.length; i++) {
                        $("tr[data-tr-id='" + ids[i] + "']").find("#circle").removeClass('active-circle').addClass('not-active-circle');
                    }
                    let checkbox = $('table tbody input[type="checkbox"]');
                    checkbox.each(function () {
                        this.checked = false;
                    });
                }
            });
        } else if (action_value == 3 || action2_value == 3) {
            $('#deleteUserModal').modal('show');
            let selected_values = user.join(",");
            $('#delete_single').click(function () {
                $.ajax({
                    url: "backend/save.php",
                    type: "POST",
                    cache: false,
                    data: {
                        type: 'multiple_delete',
                        id: selected_values
                    },
                    success: function (dataResult) {
                        $('#deleteUserModal').modal('hide');
                        $('#selectAll').prop('checked', false);
                        let ids = dataResult.split(",");
                        for (let i = 0; i < ids.length; i++) {
                            $("#" + ids[i]).remove();
                        }
                    }
                });
            });
        }
    }
});

function getUsers() {
    $.ajax({
        url: "backend/show.php",
        type: "GET",
        dataType: "json",
        success: function (dataResult) {
            $.each(dataResult, function (key, value) {
                let status_color;
                if (value['status'] == 1)
                    status_color = "active-circle";
                else if (value['status'] == 0)
                    status_color = "not-active-circle";
                let template = "<tr id='" + value['id'] + "' data-tr-id='" + value['id'] + "'>" +
                    "<td class='align-middle'>" +
                    "<div class='custom-checkbox' id='checkbox2'>" +
                    "<input type='checkbox' class='user_checkbox' data-user-id='" + value['id'] + "'>" +
                    "<label for='checkbox2'>" + "</label>" +
                    "</div>" +
                    "</td>" +
                    "<td class='text-nowrap align-middle'>" + value['first_name'] + ' ' + value['last_name'] + "</td>" +
                    "<td class='text-nowrap align-middle'>" +
                    "<span>" + value['role'] + "</span>" + "</td>" +
                    "<td class='text-center align-middle'><i class='fa fa-circle " + status_color + "' id='circle'></td>" +
                    "<td class='text-center align-middle'>" +
                    "<div class='btn-group align-top'>" +
                    "<button class='btn btn-sm btn-outline-secondary badge' type='button' data-toggle='modal' data-target='#editUserModal'>" +
                    "<i class='fa fa-edit update' data-toggle='tooltip' data-id='" + value['id'] + "'" +
                    " data-first_name='" + value['first_name'] + "'" +
                    " data-last_name='" + value['last_name'] + "'" +
                    " data-role='" + value['role'] + "'" +
                    " data-status='" + value['status'] + "'" +
                    " title='Edit'>" + "</i>" + "</button>" +
                    "<button class='btn btn-sm btn-outline-secondary badge' type='button' data-toggle='modal' data-target='#deleteUserModal'>" +
                    "<i class='fa fa-trash delete' data-toggle='tooltip' data-id='" + value['id'] + "'" +
                    " title='Delete'>" + "</i>" + "</button>" +
                    "</div>" + "</td>" + "</tr>";
                $('#usersList').append(template);
            });
            checkboxTooltip();
        }
    });
}

function checkboxTooltip() {
    $('[data-toggle="tooltip"]').tooltip();
    let checkbox = $('table tbody input[type="checkbox"]');
    $('#selectAll').click(function () {
        if (this.checked) {
            checkbox.each(function () {
                this.checked = true;
            });
        } else {
            checkbox.each(function () {
                this.checked = false;
            });
        }
    });
    checkbox.click(function () {
        if ($('.user_checkbox').length === $('.user_checkbox:checked').length) {
            $('#selectAll').prop('checked', true);
        } else {
            $('#selectAll').prop('checked', false);
        }
    });
}

function renderTableTemplate(data) {
    let status_color;
    if (data.status == 1)
        status_color = "active-circle";
    else if (data.status == 0)
        status_color = "not-active-circle";
    let template = "<tr id='" + data.id + "' data-tr-id='" + data.id + "'>" +
        "<td class='align-middle'>" +
        "<div class='custom-checkbox' id='checkbox2'>" +
        "<input type='checkbox' class='user_checkbox' data-user-id='" + data.id + "'>" +
        "<label for='checkbox2'>" + "</label>" +
        "</div>" +
        "</td>" +
        "<td class='text-nowrap align-middle'>" + data.first_name + ' ' + data.last_name + "</td>" +
        "<td class='text-nowrap align-middle'>" +
        "<span>" + data.role + "</span>" + "</td>" +
        "<td class='text-center align-middle'><i class='fa fa-circle " + status_color + "' id='circle'></td>" +
        "<td class='text-center align-middle'>" +
        "<div class='btn-group align-top'>" +
        "<button class='btn btn-sm btn-outline-secondary badge' type='button' data-toggle='modal' data-target='#editUserModal'>" +
        "<i class='fa fa-edit update' data-toggle='tooltip' data-id='" + data.id + "'" +
        " data-first_name='" + data.first_name + "'" +
        " data-last_name='" + data.last_name + "'" +
        " data-role='" + data.role + "'" +
        " data-status='" + data.status + "'" +
        " title='Edit'>" + "</i>" + "</button>" +
        "<button class='btn btn-sm btn-outline-secondary badge' type='button' data-toggle='modal' data-target='#deleteUserModal'>" +
        "<i class='fa fa-trash delete' data-toggle='tooltip' data-id='" + data.id + "'" +
        " title='Delete'>" + "</i>" + "</button>" +
        "</div>" + "</td>" + "</tr>";
    return template;
}

function validateNames() {
    let f_name = $("#first_name").val();
    let l_name = $("#last_name").val();

    if (f_name.trim() == "") {
        $('#error_first_name').show();
        $('#first_name').focus();
        $('#error_first_name').hide().slideDown().delay(3000).fadeOut();
        return false;
    } else if (l_name.trim() == "") {
        $("#error_last_name").show();
        $("#last_name").focus();
        $('#error_last_name').hide().slideDown().delay(3000).fadeOut();
        return false;
    }
}