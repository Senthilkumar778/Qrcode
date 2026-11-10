<x-layout.default>
@section('title')
Locations
@endsection
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <div class="panel mt-6">

        <div class="flex justify-between">
            <div>
                <h5 class="font-semibold text-lg dark:text-white-light mb-4">All Locations</h5>
            </div>
            <div>
                <a href="{{ route('locationAdd')}}"><button class="btn btn-sm btn-primary">Add Location</button></a>
            </div>
        </div>
        <div class="my-3">
            <table id="locations" class="table-auto stripe hover dt-responsive nowrap w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Region</th>
                        <!-- <th>Image</th> -->
                        <!-- <th>Coordinates Number</th> -->
                        <th class="w-32">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $key=> $location)
                        <tr>
                            <td>{{ $location->id }}</td>
                            <td>{{ $location->name }}</td>
                            <td>{{ $location->regionID}}</td>
                            <!-- <td>{{ $location->image }}</td> -->
                            <!-- <td>{{ $location->coordinates }}</td> -->
                             <td class="w-32">
                                <div class="flex">
                                    <a href="{{route('editLocation', $location->id)}}" class="edit-btn btn-sm btn-warning mx-2" data-id="{{ $location->id }}">Edit</a>
                                    <a href="{{route('deleteLocation', $location->id)}}" class="delete-btn btn-sm btn-danger" onclick="confirmation(event)" data-id="{{ $location->id }}">Delete</a>
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
            $('#locations').DataTable({
                responsive:true,
                pageLength: 50,
                order: [],
            });
        });

        // function getLocations(){
        //     $.ajax({
        //         url: "('getLocations')",
        //         method:"GET",
        //         success:function(response){
        //             console.log(response);
        //             if(response.locations.length>0){

        //                 $('#locations').DataTable({
        //                     // responsive: true,
        //                     data: response.locations,
        //                     columns: [
        //                         { data: 'id' },
        //                         { data: 'name' },
        //                         { data: 'image' },
        //                         { data: 'coordinates' },
        //                         {
        //                             data:null,
        //                             render: function(data,type,row){
        //                                 return '<div class=""><a class="edit-btn btn-sm  btn-warning mx-2" data-id="'+row.id+'">Edit</a> <button class="delete-btn btn-sm btn-danger mx-2" data-id="'+row.id+'">Delete</button> </div>';
        //                             }
        //                         }
        //                     ]
        //                 });

        //             }
        //         }
        //     });
        // }

    </script>
</x-layout.default>
