<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        
        <style>
        </style>
    </head>
    <body>
        <table class="table" data-type-sort="" id="table">
        <thead>
          <tr>
          @foreach($attributes as $attribute)
            <th scope="col" id="{{$attribute}}"><a href="/" onclick="sort(event)">{{$attribute}}</a></th>
          @endforeach
          </tr>
        </thead>
        @if(isset($products))
        @foreach($products as $product)
            <tr>
              <td>{{$product->id}}</td>
              <td>{{$product->name}}</td>
              <td>{{$product->price}}</td>
              <td>{{$product->rating}}</td>
              <td style="padding:7px">
                <button class="btn btn-primary" type="button"  data-row-id="{{$product->id}}" onclick="deleteProduct(event)" >DELETE</button>
                <button class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-row-id="{{$product->id}}" onclick="getData(event)">EDIT</button>
              </td>
            </tr>
        @endforeach
        @endif
        </table>
        <button class="btn btn-primary" data-toggle="modal" data-target="#createModal"> Добавить запись </button>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Изменение строки:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="editForm" data-row-id="">           
                  <div class="form-group">
                    <label for="nameInput">Name:</label>
                    <input id="nameInput" name="name" class="form-control" value="" >
                  </div>
                  <div class="form-group">
                    <label for="priceInput">Price:</label>
                    <input id="priceInput" name="price" class="form-control" value="" >
                  </div>
                  <div class="form-group">
                    <label for="ratingInput">Rating:</label>
                    <input id="ratingInput" name="rating" class="form-control" value="" >
                  </div>
                </form>
              </div>
            <div class="modal-footer" id="modal-footer-edit">
              <p></p>
              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="buttonClose">Закрыть</button>
              <button type="button" class="btn btn-primary" id="buttonUpload" onclick="sendUpdate(event)">Изменить</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Добавить строку:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="createForm" data-row-id="">           
                  <div class="form-group">
                    <label for="nameInput">Name:</label>
                    <input id="nameInput" name="name" class="form-control" value="" >
                  </div>
                  <div class="form-group">
                    <label for="priceInput">Price:</label>
                    <input id="priceInput" name="price" class="form-control" value="" >
                  </div>
                  <div class="form-group">
                    <label for="ratingInput">Rating:</label>
                    <input id="ratingInput" name="rating" class="form-control" value="" >
                  </div>
                </form>
              </div>
            <div class="modal-footer" id="modal-footer-add">
              <p></p>
              <button type="button" class="btn btn-secondary" id="buttonClose" data-dismiss="modal">Закрыть</button>
              <button type="button" class="btn btn-primary" id="buttonCreate" onclick="createRow(event)">Создать запись</button>
            </div>
          </div>
        </div>
      </div>
    </body>
    <script src="{{asset('js/myscript.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
</html>
