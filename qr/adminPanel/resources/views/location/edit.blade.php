<x-layout.default>
@section('title')
Edit Location
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-map/3.0-rc1/jquery.ui.map.js"></script> -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBv6shA-pBM0e9KydvwubSY55chq0gqS8&libraries=places" defer></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-map/3.0-rc1/min/jquery.ui.map.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-map/3.0-rc1/jquery.ui.map.extensions.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-map/3.0-rc1/jquery.ui.map.overlays.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-map/3.0-rc1/jquery.ui.map.services.js"></script>

    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Edit Location</h5>
            <a href="{{ route('locations')}}"><button class="btn btn-sm btn-secondary">Go Back</button></a>
        </div>
        <div class="mb-5">
            <form id="editLocation" class="space-y-5" action="{{ route('updateLocation', $locationEdit->id)}} " method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <label for="name" class="w-3/12">Name <span class="text-red-500">*</span></label>
                    <input id="name" type="text" name="name" class="w-9/12 form-input" value="{{ $locationEdit->name}}" required/>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="userID" class="w-3/12">Location <span class="text-red-500">*</span></label></div>
                    <div class="w-9/12">
                        <select id="regionID" name="regionID" class="text-dark" required>
                        <option value=" ">-select-</option>
                        @foreach($regions as $region)
                            <option value="{{$region->regionID}}" {{$locationEdit->regionID == $region->regionID ? 'selected' : '' }}> {{ $region->regionID}} - {{ $region->regionTag}}</option>
                        @endforeach
                        </select>
                        @error('regionID')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <label for="image" class="w-3/12">Image</label>
                    <input id="image" type="file" name="image" class="w-9/12 form-input" />
                </div>

               
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <label for="email" class="w-3/12">Emails </label>
                    <textarea rows="4" name="email" id="email" class="w-9/12 form-textarea ltr:rounded-l-none rtl:rounded-r-none">{{ $locationEdit->email }}</textarea>
                </div>

                <!-- @php
                $latLang = explode(',', $locationEdit->coordinates);
                @endphp -->
                <!-- <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <label for="coordinates" class="w-3/12">Coordinates</label>
                    <input id="coordinates" type="text" name="coordinates" class="w-9/12 form-input"  value="{{ $locationEdit->coordinates}}" />
                </div> -->

                <div class="flex justify-end">
                    <div class="mx-3">
                        <a href="{{route('locations')}}"><button type="button" class="btn btn-sm btn-danger ">
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
        <div class="text-center flex items-center justify-center my-2">
            <div class="w-1/2" id="map" style="height: 400px;"></div>
        </div>
       
    </div>
</x-layout.default>

<script>
    
    $(document).ready(function(){
        $(document).on('click', '.addInfo', function(){
            var html = '<div class="sm:flex justify-between items-center gap-5 md:gap-20">'+
                            '<label for="info" class="w-3/12"></label>'+
                            '<div class="w-9/12 flex items-center infoGroup">' +
                                '<div class="flex items-center">' +
                                    '<input type="text" name="keyInfo[]" class="w-48 form-input" />' +
                                    '<input type="text" name="valueInfo[]" class="w-48 form-input mx-2" />'+
                                    '<span class="ms-2"> <button type="button" class="btn btn-sm btn-danger removeInfo">-</button></span>' +
                                '</div>' +  
                            '</div>'+
                        '</div>';
                        $('.infoContainer:last').after(html);

           
        });

        $(document).on('click', '.removeInfo', function() {
            $(this).closest('.infoGroup').remove();
        });
    });

    var options = {
        searchable: true
    };

    document.addEventListener("DOMContentLoaded", function(e) {
        var regionIDInstance = NiceSelect.bind(document.getElementById("regionID"), options);
    });

    $(document).ready( function (){
        $(document).on('submit', '#editLocation', function (e) {
            $('#submit').attr('disabled', true);
        });
    });
</script>
