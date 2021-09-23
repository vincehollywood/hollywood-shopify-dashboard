@extends('shopify-app::layouts.default')

@section('content')
    <p>You are: {{ $shopDomain ?? Auth::user()->name }}</p>
    <h1>Hello Shopify</h1>
    <hr />
    <p>Store Name: {{ $storeDetails['name'] }}</p>
    <p>Registered Address: {{ $registeredAddress }}</p>
    <p>Email: {{ $storeDetails['email'] }}</p>
    <hr />
    <p>Product Name: {{ $selectedProduct->title }}</p>
    <p>Product Default Variant Price: &pound;{{ $selectedProduct->variants[0]['price'] }}</p>
    <hr />
    <p>Order Title: {{ $selectedOrder->name }}</p>
    <p>Order Line Item Count: {{ $lineItemsCount }}</p>
    <p>Order Total Value: &pound;{{ $selectedOrder->total_price }}</p>
@endsection

@section('scripts')
    @parent

    <script>
        actions.TitleBar.create(app, { title: 'Home' });
    </script>
@endsection