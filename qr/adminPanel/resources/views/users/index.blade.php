<x-layout.default>
@section('title')
Users
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
                <h5 class="font-semibold text-lg dark:text-white-light mb-4">All Users</h5>
            </div>
    
            <div>
                <a href="{{ route('userAdd')}}"><button class="btn btn-sm btn-primary">Add User </button></a>
            </div>
               
        </div>
        <div class="my-3">
            <table id="users" class="table-auto stripe hover dt-responsive nowrap w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->employeeID }}</td>
                            <td>{{ $user->firstName }}</td>
                            <td>{{ $user->lastName }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->mobileNumber }}</td>
                            <td>{{ $user->userRole }}</td>
                            <td>
                                <div class="flex">
                                    <a href="{{route('editUser', $user->id)}}" class="edit-btn btn-sm btn-warning mx-2" data-id="{{ $user->id }}">Edit</a>
                                    <a href="{{route('deleteUser', $user->id)}}" class="delete-btn btn-sm btn-danger" onclick="confirmation(event)" data-id="{{ $user->id }}">Delete</a>
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
            $('#users').DataTable({
                responsive: true,
                pageLength: 50,
                order: [],
            });

        });

       
        // $('.delete-btn').click(function(e){
        //     e.preventDefault();
        //     var id = $(this).data('id');
        //     Swal.fire({
        //     title: "Are you sure?",
        //     text: "But you will still be able to retrieve this file.",
        //     icon: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: "#DD6B55",
        //     confirmButtonText: "Yes, archive it!",
        //     cancelButtonText: "No, cancel please!",
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             var url =  $('#deleteForm').attr('action');
        //             alert(url);
        //             var token = $('meta[name="csrf-token"]').attr('content');
        //             $.ajax({
        //                 url:url,
        //                 method:"DELETE",
        //                 data:{_token:token ,id:id},
        //                 success:function(){
        //                     window.location.reload();
        //                 }
        //             });
        //         } else {
        //             Swal.fire("Cancelled", "Your imaginary file is safe :)", "error");
        //         }
        //     });
        // });
    </script>
</x-layout.default>
