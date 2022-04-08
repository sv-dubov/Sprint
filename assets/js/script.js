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

$(document).on("click", "#btn-actions", function () {
    let action_value = document.getElementById('actions').value;
    let user = [];
    $(".user_checkbox:checked").each(function () {
        user.push($(this).data('user-id'));
    });
    if (user.length < 1) {
        $('.info-body').html('Please, select records');
        $('#warningModal').modal('show');
    } else {
        if (action_value === '0') {
            $('.info-body').html('Please, select action');
            $('#warningModal').modal('show');
        }
        if (action_value === '1') {
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
                    location.reload();
                }
            });
        } else if (action_value === '2') {
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
                    location.reload();
                }
            });
        } else if (action_value === '3') {
            $('#deleteUserModal').modal('show');
            let selected_values = user.join(",");
            $('#delete_single').click(function () {
                $.ajax({
                    type: "post",
                    url: "backend/save.php",
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
