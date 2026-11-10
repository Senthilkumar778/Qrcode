<x-layout.default>
@section('title')
Add Product
@endsection
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Add Product</h5>
            <a href="{{ route('products')}}"><button class="btn btn-sm btn-secondary">Go Back</button></a>
        </div>
        <div class="mb-5">
            <form id="addProduct" action="{{route('storeProducts')}}" method="POST" class="space-y-5" enctype="multipart/form-data">
               @csrf
               @method('POST')
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <label for="productName" class="w-3/12">Product Name <span class="text-red-500">*</span></label>
                    <input id="productName" type="text" name="productName" value="{{old('productName')}}" class="w-9/12 form-input" required />
                    @error('productName')<span class="text-danger">{{$message}}</span>@enderror
                </div>

                <div class="sm:flex  justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="description" class="">Description</label></div>
                    <div class="w-9/12"><input id="description" type="text" name="description" value="{{old('description')}}" class=" form-input"/>
                        @error('description')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <label for="enquiryFlag" class="w-3/12">Enquiry Flag </label>
                    <div class="w-9/12 flex items-center">
                        <input id="enquiryFlag" type="checkbox" name="enquiryFlag" value="1" class="form-checkbox">
                    </div>
                </div>
               
                <div class="flex justify-end">
                    <div class="mx-3">
                        <a href="{{route('products')}}"><button type="button" class="btn btn-sm btn-danger ">
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
        $(document).on('submit', '#addProduct', function (e) {
            $('#submit').attr('disabled', true);
        });
    });
</script>