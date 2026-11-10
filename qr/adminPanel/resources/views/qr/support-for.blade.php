<x-layout.qr>
    @section('title')
        KEWAUNEE - SUPPORT FOR
    @endsection
    @section('styles')
        <link rel='stylesheet' type='text/css' href='{{ asset('assets/qr/css/nice-select2.css') }}'>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/qr/css/file-upload-with-preview.min.css') }}" />
    @endsection
    @section('content')
        <!-- start main content section -->
        <div class="relative flex items-center justify-center overflow-hidden">
            <div class="px-6 w-full py-6 md:py-20">
                <div class="mb-3">
                    <h4 class="text-xl font-bold">SUPPORT FOR</h4>
                </div>
                <form class="w-full space-y-5" id="support_for_form" enctype="multipart/form-data">
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
                        {{-- <select id="supportFor" placeholder="Select Support For" class="form-select"> --}}
                        <select id="supportFor">
                            <option value=""></option>
                            @foreach ($products as $product)
                                <option value="{{ $product['id'] }}">{{ $product['productName'] }}</option>
                            @endforeach
                        </select>
                        <div id="supportFor-error" class="supportFor hidden text-danger">Support For is required</div>
                    </div>
                    <div>
                        <label for="issue">
                            Describe your issue
                            <span class="text-danger">*</span>
                        </label>
                        <textarea id="issue" type="text" rows="5" class="form-textarea"></textarea>
                        <div id="issue-error" class="issueError hidden text-danger">Issue is required</div>
                    </div>
                    <div>
                        <label for="images">Add images</label>
                        {{-- <div class="custom-file-container" data-upload-id="images"></div> --}}
                        <input type="file" class="form-file" accept=".jpg, .jpeg, .png" name="images" id="images" multiple />
                    </div>
                    <div class="flex gap-2">
                        <button type="button" class="btn btn-primary mt-6" onclick="validate()">Submit</button>
                        <a href="{{ route('qr_index') }}" class="btn btn-danger mt-6">Back</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- end main content section -->
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
        {{-- <script src="{{ asset('assets/qr/js/file-upload-with-preview.iife.js') }}"></script> --}}
        {{-- <script>
            const fileUpload = new FileUploadWithPreview.FileUploadWithPreview('images', {
                images: {
                    baseImage: "{{ asset('assets/qr/images/file-preview.svg') }}",
                    backgroundImage: '',
                },
                multiple: true,
            });
        </script> --}}
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

                const issue = document.getElementById('issue');
                const issueError = document.getElementById('issue-error');

                const images = document.getElementById('images').files;

                // const selectedFiles = fileUpload.cachedFileArray;

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

                if(issue.value == "" || issue.value.trim() == ""){
                    issue.classList.add('border');
                    issue.classList.add('border-danger');
                    issueError.classList.remove('hidden');
                    isValid = false;
                }else{
                    issue.classList.remove('border');
                    issue.classList.remove('border-danger');
                    issueError.classList.add('hidden');
                }

                if(isValid){
                    let locationID = "{{ request()->route('region') }}";
                    var formData = new FormData();
                    formData.append('name', name.value);
                    formData.append('email', email.value);
                    formData.append('phoneNumber', phoneNumber.value);
                    formData.append('productID', supportFor.value);
                    formData.append('issueDescription', issue.value);
                    formData.append('locationID', locationID);

                    for (let i = 0; i < images.length; i++) {
                        formData.append('issues_images[]', images[i]);
                    }

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('qr_add_service', 'support') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
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
