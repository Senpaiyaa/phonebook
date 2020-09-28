<?php
    require_once 'class/functions.php';
    require_once 'class/Contacts.php';
    require_once 'class/Notes.php';

    $contacts_db    = new Contacts();
    $notes_db       = new Notes();

    if (isset($_POST["submit"])) {
        $firstName      = escape($_POST["firstName"]);
        $lastName       = escape($_POST["lastName"]);
        $email          = escape($_POST["email"]);
        $contact_number = escape($_POST["contact_number"]);
        $address        = escape($_POST["address"]);
        $notes          = escape($_POST["notes_id"]);

        if ( isset($_FILES["fileToUpload"]) ) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));    
    
            // Check if file already exists
            if (file_exists($target_file)) {
                $uploadOk = 0;
            }
    
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                $uploadOk = 0;
            }
    
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                redirect_to("error.php");
                exit(1);
                $uploadOk = 0;
            }
    
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
    
            $path =  $target_file;
            // echo '<pre>' . var_export($new_path, true) . '</pre>';    
        }

        $activity = "Contact with name ".$firstName . ' ' . $lastName . ' ' . " has been created.";
        $contacts_db->create_activity($activity);
        $contacts_db->insert_contacts($firstName, $lastName, $email, $contact_number, $path, $address, $notes);
        $message = '<div class="alert alert-success">Contact has been added.</div>';
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
            <br>
            <div class="row">
                <form class="form-horizontal" role="form" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="contact_information_form">
                    <div class="col-lg-12">
                    <span id="message"><?php if(isset($message)) echo $message; ?></span>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-pencil"></i> Contact Basic Information
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <div class="form-group">
                                            <label for="insertPicture" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Profile Picture:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-10">
                                                <input type="file" name="fileToUpload" id="fileToUpload">
                                            </div>
                                        </div>                                   

                                        <div class="form-group">
                                            <label for="firstName" class="col-sm-3 col-md-3 col-lg-2 control-label wide">First Name:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-10">
                                                <input name="firstName" id="firstName" class="form-control" type="text">
                                                <span class="text-danger" style="display:none;">First name is a required field.</span>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastName" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Last Name:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-10">
                                                <input name="lastName" id="lastName" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-3 col-md-3 col-lg-2 control-label wide">E-mail:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-10">
                                                <input name="email" id="email" class="form-control" type="text">
                                                <span class="text-danger" style="display:none;" id="empty_email">Email is a required field.</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_number" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Contact Number:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-10">
                                                <input name="contact_number" id="contact_number" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Address:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-10">
                                                <input name="address" id="address" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="notes_id" class="col-sm-3 col-md-3 col-lg-2 control-label wide">Notes:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-10">
                                                <select id="notes_id" class="form-control" name="notes_id">
                                                    <?php
                                                        $contact_notes = $notes_db->option_notes();
                                                        $option = "";
                                                        foreach ($contact_notes as $notes) {
                                                            $option .= option($notes['contact_notes'], $notes['notes_id']);
                                                        }
                                                        echo $option;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                </div>
                                <div class="form-actions">
                                    <input type="submit" name="submit" class="submit_button floating_button btn btn-primary" value="Submit" id="submit">
                                </div>   

                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->                 
                </form>

            </div>
            <!-- .row -->
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

</body>

</html>
