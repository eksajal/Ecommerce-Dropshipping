<!-- Products Start -->


@if (session('message'))
    <div id="notification"
        style="background-color: teal; color: white; text-align: center; margin-top: 5px; position: fixed; top: 20px; right: 20px; padding: 10px 20px; border-radius: 5px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); z-index: 9999;">
        {{ session('message') }}
        <button onclick="hideNotification()"
            style="background: transparent; border: none; color: white; font-size: 16px; font-weight: bold; float: right; cursor: pointer;">&times;</button>
    </div>
    <script>
        function hideNotification() {
            document.getElementById('notification').style.display = 'none';
        }

        // Automatically hide the notification after 10 seconds
        setTimeout(hideNotification, 10000);
    </script>
@endif



<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">


        @foreach ($products as $product)
            @if ($product->category_id > 8)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div
                            class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img style="width: 250px; height: 350px;" class="img-fluid w-100"
                                src="productImage/{{ $product->image }}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $product->title }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>Price: ${{ $product->price }}</h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{ url('view_details_page', $product->id) }}" class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <a href="{{ url('add_cart', $product->id) }}" class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach


    </div>


    <div class="d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>




</div>
<!-- Products End -->
