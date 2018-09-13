@extends("layouts/app")

@section("head")
<script src="/js/ace-builds/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<style>
#editor {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    height:50vh;
}
</style>
@endsection

@section("content")
<form action="/admin/puzzle" method="POST" enctype="multipart/form-data">
<div>
  Current photo: <img src="{{$mapPiece->imagePath}}" style="width:auto;height:100px">
</div>
<div>
  Upload photo? <input type="file" class="form-control" name="image">
</div>
<div>Puzzle name: <input type="text" name="puzzleName" value="{{$puzzle->shortDescription}}"></div>
<input type="hidden" value="{{$puzzle->id}}" name="puzzleId"/>
<div>Puzzle description:</div>
<div style="position:relative;padding-bottom:50vh">Puzzle description: <div id="editor">{{$puzzle->description}}</div></div>
<input type="hidden" name="puzzleDescription"/>
<div>
Test cases:
<input type="hidden" name="testCases"/>
<table class="table">
  <thead>
    <td>Id</td>
    <td>Input</td>
    <td>Output</td>
    <td>Action</td>
  </thead>
  <tbody>
    <tr style="display:none">
      <td><em>new</em></td>
      <td><textarea class="testCaseInput"></textarea></td>
      <td><input type="text" class="testCaseOutput"></td>
      <td><button type="button" class="btn btn-danger testCaseDeleteBtn">Delete</button></td>
    </tr>
    @foreach($puzzle->testCases as $testCase)
    <tr>
      <td>{{$testCase->id}}</td>
      <td><textarea class="testCaseInput" multiline>{{$testCase->input}}</textarea></td>
      <td><input type="text" value="{{$testCase->output}}" class="testCaseOutput"></td>
      <td><button type="submit" class="btn btn-danger testCaseDeleteBtn">Delete</button></td>
    </tr>
    @endforeach
  </tbody>
</table>
<button type="button" class="btn btn-outline-primary" id="addTestCaseBtn">Add test case</button>
<div>Time Limit: <input type="text" name="puzzleTimeLimit" value="{{$puzzle->timeLimit}}"></div>
<div>
  <button type="button" class="btn btn-primary" id="saveBtn">Save</button>
</div>
@csrf
</form>
<script>
$(document).ready(function(){
  $("#addTestCaseBtn").on("click",function(){
    var newRow = $("tbody > tr:first-child").clone(true,true).css("display","table-row");
    $("tbody").append(newRow);
    $(this).get(0).scrollIntoView();
  });
  $(".testCaseDeleteBtn").on("click",function(){
    $(this).parents("tr").remove();
  });
  $("#saveBtn").on("click",function(e){
    e.preventDefault();
    e.stopPropagation();
    parseTestCases();
    $("input[name='puzzleDescription']").val(editor.getValue());
    $("form").submit();
  });
});
function parseTestCases(){
  var rows = $("tbody tr");
  var saveObject = [];
  for(var i=1;i<rows.length;i++){
    var newEntry = {};
    newEntry.input = $(rows[i]).find(".testCaseInput").val();
    newEntry.output = $(rows[i]).find(".testCaseOutput").val();
    saveObject.push(newEntry);
  }
  $("input[name='testCases']").val(JSON.stringify(saveObject));
}
var editor = ace.edit("editor");
editor.setTheme("ace/theme/monokai");
editor.session.setMode("ace/mode/html");
</script>
@endsection
