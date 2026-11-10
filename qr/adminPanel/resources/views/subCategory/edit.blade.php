<x-layout.default>
@section('title')
Edit Subcategory
@endsection
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Edit Subcategory</h5>
            <a href="{{ route('subcategories')}}"><button class="btn btn-sm btn-secondary">Go Back</button></a>
        </div>
        <div class="mb-5">
            <form id="editSubcategory" action="{{route('updateSubcategory', $subcategoryEdit->id)}}" method="POST" class="space-y-5" enctype="multipart/form-data">
               @csrf
               @method('PUT')
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="productName" class="">Product<span class="text-red-500">*</span></label></div>
                    <div class="w-9/12">
                        <!-- <input id="productName" type="text" name="productName" value="{{old('productName')}}" class="form-input" required /> -->
                        <select id="productID" name="productID" class="form-select text-dark" required>
                            <option value="">select a product</option>
                            @foreach($products as $key=> $product)
                                <option value="{{$product->id}}" {{ $product->id == $subcategoryEdit->productID ? 'selected' : ''}}> {{ $product->productName}}</option>
                            @endforeach
                        </select>
                        @error('productID')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex  justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="subcategoryName" class="">Subcategory Name<span class="text-red-500">*</span></label></div>
                    <div class="w-9/12">
                        <input id="subcategoryName" type="text" name="subcategoryName" value="{{ $subcategoryEdit->subcategoryName }}" class=" form-input"/>
                        @error('subcategoryName')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <div class="mx-3">
                        <a href="{{route('subcategories')}}"><button type="button" class="btn btn-sm btn-danger ">
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
        $(document).on('submit', '#editSubcategory', function (e) {
            $('#submit').attr('disabled', true);
        });
    });
</script>