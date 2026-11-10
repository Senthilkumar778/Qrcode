<x-layout.default>
@section('title')
Change Password
@endsection
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Change Password</h5>
            <a href="{{ route('index')}}"><button class="btn btn-sm btn-secondary">Go Back</button></a>
        </div>
        <div class="mb-5">
            <form id="updatePassword" action="{{ route('updatePassword',auth()->user()->id )}}" method="POST" class="space-y-5">
               @csrf
               @method('PUT')

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="password" class="">Old Password <span class="text-red-500">*</span></label></div>
                    <div class="w-9/12"><input id="oldPassword" type="password" name="oldPassword" value="{{old('oldPassword')}}" class="form-input" required /></div>
                    @error('oldPassword')<span class="text-danger">{{$message}}</span>@enderror
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="password" class="">New Password <span class="text-red-500">*</span></label></div>
                    <div class="w-9/12"><input id="password" type="password" name="password" value="{{old('password')}}" class="form-input" required/></div>
                    @error('password')<span class="text-danger">{{$message}}</span>@enderror
                </div>

                <div class="sm:flex  justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="password_confirmation" class="">Confirm Password <span class="text-red-500">*</span></label></div>
                    <div class="w-9/12"><input id="password_confirmation" type="password" name="password_confirmation" value="{{old('password_confirmation')}}" class=" form-input" required/>
                        @error('password_confirmation')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>
               
                <div class="flex justify-end">
                    <div class="mx-3">
                        <a href="{{ route('index')}}"><button type="button" class="btn btn-sm btn-danger ">
                            Cancel
                        </button></a>
                    </div>
                    <div class="mx-2">
                        <button type="submit" class="btn btn-sm btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout.default>

<!-- <script>
    $('#updatePassword').validate({
        rules: {
            oldPassword:{
                required:true,
            },
            password:{
                required:true,
            },
            password_confirmation: {
                required: true,
                equalTo: '#password'
            }
        },
        messages : {
            oldPassword :{
                required: "Old password is required"
            },
            password: {
                required: "Password is required"
            },
            password_confirmation : {
                required: "Confirm password is required",
                equalTo: "Password mismatch"
            },
        },
        submitHandler : function (form){
            form.submit();
        }
    });
</script> -->
