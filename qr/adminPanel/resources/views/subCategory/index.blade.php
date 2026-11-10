<x-layout.default>
@section('title')
SubCategory
@endsection
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   

    <div class="panel">

        <div class="flex justify-between my-3">
            <div>
                <h5 class="font-semibold text-lg dark:text-white-light mb-4">All SubCategory</h5>
            </div>
            <div>
                <a href="{{ route('addSubcategory')}}"><button class="btn btn-sm btn-primary">Add SubCategory</button></a>
            </div>
        </div>
       
        <div class="container mx-auto my-3">
            <table id="subcategory" class="md:table-auto lg:table-auto sm:table-auto stripe hover dt-responsive min-w-full md:wrap lg:w-full sm:break-words md:break-words lg:text-wrap md:text-wrap xl:text-wrap xl:break-words text-wrap break-words">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product ID</th>
                        <th>Subcategory Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subcategories as $key=> $subcategory)
                        <tr>
                            <td>{{ $subcategory->id }}</td>
                            <td>{{ $subcategory->productName }}</td>
                            <td>{{ $subcategory->subcategoryName }}</td>
                            <td>
                                <div class="flex">
                                    <a href="{{route('editSubcategory', $subcategory->id)}}" class="edit-btn btn-sm btn-warning mx-2" data-id="{{ $subcategory->id }}">Edit</a>
                                    <a href="{{route('deleteSubcategory', $subcategory->id)}}" class="delete-btn btn-sm btn-danger" onclick="confirmation(event)" data-id="{{ $subcategory->id }}">Delete</a>
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
            $('#subcategory').DataTable({
                // responsive: true,
                pageLength: 50,
                order: [],
            });
        });

    </script>
</x-layout.default>
