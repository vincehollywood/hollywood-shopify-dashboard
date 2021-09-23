<?php

namespace App\Http\Controllers;

use NumberFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $shop = Auth::user();

        // API Ref: https://shopify.dev/api/admin/rest/reference/store-properties/shop#show-2021-07
        $storeDetails = $shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];

        // Lets group up the address
        $registeredAddress = implode(', ', array_filter([
            $storeDetails['address1'],
            $storeDetails['address2'],
            $storeDetails['city'],
            $storeDetails['zip'],
            $storeDetails['country_name'],
        ]));

        // API Ref: https://shopify.dev/api/admin/rest/reference/products/product#show-2021-07
        $selectedProduct = $shop->api()->rest('GET', '/admin/products/7053016400038.json')['body']['product'];

        // API Ref: https://shopify.dev/api/admin/rest/reference/orders/order#show-2021-07
        $selectedOrder = $shop->api()->rest('GET', '/admin/orders/4151289807014.json')['body']['order'];

        // Lets sum up the quantity from the line items
        $lineItemsCount = collect($selectedOrder['line_items'])->sum('quantity');

        return view('welcome', compact('storeDetails', 'registeredAddress', 'selectedProduct', 'selectedOrder', 'lineItemsCount'));
    }
}
