<!-- admin/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>

    <div class="info-box">
        <div class="box">
            <h2>User Members</h2>
            <p>{{ $userCount }}</p>
        </div>
        <div class="box">
            <h2>Orders</h2>
            <p>{{ $orderCount }}</p>
        </div>
        <div class="box">
            <h2>UI/UX Products</h2>
            <p>{{ $uiUxProductCount }}</p>
        </div>
        <div class="box">
            <h2>Feeds Products</h2>
            <p>{{ $feedsProductCount }}</p>
        </div>
        <div class="box">
            <h2>Total Products</h2>
            <p>{{ $totalProductsCount }}</p>
        </div>
        <div class="box">
            <h2>Total Earnings</h2>
            <p>Rp {{ $totalEarnings }}</p>
        </div>
        <div class="box">
            <h2>Most Active User</h2>
            <p>{{ $mostActiveUser->name }} ({{ $mostActiveUser->email }})</p>
        </div>
        <div class="box">
            <h2>Best Selling Product</h2>
            <p>{{ $mostPurchasedProduct->name_product }} ({{ $mostPurchasedProduct->kategori }})</p>
        </div>
    </div>
</div>
@endsection
