<?php
$org=$_POST['org'];
$des=$_POST['des'];
if (isset($_POST['org'])&& isset($_POST['des']))
 {

}
?>
<iframe 
width="750"
height="550"
frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/direction?key=AIzaSyDWJMuwdHCgeA1cKQdSuq1KuYzO-na4l2Y&origin=<?php echo $org; ?>&destination=<?php
echo $des; ?>" allowfullscreen>
</iframe>

