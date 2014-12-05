<?php 
require_once('chess.php');
/*movecallback.php


process $_POST returning a JSON response containing all the processed move info

pieceType
originSquare
destSquare 


*/

if(isset($_POST['originSquare'])): 

$pt = $_POST['pieceType']; 

$move = Move::get($pt::get($_POST['originSquare']), ChessSquare::get($_POST['originSquare']), ChessSquare::get($_POST['destSquare']) ); 






header('application/json');




echo json_encode($move->toArray());


endif; 
exit(0);