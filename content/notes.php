<?php
    require_once 'class/Notes.php';
    require_once 'class/functions.php';

    $notes_db = new Notes();

    if (isset($_POST["submit"])) {
        $contact_notes = escape($_POST["notes"]);

        $notes = $notes_db->insert_notes($contact_notes);
    }

    function create_notes($notes) {
        $notes_id = $notes["notes_id"];
        $contact_notes  = $notes["contact_notes"];
        $html = '
            <tr id="'.$notes['notes_id'].'" class="td-notes">
                <td class="notes text-center">' . $contact_notes . '</td>
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

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <!-- <p>&nbsp;</p> -->
            <!-- <br> -->
            <span>&nbsp;</span>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default" >
                        <div class="panel-heading">
                            Manage Notes
                            <div class="pull-right button_option">
                                <a href="#" data-toggle="modal" data-target="#add_notes"><span class="fa fa-plus"></span> New Notes</a>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" >
                            <table class="table table-bordered table-striped" id="notes-list" style="width:50%; margin: 0 auto;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Available Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $query = $notes_db->get_all_notes();

                                        $tds = '';
                                        $td = '';

                                        foreach ($query as $notes) {
                                            $tds .= create_notes($notes);
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
    <form method="post" autocomplete="off" role="form" id="notes_form">
        <div class="modal fade" id="add_notes" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Please enter Notes</h4>
                    </div>
                    <div class="modal-body"> 
                            <div class="form-group">
                                <label for="add_notes" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Notes:</label>
                                <div class="col-sm-9 col-md-9 col-lg-10">
                                    <input name="notes" value="" id="notes" class="form-control form-inps" type="text">
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer" style="margin-top: 40px;">
                        <button type="submit" class="btn btn-primary pull-right" name="submit">Submit</button>
                    </div>
                </div>  
            </div>
        </div>
    </form>
    <!-- /#add_category -->

    </div>
    <!-- /#wrapper -->

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
            $('#notes-list').DataTable({
                responsive: true
            });
        });
    </script>
</body>

</html>
