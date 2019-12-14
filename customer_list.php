<?php
//customer_list.php - shows a list of customer data
?>
<?php 
include 'includes/config.php';

//for this page we'll request no caching to see the latest image
if(isset($_SESSION["AdminID"]))
{//don't cache uploaded images
    $config->loadhead .='
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
    ';
    
}

get_header();
?>
<h1>Customer List</h1>
<?php
$sql = "select * from test_Customers";
//we connect to the db here
$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//we extract the data here
$result = mysqli_query($iConn,$sql);

if(mysqli_num_rows($result) > 0)
{//show records

    while($row = mysqli_fetch_assoc($result))
    {
        echo '<p>';
        echo 'FirstName: <b>' . $row['FirstName'] . '</b> ';
        echo 'LastName: <b>' . $row['LastName'] . '</b> ';
        echo 'Email: <b>' . $row['Email'] . '</b> ';
        
        echo '<a href="customer_view.php?id=' . $row['CustomerID'] . '">' . $row['FirstName'] . '</a>';
        
        echo '<img src="' . $config->virtual_path . '/uploads/customer' . dbOut($row['CustomerID']) . '_thumb.jpg" />';
        
        echo '</p>';
    }    

}else{//inform there are no records
    echo '<p>There are currently no customers</p>';
}

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);

?>
<?php get_footer();?>