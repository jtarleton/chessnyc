 <?php 
class Chesspiece 
{
	public $type, $kolor;

	public function __construct(){
		$this->type = strtolower(static::$objName);
		$this->kolor = strtolower(static::$color);
	}
	public static function get($pos){
		$class = static::$objName . 'Factory';
		return $class::create($pos, static::$color . static::$objName);
	}
}
class Chesspieces 
{
	public static function getPieces(){
		$class = static::$entityName;
		$instances = array();
		foreach(static::$instancesByStartPosition as $instanceByPosition){
			$instances[$instanceByPosition] = $class::get($instanceByPosition);
		} 
		return $instances;
	}
}
class Bishop extends Chesspiece
{
	public static $objName = 'Bishop';
	public function __construct(){
		parent::__construct();
	}
}
class BishopFactory {
	public static function create($pos, $v){
		if(class_exists($v)){
			return new $v(strtoupper($pos));
		} 
		throw new Exception('Invalid bishop color!');
	}
}
class Knight extends Chesspiece
{
	//$curPos;
	public static $objName = 'Knight';
	public function __construct(){
		parent::__construct();
	}
	public function getLegalMoves(){
		/* 
		For a Knight on F3, 
			D2, D4, 
			E1, G1,
			H2, H4,
			E5, G5

		*/
	}
}
class KnightFactory {
	public static function create($pos, $v){
		if(class_exists($v)){
			return new $v(strtoupper($pos));
		} 
		throw new Exception('Invalid knight color!');
	}
}
class Rook extends Chesspiece
{
	public static $objName = 'Rook';
	public function __construct(){
		parent::__construct();
	}
}
class RookFactory {
	public static function create($pos, $v){
		if(class_exists($v)){
			return new $v(strtoupper($pos));
		} 
		throw new Exception('Invalid rook color!');
	}
}
class Queen extends Chesspiece
{
	public static $objName = 'Queen';
	public function __construct(){
		parent::__construct();
	}
}
class QueenFactory {
	public static function create($pos, $v){
		if(class_exists($v)){
			return new $v(strtoupper($pos));
		} 
		throw new Exception('Invalid queen color!');
	}
}
class King extends Chesspiece
{
	public static $objName = 'King';
	public function __construct(){
		parent::__construct();
	}
}
class KingFactory {
	public static function create($pos, $v){
		if(class_exists($v)){
			return new $v(strtoupper($pos));
		} 
		throw new Exception('Invalid king color!');
	}
}
class Pawn extends Chesspiece
{
	public static $objName = 'Pawn';
	public function __construct(){
		parent::__construct();
	}
	
}
class PawnFactory {
	public static function create($pos, $v){
		if(class_exists($v)){
			return new $v(strtoupper($pos));
		} 
		throw new Exception('Invalid pawn color!');
	}
}
class WhitePawn extends Pawn
{
	public static $color = 'white';
	public $asciicode = '&#9817;';
	public $illegalCoordinates = array('a1','b1','c1','d1','e1','f1','g1','h1'); 
}
class BlackPawn extends Pawn
{
	public static $color = 'black';
	public $asciicode = '&#9823;';
	public $illegalCoordinates = array('a8','b8','c8','d8','e8','f8','g8','h8'); 
}
class WhiteBishop extends Bishop
{
	public static $color = 'white';
	public $asciicode = '&#9815;';
	public $queenkingside;

	public $illegalCoordinates = array(); 



	public function __construct(){

		parent::__construct();
		$this->setIllegalCoordinates(); 	
	}



	public function setIllegalCoordinates(){
		$this->queenkingside = 'q';
		$this->illegalCoordinates =($this->queenkingside == 'q') 
			? array('B1','D1','F1','H1', 
					'A2','C2','E2','G2',
					'B3','D3','F3','H3',
					'A4','C4','E4','G4',
					'B5','D5','F5','H5',
					'A6','C6','E6','G6',
					'B7','D7','F7','H7',
					'A8','C8','E8','G8'
				)
			: array('A1','C1','E1','G1',
				'B2','D2','F2','H2', 
				'A3','C3','E3','G3',
				'B4','D4','F4','H4', 
				'A5','C5','E5','G5',
				'B6','D6','F6','H6', 
				'A7','C7','E7','G7',
				'B8','D8','F8','H8'
			);
	}
}
class BlackBishop extends Bishop
{
	public static $color = 'black';
	public $asciicode = '&#9821;';
	public $illegalCoordinates = array(); 
}
class WhiteRook extends Rook
{
	public static $color = 'white';
	public $asciicode = '&#9814;';
	public $illegalCoordinates = array(); 
}
class BlackRook extends Rook
{
	public static $color = 'black';
	public $asciicode = '&#9820;';
	public $illegalCoordinates = array(); 
}
class WhiteKnight extends Knight
{
	public static $color = 'white';
	public $asciicode = '&#9816;';
	public $illegalCoordinates = array(); 
}
class BlackKnight extends Knight
{
	public static $color = 'black';
	public $asciicode = '&#9822;';
	public $illegalCoordinates = array(); 
}
class WhiteQueen extends Queen
{
	public static $color = 'white';
	public $asciicode = '&#9813;';
	public $illegalCoordinates = array(); 
}
class BlackQueen extends Queen
{
	public static $color = 'black';
	public $asciicode = '&#9819;';
	public $illegalCoordinates = array(); 
}
class WhiteKing extends King
{
	public static $color = 'white';
	public $asciicode = '&#9812;';
	public $illegalCoordinates = array(); 
}
class BlackKing extends King
{
	public static $color = 'black';
	public $asciicode = '&#9818;';
	public $illegalCoordinates = array(); 
}


class BlackBishops extends Chesspieces 
{
	public static $entityName = 'BlackBishop';
	public static $instancesByStartPosition = array('c8','f8');
}
class WhiteBishops extends Chesspieces 
{
	public static $entityName = 'WhiteBishop';
	public static $instancesByStartPosition = array('c1','f1');
}

class BlackKnights extends Chesspieces 
{
	public static $entityName = 'BlackKnight';
	public static $instancesByStartPosition = array('b8','g8');
}
class WhiteKnights extends Chesspieces 
{
	public static $entityName = 'WhiteKnight';
	public static $instancesByStartPosition = array('b1','g1');
}

class WhiteRooks extends Chesspieces 
{
	public static $entityName = 'WhiteRook';
	public static $instancesByStartPosition = array('a1','h1');
}
class BlackRooks extends Chesspieces 
{
	public static $entityName = 'BlackRook';
	public static $instancesByStartPosition = array('a8','h8');
}
class WhiteQueens extends Chesspieces 
{
	public static $entityName = 'WhiteQueen';
	public static $instancesByStartPosition = array('d1');
}
class BlackQueens extends Chesspieces 
{
	public static $entityName = 'BlackQueen';
	public static $instancesByStartPosition = array('d8');
}
class WhiteKings extends Chesspieces 
{
	public static $entityName = 'WhiteKing';
	public static $instancesByStartPosition = array('e1');
}
class BlackKings extends Chesspieces 
{
	public static $entityName = 'BlackKing';
	public static $instancesByStartPosition = array('e8');
}
class WhitePawns extends Chesspieces
{
	public static $entityName = 'WhitePawn';
	public static $instancesByStartPosition = array(
		'a2','b2','c2','d2','e2','f2','g2','h2'
	); 
}
class BlackPawns extends Chesspieces 
{
	public static $entityName = 'BlackPawn';
	public static $instancesByStartPosition = array(
		'a7','b7','c7','d7','e7','f7','g7','h7'
	); 
}
class ChessSquare
{
	public $color, $pos, $rank, $col;

	public function __construct($pos){
		$this->pos = strtoupper($pos);
		$this->rank = substr($this->pos, 1, 1);
		$this->col = substr($this->pos, 0, 1);
		 
	}
	public static function get($pos){
		return new self($pos);
	}
}
class ChessSquares 
{
	private static $allPositions = array(
		array('a1','b1','c1','d1','e1','f1','g1','h1'),
		array('a2','b2','c2','d2','e2','f2','g2','h2'),
		array('a3','b3','c3','d3','e3','f3','g3','h3'),
		array('a4','b4','c4','d4','e4','f4','g4','h4'),
		array('a5','b5','c5','d5','e5','f5','g5','h5'),
		array('a6','b6','c6','d6','e6','f6','g6','h6'),
		array('a7','b7','c7','d7','e7','f7','g7','h7'),
		array('a8','b8','c8','d8','e8','f8','g8','h8')
	);

	public static function getAll(){
		$squares = array();
		foreach(self::$allPositions as $row) {
			$rank = substr($row[0], 1, 1);
			foreach($row as $pos){
				$squares[$rank][strtoupper($pos)] = ChessSquare::get(strtoupper($pos)); 
			}
		}
		return array_reverse($squares);
	}
}
class ChessBoard extends ChessSquares {
	
	public $squares;

	public function __construct(){
		$this->init();
	}
	public function init(){
		$this->squares = ChessSquares::getAll();
		$this->setup   = SetupUtils::mapBoard();
	}
	public static function get(){
		return new self;
	}
} /*
class GameLog {

	public function __construct($glid){
		$this->glid = $glid;
	}
	public static function get(){
		$rows = GameLogger::getLogByGameLogID();
	}
	
}
class GameLogger {
	private function __construct(){

	}
	public static function init(){

	}
	public static function logMove(){

	}
	public static function getLogByGameLogID(){

	}
	
}
class Game {
	public function __construct(){
		GameLogger::init();
		$this->log = GameLog::get();
	}

} */
class SetupUtils {

	public static function getPieceTypes(){
		$types = array();
		foreach(self::getPieces() as $array){
			foreach($array as $piece){
				$types[get_class($piece)] = get_class($piece);
			}
		} 
		return $types;
	}

	public static function getPieces(){

		$wb = array();
		$wb = WhiteBishops::getPieces();
		$wb['c1']->queenkingside = 'q'; 
		$wb['f1']->queenkingside = 'k';
		$wb['c1']->setIllegalCoordinates(); 
		$wb['f1']->setIllegalCoordinates();
		//die(var_dump($wb));
		//die(var_dump($wb));	
		//$queenkingside
		return array(
			'pawns'   => array_merge(WhitePawns::getPieces(),   BlackPawns::getPieces()   ),
			'rooks'   => array_merge(WhiteRooks::getPieces(),   BlackRooks::getPieces()   ),
			'knights' => array_merge(WhiteKnights::getPieces(), BlackKnights::getPieces() ),
			'bishops' => array_merge($wb, BlackBishops::getPieces() ),
			'kings'   => array_merge(WhiteKings::getPieces(),   BlackKings::getPieces()   ),
			'queens'  => array_merge(WhiteQueens::getPieces(),  BlackQueens::getPieces()  )
		);
	}
	public static function mapBoard(){
		$setup = array();
		foreach(self::getPieces() as $type=>$pieces){
			foreach($pieces as $pos=>&$obj){

				if(strtolower($pos) == 'c1'){
					$obj->queenkingside = 'q'; 
					$obj->setIllegalCoordinates(); 	
				}
				if(strtolower($pos) == 'f1'){
					$obj->queenkingside = 'k';
					$obj->setIllegalCoordinates(); 
				}

				$setup[strtoupper($pos)] = $obj;
			}
		}
		return $setup;
	}
}
class Move 
{

	public function __construct(ChessPiece $movingPiece,
			ChessSquare $originSquare,
			ChessSquare $destinationSquare,
            $isCheck = false,
            $isMate= false,
            $isWhiteMove = true
            ){
	/* 

    Creates a full move.

	Parameters:
	    move - the short move
	    movingPiece - the piece moving
	    colFrom - file if should be taken for SAN, NO_COL otherwise
	    rowFrom - rank if should be taken for SAN, NO_ROW otherwise
	    isCheck - whether the move gives a check
	    isMate - whether the move sets mate 

    */

    $this->originSquare      = $originSquare;
	$this->destinationSquare = $destinationSquare;
	$this->movingPiece       = $movingPiece;
	$this->isCheck           = $isCheck;
	$this->isMate            = $isMate; 
	$this->valid             = $this->isValid();
	}

	public static function cols2Int($color = 'white'){
		$rev = array_reverse(range('A','H'));
		$ret = ($color == 'white') 
			? array_combine( range(1, 8),            range('A','H') ) 
			: array_combine( range(1, 8), $rev) ;
		return array_flip($ret);
	}
    public function toArray()
    {
    	return get_object_vars($this);
    }
     
	public function isValid(){
		echo '';
		if( in_array($this->originSquare,      $this->movingPiece->illegalCoordinates) || 
			in_array($this->destinationSquare, $this->movingPiece->illegalCoordinates)
			){
			return false;
		}


		switch(get_class($this->movingPiece)){
			case 'WhiteKing':
			case 'BlackKing':
			return $this->validateKingMove();
		
			case 'WhiteRook':
			case 'BlackRook':
			return $this->validateRookMove();
		
			case 'WhiteKnight':
			case 'BlackKnight':
			return $this->validateKnightMove();
		
			case 'WhiteBishop':
			case 'BlackBishop':
			return $this->validateBishopMove();
		
			case 'WhiteQueen':
			case 'BlackQueen':
			return $this->validateQueenMove();
		
			case 'WhitePawn':
			case 'BlackPawn':
			return $this->validatePawnMove();
			
			default:
			break;
		}
		return false;
	}

	public function validateKingMove(){

		Move::cols2Int($this->destinationSquare->col ) - Move::cols2Int($this->originSquare->col );;

		if ($this->destinationSquare->rank - $this->originSquare->rank == 1  ) {
			return true;
		}
		return false;
	}

	public function validateKnightMove(){
		if ($this->destinationSquare->col - $this->originSquare->col == 1  
			&& $this->destinationSquare->rank - $this->originSquare->rank == 2
			) {
			return true;
		}
		return false;
	}

	/* 
	The Queen's moves set is a superset of the Bishop, Rook, King moves set
	*/
	public function validateQueenMove(){
		if ($this->validateBishopMove() 
			&& $this->validateKingMove() 
			&& $this->validateRookMove() ) {
			return true;
		}
		return false;
	}

	public function validateBishopMove(){

		//echo 'called validator';
		if( in_array($this->originSquare->pos,      $this->movingPiece->illegalCoordinates) || 
			in_array($this->destinationSquare->pos, $this->movingPiece->illegalCoordinates)
			){
			return false;
		}
		return true;
	}

	public function validateRookMove(){
		if ($this->destinationSquare->col == $this->originSquare->col  
			|| $this->destinationSquare->rank == $this->originSquare->rank 
			) {
			return true;
		}
		return false;
	}

	public function validatePawnMove(){
		$isCapture = false;

		$startPositions = ($this->movingPiece->kolor == 'black') 
			? BlackPawns::$instancesByStartPosition 
			: WhitePawns::$instancesByStartPosition;

		$isFirstMove = in_array(strtolower($this->originSquare->pos), $startPositions);
		$this->isFirstMove = true;
		$this->rankDiff = $this->destinationSquare->rank - $this->originSquare->rank;
		if ( !$isCapture 
			&& !$isFirstMove
			&& ($this->destinationSquare->col == $this->originSquare->col) 
			&& ( $this->rankDiff == 1) 
			) {
			
			return true;
		}
		if ( !$isCapture 
			&& $isFirstMove
			&& ($this->destinationSquare->col == $this->originSquare->col) 
			&& ( $this->rankDiff == 1 ||  $this->rankDiff == 2) 
			) {
			return true;
		}
		return false;
	}

	public static function get(ChessPiece $movingPiece,
			ChessSquare $originSquare,
			ChessSquare $destinationSquare,
            $isCheck = false,
            $isMate= false,
            $isWhiteMove = true){

		return new self( $movingPiece, $originSquare,$destinationSquare, $isCheck, $isMate,$isWhiteMove  );
	}
}
$board = ChessBoard::get();