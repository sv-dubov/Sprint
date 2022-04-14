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
    let data = $('#user_add_form').serialize();
    $.ajax({
        url: "backend/save.php",
        type: "POST",
        data: data,
        success: function (dataResult) {
            let dataRes = JSON.parse(dataResult);
            if (dataRes.statusCode === 200) {
                $('#btn-add').button('reset');
                $('#user_add_form')[0].reset();
                $('#addUserModal').modal('hide');
                //location.reload();
                $('#usersList').html("");
                getUsers();
            } else if (dataRes.statusCode === 201) {
                alert(dataRes);
            }
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
            $('#usersList').html("");
            getUsers();
        }
    });
});

$(document).on("click", "#btn-actions", function () {
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
        if (action_value == 0 || action2_value == 0) {
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
                success: function () {
                    $('#usersList').html("");
                    getUsers();
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
                success: function () {
                    $('#usersList').html("");
                    getUsers();
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
                    success: function (response) {
                        $('#deleteUserModal').modal('hide');
                        let ids = response.split(",");
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
                let template = "<tr id='" + value['id'] + "'>" +
                    "<td class='align-middle'>" +
                    "<div class='custom-checkbox' id='checkbox2'>" +
                    "<input type='checkbox' class='user_checkbox' data-user-id='" + value['id'] + "'>" +
                    "<label for='checkbox2'>" + "</label>" +
                    "</div>" +
                    "</td>" +
                    "<td class='text-nowrap align-middle'>" + value['first_name'] + ' ' + value['last_name'] + "</td>" +
                    "<td class='text-nowrap align-middle'>" +
                    "<span>" + value['role'] + "</span>" + "</td>" +
                    "<td class='text-center align-middle'><i class='fa fa-circle " + status_color + "'></td>" +
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