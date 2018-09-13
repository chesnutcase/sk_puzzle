@extends("layouts/app")

@section("head")
<script src="/js/ace-builds/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<link rel="preload" as="font" href="/font/LidoSTFBoldItalic.otf">
<link rel="stylesheet" href="/css/stageClearAnimation.css">
<style type="text/css" media="screen">
    @font-face {
        font-family: 'Lido STF Bold Italic';
        src: url('/font/LidoSTFBoldItalic.otf');
    }
    #editor {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        height:50vh;
    }
    #runButton{
      position:absolute;
      top:50vh;
      left:0;
      z-index:9001;
    }
    #attemptsTableDiv{
      max-height:50vh;
      overflow-y: scroll;
    }
    #clearMaki{
      border-radius:50%;
      width:50%;
      height:auto;
      margin-left:25%;
      margin-right:25%;
      margin-top:15%;
      display:none;
    }
    #stageClearText{
      position:relative;
      text-align:center;
      margin-top:5%;
      font-family:'Lido STF Bold Italic';
      color:#EE0000;
      transform: translate(-150px, -50px) rotate(-180deg) scale(3);
    }
    pre{
      background-color:lightgray;
    }
</style>
<script>
var puzzleId = {{$puzzle->id}};
</script>
@endsection

@section("content")
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <h1 class="display-3" style="font-family:'Lido STF Bold Italic';color:#EE0000">{{$puzzle->shortDescription}}</h1>
      <div>{!!$puzzle->description!!}</div>
    </div>
    <div class="col-md-6">
        <?php
        $defaultCode = <<<'EOT'
#include <iostream>

using namespace std;

int main(){
    
    return 0;
}
EOT;
        ?>
        <div id="editor">{{$puzzle->attempts()->count() > 0 ? $puzzle->attempts()->orderBy("created_at","desc")->first()->code : $defaultCode}}</div>
        <button type="button" class="btn btn-primary" id="runButton">Run</button>
    </div>
  </div>
  <div class="row" id="attemptsTableDiv">
    <div class="col-md-6">
      <div class="row">
        <div class="col-auto">
          <h3 style="display:inline">Your recent attempts</h3>
        </div>
        <div class="col-auto ml-auto">
          <small class="text-muted">Scroll table for more</small>
        </div>
      </div>
      <table class="table table-striped" id="attemptsTable">
        <thead class="thead-light">
          <tr>
            <th>Attempt</th>
            <th>Verdict</th>
          </tr>
        </thead>
        <tbody>
        @foreach($puzzle->attempts->reverse() as $attempt)
          @foreach($attempt->results as $result)
            <tr class="{{strpos($result->verdict,'Compilation Error') === 0 ? 'table-warning' : ($result->verdict == 'OK' ? 'table-success' : 'table-danger') }}">
              @if($loop->first == 1)
                <td rowspan="{{$attempt->results->count()}}">{{$attempt->id}}</td>
              @endif
              <td>{{$result->verdict}}</td>
            </tr>
          @endforeach
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="modal fade" id="stageClearModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body" style="height:60vh">
        <img src="/img/clear_maki.jpg" id="clearMaki"/>
        <h1 class="display-3" id="stageClearText"><span>S</span><span>t</span><span>a</span><span>g</span><span>e</span><span> </span><span>C</span><span>l</span><span>e</span><span>a</span><span>r</span><span>!</span>
        </h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="window.location='/game'">Return to puzzles home</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $(".container-fluid").addClass("animated fadeInUp");
  $("#runButton").on("click",function(){
    var nextAttemptId = $("#attemptsTable > tr:last-child > td:first-child").html();
    if(nextAttemptId == undefined){
      nextAttemptId = 0;
    }
    var newRow = document.createElement("tr");
    newRow.innerHTML = "<td>" + (Number.parseInt(nextAttemptId) + 1).toString() + "</td>" + "<td>Compiling....</td>";
    $("#attemptsTable tbody").prepend(newRow);
    newRow.scrollIntoView();
    var compileXHR = new XMLHttpRequest();
    var compileFD = new FormData();
    compileXHR.open("POST","/game/api/compile");
    compileXHR.setRequestHeader("X-CSRF-TOKEN",csrf);
    compileFD.append("code", editor.getValue());
    compileFD.append("puzzle", puzzleId);
    compileXHR.onreadystatechange = function(){
      if(compileXHR.status == 200 && compileXHR.readyState == 4){
        var responseObj = JSON.parse(compileXHR.responseText);
        $(newRow).find("td:first-child").html(responseObj.id);
        if(responseObj.status == "OK"){
          $(newRow).find("td:last-child").html("Compile OK - Running...");
          $(newRow).addClass("table-warning");
          var testXHR = new XMLHttpRequest();
          var testFD = new FormData();
          testFD.append("attempt",responseObj.id);
          testXHR.open("POST","/game/api/test");
          testXHR.setRequestHeader("X-CSRF-TOKEN",csrf);
          testXHR.onreadystatechange = function(){
            if(testXHR.readyState == 4 && testXHR.status == 200){
              var responseObj2 = JSON.parse(testXHR.responseText);
              $(newRow).find("td:first-child").attr("rowspan",responseObj2.length);
              $(newRow).find("td:last-child").html(responseObj2[0].verdict);
              if(responseObj2[0].verdict == "OK"){
                $(newRow).addClass("table-success").removeClass("table-warning");
              }else{
                $(newRow).addClass("table-danger").removeClass("table-warning");
              }
              for(var i=responseObj2.length-1;i>=1;i--){
                if(responseObj2[i].verdict == "OK"){
                  var newClass = "class='table-success'";
                }else{
                  var newClass = "class='table-danger'";
                }
                $(newRow).after("<tr "+newClass+"><td>" + responseObj2[i].verdict + "</td></tr>");
              }
              var cleared = true;
              //set default true and try to prove it false
              for(var i=0;i<responseObj2.length;i++){
                if(responseObj2[i].verdict != "OK"){
                  cleared = false;
                }
              }
              if(cleared){
                $("#stageClearModal").modal();
                $("#stageClearText").removeClass("clearAnimation");
                $("#stageClearText").addClass("clearAnimation");
              }
              $("#attemptsTable").get(0).scrollIntoView();
            }
          }
          testXHR.send(testFD);
        }else{
          $(newRow).find("td:last-child").html("Compilation error: " + responseObj.error);
          $(newRow).addClass("table-danger");
        }
      }
    }
    compileXHR.send(compileFD);
  });
});

var editor = ace.edit("editor");
editor.setTheme("ace/theme/monokai");
editor.session.setMode("ace/mode/c_cpp");
</script>
@endsection
