<x-layout.default>
@section('title')
Add Region
@endsection
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Add Region</h5>
            <a href="{{ route('regions')}}"><button class="btn btn-sm btn-secondary">Go Back</button></a>
        </div>
        <div class="mb-5">
            <form id="addRegion" class="space-y-5" action="{{route('storeRegion')}}" method="POST">
                @csrf
                @method('POST')
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <label for="name" class="w-3/12">Region ID <span class="text-red-500">*</span></label>
                    <input id="usageID" type="text" name="regionID" class="w-9/12 form-input" required/>
                </div>
               
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <label for="name" class="w-3/12">Region Tag <span class="text-red-500">*</span></label>
                    <input id="name" type="text" name="regionTag" class="w-9/12 form-input" required/>
                </div>
                
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <label for="email" class="w-3/12">Emails </label>
                    <textarea rows="4" name="email" id="email" class="w-9/12 form-textarea ltr:rounded-l-none rtl:rounded-r-none"></textarea>
                </div>

                <div class="flex justify-end">
                    <div class="mx-3">
                        <a href="{{ route('regions')}}"><button type="button" class="btn btn-sm btn-danger ">
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
    </div>
</x-layout.default>
<script>
    $(document).ready( function (){
        $(document).on('submit', '#addRegion', function (e) {
            $('#submit').attr('disabled', true);
        });
    });
</script>
