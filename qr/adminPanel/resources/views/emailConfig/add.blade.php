<x-layout.default>
@section('title')
Add Email Config
@endsection
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Add Email Config</h5>
            <a href="{{ route('emailConfig')}}"><button class="btn btn-sm btn-secondary">Go Back</button></a>
        </div>
        <div class="mb-5">
            <form id="emailConfigAdd" class="space-y-5" action="{{route('storeEmailConfig')}}" method="POST">
                @csrf
                @method('POST')
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="name" class="">Template ID <span class="text-red-500">*</span></label></div>
                    <div class="w-9/12"><input id="usageID" type="text" name="templateID" class="form-input" value="{{ old('templateID')}}" required/>
                        @error('templateID')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                   
                </div>
               
                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <div class="w-3/12"><label for="name" class="">Subject <span class="text-red-500">*</span></label></div>
                    <div class="w-9/12"><input id="name" type="text" name="subject" class="form-input" value="{{ old('subject')}}" required/>
                        @error('subject')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                    <label for="name" class="w-3/12">Body <span class="text-red-500">*</span></label>
                    <div class="w-9/12">
                        <input id="body" type="hidden" name="body"/>
                        <div id="editor" class="" name="body">
                            
                        </div>
                        <!-- <span id="bodyError" class="error"></span> -->
                        @error('body')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <div class="mx-3">
                        <a href="{{ route('emailConfig')}}"><button type="button" class="btn btn-sm btn-danger ">
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

    function validateQuillEditor() {
        var quillContent = document.querySelector('.ql-editor').innerHTML;
        return quillContent.trim().length > 0;
    }

    document.addEventListener("DOMContentLoaded", function() {
        $('.error').text(' ');
        var quill =  new Quill('#editor', {
            theme: 'snow'
        });

        // var form = document.querySelector('form');

        // form.addEventListener('submit', function(event) {
        //     $('.error').text(' ');
        //     var body = document.getElementById('body');
        //     var editorContent = quill.getText().trim();
            
        //     if (editorContent.length === 0) {
        //         event.preventDefault(); 
        //         $('#bodyError').text('Body field is required')
        //     } else {
        //         body.value = quill.root.innerHTML;
        //     }
        // });

        var body = document.getElementById('body');
        quill.on('text-change', function() {
            body.value = quill.root.innerHTML;
        });
        var toolbar = quill.container.previousSibling;
        toolbar.querySelector('.ql-picker').setAttribute('title', 'Font Size');
        toolbar.querySelector('button.ql-bold').setAttribute('title', 'Bold');
        toolbar.querySelector('button.ql-italic').setAttribute('title', 'Italic');
        toolbar.querySelector('button.ql-link').setAttribute('title', 'Link');
        toolbar.querySelector('button.ql-underline').setAttribute('title', 'Underline');
        toolbar.querySelector('button.ql-clean').setAttribute('title', 'Clear Formatting');
        toolbar.querySelector('[value=ordered]').setAttribute('title', 'Ordered List');
        toolbar.querySelector('[value=bullet]').setAttribute('title', 'Bullet List');
    });

    $(document).ready( function (){
        $(document).on('submit', '#emailConfigAdd', function (e) {
            $('#submit').attr('disabled', true);
        });
    });
</script>