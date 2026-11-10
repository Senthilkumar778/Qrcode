<x-layout.qr>
    @section('title')
        KEWAUNEE - NEW ENQUIRY
    @endsection
    @section('styles')
        <link rel='stylesheet' type='text/css' href='{{ asset('assets/qr/css/nice-select2.css') }}'>
    @endsection
    @section('content')
        <!-- start main content section -->
        <div class="relative flex items-center justify-center overflow-hidden">
            <div class="px-6 w-full pt-6 pb-16 md:py-20">
                <div class="mb-3">
                    <h4 class="text-xl font-bold">NEW ENQUIRY</h4>
                </div>
                <form class="w-full space-y-5" id="new_enquiry_form" enctype="multipart/form-data">
                    <div>
                        <label for="name">
                            Name
                            <span class="text-danger">*</span>
                        </label>
                        <input id="name" type="text"  placeholder="Enter Name" class="form-input" />
                        <div id="name-error" class="nameError hidden text-danger">Name is required</div>
                    </div>
                    <div>
                        <label for="email">
                            Email
                            <span class="text-danger">*</span>
                        </label>
                        <input id="email" type="email"  placeholder="Enter Email" class="form-input" />
                        <div id="email-error" class="emailError hidden text-danger">Email is required</div>
                    </div>
                    <div>
                        <label for="phoneNumber">
                            Phone Number
                            <span class="text-danger">*</span>
                        </label>
                        <input id="phoneNumber" type="text" placeholder="Enter Phone Number" class="form-input" />
                        <div id="phoneNumber-error" class="phoneNumberError hidden text-danger">Phone Number is required</div>
                    </div>
                    <div>
                        <label for="supportFor">
                            Support For
                            <span class="text-danger">*</span>
                        </label>
                        {{-- <select id="supportFor" placeholder="Select Product Type" class="form-select"> --}}
                        <select id="supportFor">
                            <option value=""></option>
                            @foreach ($products as $product)
                                @if($product['enquiryFlag'] == 1)
                                    <option value="{{ $product['id'] }}">{{ $product['productName'] }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div id="supportFor-error" class="supportForError hidden text-danger">Support For is required</div>
                    </div>
                    <div>
                        <label for="need">
                            Describe your need
                            <span class="text-danger">*</span>
                        </label>
                        <textarea id="need" type="text" rows="5" class="form-textarea"></textarea>
                        <div id="need-error" class="needError hidden text-danger">Need is required</div>
                    </div>
                    <div class="flex gap-2">
                        <button type="button" class="btn btn-primary mt-6" onclick="validate()">Submit</button>
                        <a href="{{ route('qr_index') }}" class="btn btn-danger mt-6">Back</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- end main content section --><!-- script -->
    @endsection
    @section('scripts')
        <script src="{{ asset('assets/qr/js/nice-select2.js') }}"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function(e) {
                const options = {
                    searchable: false,
                    placeholder: 'Select support for'
                };

                const region = document.getElementById("supportFor");
                NiceSelect.bind(region, options);
            })
        </script>
        <script defer src="{{ asset('assets/qr/js/sweetalert.min.js') }}"></script>
        <script>
            async function showAlert(status, message, text) {
                new window.Swal({
                    icon: status,
                    title: message,
                    html: text,
                    padding: '2em',
                }).then((result) => {
                    if (result.value) {
                        window.location.href = "{{ route('qr_index') }}"
                    }
                });
            };
            function validate(){
                set_preloader(true);
                const name = document.getElementById('name');
                const nameError = document.getElementById('name-error');

                const email = document.getElementById('email');
                const emailError = document.getElementById('email-error');

                const phoneNumber = document.getElementById('phoneNumber');
                const phoneNumberError = document.getElementById('phoneNumber-error');

                const supportFor = document.getElementById('supportFor');
                const supportForError = document.getElementById('supportFor-error');

                const need = document.getElementById('need');
                const needError = document.getElementById('need-error');

                let isValid = true;

                if(name.value == "" || name.value.trim() == ""){
                    name.classList.add('border');
                    name.classList.add('border-danger');
                    nameError.classList.remove('hidden');
                    isValid = false;
                }else{
                    name.classList.remove('border');
                    name.classList.remove('border-danger');
                    nameError.classList.add('hidden');
                }

                if((email.value == "" || email.value.trim() == "")){
                    email.classList.add('border');
                    email.classList.add('border-danger');
                    emailError.classList.remove('hidden');
                    isValid = false;
                }else{
                    if(emailRegex.test(email.value)){
                        email.classList.remove('border');
                        email.classList.remove('border-danger');
                        emailError.classList.add('hidden');
                    } else {
                        email.classList.add('border');
                        email.classList.add('border-danger');
                        emailError.classList.remove('hidden');
                        isValid = false;
                    }
                }

                if(phoneNumber.value == "" || phoneNumber.value.trim() == ""){
                    phoneNumber.classList.add('border');
                    phoneNumber.classList.add('border-danger');
                    phoneNumberError.classList.remove('hidden');
                    isValid = false;
                }

                if(supportFor.value == "" || supportFor.value.trim() == ""){
                    supportFor.classList.add('border');
                    supportFor.classList.add('border-danger');
                    supportForError.classList.remove('hidden');
                    isValid = false;
                }else{
                    supportFor.classList.remove('border');
                    supportFor.classList.remove('border-danger');
                    supportForError.classList.add('hidden');
                }

                if(need.value == "" || need.value.trim() == ""){
                    need.classList.add('border');
                    need.classList.add('border-danger');
                    needError.classList.remove('hidden');
                    isValid = false;
                }else{
                    need.classList.remove('border');
                    need.classList.remove('border-danger');
                    needError.classList.add('hidden');
                }

                if(isValid){
                    let data = {
                        name: name.value,
                        email: email.value,
                        phoneNumber: phoneNumber.value,
                        productID: supportFor.value,
                        issueDescription: need.value,
                        locationID: "{{ request()->route('region') }}",
                    };
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('qr_add_service', 'new') }}",
                        data: data,
                        success: function (data){
                            showAlert(data.status, data.message, data.text);
                            set_preloader(false);
                        },
                        error: function(xhr, status, error){
                            console.log(xhr, status, error);
                            set_preloader(false);
                        }
                    })
                } else {
                    set_preloader(false);
                }
            }
        </script>
    @endsection
</x-layout.qr>
