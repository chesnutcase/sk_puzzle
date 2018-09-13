@extends("layouts/app")

@section("head")
<script src="/js/ace-builds/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<style type="text/css" media="screen">
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
</style>
<script>
var puzzleId = {{$puzzle->id}};
</script>
@endsection

@section("content")
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <h1 class="display-4">{{$puzzle->shortDescription}}</h1>
      <div>{!!$puzzle->description!!}</div>
    </div>
    <div class="col-md-6">
        <div id="editor">{{$puzzle->attempts()->count() > 0 ? $puzzle->attempts()->orderBy("created_at","desc")->first()->code : ''}}</div>
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
          <h6 style="display:inline">Scroll table for more</h6>
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
              $("#attemptsTable > tr:last-child").get(0).scrollIntoView();
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
