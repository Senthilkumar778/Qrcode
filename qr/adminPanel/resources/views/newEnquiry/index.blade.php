<x-layout.default>
@section('title')
New Enquiry
@endsection
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js" defer></script>

    {{-- ===== FILTER CSS (START) ===== --}}
    <style>
        .filter-box{background:#fafafa;border:1px solid #e5e7ef;border-radius:8px;padding:20px;margin-bottom:24px}
        .filter-row{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
        .filter-item label{display:block;font-size:13px;color:#7a7f9a;letter-spacing:.5px;margin-bottom:6px}
        .filter-item select{width:100%;padding:10px 14px;border:1px solid #e0e3ec;border-radius:8px;background:#fff;font-size:15px}
        .filter-item select:focus{outline:none;border-color:#4f5bd5}
        .filter-item select{appearance:none;-webkit-appearance:none;padding-right:40px;background:#fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'><path d='M1 1l5 5 5-5' fill='none' stroke='%23333' stroke-width='1.5' stroke-linecap='round'/></svg>") no-repeat right 14px center}
        .filter-actions{display:flex;align-items:center;gap:12px;margin-top:16px}
        .btn-filter{background:#4f5bd5;color:#fff;border:0;padding:10px 22px;border-radius:8px;cursor:pointer;box-shadow:0 4px 10px rgba(79,91,213,.3)}
        .btn-reset{border:1px solid #e05555;color:#e05555;padding:9px 20px;border-radius:8px;text-decoration:none;background:#fff}
        .record-count{margin-left:auto;display:flex;align-items:center;flex-wrap:wrap;justify-content:flex-end;gap:10px;color:#1f2937;font-size:14px}
        .filter-chip{border:1px solid #4361ee;color:#4361ee;border-radius:6px;padding:4px 10px;font-size:13px;background:#fff}
        .no-filter{color:#7a7f9a}
        .custom-range{display:none;gap:20px;margin-top:16px}
        .custom-range .filter-item{flex:1;max-width:300px}
        .filter-item input[type=date]{width:100%;padding:10px 14px;border:1px solid #e0e3ec;border-radius:8px;background:#fff;font-size:15px}
        @media(max-width:900px){.filter-row{grid-template-columns:1fr 1fr}}
    </style>
    {{-- ===== FILTER CSS (END) ===== --}}

    <div class="panel mt-6">

        <div class="flex justify-between my-3">
            <div>
                <h5 class="font-semibold text-lg dark:text-white-light mb-4">All New Enquiries</h5>
            </div>
            <!-- <div>
                <a href=""><button class="btn btn-sm btn-primary">Add Region</button></a>
            </div> -->
        </div>

        {{-- ===== FILTER FORM (START) ===== --}}
        <form method="GET" action="{{ url('/newEnquiries') }}" class="filter-box">
            <div class="filter-row">
                <div class="filter-item">
                    <label>DATE RAISED</label>
                    <select name="date" id="dateSelect">
                        <option value="">All dates</option>
                        <option value="custom" {{ request('date')=='custom' ? 'selected':'' }}>Custom date range...</option>
                        @foreach($dateMonths as $value => $label)
                            <option value="{{ $value }}" {{ request('date')==$value ? 'selected':'' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-item">
                    <label>LOCATION</label>
                    <select name="location">
                        <option value="">All locations</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc }}" {{ request('location')==$loc ? 'selected':'' }}>{{ $loc }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-item">
                    <label>REGION</label>
                    <select name="region">
                        <option value="">All regions</option>
                        @foreach($regions as $reg)
                            <option value="{{ $reg }}" {{ request('region')==$reg ? 'selected':'' }}>{{ $reg }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-item">
                    <label>STATUS</label>
                    <select name="status">
                        <option value="">All statuses</option>
                        @foreach($statuses as $st)
                            <option value="{{ $st }}" {{ request('status')==$st ? 'selected':'' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- From / To boxes: shown only when "Custom date range..." is selected --}}
            <div class="custom-range" id="customRange">
                <div class="filter-item">
                    <label>FROM</label>
                    <input type="date" name="from" value="{{ request('from') }}">
                </div>
                <div class="filter-item">
                    <label>TO</label>
                    <input type="date" name="to" value="{{ request('to') }}">
                </div>
            </div>

            @php
                $chips = [];
                if (request('date') === 'custom') {
                    $f = request('from');
                    $t = request('to');
                    try {
                        $fl = $f ? \Carbon\Carbon::parse($f)->format('d M Y') : null;
                        $tl = $t ? \Carbon\Carbon::parse($t)->format('d M Y') : null;
                    } catch (\Exception $e) {
                        $fl = $f;
                        $tl = $t;
                    }
                    if ($fl && $tl && $f === $t) {
                        $chips[] = 'Date: ' . $fl;
                    } else {
                        if ($fl) { $chips[] = 'From: ' . $fl; }
                        if ($tl) { $chips[] = 'To: ' . $tl; }
                    }
                } elseif (request()->filled('date')) {
                    $chips[] = 'Month: ' . ($dateMonths[request('date')] ?? request('date'));
                }
                foreach (['location' => 'Location', 'region' => 'Region', 'status' => 'Status'] as $key => $label) {
                    if (request()->filled($key)) {
                        $chips[] = $label . ': ' . request($key);
                    }
                }
            @endphp

            <div class="filter-actions">
                <button type="submit" class="btn-filter">Filter</button>
                <a href="{{ url('/newEnquiries') }}" class="btn-reset">Reset</a>
                <span class="record-count">
                    {{ number_format(count($newEnquiries)) }} records
                    @forelse($chips as $chip)
                        <span class="filter-chip">{{ $chip }}</span>
                    @empty
                        <span class="no-filter">No filters applied</span>
                    @endforelse
                </span>
            </div>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var sel = document.getElementById('dateSelect');
                var box = document.getElementById('customRange');
                function toggleRange() {
                    var on = sel.value === 'custom';
                    box.style.display = on ? 'flex' : 'none';
                    box.querySelectorAll('input').forEach(function (i) { i.disabled = !on; });
                }
                sel.addEventListener('change', toggleRange);
                toggleRange();
            });
        </script>
        {{-- ===== FILTER FORM (END) ===== --}}

        <div class="my-3">
            <div class="flex justify-end mb-3">
                <!-- Buttons will appear here because of dom: 'Bfrtip' -->
            </div>
            <table id="newEnquiry" class="md:table-auto lg:table-auto sm:table-auto stripe hover dt-responsive min-w-full md:wrap lg:w-full sm:break-words md:break-words lg:text-wrap md:text-wrap xl:text-wrap xl:break-words text-wrap break-words">
                <thead>
                    <tr>
                        <th>Case ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Product Type</th>
                        <th>Location Name</th>
                        <th>Region Name</th>
                        <th>Request Time</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($newEnquiries as $key=> $newEnquiry)
                        <tr>
                            <td class="newEnquiryID">N{{ $newEnquiry->id }}</td>
                            <td>{{ $newEnquiry->name }}</td>
                            <td>{{ $newEnquiry->email }}</td>
                            <td>{{ $newEnquiry->phoneNumber }}</td>
                            <td>{{ $newEnquiry->productType }}</td>
                            <td>{{ $newEnquiry->locationName }}</td>
                            <td>{{ $newEnquiry->regionName }}</td>
                            <td>{{ $newEnquiry->requestTime }}</td>
                            <td> {{$newEnquiry->status }}</td>
                            <td>{!! $newEnquiry->remarks !!}</td>
                            <td>
                                <div class="flex">
                                    <a href="{{route('editNewEnquiry', $newEnquiry->id)}}" class="edit-btn btn-sm btn-warning mx-2" data-id="{{ $newEnquiry->id }}">Edit</a>
                                    <a href="{{route('deleteNewEnquiry', $newEnquiry->id)}}" class="delete-btn btn-sm btn-danger" onclick="confirmation(event)" data-id="{{ $newEnquiry->id }}">Delete</a>
                                    <a href="{{route('newEnquiryHistory', $newEnquiry->id)}}" class="delete-btn btn-sm btn-info mx-2" data-id="{{ $newEnquiry->id }}"> History</a>
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
            $('#newEnquiry').DataTable({
                responsive: true,
                pageLength: 50,
                order: [],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csvHtml5',
                        text: 'Export CSV',
                        className: 'btn btn-sm btn-primary',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Print Table',
                        className: 'btn btn-sm btn-secondary',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        },
                        customize: function (win) {
                            // Set landscape layout
                            const css = '@page { size: landscape; }';
                            const head = win.document.head || win.document.getElementsByTagName('head')[0];
                            const style = win.document.createElement('style');

                            style.type = 'text/css';
                            style.media = 'print';

                            if (style.styleSheet) {
                                style.styleSheet.cssText = css;
                            } else {
                                style.appendChild(win.document.createTextNode(css));
                            }

                            head.appendChild(style);
                        }
                    }
                ]
            });
        });

    </script>
</x-layout.default>