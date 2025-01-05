@extends('layouts.app')

@section('content')
  <!-- Portfolio Section -->
  <section id="portfolio" class="portfolio section">

    <!-- Section Title -->
    <div class="container section-title">
      <h2>Produk Kami</h2>
    </div><!-- End Section Title -->

    <div class="container">
      <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
        <style>
          /* Custom Styles */
          .portfolio-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: start;
          }
          .portfolio-filters li {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            background-color: #ffffff;
            background: linear-gradient(135deg, #6e7dff, #5766eb);
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: capitalize;
            width: 100px;
            height: 50px;
            box-sizing: border-box;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          }
          .portfolio-filters li:hover {
            transform: scale(1.1);
            background: linear-gradient(135deg, #8a99ff, #7188ff);
            font-size: 16px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
          }
          .portfolio-filters li.filter-active {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
          }
          .portfolio-content img {
            display: block;
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 5px;
          }
          .product-info {
            padding: 1rem;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            top: -20px;
          }
          .product-info h4 {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
          }
          .product-info p {
            font-size: 0.9rem;
            margin-bottom: 1rem;
          }
          .product-info .stock {
            font-size: 1rem;
            font-weight: bold;
            margin-top: 0.5rem;
            color: #333;
          }
          .product-info .product-links {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            gap: 15px;
          }
          .product-info .product-links a {
            font-size: 1.5rem;
            color: #333;
            transition: color 0.3s ease;
          }
          .portfolio-content:hover .product-links {
            display: flex;
          }
        </style>

        <!-- Portfolio Filters -->
        <ul class="portfolio-filters isotope-filters">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-snack">Snack</li>
          <li data-filter=".filter-cake">Cake</li>
          <li data-filter=".filter-bubur">Bubur</li>
        </ul><!-- End Portfolio Filters -->

        <!-- Portfolio Items -->
        <div class="row gy-4 isotope-container">
          @foreach($products as $product)
          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ strtolower(str_replace(' ', '-', $product->category)) }}">
            <a href="{{ route('product.details', $product->id) }}" >
              <div class="portfolio-content h-100">
                <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid" alt="{{ $product->name }}">
              </div>

              <!-- Info Produk -->
              <div class="product-info">
                <h4>{{ $product->name }}</h4>
                <p>{{ $product->description }}</p>
                <p class="stock"><strong>Stok:</strong> {{ $product->stock }} pcs</p>
              </div>
            </a>
            </div><!-- End Portfolio Item -->
          @endforeach
        </div>
      </div>
    </div>
  </section><!-- /Portfolio Section -->
@endsection
