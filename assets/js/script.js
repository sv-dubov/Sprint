$(document).on('click', '#btn-add', function () {
    let data = $("#user_add_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "backend/save.php",
        success: function (dataResult) {
            dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode === 200) {
                $('#addUserModal').modal('hide');
                alert('User was added successfully!');
                location.reload();
            } else if (dataResult.statusCode === 201) {
                alert(dataResult);
            }
        }
    });
});

$(document).on('click', '.update', function () {
    let id = $(this).attr("data-id");
    let first_name = $(this).attr("data-first_name");
    let last_name = $(this).attr("data-last_name");
    let role = $(this).attr("data-role");
    if($(this).attr("data-status")) {
        var status = 1;
    } else {
        var status = 0;
    }
    $('#id_u').val(id);
    $('#first_name_u').val(first_name);
    $('#last_name_u').val(last_name);
    $('#role_u').val(role);
    $('#status_u').val(status);
});

$(document).on('click', '#update', function () {
    let data = $("#user_update_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "backend/save.php",
        success: function () {
            $('#editUserModal').modal('hide');
            alert('User was updated successfully!');
            location.reload();
        }
    });
});

$(document).on("click", ".delete", function () {
    let id = $(this).attr("data-id");
    $('#id_d').val(id);
});

$(document).on("click", "#delete", function () {
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
        MULTIPLE_SET_ACTIVE_WARNING = "Are you sure you want to set chosen " + (user.length > 1 ? "users" : "user") + " active?";
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
        MULTIPLE_SET_INACTIVE_WARNING = "Are you sure you want to set chosen " + (user.length > 1 ? "users" : "user") + " not active?";
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
