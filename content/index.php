<?php
    require_once 'class/Contacts.php';
    require_once 'class/Notes.php';

    $contact_db = new Contacts();
    $notes_db   = new Notes();    

    function create_contact($contact) {
        global $notes_db;

        $contact_id = $contact["contact_id"];
        $fullName  = $contact["first_name"].' '.$contact["last_name"];
        $email = $contact["email"];
        $mail = '<a href="mailto:' . $email . '"> ' . $email . ' </a>';
        $edit = '<a id="edit" class="pointer pull-right" onClick="update_contact('.$contact_id.')"><span class="glyphicon glyphicon-pencil"></span> Edit</a>';
        $delete = '<a class="pointer pull-right link-red" style="margin-left: 15px;" onClick="show_delete_modal('.$contact_id.')"><span class="glyphicon glyphicon-remove"></span> Delete</a>';

        $notes = $notes_db->get_notes($contact["notes_id"]);

        $html = '
            <tr id="'.$contact['contact_id'].'" class="td-contact">
                <td class="image text-center"><img src="'.$contact["path"].'" alt="Photo" width="100" height="100" class="img-circle"></td>
                <td class="firstName text-center"><a href="view_contact.php?contact_id='.$contact_id.'">' . $fullName . '</a></td>
                <td class="email text-center">' . $mail . '</td>
                <td class="contact_number text-center">' . $contact["contact_number"] . '</td>
                <td class="address text-center">' . $contact["address"] . '</td>
                <td class="notes text-center">' . $notes["contact_notes"] . '</td>

                <td>' . $delete . $edit . '</td>
            </tr>';
        return $html;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Contact List</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Phonebook</a>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-users"></i> Contacts</a>
                        </li>
                        <li>
                            <a href="notes.php"><i class="fa fa-book"></i> Manage Notes</a>
                        </li>
                        <li>
                            <a href="activity_logs.php"><i class="fa fa-lock"></i> Activity Log</a>
                        </li>
                        <li>
                            <a href="https://github.com/Senpaiyaa/phonebook" target="_blank"><i class="fa fa-code-fork"></i> Github</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List of Available Contacts
                            <div class="pull-right button_option">
                                <a href="insert_contact.php" class="hidden-sm hidden-xs">
                                    <span class="fa fa-plus"></span>
                                    New Contact
                                </a>
                                <ul class="nav navbar-right item_config">
                                        <li class="dropdown pull-right">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="visible-sm visible-xs">
                                                    <a href="new_employee.php"><i class="glyphicon glyphicon-plus"></i> Add New Employee </a>
                                                </li>
                                                <li>
                                                    <a href="manage_accounts.php"><i class="glyphicon glyphicon-cog"></i> Manage Deleted Accounts</a>
                                                </li>
                                            </ul>
                                            <!-- /.dropdown-menu -->
                                        </li>
                                        <!-- /.dropdown -->
                                    </ul>

                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <table width="100%" class="table table-hover" id="contact_list" >
                                <thead>
                                    <tr>
                                        <th>Profile Picture</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Contact Number</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">Notes</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = $contact_db->get_all_contacts();

                                        $tds = '';
                                        $td = '';

                                        foreach ($query as $contact) {
                                            $tds .= create_contact($contact);
                                        }

                                        $td .= $tds;
                                        $tdIsEmpty = "<span class='text-danger'>Message: No result found.</span>";

                                        if (empty($td)) {
                                            echo $tdIsEmpty;
                                        } else {
                                            echo $td;
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Delete modal -->
    <div class="modal fade" id="delete-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Do you want to delete this account?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-default" data-dismiss="modal" id="btnNo">Cancel</button>
                    <button type="button" class="btn btn-md btn-danger" data-dismiss="modal" id="btnYes">Delete</button>
                </div>
            </div>  
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <script>
        var contact_id = null

        $("#btnYes").click(function () {
            window.location = "remove_contact.php?contact_id=" + contact_id
        });

        $("#btnNo").click(function () {
            $("#delete-modal").modal("hide");
        });

        function show_delete_modal(id) {
            contact_id = id;
            $("#delete-modal").modal("show");
        }

        function update_contact(id) {
            window.location = "update_contact.php?contact_id=" + id;
        }

        $(document).ready(function() {
            $('#contact_list').DataTable({
                responsive: true,
                aoColumnDefs: [
                    {
                        bSortable: false,
                        className: "text-center",
                        aTargets: [ -1, -7 ]
                    }
                ]
            });
        });

    </script>
</body>

</html>
