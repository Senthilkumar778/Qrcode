<x-layout.default>
    <link rel='stylesheet' type='text/css' media='screen' href="{{ Vite::asset('resources/css/fancybox.css') }}">
    <script src="/assets/js/fancybox.umd.js"></script>


    <div x-data="lightbox">
        <script src="/assets/js/simple-datatables.js"></script>


        <div class="panel px-0 border-[#e0e6ed] dark:border-[#1b2e4b]">
            <div class="px-5">
                <div class="md:top-5 ltr:md:left-5 rtl:md:right-5">
                    <div class="flex items-center gap-2 mb-1">
                    <h5 class="text-lg font-semibold dark:text-white-light">QR code - Test</h5>
                    <a @click="fetchData()" href="javascript:void(0)" class="btn btn-primary gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="w-5 h-5">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add New
                    </a>
                    </div>
                </div>
            </div>
             <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 mt-1  " x-init="bindFancybox()">
                <template x-for="(item, i) in getItems" :key="i">
                    <a href="javascript:;" class="mb-4 text-center">
                        <img :src="item.src" alt="image-gallery" data-fancybox="gallery"
                            class="rounded-md w-full h-full object-cover" :data-caption="item.title" />
                         <label x-text="item.title"></label>
                    </a>
                </template>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("lightbox", () => ({
                allcontrols: 1,
                items: [],

                getItems() {
                    var images = [];
                    // fetch('api/listAllQRCode')
                    //     .then(response => {
                    //         if (!response.ok) {
                    //             throw new Error('Network response was not ok');
                    //         }
                    //         return response.json();
                    //     })
                    //     .then(data => {
                    //         var currentImages = data?.data;
                    //         var newImages = [];
                    //         currentImages?.map((image) => {
                    //             newImages.push({
                    //                 src: (image),
                    //                 title: 'QR Code 100',
                    //                 description: 'QR Code',
                    //             })
                    //         })
                    //         this.images = newImages;
                    //         console.log(this.images);
                    //     })
                    //     .catch(error => {
                    //         console.error('There was a problem with the fetch operation:', error);
                    //     });

                    return this.allcontrols == 1 ? this.items = [
                        {
                            src: ("/qrcodes/test_qr_code_small.png"),
                            title: 'QR Code small',
                            description: 'QR Code',
                        },
                        {
                            src: ("/qrcodes/test_qr_code_medium.png"),
                            title: 'QR Code medium',
                            description: 'QR Code',
                        },
                        {
                            src: ("/qrcodes/test_qr_code_large.png"),
                            title: 'QR Code large',
                            description: 'QR Code',
                        },
                        // {
                        //     src: ("/qrcodes/qr_code_100.png"),
                        //     title: 'QR Code 100',
                        //     description: 'QR Code',
                        // },
                        // {
                        //     src: ("/qrcodes/qr_code_200.png"),
                        //     title: 'QR Code 200',
                        //     description: 'QR Code',
                        // },
                        // {
                        //     src: ("qrcodes/qr_code_300.png"),
                        //     title: 'QR Code 300',
                        //     description: 'QR Code',
                        // },
                        // {
                        //     src: ("qrcodes/qr_code_400.png"),
                        //     title: 'QR Code 400',
                        //     description: 'QR Code',
                        // },
                        // {
                        //     src: ("/qrcodes/qr_code_500.png"),
                        //     title: 'QR Code 500',
                        //     description: 'QR Code',
                        // },
                        // {
                        //     src: ("/qrcodes/qr_code_600.png"),
                        //     title: 'QR Code 600',
                        //     description: 'QR Code',
                        // },
                        // {
                        //     src: ("qrcodes/qr_code_700.png"),
                        //     title: 'QR Code 700',
                        //     description: 'QR Code',
                        // },
                        // {
                        //     src: ("qrcodes/qr_code_800.png"),
                        //     title: 'QR Code 800',
                        //     description: 'QR Code',
                        // },
                        // {
                        //     src: ("qrcodes/qr_code_900.png"),
                        //     title: 'QR Code 900',
                        //     description: 'QR Code',
                        // },
                        // {
                        //     src: ("qrcodes/qr_code_1000.png"),
                        //     title: 'QR Code 1000',
                        //     description: 'QR Code',
                        // },
                    ] : this.items = [{
                            src: ("/assets/images/lightbox1.jpg")
                        },
                        {
                            src: ("/assets/images/lightbox2.jpeg")
                        },
                        {
                            src: ("/assets/images/lightbox3.jpeg")
                        },
                        {
                            src: ("/assets/images/lightbox4.jpeg")
                        },
                        {
                            src: ("/assets/images/lightbox5.jpeg")
                        },
                        {
                            src: ("/assets/images/lightbox6.jpeg")
                        },
                    ];
                },

                bindFancybox() {
                    if (this.allcontrols == 1) {
                        Fancybox.bind('[data-fancybox="gallery"]', {
                            Carousel: {
                                Navigation: {
                                    prevTpl: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11 5l-7 7 7 7"/><path d="M4 12h16"/></svg>',
                                    nextTpl: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M4 12h16"/><path d="M13 5l7 7-7 7"/></svg>',
                                },
                            },

                        });
                    } else if (this.allcontrols == 2) {
                        Fancybox.bind('[data-fancybox="gallery"]', {
                            Carousel: {
                                Navigation: {
                                    prevTpl: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11 5l-7 7 7 7"/><path d="M4 12h16"/></svg>',
                                    nextTpl: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M4 12h16"/><path d="M13 5l7 7-7 7"/></svg>',
                                },
                            },
                            Thumbs: false,
                            Toolbar: false,
                            closeButton: "top",
                        });
                    }
                },
                fetchData() {
                    console.log("/generateQRCode/test")
                    fetch('/generateQRCode/test')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Update data with the fetched results
                            // this.data = data;
                            if(data.status == "success"){
                                window.location.reload();
                            }
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                        });
                }
            }));

        })
    </script>
</x-layout.default>
