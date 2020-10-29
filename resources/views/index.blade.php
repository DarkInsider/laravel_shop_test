@extends('layouts.master')

@section('title', 'Главная')

@section('content')
        <h1>All products</h1>
        <form method="GET" action="http://internet-shop.tmweb.ru">
            <div class="filters row">
                <div class="col-sm-6 col-md-3">
                    <label for="price_from">Price from                    <input type="text" name="price_from" id="price_from" size="6" value="">
                    </label>
                    <label for="price_to">to                    <input type="text" name="price_to" id="price_to" size="6"  value="">
                    </label>
                </div>
                <div class="col-sm-2 col-md-2">
                    <label for="hit">
                        <input type="checkbox" name="hit" id="hit" > Hit                </label>
                </div>
                <div class="col-sm-2 col-md-2">
                    <label for="new">
                        <input type="checkbox" name="new" id="new" > New                </label>
                </div>
                <div class="col-sm-2 col-md-2">
                    <label for="recommend">
                        <input type="checkbox" name="recommend" id="recommend" > Recommend                </label>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="http://internet-shop.tmweb.ru" class="btn btn-warning">Reset</a>
                </div>
            </div>
        </form>
        <div class="row">
            @foreach($products as $product)
                @include('layouts.card',['product' => $product])
            @endforeach
        </div>
        <nav>
            <ul class="pagination">

                <li class="page-item disabled" aria-disabled="true" aria-label="&laquo; Previous">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>





                <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                <li class="page-item"><a class="page-link" href="?&amp;page=2">2</a></li>


                <li class="page-item">
                    <a class="page-link" href="?&amp;page=2" rel="next" aria-label="Next &raquo;">&rsaquo;</a>
                </li>
            </ul>
        </nav>
@endsection
