<?php
include("session.php");
$update = false;
$del = false;

$expenseamount = "";
$expensedate = date("d-m-Y");
$expensecategory = "";
$expensedescription ="";
$payment_type = "";

include("php_functions/expanse_function.php");

if (isset($_POST['add'])) {
    
    $expenseamount = $_POST['expenseamount'];

    $date = $_POST['expensedate'];
    $expensedate = date('d-m-Y',strtotime($date));        
    $expensecategory = $_POST['expensecategory'];
    $expensedescription = $_POST['expansedescription'];
    $payment_type = $_POST['paymentcategory'];

    add_expanse($expenseamount ,$date ,$expensedate , $expensecategory ,$expensedescription,$payment_type);
    header('location: add_expense.php');
}

if (isset($_POST['update'])) {
    
    echo'inside _post--> update ';

    $id = $_GET['edit'];
    
    $expenseamount = $_POST['expenseamount'];

    $date = $_POST['expensedate'];
    $expensedate = date('d-m-Y',strtotime($date));
    $expanse_id = $_POST['id'];
    $expensecategory = $_POST['expensecategory'];
    $expensedescription = $_POST['expansedescription'];
    $payment_type = $_POST['paymentcategory'];
    $expansedescription = $_POST['expansedescription'];
    
    update_expanse($id,$expenseamount,$expensecategory,$expensedate,$expansedescription,$payment_type);
    header('location: manage_expense.php');
}

if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    
    $expenseamount = $_POST['expenseamount'];

    $date = $_POST['expensedate'];
    $expensedate = date('d-m-Y',strtotime($date));

    $expensecategory = $_POST['expensecategory'];
    $expensedescription = $_POST['expansedescription'];
    $payment_type = $_POST['paymentcategory'];
    $expansedescription = $_POST['expansedescription'];
    
    update_expanse($id,$expenseamount,$expensecategory,$expensedate,$expansedescription,$payment_type);
    header('location: manage_expense.php');
}

// POST DELETE
if (isset($_POST['delete'])) {
    $id = $_GET['delete'];
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

    delete_expanse($id);
    header('location: manage_expense.php');
}


// GET EDIT 
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($con, "SELECT * FROM expenses WHERE user_id='$userid' AND expense_id=$id");
    if (mysqli_num_rows($record) == 1) {

        $n = mysqli_fetch_array($record);
        $expenseamount = $n['expense'];
        $date = $n['expensedate'];
        $expansedate = date('d-m-Y',strtotime($date));
        $expensecategory = $n['expensecategory'];
        $expansedescription = $n['expanse_description'];
        $payment_type = $n['payment_type'];

    } else {
        echo ("WARNING: AUTHORIZATION ERROR: Trying to Access Unauthorized data");
    }
}


//GET DELETE 
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $del = true;
    $record = mysqli_query($con, "SELECT * FROM expenses WHERE user_id='$userid' AND expense_id=$id");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        
        $expenseamount = $n['expense'];
        $date = $n['expensedate'];
        $expansedate = date('d-m-Y',strtotime($date));
        $expensecategory = $n['expensecategory'];
        $expansedescription = $n['expanse_description'];
        $payment_type = $n['payment_type'];
        
    } else {
        echo ("WARNING: AUTHORIZATION ERROR: Trying to Access Unauthorized data");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Expense Manager - Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Feather JS for Icons -->
    <script src="js/feather.min.js"></script>

</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
            <div class="user">
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="120">
                <h5><?php echo $username ?></h5>
                <p><?php echo $useremail ?></p>
            </div>
            <div class="sidebar-heading">Management</div>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action"><span data-feather="home"></span> Dashboard</a>
                <a href="add_expense.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="plus-square"></span> Add Expenses</a>
                <a href="manage_expense.php" class="list-group-item list-group-item-action"><span data-feather="dollar-sign"></span> Manage Expenses</a>
            </div>
            <div class="sidebar-heading">Settings </div>
            <div class="list-group list-group-flush">
                <a href="profile.php" class="list-group-item list-group-item-action "><span data-feather="user"></span> Profile</a>
                <a href="logout.php" class="list-group-item list-group-item-action "><span data-feather="power"></span> Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light  border-bottom">


                <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
                    <span data-feather="menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="25">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profile.phcol-mdp">Your Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container">
                <h3 class="mt-4 text-center">Add Your Daily Expenses</h3>
                <hr>
                <div class="row ">

                <input type="hidden" class="form-control col-sm-12" value="<?php echo $id; ?>" id="expenseamount" name="expenseamount" required>
                    <div class="col-md-3"></div>

                    <div class="col-md" style="margin:0 auto;">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="expenseamount" class="col-sm-6 col-form-label"><b>Enter Amount(Rs.)</b></label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control col-sm-12" value="<?php echo $expenseamount; ?>" id="expenseamount" name="expenseamount" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="expensedate" class="col-sm-6 col-form-label"><b>Date</b></label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control col-sm-12" value="<?php echo $expensedate; ?>" name="expensedate" id="expensedate" required>
                                </div>
                            </div>
                           
                                <div class="form-group row">
                                    <legend class="col-form-label col-sm-6 pt-0"><b>Category</b></legend>
                                    <div class="col-md">
                                        <select name="expensecategory" id="expensecategory">
                                            <option value="Food">Food and Dining</option>
                                            <option value="Internet">Internet</option>
                                            <option value="medicine">Medicine</option>
                                            <option value="Bus fare">Bus fare</option>
                                            <option value="">petrol/gas</option>
                                            <option value="">Auto/tranport</option>
                                            <option value="">household</option>
                                            <option value="">stationery</option>
                                            <option value="">rent</option>
                                            <option value="">personal care</option>
                                            <option value="">education</option>
                                            <option value="">entertainment</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <legend class="col-form-label col-sm-6 pt-0"><b>Description</b></legend>
                                    <div class="col-md">
                                        <textarea name="expansedescription" id="expansedescription" cols="30" rows="5" placeholder="descrption"><?php echo $expansedescription ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <legend class="col-form-label col-sm-6 pt-0"><b>payment Type : </b></legend>
                                    <div class="col-md">
                                        <select name="paymentcategory" id="paymentcategory">
                                            <option value="cash" default selected>Cash</option>
                                            <option value="UPI">UPI</option>
                                            <option value="credit/debit card">credit/debit card</option>
                                            <option value="cheqeue">cheqeue</option>
                                        </select>
                                    </div>
                                </div>

                            </fieldset>
                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <?php if ($update == true) : ?>
                                        <input class="btn btn-lg btn-block btn-warning" style="border-radius: 0%;" type="submit" name="update" value="update">
                                    <?php elseif ($del == true) : ?>
                                        <button class="btn btn-lg btn-block btn-danger" style="border-radius: 0%;" type="submit" name="delete">Delete</button>
                                    <?php else : ?>
                                        <button type="submit" name="add" class="btn btn-lg btn-block btn-success" style="border-radius: 0%;">Add Expense</button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-3"></div>
                    
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        feather.replace();
    </script>
    <script>

    </script>
</body>
</html>