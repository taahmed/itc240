<?php include 'includes/config.php'; ?>
<?php
if(isset($_GET['day'])){
//day comes from link on page
$day = $_GET['day'];
}
else{
//current day of week
$day = date('l');
}

switch($day){
        case 'Monday';
            $coffee = 'Mocha';
            $image ='mocha.jpg';
        break;
        case 'Tuesday';
            $coffee = 'Latte';
            $image ='latte.jpg';
        break;
        case 'Wednesday';
            $coffee = 'Glace';
            $image ='glace.jpg';
        break;
        case 'Thursday';
            $coffee = 'Pumpkin Spice Latte';  
            $image ='pumpkin-spice-latte.jpg';
        break;
        case 'Friday';
            $coffee = 'Espresso';
            $image ='espresso.jpg';
        break;
        case 'Saturday';
            $coffee = 'Frappe';
            $image ='frappe.jpg';  
        break;
        case 'Sunday';
            $coffee = 'Macchiato';
            $image ='macchiato.jpg';  
        break;
}

?>
<?php get_header()?>
<h3>Daily Special</h3>
<p>Bellow you can see our daily special for <?=$day?>!</p>
<p><?=$coffee?></p><p><img src="images/<?=$image?>" alt="The daily special coffee!"></p>

<p>Click below to view the specials for every weekday<p>

<p><a href='daily.php?day=Monday'>Monday</a></p>
<p><a href='daily.php?day=Tuesday'>Tuesday</a> </p>
<p><a href='daily.php?day=Wednesday'>Wednesday</a></p>
<p><a href='daily.php?day=Thursday'>Thursday</a></p>
<p><a href='daily.php?day=Friday'>Friday</a></p>
<p><a href='daily.php?day=Saturday'>Saturday</a></p>
<p><a href='daily.php?day=Sunday'>Sunday</a></p>

<?php get_footer()?>