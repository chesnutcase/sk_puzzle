@extends("layouts/app")

@section("head")
<style>
table img{
  max-width:20vmin;
  height:auto;
  cursor:pointer;
}
td{
  width:min-content;
}
</style>
@endsection

@section("content")
<table>
@foreach(\App\MapPiece::all()->chunk(3) as $row)
  <tr>
    @foreach($row as $column)
    <td><img src="{{$column->imagePath}}"></td>
    @endforeach
  </tr>
@endforeach
</table>
<div>
  Click on puzzle piece to modify data
</div>
@endsection
