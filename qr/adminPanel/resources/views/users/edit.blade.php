<x-layout.default>
@section('title')
Edit User
@endsection
  

    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Edit User</h5>
            <a href="{{ route('users')}}"><button class="btn btn-sm btn-secondary">Go Back</button></a>
        </div>
        <div class="mb-5">
            <form id="editUser" action="{{route('updateUser', $user->id)}}" method="POST" class="space-y-5" enctype="multipart/form-data">
               @csrf
               @method('PUT')
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="firstName" class="">First Name <span class="text-red-500">*</span></label></div>
                    <div class="w-9/12"><input id="firstName" type="text" name="firstName" value="{{$user->firstName}}" class="form-input" required />
                        @error('firstName')<span class="text-danger">{{$message}}</span>@enderror
                        <input type="hidden" name="" value="$user->id">
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="lastName" class="">Last Name</label></div>
                    <div class="w-9/12"><input id="lastName" type="text" name="lastName" value="{{$user->lastName}}" class="form-input"/>
                        @error('lastName')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="email" class="">Email <span class="text-red-500">*</span></label></div>
                    <div class="w-9/12"><input id="email" type="email" name="email"  value="{{$user->email}}" class="form-input"  required/>
                        @error('email')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>
               
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="phone" class="">Mobile Number</label></div>
                    <div class="w-9/12"><input id="mobileNumber" type="tel" name="mobileNumber"  value="{{$user->mobileNumber}}" class="form-input" />
                        @error('mobileNumber')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="employee-id" class="">Employee Id <span class="text-red-500">*</span></label></div>
                    <div class="w-9/12"><input id="employeeID" type="text" name="employeeID"  value="{{$user->employeeID}}" class="form-input" required/>
                        @error('employeeID')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="ctnSelect1" class="">Role <span class="text-red-500">*</span></label></div>
                    <div class="w-9/12">
                        <select id="userRole" name="userRole" class="form-select text-white-dark" required>
                            <option value="">-select-</option>
                            <option value="SystemSpecialist" {{ $user->userRole == 'SystemSpecialist' ? 'selected': ''}}>System Specialist</option>
                            <option value="SuperAdmin" {{ $user->userRole == 'SuperAdmin' ? 'selected': ''}}>Super Admin</option>
                            <option value="Admin" {{ $user->userRole == 'Admin' ? 'selected': ''}}>Admin</option>
                            <option value="Manager" {{ $user->userRole == 'Manager' ? 'selected': ''}}>Manager</option>
                            <option value="User" {{ $user->userRole == 'User' ? 'selected': ''}}>User</option>        
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
                                <option value="{{$region->id}}" {{ $region->id == $user->regionID ? 'selected' : ''}}>{{$region->regionID}} - {{$region->regionTag}}</option>
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

                        <div class="">
                            <div><span id="cancel-signature" style="display: none; cursor: pointer;"><i class="fa-solid fa-xmark" style="color: #ff0040;"></i></span></div>
                            <div id="signature-preview"></div>
                        </div>
                        
                    </div>
                </div>

                <div class="custom-file-container" data-upload-id="myFirstImage"></div>

                <div class="flex justify-end">
                    <div class="mx-3">
                        <a href="{{route('users')}}"><button type="button" class="btn btn-sm btn-danger ">
                            Cancel
                        </button></a>
                    </div>
                    <div class="mx-2">
                        <button type="submit" id="submit" class="btn btn-sm btn-primary">
                            Update
                        </button>
                    </div>
                    

                </div>
            </form>
        </div>
    </div>
</x-layout.default>
<script src="https://cdnjs.cloudflare.com/ajax/libs/file-upload-with-preview/10.17.2/file-upload-with-preview.min.js"></script>

<script>
    $(document).ready(function() {
        // Display signature image when file is selected
        $('#signature').change(function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#signature-preview').html('<img src="' + e.target.result + '" alt="Signature" style="max-width: 150px; max-height: 50px;">');
                    $('#cancel-signature').show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        @if($user->signature)
            $('#signature-preview').html('<img src="{{ asset($user->signature) }}" alt="Signature" style="max-width: 150px; max-height: 50px;">');
            $('#cancel-signature').show();
        @endif

        // Cancel signature image
        $('#cancel-signature').click(function() {
            $('#signature').val('');
            $('#signature-preview').html('');
            $(this).hide();
        });
    });

    $(document).ready( function (){
        $(document).on('submit', '#editUser', function (e) {    
            $('#submit').attr('disabled', true);
        });
    });
</script>
