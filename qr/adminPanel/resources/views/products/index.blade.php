<x-layout.default>
@section('title')
Products
@endsection
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
    
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js" defer></script>
    
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> -->
    
    <div class="panel mt-6">
        <div class="flex justify-between my-3">
            <div>
                <h5 class="font-semibold text-lg dark:text-white-light mb-4">All Products</h5>
            </div>
    
            <div>
                <a href="{{ route('productsAdd')}}"><button class="btn btn-sm btn-primary">Add Product </button></a>
            </div>
               
        </div>
        <div class="my-3">
            <table id="products" class="table-auto stripe hover dt-responsive nowrap w-full">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Enquiry Flag</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key=> $product)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $product->productName }}</td>
                            <td>{{ $product->description }}</td>
                            @if($product->enquiryFlag == 1)
                                <td>Yes</td>
                            @else
                                <td>No</td>
                            @endif
                            <td>
                                <div class="flex">
                                    <a href="{{route('editProduct', $product->id)}}" class="edit-btn btn-sm btn-warning mx-2" data-id="{{ $product->id }}">Edit</a>
                                    <a href="{{route('deleteProduct', $product->id)}}" class="delete-btn btn-sm btn-danger" onclick="confirmation(event)" data-id="{{ $product->id }}">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       
    </div>

    <script>

        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');  
            console.log(urlToRedirect); 
            swal.fire({
                title: "Are you sure?",
                // text: "But you will still be able to retrieve this file.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
            })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = urlToRedirect;
                }
            });
        }

        $(document).ready(function() {
            $('#products').DataTable({
                responsive: true,
                pageLength: 50,
                order: [],
            });

        });
    </script>
</x-layout.default>
