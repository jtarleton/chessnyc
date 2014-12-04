<?php require_once('chess.php'); ?>

<!DOCTYPE html>
<head>
<!-- 
&#9812; = ♔
&#9813; = ♕
&#9814; = ♖
&#9815; = ♗
&#9816; = ♘
&#9817; = ♙
&#9818; = ♚
&#9819; = ♛
&#9820; = ♜
&#9821; = ♝
&#9822; = ♞
&#9823; = ♟
-->
<style type="text/css">
a {
	color:#000;
	display:block;
	font-size:60px;
	height:80px;
	position:relative;
	text-decoration:none;
	text-shadow:0 1px #fff;
	width:80px;
}
#chess_board { border:5px solid #333; }
#chess_board td {
	background:#fff;
	background:-moz-linear-gradient(top, #fff, #eee);
	background:-webkit-gradient(linear,0 0, 0 100%, from(#fff), to(#eee));
	box-shadow:inset 0 0 0 1px #fff;
	-moz-box-shadow:inset 0 0 0 1px #fff;
	-webkit-box-shadow:inset 0 0 0 1px #fff;
	height:80px;
	text-align:center;
	vertical-align:middle;
	width:80px;
}
#chess_board tr:nth-child(odd) td:nth-child(even),
#chess_board tr:nth-child(even) td:nth-child(odd) {
	background:#ccc;
	background:-moz-linear-gradient(top, #ccc, #eee);
	background:-webkit-gradient(linear,0 0, 0 100%, from(#ccc), to(#eee));
	box-shadow:inset 0 0 10px rgba(0,0,0,.4);
	-moz-box-shadow:inset 0 0 10px rgba(0,0,0,.4);
	-webkit-box-shadow:inset 0 0 10px rgba(0,0,0,.4);
}


</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<style>
#draggable, #draggable2 { width: 100px; height: 100px; padding: 0.5em; float: left; margin: 10px 10px 10px 0; }
#droppable { width: 150px; height: 150px; padding: 0.5em; float: left; margin: 10px; }

.ui-state-hover,
.ui-widget-content .ui-state-hover,
.ui-widget-header .ui-state-hover,
.ui-state-focus,
.ui-widget-content .ui-state-focus,
.ui-widget-header .ui-state-focus {
	border: 1px solid lime;
	background: #dadada url("images/ui-bg_glass_75_dadada_1x400.png") 50% 50% repeat-x;
	font-weight: normal;
	color: #212121;
}

/* Interaction Cues */
.ui-state-highlight,
.ui-widget-content .ui-state-highlight,
.ui-widget-header .ui-state-highlight {
	border: 1px solid cyan;
	background: lime url("images/ui-bg_glass_55_fbf9ee_1x400.png") 50% 50% repeat-x;
	color: orange;
} 

</style>
<script type="text/javascript">

function validatemove(){
	var data = {
		"originSquare" : jQuery('#originSquare').val(),
		"destSquare"   : jQuery('#destSquare').val(),
		"pieceType"    : jQuery('#pieceType').val()
	};
	var success = function( data ) {

		/* 
		{"originSquare":{
			"color":null,"pos":"E2","rank":"2","col":"E"},
			"destinationSquare":{"color":null,"pos":"E4","rank":"4","col":"E"},
			
			"movingPiece":
			{"asciicode":"&#9817;",
			"illegalCoordinates":["a1","b1","c1","d1","e1","f1","g1","h1"],
			"type":"pawn","kolor":"white"},
		"isCheck":false,"isMate":false,
		"isFirstMove":true,
		"rankDiff":2,
		"valid":true}

		*/

	if(data.movingPiece.kolor=='white'){
	  jQuery( "#whitelog" ).append('<li>' + data.movingPiece.asciicode +' '+ ucfirst(data.movingPiece.kolor) + ' ' + ucfirst(data.movingPiece.type) + ' '+ data.originSquare.pos + ' '+ data.destinationSquare.pos +' '+data.valid +'</li>');
	}
	else if(data.movingPiece.kolor=='black') {
	  jQuery( "#blacklog" ).append('<li>' + data.movingPiece.asciicode +' '+ ucfirst(data.movingPiece.kolor) + ' ' + ucfirst(data.movingPiece.type) + ' '+ data.originSquare.pos + ' '+ data.destinationSquare.pos +' '+data.valid +'</li>');

	}

		if(data.valid == false){
			//jQuery( ".pawn" ).draggable({ revert: "valid" });
		} else {
			return;
		}
	};

	jQuery.ajax({
	  type: "POST",
	  url: 'movecallback.php',
	  data: data,
	  success: success,
	  dataType: 'json'
	});
}


function ucfirst(str) {
  //  discuss at: http://phpjs.org/functions/ucfirst/
  str += '';
  var f = str.charAt(0)
    .toUpperCase();
  return f + str.substr(1);
}

jQuery(document).ready(function(){
	jQuery('a').unbind('mouseleave').bind('mouseleave', function (){ 
	jQuery('#pieceType').val('');
	jQuery('#originSquare').val('');
	jQuery('#destSquare').val('');
});

jQuery('a').unbind('mouseenter').bind('mouseenter', function (){

classes=jQuery(this).attr('class');
classesarr = classes.split(' ');

objname = ucfirst(classesarr[1]) + ucfirst(classesarr[0]);

jQuery('#pieceType').val(objname);

jQuery('#originSquare').val(jQuery(this).parent('td').attr('id'));

activepiece = classesarr[0] +  classesarr[1] + ' ' + jQuery(this).parent('td').attr('id');

});

var dropcallback = function( event, ui ) {

 	jQuery( this )
		.addClass( "ui-state-highlight" )
		.addClass( "ui-state-highlight2" ); 
	
var d = new Date();
activepiece = ucfirst(classesarr[1]) + ' moved ' + ucfirst(classesarr[0]) +' from ' + jQuery('#originSquare').val() + ' to '+ jQuery(this).attr('id') +' at ' + d.toLocaleString() ;
jQuery('ul#log').append('<li>'+ activepiece +'</li>');


	jQuery('#destSquare').val(jQuery(this).attr('id'));
	validatemove();
	
};



jQuery( "#draggable2" ).draggable({ revert: "invalid" });

jQuery( ".pawn, .knight" ).draggable({ revert: "invalid" });

jQuery( "#A3, #A4, #B3, #B4, #C3, #C4, #D3, #D4, #E3, #E4,#F3, #F4,#G3, #G4, #H3, #H4, #A5, #A6, #B5, #B6, #C5, #C6, #D5, #68, #E5, #E6,#F5, #F6,#G5, #G6, #H5, #H6" ).droppable({

	activeClass: "ui-state-default",

	hoverClass : "ui-state-hover"  ,

	drop: dropcallback

});

});
</script>
</head>
</style>
</head>
<body><div style="float:left;">
<table id="chess_board" cellpadding="0" cellspacing="0">
<?php foreach($board->squares as $rank=>$row): ?>
<tr>
	<?php foreach($row as $square):
		$coord = strtoupper($square->pos);  
		$po    = (array_key_exists($coord, $board->setup)) ? $board->setup[$coord] : null; ?>
		<td id="<?php echo $coord; ?>"> 
			<?php if((isset($po))): ?>
			<a href="#" class="<?php echo $po->type; ?> <?php echo $po->kolor; ?>"><?php echo (isset($po)) ? $po->asciicode : null; ?></a>
			<?php endif; ?>   
		</td>
	<?php endforeach; ?>
</tr>
<?php endforeach; ?>
</table></div>
<div style="">

<table style="width:500px;table-layout:fixed;">
<thead>
<tr>
<th>White</th>
<th>Black</th>
<th>Events</th>

</tr>
</thead>
<tbody>
	<tr><td>
<ul id="whitelog"></ul></td>
<td><ul id="blacklog"></ul></td>
<td><ul id="log"></ul></td>
</tr>
</tbody>
</table>
</div>

<div style="clear:both;">

<form id="moveform" action="chessui.php" method="POST">
<select id="pieceType" name="pieceType">
	<?php foreach(SetupUtils::getPieceTypes() as $type): ?>
<option value="<?php echo $type; ?>"><?php echo $type; ?></option>
<?php endforeach; ?>
</select>

	<select id="originSquare" name="originSquare">
<?php foreach(ChessSquares::getAll() as $row): ?>
	<optgroup label="<?php $i = current($row); echo $i->rank; ?>">
	<?php foreach($row as $obj): ?>
<option value="<?php echo $obj->pos; ?>"><?php echo $obj->pos; ?></option>
<?php endforeach; ?></optgroup>
<?php endforeach; ?>
</select>

<select id="destSquare" name="destSquare">
<?php foreach(ChessSquares::getAll() as $row): ?>
	<optgroup label="<?php $i = current($row); echo $i->rank; ?>">
	<?php foreach($row as $obj): ?>
<option value="<?php echo $obj->pos; ?>"><?php echo $obj->pos; ?></option>
<?php endforeach; ?></optgroup>
<?php endforeach; ?>
</select>
</form>
</div>
</body>
</html>