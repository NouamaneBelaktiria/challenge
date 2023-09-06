<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
               
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('product.create') }}"> Create product</a>
                </div>
            </div>
        </div>
        <form method="GET" class="search-form mt-3">
        <div class="input-group">
            <input type="text" class="form-control search-input" name="search" value="{{ $search }}" placeholder="Chercher...">
        

            <button type="submit" class="btn btn-primary search-btn">CHERCHER</button>
        </div>
        </form>
       
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>name</th>
                    <th>description</th>
                    <th> price</th>
                    <th> image</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                    <td><img src="/image/{{ $product->image }}" width="100px"></td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            <form action="{{ route('product.destroy',$product->id) }}" method="Post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
 
    </div>
</body>
</html>