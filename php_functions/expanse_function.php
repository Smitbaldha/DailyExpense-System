<?php
function  add_expanse($expenseamount ,$date ,$expensedate , $expensecategory ,$expensedescription ,
                        $payment_type ) 
{
    include("session.php");
    
    $expenseamount = $_POST['expenseamount'];

    $date = $_POST['expensedate'];
    $expensedate = date('d-m-Y',strtotime($date));        
    $expensecategory = $_POST['expensecategory'];
    $expensedescription = $_POST['expansedescription'];
    $payment_type = $_POST['paymentcategory'];


    $expenses = "INSERT INTO expenses (user_id, expense,expensedate,expensecategory,expanse_description,payment_type) VALUES ('$userid', '$expenseamount','$expensedate','$expensecategory','$expensedescription','$payment_type')";
    $result = mysqli_query($con, $expenses) or die("Something Went Wrong!");


}

function update_expanse($id,$expenseamount,$expensecategory,$expensedate,$expansedescription,$payment_type){
    
    include("session.php");
    $sql = "UPDATE expenses SET expense='$expenseamount', expensedate='$expensedate', expensecategory='$expensecategory',expanse_description='$expansedescription',payment_type='$payment_type' WHERE user_id='$userid' AND expense_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
}


function delete_expanse($id){
    
    include("session.php");
    $sql = "DELETE FROM expenses WHERE user_id='$userid' AND expense_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
}

// function display_flash_message(string $name): void
// {
//     if (!isset($_SESSION[FLASH][$name])) {
//         return;
//     }

//     // get message from the session
//     $flash_message = $_SESSION[FLASH][$name];

//     // delete the flash message
//     unset($_SESSION[FLASH][$name]);

//     // display the flash message
//     echo format_flash_message($flash_message);
// }

?>