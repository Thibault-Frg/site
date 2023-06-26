<?php
require_once("../login/config.php");

$sqlQuery = 'SELECT * FROM confiseries';
$confi = db_query($sqlQuery);

foreach ($confi as $confi) {
?>
    <p><?php echo $confi['nom']; ?></p>
    <p><?php echo $confi['type']; ?></p>
    <p><?php echo $confi['prix']; ?></p>
<?php
}
?>
