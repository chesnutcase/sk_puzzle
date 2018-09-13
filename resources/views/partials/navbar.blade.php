
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/" style="font-family:'Lido STF Bold Italic';color:#EE0000">SK_Puzzles</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/game">Puzzles</a>
      </li>
      @if(session("loggedInAs") == "admin")
      <li class="nav-item">
        <a class="nav-link" href="/admin">Admin</a>
      </li>
      @else
      <li class="nav-item">
        <button type="button" class="btn btn-outline-primary" id="adminLoginBtn">Admin login</button>
      </li>
      @endif
  </div>
</nav>

<script>
  $("#adminLoginBtn").on("click",function(){
    var inputPassword = prompt("Password:");
    var xhr = new XMLHttpRequest();
    var fd = new FormData();
    xhr.open("POST","/adminLogin");
    xhr.setRequestHeader("X-CSRF-TOKEN",csrf);
    fd.append("password",inputPassword);
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4){
        if(xhr.status == 200){
          window.location = "/admin";
        }else if(xhr.status == 403){
          alert("invalid password");
        }else{
          console.log("error");
        }
      }
    }
    xhr.send(fd);
  });
</script>
