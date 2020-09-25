<?php
    require_once 'class/Contacts.php';
    $contact_db = new Contacts();

    function create_contact($contact) {
        $contact_id = $contact["contact_id"];
        $fullName  = $contact["first_name"].' '.$contact["last_name"];
        $email = $contact["email"];
        $mail =  $email;
        $reactivate = '<a class="pointer pull-right btn btn-success" onClick="show_restore_modal('.$contact_id.')">Reactivate</a>';
        $html = '
            <tr id="'.$contact['contact_id'].'" class="td-contact">
                <td class="image text-center"><img src="'.$contact["path"].'" alt="Photo" width="100" height="100"></td>
                <td class="firstName text-center">' . $fullName . '</td>
                <td class="email text-center">' . $mail . '</td>
                <td class="contact_number text-center">' . $contact["contact_number"] . '</td>
                <td class="address text-center">' . $contact["address"] . '</td>

                <td>' . $reactivate . '</td>
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
                            List of Deleted Contacts
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <table width="100%" class="table table-hover" id="contact_list" >
                                <thead>
                                    <tr>
                                        <th class="text-center">Profile Picture</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Contact Number</th>
                                        <th class="text-center">Address</th>
                                        <th id="action" class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = $contact_db->get_deleted_accounts();

                                        $tds = '';
                                        $td = '';

                                        foreach ($query as $contact) {
                                            $tds .= create_contact($contact);
                                        }

                                        $td .= $tds;

                                        echo $td;
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

    <!-- Restore modal -->
    <div class="modal fade" id="restore-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Do you want to restore this account?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-default" data-dismiss="modal" id="btnNo">Cancel</button>
                    <button type="button" class="btn btn-md btn-success" data-dismiss="modal" id="RestoreButton">Restore</button>
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

    <script src="js/main.js"></script>

    <script>
        var contact_id = null

        $("#RestoreButton").click(function () {
            window.location = "restore.php?contact_id=" + contact_id;
        });

        $("#btnNo").click(function () {
            $("#delete-modal").modal("hide");
        });

        function show_restore_modal(id) {
            contact_id = id;
            $("#restore-modal").modal("show");
        }

    </script>
</body>

</html>
