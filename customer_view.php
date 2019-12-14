<?php
//customer_view.php - shows details of a single customer
?>
<?php include 'includes/config.php';?>
<?php

//process querystring here
if(isset($_GET['id']))
{//process data
    //cast the data to an integer, for security purposes
    $id = (int)$_GET['id'];
}else{//redirect to safe page
    header('Location:customer_list.php');
}


$sql = "select * from test_Customers where CustomerID = $id";
//we connect to the db here
$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//we extract the data here
$result = mysqli_query($iConn,$sql);

if(mysqli_num_rows($result) > 0)
{//show records

    while($row = mysqli_fetch_assoc($result))
    {
        $FirstName = stripslashes($row['FirstName']);
        $LastName = stripslashes($row['LastName']);
        $Email = stripslashes($row['Email']);
        $title = "Title Page for " . $FirstName;
        $pageID = $FirstName;
        $Feedback = '';//no feedback necessary
    }    

}else{//inform there are no records
    $Feedback = '<p>This customer does not exist</p>';
}

//for this page we'll request no caching to see the latest image
if(isset($_SESSION["AdminID"]))
{//don't cache uploaded images
    $config->loadhead .='
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
    ';
    
}

?>
<?php get_header();?>
<h1>Customer View</h1>
<?php
    
    
if($Feedback == '')
{//data exists, show it

    echo '<p>';
    echo 'FirstName: <b>' . $FirstName . '</b> ';
    echo 'LastName: <b>' . $LastName . '</b> ';
    echo 'Email: <b>' . $Email . '</b> ';
    
    echo '<img src="uploads/customer' . $id . '.jpg" />';

    if(startSession() && isset($_SESSION["AdminID"]))
        {# only admins can see 'peek a boo' link:
            echo '<p align="center"><a href="' . $config->virtual_path . '/upload_form.php?' . $_SERVER['QUERY_STRING'] . '">UPLOAD IMAGE</a></p>';
            /*
            # if you wish to overwrite any of these options on the view page, 
            # you may uncomment this area, and provide different parameters:						
            echo '<div align="center"><a href="' . VIRTUAL_PATH . 'upload_form.php?' . $_SERVER['QUERY_STRING']; 
            echo '&imagePrefix=customer';
            echo '&uploadFolder=upload/';
            echo '&extension=.jpg';
            echo '&createThumb=TRUE';
            echo '&thumbWidth=50';
            echo '&thumbSuffix=_thumb';
            echo '&sizeBytes=100000';
            echo '">UPLOAD IMAGE</a></div>';
            */						

        }

    echo '</p>'; 
}else{//warn user no data
    echo $Feedback;
}    

echo '<p><a href="customer_list.php">Go Back</a></p>';

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);

?>
<?php get_footer();?>