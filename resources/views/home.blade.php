@extends("layouts/app")

@section("head")
<style>
td img{
  max-width:20vmin;
  height:auto;
  margin:2vmin;
  position:relative;
  transition:top 2s , transform 0.4s;
  transition-timing-function: ease-out;
  top:0px;
  cursor:pointer;
  transform-style:preserve-3d;
}

td {
}
@media screen and (orientation: landscape){
  @keyframes cardopen{
    from{
      transform: scale(1.2) rotateZ(0deg);
    }
    to{
      transform: scale(1.6) rotateZ(-45deg) translateX(-10vw) translateY(-10vw);
    }
  }
  @keyframes cardopenReverse{
    from{
      transform: scale(1.6) rotateZ(-45deg) translateX(-10vw) translateY(-10vw);
    }
      to{
        transform: scale(1) rotateZ(0deg);
      }
  }
  @keyframes deckshift{
    from{
      transform: translateX(0) scale(1);
    }
    to{
      transform: translateX(20vw) scale(0.8);
    }
  }
  @keyframes deckshiftReverse{
    from{
      transform: translateX(20vw) scale(0.8);
    }
    to{
      transform: translateX(0) scale(1);
    }
  }
  #puzzleDetails{
    position:absolute;
    top:10vh;
    margin-left:0px;
    padding-top:30vh;
    background-color:#f5f5f5;
    width:30vw;
    height:90vh;
    transition:all 1s;
    border:black 5px dotted;
    z-index: 9001;
    /* Initial setting: */
    left:-35vw;
  }
  #puzzleDetails div.row{
    margin:5px;
  }
  @keyframes puzzledetailsopen{
    from{
      left:-35vw;
    }
    to{
      left:0vw;
    }
  }
  @keyframes puzzledetailsopenReverse{
    from{
      left:0vw;
    }
    to{
      left:-35vw;
    }
  }
}


@media screen and (orientation: portrait){
  @keyframes cardopen{
    0%{
      transform: scale(1) rotateY(0deg);
    }
    100%{
      transform: scale(2) rotateY(180deg) translateY(-15vh);
    }
  }
  @keyframes cardopenReverse{
    from{
      transform: scale(2) rotateY(180deg) translateY(-15vh);
    }
      to{
        transform: scale(1) rotateY(0deg);
      }
  }
  @keyframes deckshift{
    from{
      transform: translateY(0) scale(1);
    }
    to{
      transform: translateY(20vh) scale(0.7);
    }
  }
  @keyframes deckshiftReverse{
    from{
      transform: translateY(20vh) scale(0.7);
    }
    to{
      transform: translateY(0) scale(1);
    }
  }
  #puzzleDetails{
    position:absolute;
    margin-left:0px;
    background-color:#f5f5f5;
    width:100%;
    height:30vh;
    transition:all 1s;
    border:black 5px dotted;
    z-index: 9001;
    /* Initial setting: */
    top:-35vh;
  }
  #puzzleDetails div.row{
    margin:5px;
  }
  @keyframes puzzledetailsopen{
    from{
      top:-35vh;
    }
    to{
      top:0vh;
    }
  }
  @keyframes puzzledetailsopenReverse{
    from{
      top:0vh;
    }
    to{
      top:-35vh;
    }
  }
  table{
    margin-top:20vh;
  }
}
.cardopenAnimation{
  animation-name:cardopen;
  animation-duration:1s;
  animation-fill-mode: forwards;
}

.cardopenAnimationReverse{
  animation-name:cardopenReverse;
  animation-duration:1s;
  animation-fill-mode: initial;
}
.deckshiftAnimation{
  animation-name:deckshift;
  animation-duration:1s;
  animation-fill-mode: forwards;
}
.deckshiftAnimationReverse{
  animation-name:deckshiftReverse;
  animation-duration:1s;
}
.puzzledetailsopenAnimation{
  animation-name:puzzledetailsopen;
  animation-duration:1s;
  animation-fill-mode: forwards;
}
.puzzledetailsopenAnimationReverse{
  animation-name:puzzledetailsopenReverse;
  animation-duration:1s;
  animation-fill-mode: initial;
}
</style>
@endsection

@section("content")
<div class="container" style="padding-top:5vmin">
  <div class="row align-items-center justify-content-center">
    <div class="col-auto">
      <table id="map">
        @foreach(App\MapPiece::all()->chunk(3) as $row)
          <tr>
            @foreach($row as $mapPiece)
            <?php
            $attempts = $mapPiece->puzzle->attempts()->orderBy('created_at', 'desc')->get();
            $solved = false;
            foreach ($attempts as $attempt) {
                $uniqueResults = $attempt->results->pluck('verdict')->unique();
                if ($uniqueResults->count() == 1 && $uniqueResults->first() == 'OK') {
                    $solved = true;
                    break;
                }
            }
            ?>
            <td>
              <img src="{{$solved ? $mapPiece->imagePath : '/img/hidden_map.jpg'}}" data-puzzleId="{{$mapPiece->puzzle->id}}">
            <td>
            @endforeach
          <tr>
        @endforeach
      </table>
    </div>
  </div>
</div>
<div class="container-fluid" id="puzzleDetails">
  <div class="row align-items-center justify-content-center">
    <h1 id="puzzleName">Puzzle name</h1>
  </div>
  <div class="row align-items-center justify-content-center">
    <h3 id="puzzleStatus">To be completed</h3>
  </div>
  <div class="row align-items-center justify-content-center">
    <button type="button" class="btn btn-primary" id="puzzleOpenBtn">Solve Challenge</button>
  </div>
</div>
<script>
$(document).ready(function(){
  //generate nine random delays, from 0 to 500ms
  var delays = [];
  for(var i=0;i<9;i++){
    delays.push(Math.floor(Math.random()*500));
  }
  var squares = $("td img");
  for(var i=0;i<9;i++){
    window.setTimeout(function(delay){
      const ii = delays.indexOf(delay);
      var offset = Math.floor(5 + (Math.random() * 10)).toString();
      $(squares.get(ii)).css('top',offset + "px");
      window.setInterval(function(){
        if($(squares.get(ii)).attr("data-open")=="true"){
          return;
        }
        var curTop = Number.parseInt($(squares.get(ii)).css('top'));
        $(squares.get(ii)).css("top",(curTop*-1).toString()+"px");
      },2050);
    }, delays[i], delays[i]);
  }
  $("#map").addClass("animated fadeIn");
  $("td img").on("mouseenter",function(){
    if($(this).attr('data-open')=='true'){
      return;
    }
    if(window.screen.width < window.screen.height){
      //probably mobile
      return;
    }
    $(this).css("transform","scale(1.3)");
  })
  $("td img").on("mouseout",function(){
    if($(this).attr('data-open')=='true'){
      return;
    }
    $(this).css("transform","scale(1)");
  })
  $("td img").on("click",function(){
    //prevent only one card to be open at a time
    var cards = $("td img");
    for(var i=0;i<cards.length;i++){
      if($(cards.get(i)) != $(this) && $(cards.get(i)).attr('data-open')=='true'){
        if($(this).attr("data-open")!='true'){
          return;
        }
      }
    }
    if($(this).attr('data-open')!='true'){
      $(this).attr('data-open','true');
      $(this).removeClass("cardopenAnimationReverse");
      $(this).addClass("cardopenAnimation");
      $("#map").removeClass("deckshiftAnimationReverse");
      $("#map").addClass('deckshiftAnimation');
      $(this).css('z-index',9002);
      $("#puzzleDetails").removeClass("puzzledetailsopenAnimationReverse");
      $("#puzzleDetails").addClass("puzzledetailsopenAnimation");
      var xhr = new XMLHttpRequest();
      xhr.open("GET","/game/api/puzzle/"+ $(this).attr('data-puzzleId'));
      xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
          var responseObj = JSON.parse(xhr.responseText);
          $("#puzzleName").html(responseObj.shortDescription);
          if(responseObj.solved == true){
            $("#puzzleStatus").html("Complete!");
          }else{
            $("#puzzleStatus").html("To be completed");
          }
          $("#puzzleOpenBtn").attr("data-puzzleId",responseObj.id);
        }
      }
      xhr.send();
    }else{
      $(this).attr('data-open','false');
      $(this).addClass("cardopenAnimationReverse");
      $("#map").removeClass('deckshiftAnimation');
      $("#map").addClass("deckshiftAnimationReverse");
      $("#puzzleDetails").removeClass("puzzledetailsopenAnimation");
      $("#puzzleDetails").addClass("puzzledetailsopenAnimationReverse");
      window.setTimeout(function(){
        $(this).css('z-index','1');
      },1000);
    }

  });
  $("#puzzleOpenBtn").on("click",function(){
    window.location = "/game/puzzle/"+$(this).attr("data-puzzleId");
  });
});
</script>
@endsection
