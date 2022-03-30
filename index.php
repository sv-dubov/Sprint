<?php

include_once ('config/db_connect.php');
//echo mysqli_connect_error();
include_once ('partials/header.php');

?>

<div class="container">
    <div class="row flex-lg-nowrap">
        <div class="col">
            <div class="row flex-lg-nowrap">
                <div class="col mb-3">
                    <div class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>Users</span></h6>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="align-top">
                                                <div
                                                    class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0">
                                                    <input type="checkbox" class="custom-control-input" id="all-items">
                                                    <label class="custom-control-label" for="all-items"></label>
                                                </div>
                                            </th>
                                            <th class="max-width">Name</th>
                                            <th class="sortable">Role</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="align-middle">
                                                <div
                                                    class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                    <input type="checkbox" class="custom-control-input" id="item-1">
                                                    <label class="custom-control-label" for="item-1"></label>
                                                </div>
                                            </td>
                                            <td class="text-nowrap align-middle">Adam Cotter</td>
                                            <td class="text-nowrap align-middle"><span>Active</span></td>
                                            <td class="text-center align-middle"><i
                                                    class="fa fa-circle active-circle"></i></td>
                                            <td class="text-center align-middle">
                                                <div class="btn-group align-top">
                                                    <button class="btn btn-sm btn-outline-secondary badge" type="button"
                                                            data-toggle="modal"
                                                            data-target="#user-form-modal">Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-secondary badge"
                                                            type="button"><i
                                                            class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">
                                                <div
                                                    class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                    <input type="checkbox" class="custom-control-input" id="item-2">
                                                    <label class="custom-control-label" for="item-2"></label>
                                                </div>
                                            </td>
                                            <td class="text-nowrap align-middle">Pauline Noble</td>
                                            <td class="text-nowrap align-middle"><span>User</span></td>
                                            <td class="text-center align-middle"><i
                                                    class="fa fa-circle active-circle"></i></td>
                                            <td class="text-center align-middle">
                                                <div class="btn-group align-top">
                                                    <button class="btn btn-sm btn-outline-secondary badge" type="button"
                                                            data-toggle="modal"
                                                            data-target="#user-form-modal">Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-secondary badge"
                                                            type="button"><i
                                                            class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">
                                                <div
                                                    class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                    <input type="checkbox" class="custom-control-input" id="item-3">
                                                    <label class="custom-control-label" for="item-3"></label>
                                                </div>
                                            </td>
                                            <td class="text-nowrap align-middle">Sherilyn Metzel</td>
                                            <td class="text-nowrap align-middle"><span>Admin</span></td>
                                            <td class="text-center align-middle"><i
                                                    class="fa fa-circle not-active-circle"></i></td>
                                            <td class="text-center align-middle">
                                                <div class="btn-group align-top">
                                                    <button class="btn btn-sm btn-outline-secondary badge" type="button"
                                                            data-toggle="modal"
                                                            data-target="#user-form-modal">Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-secondary badge"
                                                            type="button"><i
                                                            class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">
                                                <div
                                                    class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                    <input type="checkbox" class="custom-control-input" id="item-4">
                                                    <label class="custom-control-label" for="item-4"></label>
                                                </div>
                                            </td>
                                            <td class="text-nowrap align-middle">Terrie Boaler</td>
                                            <td class="text-nowrap align-middle"><span>Admin</span></td>
                                            <td class="text-center align-middle"><i
                                                    class="fa fa-circle active-circle"></i></td>
                                            <td class="text-center align-middle">
                                                <div class="btn-group align-top">
                                                    <button class="btn btn-sm btn-outline-secondary badge" type="button"
                                                            data-toggle="modal"
                                                            data-target="#user-form-modal">Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-secondary badge"
                                                            type="button"><i
                                                            class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">
                                                <div
                                                    class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                    <input type="checkbox" class="custom-control-input" id="item-5">
                                                    <label class="custom-control-label" for="item-5"></label>
                                                </div>
                                            </td>
                                            <td class="text-nowrap align-middle">Rutter Pude</td>
                                            <td class="text-nowrap align-middle"><span>User</span></td>
                                            <td class="text-center align-middle"><i
                                                    class="fa fa-circle active-circle"></i></td>
                                            <td class="text-center align-middle">
                                                <div class="btn-group align-top">
                                                    <button class="btn btn-sm btn-outline-secondary badge" type="button"
                                                            data-toggle="modal"
                                                            data-target="#user-form-modal">Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-secondary badge"
                                                            type="button"><i
                                                            class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- User Form Modal -->
            <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit user</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="py-1">
                                <form class="form" novalidate="">
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input class="form-control" type="text" name="name"
                                                               placeholder="John" value="John">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Last name</label>
                                                        <input class="form-control" type="text" name="username"
                                                               placeholder="Smith" value="Smith">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col d-flex justify-content-end">
                                            <button class="btn btn-primary" type="submit">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
