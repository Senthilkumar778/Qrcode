<x-layout.default>
@section('title')
Email Config
@endsection
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   

    <div class="panel mt-6">

        <div class="flex justify-between my-3">
            <div>
                <h5 class="font-semibold text-lg dark:text-white-light mb-4">All Email Configs</h5>
            </div>
            <div>
                <a href="{{ route('addEmailConfig')}}"><button class="btn btn-sm btn-primary">Add Email Config</button></a>
            </div>
        </div>
       
        <div class="my-3">
            <table id="region" class="table-auto stripe hover dt-responsive w-full">
                <thead>
                    <tr>
                        <th>Template ID</th>
                        <th>Subject</th>
                        <th>Body</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emailConfig as $key=> $template)
                        <tr>
                            <td>{{ $template->templateID }}</td>
                            <td>{{ $template->subject }}</td>
                            <td class="">{{ strip_tags($template->body) }}</td>
                             <td>
                                <div class="flex">
                                    <a href="{{route('editEmailConfig', $template->id)}}" class="edit-btn btn-sm btn-warning mx-2" data-id="{{ $template->id }}">Edit</a>

                                    <a href="{{route('deleteEmailConfig', $template->id)}}" class="delete-btn btn-sm btn-danger" onclick="confirmation(event)" data-id="{{ $template->id }}">Delete</a>
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
            $('#region').DataTable({
                responsive: true,
                pageLength: 50
            });
        });
    </script>
</x-layout.default>
