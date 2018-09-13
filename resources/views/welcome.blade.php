@extends("layouts/app")

@section("content")
<div class="container-fluid" style="padding-top:5vh">
  <div class="row align-items-center justify-content-center" style="perspective:1000px">
    <img src="/img/main_maki.jpg" style="max-height:35vh;width:auto;border-radius:50%;position:relative" id="maki" data-flipCount="1"/>
  </div>
  <div class="row align-items-center justify-content-center">
    <h1 class="display-1">Hello SK</h1>
  </div>
  <div class="row align-items-center justify-content-center">
    <h4>Let us begin the game</h4>
  </div>
  <div class="row align-items-center justify-content-center">
    <div class="input-group col-md-2">
      <input class="form-control" type="password" placeholder="password" id="passwordField" autofocus>
      <div class="input-group-append">
        <button class="btn btn-primary" onClick="login();">Enter</button>
      </div>
    </div>
  </div>
  <div class="row align-items-center justify-content-center" style="display:none" id="wrongPasswordAlert">
    <div class="alert alert-danger" role="alert">
      Incorrect password!
    </div>
  </div>
  @if(session("error"))
  <div class="row align-items-center justify-content-center">
    <div class="alert alert-danger" role="alert">
      {{session("error")}}
    </div>
  </div>
  @endif
</div>

<script>
function login(){
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/login");
  xhr.setRequestHeader("X-CSRF-TOKEN",csrf);
  var fd = new FormData();
  fd.append("password",$("#passwordField").val());
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      if(xhr.status == 200){
        window.location = "/game";
      }else{
        $("#wrongPasswordAlert").show();
        $("#wrongPasswordAlert").addClass("animated shake faster");
        $("#wrongPasswordAlert").one("animationend",function(){
          $("#wrongPasswordAlert").removeClass("animated shake faster");
        })
      }
    }
  }
  xhr.send(fd);
}
$(document).ready(function(){
  $(".container-fluid").addClass("animated fadeInUp");
  window.setInterval(function(){
    $("#maki").css("transform","rotateY("+(Number.parseInt($("#maki").attr("data-flipCount"))*360).toString()+"deg)");
    $("#maki").css("transition-duration","1.2s");
    $("#maki").css("transition-timing-function","ease-in-out");
    $("#maki").css("transform-style","preserve-3d");
    $("#maki").attr('data-flipCount', Number.parseInt($("#maki").attr('data-flipCount'))+1);
  },4000);
  $("#passwordField").on("keyup",function(e){
    if(event.key == "Enter"){
      $("#passwordField").parent().find("button").trigger("click");
    }
  })
});
</script>

@endsection
