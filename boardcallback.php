<table>
<?php 
session_start();
require_once('chess.php');
//die(var_dump($_SESSION['board']));
$boardinfo = ChessBoard::getInstance(); //unserialize($_SESSION['board']->squares);
header('plain/text');

foreach($boardinfo as $i=>$row){
	foreach($row as $pos=>$obj){
		?><tr><td><?php echo $pos .' '; //get_class($obj->getOccupyingPiece()); ?></td></tr><?php
	}
}
?></table><?php 
exit(0);