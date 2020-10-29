<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">


        </div>
        <img src="http://internet-shop.tmweb.ru/storage/products/beats.jpg" alt="Наушники Beats Audio">
        <div class="caption">
            <h3>{{$product->name}}</h3>

            {{$product->category->name}}

            <p>{{$product->price}}</p>
            <p>
            <form action="{{route('basket-add',$product->id)}}" method="POST">
                <button type="submit" class="btn btn-primary" role="button">Add to cart</button>
                <a href="{{route('product',[$product->category->code,$product->code])}}"
                   class="btn btn-default"
                   role="button">More about</a>
                @csrf
            </form>
            </p>
        </div>
    </div>
</div>
