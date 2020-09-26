<?php
    require_once 'class/Contacts.php';

    $contact_db = new Contacts();

    function create_log($log) {
        $log_id = $log["activity_id"];
        $html = '
            <tr id="'.$log['activity_id'].'" class="td-logs">
                <td class="activity text-center">' . $log["user_activity"] . '</td>
                <td class="date text-center">' . $log["date_logged"] . '</td>
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>User logs</h3>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered" id="logs-list" >
                                <thead>
                                    <tr>
                                        <th class="text-center">Activity</th>
                                        <th class="text-center">Date Logged</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = $contact_db->get_logs();
                                        $tds = '';
                                        $td = '';

                                        foreach ($query as $logs) {
                                            $tds .= create_log($logs);
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
        $(document).ready(function() {
            $('#logs-list').DataTable({
                responsive: true
            });
        });
    </script>
</body>

</html>