<html>
<head>
<title>Bond Web Service Demo</title>
<style>
  body {font-family:georgia;}

  .song{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }

</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">
function bondTemplate(song){
  return`<div class="song">
    <b>Song: </b> ${song.Song}<br />
    <b>Title: </b>${song.Title}<br />
    <b>Artist: </b> ${song.Artist}<br />
    <b>Album: </b> ${song.Album}<br />
    <b>Year: </b> ${song.Year}<br />
    <b>Producers: </b> ${song.Producers}<br />
    <div class="pic"><img src="thumbnails/${song.Image}"/></div>
    </div>`;
}


  
$(document).ready(function() { 
 
 $('.category').click(function(e){
   e.preventDefault(); //stop default action of the link
   cat = $(this).attr("href");  //get category from URL
  
   var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
     console.log(data);
     //places the title of the webservice on the page
     $("#songtitle").html(data.title);

     
     //clears previous films
      $("#songs").html("");

     //loads each film via template into div
    $.each(data.songs, function(key,value){
      let str = bondTemplate(value);
      $("<div></div>").html(str).appendTo("#songs");
    });
    
     
    //view JSON as a string
     /*
    let myData = JSON.stringify(data, null, 4);
     myData = "<pre>" + myData + "</pre>";
     $("#output").html(myData);
     */
     
   });
   request.fail(function(xhr, status, error) {
     //Ajax request failed.
     var errorMessage = xhr.status + ': ' + xhr.statusText
     alert('Error - ' + errorMessage);

    });

    loadAJAX(cat);  //load AJAX and parse JSON file
	});
});	

function loadAJAX(cat)
{
	//AJAX connection will go here
    //alert('cat is: ' + cat);
}
function toConsole(data)
{//return data to console for JSON examination
	console.log(data); //to view,use Chrome console, ctrl + shift + j
}
function bondJSON(data){
//JSON processing data goes here
}

</script>
</head>
	<body>
	<h1>Spotify Hot Hits USA</h1>
		<a href="year" class="category">Bond Films By Year</a><br />
		<a href="box" class="category">Bond Films By International Box Office Totals</a>
		<h3 id="songtitle">Title Will Go Here</h3>
		<div id="songs">
			<p>Songs will go here</p>
		</div>

    <!--
    <div class="film">
    <b>Film: </b> 1<br />
    <b>Title: </b> Dr. Yes<br />
    <b>Year: </b> 1962<br />
    <b>Director: </b> Terence Young<br />
    <b>Producers: </b> Harry Saltzman and Albert R. Broccoli<br />
    <b>Writers: </b> Richard Maibaum, Johanna Harwood and Berkely Mather<br />
    <b>Composer: </b> Monty Norman<br />
    <b>Bond: </b> Sean Connery<br />
    <b>Budget: </b> $1,000,000.00<br />
    <b>BoxOffice: </b> $59,567,035.00<br />
    <div class="pic"><img src="thumbnails/dr-no.jpg"/></div>
    </div>
  -->
    
		<div id="output">Results go here</div>
	</body>
</html>