<x-layout.default>
@section('title')
Add User
@endsection
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Add User</h5>
            <a href="{{ route('users')}}"><button class="btn btn-sm btn-secondary">Go Back</button></a>
        </div>
        <div class="mb-5">
            <form id="addUser" action="{{route('storeUser')}}" method="POST" class="space-y-5" enctype="multipart/form-data">
               @csrf
               @method('POST')
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="name" class="">First Name <span class="text-red-500">*</span></label></div>
                    <div class="w-9/12"><input id="firstName" type="text" name="firstName" value="{{old('firstName')}}" class=" form-input" required />
                        @error('firstName')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="name" class="">Last Name</label></div>
                    <div class="w-9/12"><input id="lastName" type="text" name="lastName" value="{{old('lastName')}}" class=" form-input" />
                        @error('lastName')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex  justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="email" class="">Email <span class="text-red-500">*</span></label></div>
                    <div class="w-9/12"><input id="email" type="email" name="email" value="{{old('email')}}" class="form-input" required />
                        @error('email')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>
               
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="phone" class="">Mobile Number</label></div>
                    <div class="w-9/12"><input id="mobileNumber" type="tel" name="mobileNumber" value="{{old('mobileNumber')}}" class="form-input" />
                        @error('mobileNumber')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="employee-id" class="">Employee Id <span class="text-red-500">*</span></label></div>
                    <div class="w-9/12"><input id="employeeID" type="text" name="employeeID" value="{{old('employeeID')}}" class="form-input" required />
                        @error('employeeID')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="ctnSelect1" class="">Role<span class="text-red-500">*</span></label></div>
                    <div class="w-9/12">
                        <select id="userRole" name="userRole" value="{{old('userRole')}}" class="form-select text-white-dark" required>
                            <option value="">-select-</option>
                            <option value="SystemSpecialist">System Specialist</option>
                            <option value="SuperAdmin">Super Admin</option>
                            <option value="Admin">Admin</option>
                            <option value="Manager">Manager</option>
                            <option value="User">User</option>
                        </select>
                        @error('userRole')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <!-- <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="ctnSelect1" class="">Region<span class="text-red-500">*</span></label></div>
                    <div class="w-9/12">
                        <select id="regionID" name="regionID" value="{{old('regionID')}}" class="form-select text-white-dark" required>
                            <option value="">-select-</option>
                            @foreach($regions as $region)
                                <option value="{{$region->id}}">{{$region->regionID}} - {{$region->regionTag}}</option>
                            @endforeach
                        </select>
                        @error('regionID')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div> -->

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="signature" class="">Signatue</label></div>
                    <div class="w-9/12">
                        <input id="signature" type="file" name="signature" accept=".jpg, .jpeg, .png"  value="{{old('signature')}}" class=" form-input" />
                        @error('signature')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <div class="mx-3">
                        <a href="{{route('users')}}"><button type="button" class="btn btn-sm btn-danger ">
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
        $(document).on('submit', '#addUser', function (e) {
            // e.preventDefault();
            // triggerPreloader();       
            // $('#addUser')[0].submit();
            $('#submit').attr('disabled', true);
        });
    });
</script>