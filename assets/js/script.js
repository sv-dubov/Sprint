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
    if ($(this).attr("data-status")) {
        var status = 1;
    } else {
        var status = 0;
    }

    $('#type').val('edit_user');
    $('#user_id').val(user_id);
    $('#first_name').val(first_name);
    $('#last_name').val(last_name);
    $('#role').val(role);
    $('#status').val(status);
    $('#addUserModal').modal('show');
    $('.modal-title').html('Edit user');
});

// add/edit
$(document).on('click', '#btn-add', function (e) {
    e.preventDefault();
    let data = $('#user_add_form').serialize();
    $.ajax({
        url: "backend/save.php",
        method: "POST",
        data: data,
        success: function (dataResult) {
            console.log(data);
            dataResult = JSON.parse(dataResult);
            console.log(dataResult);
            if (dataResult.statusCode === 200) {
                $('#btn-add').button('reset');
                $('#user_add_form')[0].reset();
                $('#addUserModal').modal('hide');
                location.reload();
            } else if (dataResult.statusCode === 201) {
                alert(dataResult);
            }
        }
    })
});

$(document).on("click", ".delete", function () {
    let id = $(this).attr("data-id");
    $('#id_d').val(id);
});

$(document).on("click", "#delete_single", function () {
    $.ajax({
        url: "backend/save.php",
        type: "post",
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

$(document).on("click", "#delete_multiple", function () {
    let user = [];
    $(".user_checkbox:checked").each(function () {
        user.push($(this).data('user-id'));
    });
    if (user.length < 1) {
        alert("Please, select records");
    } else {
        MULTIPLE_DELETE_WARNING = "Are you sure you want to delete selected " + (user.length > 1 ? "users" : "user") + "?";
        let confirmed = confirm(MULTIPLE_DELETE_WARNING);
        if (confirmed === true) {
            let selected_values = user.join(",");
            $.ajax({
                type: "post",
                url: "backend/save.php",
                cache: false,
                data: {
                    type: 'multiple_delete',
                    id: selected_values
                },
                success: function (response) {
                    let ids = response.split(",");
                    for (let i = 0; i < ids.length; i++) {
                        $("#" + ids[i]).remove();
                    }
                }
            });
        }
    }
});

$(document).on("click", "#set_active_multiple", function () {
    let user = [];
    $(".user_checkbox:checked").each(function () {
        user.push($(this).data('user-id'));
    });
    if (user.length < 1) {
        alert("Please, select records");
    } else {
        MULTIPLE_SET_ACTIVE_WARNING = "Are you sure you want to set selected " + (user.length > 1 ? "users" : "user") + " active?";
        let confirmed = confirm(MULTIPLE_SET_ACTIVE_WARNING);
        if (confirmed === true) {
            let selected_values = user.join(",");
            $.ajax({
                type: "post",
                url: "backend/save.php",
                cache: false,
                data: {
                    type: 'multiple_set_active',
                    id: selected_values
                },
                success: function () {
                        alert('User\'s statuses was set on active!');
                        location.reload();
                }
            });
        }
    }
});

$(document).on("click", "#set_inactive_multiple", function () {
    let user = [];
    $(".user_checkbox:checked").each(function () {
        user.push($(this).data('user-id'));
    });
    if (user.length < 1) {
        alert("Please, select records");
    } else {
        MULTIPLE_SET_INACTIVE_WARNING = "Are you sure you want to set selected " + (user.length > 1 ? "users" : "user") + " not active?";
        let confirmed = confirm(MULTIPLE_SET_INACTIVE_WARNING);
        if (confirmed === true) {
            let selected_values = user.join(",");
            $.ajax({
                type: "post",
                url: "backend/save.php",
                cache: false,
                data: {
                    type: 'multiple_set_inactive',
                    id: selected_values
                },
                success: function () {
                    alert('User\'s statuses was set on not active!');
                    location.reload();
                }
            });
        }
    }
});

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    let checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function () {
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
        if (!this.checked) {
            $("#selectAll").prop("checked", false);
        }
    });
});
