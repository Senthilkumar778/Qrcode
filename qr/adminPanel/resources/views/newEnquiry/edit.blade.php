<x-layout.default>
@section('title')
Edit New Enquiry
@endsection
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Edit New Enquiry (N{{$newEnquiryEdit->id}})</h5>
            <a href="{{ route('newEnquiries')}}"><button class="btn btn-sm btn-secondary">Go Back</button></a>
        </div>
        <div class="mb-5">
            <form id="newEnquiryEdit" class="space-y-5" action="{{route('updateNewEnquiry', $newEnquiryEdit->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="name" class="">Name</label></div>
                    <div class="w-9/12"><input id="name" type="text" name="name" class="form-input pointer-events-none bg-gray-200"  value="{{ $newEnquiryEdit->name }}"  readonly/>
                        @error('name')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                   
                </div>
               
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="email" class="">Email</label></div>
                    <div class="w-9/12"><input id="email" type="text" name="email" class="form-input pointer-events-none bg-gray-200" value="{{ $newEnquiryEdit->email }}" readonly/>
                        @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="name" class="">Phone Number </label></div>
                    <div class="w-9/12"><input id="name" type="text" name="subject" class="form-input pointer-events-none bg-gray-200" value="{{ $newEnquiryEdit->phoneNumber }}" readonly/>
                        @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="productType" class="">Product Name </label></div>
                    <div class="w-9/12"><input id="productType" type="text" name="productType" class="form-input pointer-events-none bg-gray-200" value="{{ $newEnquiryEdit->productType}}" readonly/>
                        @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="regionName" class="">Region Name</label></div>
                    <div class="w-9/12"><input id="regionName" type="text" name="regionName" class="form-input pointer-events-none bg-gray-200" value="{{ $newEnquiryEdit->regionName}}" readonly/>
                        @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                        <input type="hidden" name="regionId" id="regionId" value="{{$newEnquiryEdit->regionID }}">
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="locationName" class="">Location Name</label></div>
                    <div class="w-9/12"><input id="locationName" type="text" name="locationName" class="form-input pointer-events-none bg-gray-200" value="{{ $newEnquiryEdit->locationName}}" readonly/>
                        @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                        <input type="hidden" name="locationId" id="locationId" value="{{$newEnquiryEdit->locationID }}">
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="name" class="">Issue Description </label></div>
                    <div class="w-9/12">
                        <!-- <input id="name" type="text" name="subject" class="form-input pointer-events-none bg-gray-200" value="{{ strip_tags($newEnquiryEdit->issueDescription)}}" readonly/> -->

                        <textarea rows="4" name="issueDescription" id="issueDescription" class="form-textarea ltr:rounded-l-none rtl:rounded-r-none" style="height: 100px; overflow-y: auto;" readonly> {{ strip_tags($newEnquiryEdit->issueDescription) }}</textarea>
                        @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                @php 
                    $requestTime = $newEnquiryEdit->requestTime ? new DateTime($newEnquiryEdit->requestTime) : null; 
                @endphp

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="name" class="">Request Time </label></div>
                    <div class="w-9/12"><input id="name" type="text" name="subject" class="form-input pointer-events-none bg-gray-200" value="{{ $requestTime ? $requestTime->format('d-m-Y g:i a') : ''  }}" readonly/>
                        @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="name" class="">Status </label></div>
                        <div class="w-9/12">
                            <select id="status" name="status"  class="form-select text-white-dark ">
                                <option value="">-select-</option>
                                <option value="RECEIVED" {{ $newEnquiryEdit->status == 'RECEIVED' ? 'selected' : ''}}>RECEIVED</option>
                                <option value="ACKNOWLEDGED"  {{ $newEnquiryEdit->status == 'ACKNOWLEDGED' ? 'selected' : ''}}>ACKNOWLEDGED</option>
                                <option value="QUOTE SENT" {{ $newEnquiryEdit->status == 'QUOTE SENT' ? 'selected' : ''}}>QUOTE SENT</option>
                                <option value="ORDER RECEIVED-CLOSED" {{ $newEnquiryEdit->status == 'ORDER RECEIVED-CLOSED' ? 'selected' : ''}}>ORDER RECEIVED-CLOSED</option>
                                <option value="ORDER LOST-CLOSED" {{ $newEnquiryEdit->status == 'ORDER LOST-CLOSED' ? 'selected' : ''}}>ORDER LOST-CLOSED</option>
                            </select>
                            @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="remarks" class="">Remarks</label></div>
                    <div class="w-9/12">
                        <textarea rows="4" name="remarks" id="remarks" class="form-textarea ltr:rounded-l-none rtl:rounded-r-none">{{ strip_tags(substr($newEnquiryEdit->remarks, 0, 100)) }}</textarea>
                        @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <div class="mx-3">
                        <a href="{{ route('newEnquiries')}}"><button type="button" class="btn btn-sm btn-danger ">
                            Cancel
                        </button></a>
                    </div>
                    <div class="mx-2">
                        <button type="submit" id="submit" class="btn btn-sm btn-primary">
                            Submit
                        </button>
                    </div>
                    
                </div>
            </form>
        </div>

        <div class="flex items-start mx-auto p-4">
            <div class="">
                <table class="w-full table-auto border-collapse border-spacing-0">
                    <thead>
                        <tr>
                            <th>Updated At</th>
                            <th>Aging</th>
                            <th>Status</th>
                            <th>Subcategory Name</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($newEnquiryHistory as $key => $newEnquiry)
                            <tr class="p-1 px-2">
                                <td class="p-1">
                                    <span>{{ (new \DateTime($newEnquiry->createdAt))->format('d-m-Y h:i a') }}</span>
                                </td>
                                <td class="p-1 px-2">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{$newEnquiry->timeInterval}}
                                    </p>
                                </td>
                                <td class="p-1 px-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{$newEnquiry->status}}
                                    </p>
                                </td>
                                <td class="p-1 px-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{$newEnquiry->subcategoryName}}
                                    </p>
                                </td>
                                <td class="p-1 px-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {!! $newEnquiry->remarks !!}
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-layout.default>
<script>
    $(document).ready(function() {
        var selectedOption = $('#subcategoryID option:selected');
        if (selectedOption.val() === '') {
            $('#subcategoryName').val('');
        } else {
            $('#subcategoryName').val(selectedOption.text());
        }

        $('#subcategoryID').change(function() {
            var selectedText = $('#subcategoryID option:selected').text();
            $('#subcategoryName').val(selectedText);
        });

        $(document).ready( function (){
            $(document).on('submit', '#newEnquiryEdit', function (e) {
                $('#submit').attr('disabled', true);
                triggerPreloader();   
            });
        });
    });
</script>