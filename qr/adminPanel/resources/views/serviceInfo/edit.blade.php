<x-layout.default>
@section('title')
Edit Service Info
@endsection
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Edit Service Info (S{{$serviceInfoEdit->id}})</h5>
            <a href="{{ route('serviceInfo')}}"><button class="btn btn-sm btn-secondary">Go Back</button></a>
        </div>
        <div class="mb-5">
            <form id="serviceInfoEdit" class="space-y-5" action="{{route('updateServiceInfo', $serviceInfoEdit->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="name" class="">Name</label></div>
                    <div class="w-9/12"><input id="name" type="text" name="name" class="form-input pointer-events-none bg-gray-200"  value="{{ $serviceInfoEdit->name }}"  readonly/>
                        @error('templateID')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="email" class="">Email</label></div>
                    <div class="w-9/12"><input id="email" type="text" name="email" class="form-input pointer-events-none bg-gray-200" value="{{ $serviceInfoEdit->email }}" readonly/>
                        @error('email')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="name" class="">Phone Number </label></div>
                    <div class="w-9/12"><input id="name" type="text" name="subject" class="form-input pointer-events-none bg-gray-200" value="{{ $serviceInfoEdit->phoneNumber }}" readonly/>
                        @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="productType" class="">Product Name </label></div>
                    <div class="w-9/12"><input id="productType" type="text" name="productType" class="form-input pointer-events-none bg-gray-200" value="{{ $serviceInfoEdit->productType}}" readonly/>
                        @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="regionName" class="">Region Name</label></div>
                    <div class="w-9/12"><input id="regionName" type="text" name="regionName" class="form-input pointer-events-none bg-gray-200" value="{{ $serviceInfoEdit->regionName}}" readonly/>
                        @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                        <input type="hidden" name="regionId" id="regionId" value="{{$serviceInfoEdit->regionID }}">
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="locationName" class="">Location Name</label></div>
                    <div class="w-9/12"><input id="locationName" type="text" name="locationName" class="form-input pointer-events-none bg-gray-200" value="{{ $serviceInfoEdit->locationName}}" readonly/>
                        @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                        <input type="hidden" name="locationId" id="locationId" value="{{$serviceInfoEdit->locationID }}">
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="name" class="">Issue Description </label></div>
                    <div class="w-9/12">
                        <!-- <input id="issueDescription" type="text" name="issueDescription" class="form-input pointer-events-none bg-gray-200" value="{{ strip_tags($serviceInfoEdit->issueDescription) }}" readonly/> -->

                    <textarea rows="4" name="issueDescription" id="issueDescription" class="form-textarea ltr:rounded-l-none rtl:rounded-r-none " style="height: 100px; overflow-y: auto;" readonly> {{ strip_tags($serviceInfoEdit->issueDescription) }}</textarea>
                        @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                @if($serviceInfoEdit->issueImages)
                    <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                        <div class="w-3/12"><label for="name" class="">Issue Images </label></div>
                        <div class="w-9/12">
                            <img src="{{ asset($serviceInfoEdit->issueImages) }}"width="100" height="100" alt="">
                            @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>

                @endif

                @php
                    $requestTime = $serviceInfoEdit->requestTime ? new DateTime($serviceInfoEdit->requestTime) : null;
                @endphp
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="name" class="">Request Time </label></div>
                    <div class="w-9/12"><input id="name" type="text" name="subject" class="form-input pointer-events-none bg-gray-200" value="{{ $requestTime ? $requestTime->format('d-m-Y g:i a') : '' }}" readonly/>
                        @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="subcategoryID" class="">Subcategory Name</label></div>
                        <div class="w-9/12">
                            <select id="subcategoryID" name="subcategoryID"  class="form-select text-white-dark">
                                <option value="">Select Subcategory</option>
                                @foreach($subcategories as $key=> $subcategory)
                                    <option value="{{ $subcategory->id}}" {{ $subcategory->id == $serviceInfoEdit->subcategoryID ? 'selected' : '' }}>{{ $subcategory->subcategoryName}}</option>
                                @endforeach
                            </select>
                            @error('subcategoryID')<span class="text-danger">{{$message}}</span>@enderror
                            <input type="hidden" name="subcategoryName" id="subcategoryName" value="{{$serviceInfoEdit->subcategoryName }}">
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="name" class="">Status </label></div>
                        <div class="w-9/12">
                            <select id="status" name="status"  class="form-select text-white-dark ">
                                <option value="">-select-</option>
                                <option value="RECEIVED" {{ $serviceInfoEdit->status == 'RECEIVED' ? 'selected' : ''}}>RECEIVED</option>
                                <option value="ACKNOWLEDGED"  {{ $serviceInfoEdit->status == 'ACKNOWLEDGED' ? 'selected' : ''}}>ACKNOWLEDGED</option>
                                <option value="WIP" {{ $serviceInfoEdit->status == 'WIP' ? 'selected' : ''}}>WIP</option>
                                {{-- <option value="TECH-COMPLETED" {{ $serviceInfoEdit->status == 'TECH-COMPLETED' ? 'selected' : ''}}>TECH-COMPLETED</option> --}}
                                {{-- <option value="FEEDBACK" {{ $serviceInfoEdit->status == 'FEEDBACK' ? 'selected' : ''}}>FEEDBACK</option> --}}
                                <option value="CLOSED" {{ $serviceInfoEdit->status == 'CLOSED' ? 'selected' : ''}}>CLOSED</option>
                            </select>
                            @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="remarks" class="">Remarks</label></div>
                    <div class="w-9/12">
                    <textarea rows="4" name="remarks" id="remarks" class="form-textarea ltr:rounded-l-none rtl:rounded-r-none"> {{ strip_tags(substr($serviceInfoEdit->remarks, 0, 100)) }}</textarea>
                        @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <div class="mx-3">
                        <a href="{{ route('serviceInfo')}}"><button type="button" class="btn btn-sm btn-danger ">
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
            <!-- <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                <li class="pb-3 sm:pb-4">
                    <div class="flex items-center space-x-4 rtl:space-x-reverse">
                        <div class="flex-shrink-0">
                            <span class="pl-4">Updated At</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white pl-4 ml-4">
                            Aging
                            </p>
                        </div>
                        <div>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-400 pr-4">
                            Status
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            Remarks
                        </div>
                    </div>
                </li>

            </ul> -->
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
                        @foreach($serviceInfoHistory as $key => $serviceInfo)
                            <tr class="p-1 px-2">
                                <td class="p-1">
                                    <span>{{ (new \DateTime($serviceInfo->createdAt))->format('d-m-Y h:i a') }}</span>
                                </td>
                                <td class="p-1 px-2">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{$serviceInfo->timeInterval}}
                                    </p>
                                </td>
                                <td class="p-1 px-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{$serviceInfo->status}}
                                    </p>
                                </td>
                                <td class="p-1 px-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{$serviceInfo->subcategoryName}}
                                    </p>
                                </td>
                                <td class="p-1 px-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {!! $serviceInfo->remarks !!}
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
    });


    $(document).ready( function (){
        $(document).on('submit', '#serviceInfoEdit', function (e) {
            $('#submit').attr('disabled', true);
            triggerPreloader();
        });
    });
</script>
