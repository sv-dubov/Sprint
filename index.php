<?php
include 'backend/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Users table</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>
<body>
<div class="container">
    <div class="row flex-lg-nowrap">
        <div class="col">
            <div class="row flex-lg-nowrap">
                <div class="col mb-3">
                    <div class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="col-sm-6">
                                    <h6 class="mr-2"><span>Users</span></h6>
                                </div>
                                <div class="col-sm-6">
                                    <a href="#addUserModal" class="btn btn-success" data-toggle="modal">Add user</a>
                                    <a href="JavaScript:void(0);" class="btn btn-info" id="set_active_multiple">Set
                                        active</a>
                                    <a href="JavaScript:void(0);" class="btn btn-warning" id="set_inactive_multiple">Set
                                        not active</a>
                                    <a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple">Delete</a>
                                </div>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="align-top">
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="selectAll">
                                                    <label for="selectAll"></label>
                                                </div>
                                            </th>
                                            <th class="max-width">Name</th>
                                            <th class="sortable">Role</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $result = mysqli_query($conn, "SELECT * FROM users");
                                        $i = 1;
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <tr id="<?php echo $row["id"]; ?>">
                                                <td class="align-middle">
                                                    <div class="custom-checkbox">
                                                        <input type="checkbox" class="user_checkbox"
                                                               data-user-id="<?php echo $row["id"]; ?>">
                                                        <label for="checkbox2"></label>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap align-middle"><?php echo $row["first_name"] . ' ' . $row["last_name"]; ?></td>
                                                <td class="text-nowrap align-middle">
                                                    <span><?php echo $row["role"]; ?></span></td>
                                                <?php
                                                if ($row["status"] == 1)
                                                    echo '<td class="text-center align-middle"><i class="fa fa-circle active-circle"></td>';
                                                elseif ($row["status"] == 0)
                                                    echo '<td class="text-center align-middle"><i class="fa fa-circle not-active-circle"></td>';
                                                ?>
                                                <td class="text-center align-middle">
                                                    <div class="btn-group align-top">
                                                        <button class="btn btn-sm btn-outline-secondary badge"
                                                                type="button" data-toggle="modal"
                                                                data-target="#editUserModal">
                                                            <i class="fa fa-edit update" data-toggle="tooltip"
                                                               data-id="<?php echo $row["id"]; ?>"
                                                               data-first_name="<?php echo $row["first_name"]; ?>"
                                                               data-last_name="<?php echo $row["last_name"]; ?>"
                                                               data-role="<?php echo $row["role"]; ?>"
                                                               data-status="<?php echo $row["status"]; ?>"
                                                               title="Edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-secondary badge"
                                                                type="button" data-toggle="modal"
                                                                data-target="#deleteUserModal"><i
                                                                    class="fa fa-trash delete" data-toggle="tooltip"
                                                                    data-id="<?php echo $row["id"]; ?>"
                                                                    title="Delete"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- User Add Form Modal -->
            <div class="modal fade" role="dialog" tabindex="-1" id="addUserModal">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <span id="error" style="display: none"></span>
                        <form class="form" id="user_add_form">
                            <div class="modal-header">
                                <h4 class="modal-title">Add user</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="first_name">First name</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" id="role" name="role">
                                        <option>User</option>
                                        <option>Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <label class="switch">
                                        <input type="hidden" name="status" value="0">
                                        <input type="checkbox" id="status" name="status" value="1" class="success">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" value="add_user" name="type">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <button type="button" class="btn btn-success" id="btn-add">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- User Edit Form Modal -->
            <div class="modal fade" role="dialog" tabindex="-1" id="editUserModal">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form class="form" id="user_update_form">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit user</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="id_u" name="id" class="form-control" required>
                                <div class="form-group">
                                    <label for="first_name_u">First name</label>
                                    <input type="text" id="first_name_u" name="first_name" class="form-control">
                                    <div class="form-group">
                                        <label for="last_name_u">Last name</label>
                                        <input type="text" id="last_name_u" name="last_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="role_u">Role</label>
                                        <select class="form-control" id="role_u" name="role">
                                            <option value="User">User</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <label class="switch">
                                            <input type="checkbox" id="status_u" name="status" class="success">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" value="edit_user" name="type">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <button type="button" class="btn btn-info" id="update">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- User Delete Form Modal-->
            <div class="modal fade" id="deleteUserModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h4 class="modal-title">Delete user</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="id_d" name="id" class="form-control">
                                <p>Are you sure you want to remove chosen record(s)?</p>
                                <p class="text-warning"><small>This action cannot be undone</small></p>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <button type="button" class="btn btn-danger" id="delete_single">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
