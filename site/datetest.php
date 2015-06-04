Date Applied<br /> <input id="date_applied" type="text" name="date_applied" placeholder="mm/dd/yyyy" onchange="return checkDate(this)"><br>
<?php
 $rawdate = isset($_POST['date_applied'])? $_POST['date_applied']: '';
 $xplod = explode('/', $rawdate);
print_r($xplod);
?>