<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Filtered Products</h1>

    @if(count($products) > 0)
        <ul>
            @foreach($products as $product)
                <li>{{ $product->name }} - Price: ${{ $product->price }}</li>
            @endforeach
        </ul>
    @else
        <p>No products found.</p>
    @endif
</body>
</html>