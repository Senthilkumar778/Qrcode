<x-layout.default>
@section('title')
New Enquiry History
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
                <h5 class="font-semibold text-lg dark:text-white-light mb-4">New Enquiry History</h5>
            </div>
            <div>
                <a href="{{ route('newEnquiries')}}"><button class="btn btn-sm btn-primary">Go Back</button></a>
            </div>
        </div>
       
        <div class="container mx-auto my-3">
            <table id="newEnquiry" class="md:table-auto lg:table-auto sm:table-auto stripe hover dt-responsive min-w-full md:wrap lg:w-full sm:break-words md:break-words lg:text-wrap md:text-wrap xl:text-wrap xl:break-words text-wrap break-words">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Updated At</th>
                        <th>Aging</th>
                        <th>Status</th>
                        <th>Subcategory Name</th>
                        <th>Remarks</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($newEnquiryHistory as $key=> $newEnquiry)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ (new \DateTime($newEnquiry->createdAt))->format('d-m-Y H:i:a') }}</td>
                            <td>{{ $newEnquiry->timeInterval }}</td>
                            <td>{{ $newEnquiry->status }}</td>
                            <td>{{ $newEnquiry->subcategoryName}}</td>
                            <td>{!! $newEnquiry->remarks !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       
    </div>

    <script>

        $(document).ready(function() {
            $('#newEnquiry').DataTable({
                // responsive: true,
                pageLength: 50,
                order: [],
            });
        });

    </script>
</x-layout.default>
