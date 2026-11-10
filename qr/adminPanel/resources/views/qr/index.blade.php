<x-layout.qr>
    @section('title')
        KEWAUNEE - QR
    @endsection
    @section('styles')
        <link rel='stylesheet' type='text/css' href='{{ asset('assets/qr/css/nice-select2.css') }}'>
    @endsection

    @section('content')
        <!-- start main content section -->
        <div class="relative flex items-center justify-center overflow-hidden h-[calc(100vh_-_320px)]">
            {{-- <div class="px-6 py-16 text-center font-semibold before:container before:absolute before:left-1/2 before:aspect-square before:-translate-x-1/2 before:rounded-full before:bg-[linear-gradient(180deg,#4361EE_0%,rgba(67,97,238,0)_50.73%)] before:opacity-10 md:py-20"> --}}
            <div class="px-12 py-16 text-center font-semibold md:py-20 w-full">
                <div class="relative">
                    {{-- <img :src="$store.app.theme === 'dark' || $store.app.isDarkMode ? '{{ asset('assets/qr/images/error/maintenence-dark.svg') }}' : '{{ asset('assets/qr/images/error/maintenence-light.svg') }}'" alt="maintenence" class="mx-auto -mt-10 w-full max-w-xs object-cover md:-mt-20 md:max-w-lg" src="{{ asset('assets/qr/images/error/maintenence-light.svg') }}"> --}}
                    <div>
                        <div class="mb-5">
                            <select id="region">
                                {{-- <option value=""></option> --}}
                                @foreach ($locations as $location)
                                    <option value="{{ $location['id'] }}">{{ $location['name'] }}</option>
                                @endforeach
                            </select>
                            <div class="text-left pl-3 text-danger hidden" id="region-error">Please select region</div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center gap-5 justify-center w-full">
                        <button type="button" class="btn btn-primary w-full redirect_btn" id="support_for">
                            Support For
                        </button>
                        <button type="button" class="btn btn-primary w-full redirect_btn" id="new_enquiry">
                            New Enquiry
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end main content section -->
    @endsection

    @section('scripts')
        <script src="{{ asset('assets/qr/js/nice-select2.js') }}"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function(e) {
                // seachable
                const options = {
                    searchable: true,
                    placeholder: 'Select a city'
                };

                const region = document.getElementById("region");
                const regionError = document.getElementById('region-error');

                // Retrieve and sort options
                const sortOptions = (selectElement) => {
                    const optionsArray = Array.from(selectElement.options);
                    optionsArray.sort((a, b) => {
                        if (a.text.toLowerCase() < b.text.toLowerCase()) return -1;
                        if (a.text.toLowerCase() > b.text.toLowerCase()) return 1;
                        return 0;
                    });

                    // Clear existing options and append sorted options
                    selectElement.innerHTML = '';
                    optionsArray.forEach(option => selectElement.add(option));
                };

                // Sort the options in the select element
                sortOptions(region);


                let selected_region;

                NiceSelect.bind(region, options);

                region.addEventListener('change', function() {
                    selected_region = region.value;
                });

                const region_value = (e) => {
                    set_preloader(true);
                    const target_route = e.target.id;

                    if (selected_region != undefined) {
                        regionError.classList.add('hidden');
                        let route = "{{ route('qr_support_for', 'region') }}";

                        if(target_route == 'new_enquiry'){
                            route = "{{ route('qr_new_enquiry', 'region') }}";
                        }

                        route = route.replaceAll('region', selected_region);

                        window.location.href = route;
                    } else {
                        regionError.classList.remove('hidden');
                    }
                    set_preloader(false);
                }

                document.getElementById('support_for').addEventListener('click', region_value);
                document.getElementById('new_enquiry').addEventListener('click', region_value);
            });
        </script>
    @endsection
</x-layout.qr>
