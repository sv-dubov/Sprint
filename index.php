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
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <select class="form-control mr-3" id="actions" style="width:auto;">
                                        <option selected="selected" value="0" disabled>Please Select</option>
                                        <option value="1">Set active</option>
                                        <option value="2">Set not active</option>
                                        <option value="3">Delete</option>
                                    </select>
                                    <button type="button" class="btn btn-info mr-5" id="btn-actions">OK</button>
                                    <a id="addUser" class="btn btn-success" data-toggle="modal">Add user</a>
                                </div>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3" id="table-users">
                                    <table class="table table-bordered" id="userTable">
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
                                        <tbody id="usersList"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <select class="form-control mr-3" id="actions2" style="width:auto;">
                                        <option selected="selected" value="0" disabled>Please Select</option>
                                        <option value="1">Set active</option>
                                        <option value="2">Set not active</option>
                                        <option value="3">Delete</option>
                                    </select>
                                    <button type="button" class="btn btn-info mr-5" id="btn-actions">OK</button>
                                    <a id="addUser" class="btn btn-success" data-toggle="modal">Add user</a>
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
                        <form class="form" id="user_add_form">
                            <input type="hidden" name="type" id="type">
                            <input type="hidden" name="id" id="user_id">
                            <div class="modal-header">
                                <h4 class="modal-title">Add user</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="first_name">First name</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control">
                                    <span class="error" id="error_first_name">Please, enter First name</span>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control">
                                    <span class="error" id="error_last_name">Please, enter Last name</span>
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
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <button type="button" class="btn btn-success" id="btn-add">Save</button>
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
                                <h4 class="modal-title-delete">Delete user</h4>
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
            <!-- Warnings Modal -->
            <div class="modal" id="warningModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Warning!</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body info-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
