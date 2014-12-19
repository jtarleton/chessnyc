<?php 
require_once('chess.php');
/*movecallback.php


process $_POST returning a JSON response containing all the processed move info

pieceType
originSquare
destSquare 


*/
if(isset($_POST['originSquare'])): 
	$pt      = $_POST['pieceType']; 
	$oSq     = ChessSquare::get($_POST['originSquare']);
	$dSq     = ChessSquare::get($_POST['destSquare']);
	$mPiece  = $pt::get($_POST['originSquare']);
	$move    = Move::get($mPiece, $oSq, $dSq ); 
	//$dSq->setOccupyingPiece($mPiece);
	$x = ChessBoard::getInstance();
	//$x->setSqu($dSq);
	$_SESSION['board'] = serialize($x->infoToArray());
	header('application/json');
	echo json_encode($move->toArray());
endif; 
exit(0);