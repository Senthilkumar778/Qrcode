<x-layout.default>
@section('title')
Dashboard
@endsection
    <script defer src="/assets/js/apexcharts.js"></script>
    <div x-data="sales">
       
        <div class="pt-5">
            <div class="grid xl:grid-cols-3 gap-6 mb-6">
                <!-- Last 7 Days Report -->
                <div class="panel h-full xl:col-span-2">
                    <div class="flex items-center dark:text-white-light mb-5">
                        <h5 class="font-semibold text-lg">Weekly Report</h5>
                        <div x-data="dropdown" @click.outside="open = false"
                            class="dropdown ltr:ml-auto rtl:mr-auto">
                        </div>
                    </div>
                    <!-- <p class="text-lg dark:text-white-light/90">Total Profit 
                        <span class="text-primary ml-2">$10,840</span>
                    </p> -->
                    <div class="relative overflow-hidden">
                        <div x-ref="weeklyReport" class="bg-white dark:bg-black rounded-lg">
                            <!-- loader -->
                            <div
                                class="min-h-[325px] grid place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] ">
                                <span
                                    class="animate-spin border-2 border-black dark:border-white !border-l-transparent  rounded-full w-5 h-5 inline-flex"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    /* hand cursor on every clickable chart element (they open the pages) */
                    [x-ref="category"] .apexcharts-pie-area,
                    [x-ref="category"] .apexcharts-legend-series,
                    [x-ref="weeklyReport"] .apexcharts-area-series,
                    [x-ref="weeklyReport"] .apexcharts-series-markers,
                    [x-ref="weeklyReport"] .apexcharts-legend-series,
                    [x-ref="monthlyReport"] .apexcharts-bar-area,
                    [x-ref="monthlyReport"] .apexcharts-legend-series,
                    [x-ref="serviceInfoStatus"] .apexcharts-pie-area,
                    [x-ref="serviceInfoStatus"] .apexcharts-legend-series,
                    [x-ref="newEnquiryStatus"] .apexcharts-pie-area,
                    [x-ref="newEnquiryStatus"] .apexcharts-legend-series,
                    [x-ref="serviceInfoLocation"] .apexcharts-bar-area,
                    [x-ref="newEnquiryLocation"] .apexcharts-bar-area,
                    [x-ref="serviceInfoZone"] .apexcharts-pie-area,
                    [x-ref="serviceInfoZone"] .apexcharts-legend-series,
                    [x-ref="newEnquiryZone"] .apexcharts-pie-area,
                    [x-ref="newEnquiryZone"] .apexcharts-legend-series { cursor: pointer; }
                </style>

                <!-- Total Count -->
                <div class="panel h-full">
                    <div class="flex items-center mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Report By Category</h5>
                    </div>
                    <div class="overflow-hidden">
                        <div x-ref="category" class="bg-white dark:bg-black rounded-lg">
                            <!-- loader -->
                            <div
                                class="min-h-[353px] grid place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] ">
                                <span
                                    class="animate-spin border-2 border-black dark:border-white !border-l-transparent  rounded-full w-5 h-5 inline-flex"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
                <div class="panel h-full sm:col-span-2 xl:col-span-1">
                    <div class="flex items-center mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Daily Sales <span
                                class="block text-white-dark text-sm font-normal">Go to columns for details.</span></h5>
                        <div class="ltr:ml-auto rtl:mr-auto relative">
                            <div
                                class="w-11 h-11 text-warning bg-[#ffeccb] dark:bg-warning dark:text-[#ffeccb] grid place-content-center rounded-full">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 6V18" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" />
                                    <path
                                        d="M15 9.5C15 8.11929 13.6569 7 12 7C10.3431 7 9 8.11929 9 9.5C9 10.8807 10.3431 12 12 12C13.6569 12 15 13.1193 15 14.5C15 15.8807 13.6569 17 12 17C10.3431 17 9 15.8807 9 14.5"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-hidden">
                        <div x-ref="dailySales" class="bg-white dark:bg-black rounded-lg">
                            loader
                            <div
                                class="min-h-[175px] grid place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] ">
                                <span
                                    class="animate-spin border-2 border-black dark:border-white !border-l-transparent  rounded-full w-5 h-5 inline-flex"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel h-full">
                    <div class="flex items-center dark:text-white-light mb-5">
                        <h5 class="font-semibold text-lg">Summary</h5>
                        <div x-data="dropdown" @click.outside="open = false"
                            class="dropdown ltr:ml-auto rtl:mr-auto">
                            <a href="javascript:;" @click="toggle">
                                <svg class="w-5 h-5 text-black/70 dark:text-white/70 hover:!text-primary"
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="5" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle opacity="0.5" cx="12" cy="12" r="2"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <circle cx="19" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                </svg>
                            </a>
                            <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                class="ltr:right-0 rtl:left-0">
                                <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                <li><a href="javascript:;" @click="toggle">Edit Report</a></li>
                                <li><a href="javascript:;" @click="toggle">Mark as Done</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="space-y-9">
                        <div class="flex items-center">
                            <div class="w-9 h-9 ltr:mr-3 rtl:ml-3">
                                <div
                                    class="bg-secondary-light dark:bg-secondary text-secondary dark:text-secondary-light  rounded-full w-9 h-9 grid place-content-center">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.74157 18.5545C4.94119 20 7.17389 20 11.6393 20H12.3605C16.8259 20 19.0586 20 20.2582 18.5545M3.74157 18.5545C2.54194 17.1091 2.9534 14.9146 3.77633 10.5257C4.36155 7.40452 4.65416 5.84393 5.76506 4.92196M3.74157 18.5545C3.74156 18.5545 3.74157 18.5545 3.74157 18.5545ZM20.2582 18.5545C21.4578 17.1091 21.0464 14.9146 20.2235 10.5257C19.6382 7.40452 19.3456 5.84393 18.2347 4.92196M20.2582 18.5545C20.2582 18.5545 20.2582 18.5545 20.2582 18.5545ZM18.2347 4.92196C17.1238 4 15.5361 4 12.3605 4H11.6393C8.46374 4 6.87596 4 5.76506 4.92196M18.2347 4.92196C18.2347 4.92196 18.2347 4.92196 18.2347 4.92196ZM5.76506 4.92196C5.76506 4.92196 5.76506 4.92196 5.76506 4.92196Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <path opacity="0.5"
                                            d="M9.1709 8C9.58273 9.16519 10.694 10 12.0002 10C13.3064 10 14.4177 9.16519 14.8295 8"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex font-semibold text-white-dark mb-2">
                                    <h6>Income</h6>
                                    <p class="ltr:ml-auto rtl:mr-auto">$92,600</p>
                                </div>
                                <div class="rounded-full h-2 bg-dark-light dark:bg-[#1b2e4b] shadow">
                                    <div
                                        class="bg-gradient-to-r from-[#7579ff] to-[#b224ef] w-11/12 h-full rounded-full">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-9 h-9 ltr:mr-3 rtl:ml-3">
                                <div
                                    class="bg-success-light dark:bg-success text-success dark:text-success-light rounded-full w-9 h-9 grid place-content-center">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4.72848 16.1369C3.18295 14.5914 2.41018 13.8186 2.12264 12.816C1.83509 11.8134 2.08083 10.7485 2.57231 8.61875L2.85574 7.39057C3.26922 5.59881 3.47597 4.70292 4.08944 4.08944C4.70292 3.47597 5.59881 3.26922 7.39057 2.85574L8.61875 2.57231C10.7485 2.08083 11.8134 1.83509 12.816 2.12264C13.8186 2.41018 14.5914 3.18295 16.1369 4.72848L17.9665 6.55812C20.6555 9.24711 22 10.5916 22 12.2623C22 13.933 20.6555 15.2775 17.9665 17.9665C15.2775 20.6555 13.933 22 12.2623 22C10.5916 22 9.24711 20.6555 6.55812 17.9665L4.72848 16.1369Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <circle opacity="0.5" cx="8.60699" cy="8.87891" r="2"
                                            transform="rotate(-45 8.60699 8.87891)" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <path opacity="0.5" d="M11.5417 18.5L18.5208 11.5208" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex font-semibold text-white-dark mb-2">
                                    <h6>Profit</h6>
                                    <p class="ltr:ml-auto rtl:mr-auto">$37,515</p>
                                </div>
                                <div class="w-full rounded-full h-2 bg-dark-light dark:bg-[#1b2e4b] shadow">
                                    <div class="bg-gradient-to-r from-[#3cba92] to-[#0ba360] w-full h-full rounded-full"
                                        style="width: 65%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-9 h-9 ltr:mr-3 rtl:ml-3">
                                <div
                                    class="bg-warning-light dark:bg-warning text-warning dark:text-warning-light rounded-full w-9 h-9 grid place-content-center">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <path opacity="0.5" d="M10 16H6" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" />
                                        <path opacity="0.5" d="M14 16H12.5" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" />
                                        <path opacity="0.5" d="M2 10L22 10" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex font-semibold text-white-dark mb-2">
                                    <h6>Expenses</h6>
                                    <p class="ltr:ml-auto rtl:mr-auto">$55,085</p>
                                </div>
                                <div class="w-full rounded-full h-2 bg-dark-light dark:bg-[#1b2e4b] shadow">
                                    <div class="bg-gradient-to-r from-[#f09819] to-[#ff5858] w-full h-full rounded-full"
                                        style="width: 80%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel h-full p-0">
                    <div class="flex items-center justify-between w-full p-5 absolute">
                        <div class="relative">
                            <div
                                class="text-success dark:text-success-light bg-success-light dark:bg-success w-11 h-11 rounded-lg flex items-center justify-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <path opacity="0.5"
                                        d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5"
                                        d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5" d="M11 9H8" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" />
                                    <path
                                        d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                        stroke="currentColor" stroke-width="1.5" />
                                </svg>
                            </div>
                        </div>
                        <h5 class="font-semibold text-2xl ltr:text-right rtl:text-left dark:text-white-light">
                            3,192
                            <span class="block text-sm font-normal">Total Orders</span>
                        </h5>
                    </div>
                    <div x-ref="totalOrders" class="bg-transparent rounded-lg overflow-hidden">
                        loader
                        <div
                            class="min-h-[290px] grid place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] ">
                            <span
                                class="animate-spin border-2 border-black dark:border-white !border-l-transparent  rounded-full w-5 h-5 inline-flex"></span>
                        </div>
                    </div>
                </div>
            </div> -->

            
            <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-2">
                <!-- Recent Service Info -->
                <div class="panel h-full sm:col-span-2 xl:col-span-1 pb-0">
                   <h5 class="font-semibold text-lg dark:text-white-light mb-5">Recent Service Info</h5>

                    <div class="perfect-scrollbar relative mb-4 h-[290px] pr-3 -mr-3">
                        <div class="text-sm cursor-pointer">

                       @foreach($dashboardData['recentData']['recentServiceInfo'] as $recentServiceInfo)
    <a href="{{ route('recordDetails', ['type' => 'serviceInfo', 'id' => $recentServiceInfo->id]) }}" data-record-type="serviceInfo" data-record-id="{{ $recentServiceInfo->id }}" class="js-record-link rec-item">
        <div class="bg-primary w-1.5 h-1.5 rounded-full ltr:mr-1 rtl:ml-1.5"></div>
        <div class="flex-1 rec-item-text"><span class="rec-item-id">S{{ $recentServiceInfo->id }}</span> - {{ $recentServiceInfo->status }}</div>
        <div class="ltr:ml-auto rtl:mr-auto text-xs text-white-dark dark:text-gray-500">
            {{ \Carbon\Carbon::parse($recentServiceInfo->createdAt)->diffForHumans() }}
        </div>
    </a>
@endforeach
                        </div>
                    </div>
                    <!-- <div class="border-t border-white-light dark:border-white/10">
                        <a href="javascript:;"
                            class=" font-semibold group hover:text-primary p-4 flex items-center justify-center group">
                            View All
                            <svg class="w-4 h-4 rtl:rotate-180 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition duration-300 ltr:ml-1 rtl:mr-1"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div> -->
                </div>

                  <!-- Recent New Enquiry -->
                  <style>
    /* Recent Service Info / Recent New Enquiry rows */
    .rec-item{display:flex;align-items:center;padding:6px 6px 6px 3px;border-radius:4px;color:inherit;text-decoration:none}
    .rec-item .rec-item-id{color:#4361ee}
    .rec-item:hover{background:#e8eefc;color:inherit}
    .rec-item:hover .rec-item-text{text-decoration:underline}
    .dark .rec-item:hover{background:#1b2e4b}
</style>
                <div class="panel h-full sm:col-span-2 xl:col-span-1 pb-0">
                    <h5 class="font-semibold text-lg dark:text-white-light mb-5">Recent New Enquiry</h5>

                    <div class="perfect-scrollbar relative mb-4 h-[290px] pr-3 -mr-3">
                        <div class="text-sm cursor-pointer">

      @foreach($dashboardData['recentData']['recentNewEnquiry'] as $recentNewEnquiry)
    <a href="{{ route('recordDetails', ['type' => 'newEnquiry', 'id' => $recentNewEnquiry->id]) }}" data-record-type="newEnquiry" data-record-id="{{ $recentNewEnquiry->id }}" class="js-record-link rec-item">
        <div class="bg-primary w-1.5 h-1.5 rounded-full ltr:mr-1 rtl:ml-1.5"></div>
        <div class="flex-1 rec-item-text"><span class="rec-item-id">N{{ $recentNewEnquiry->id }}</span> - {{ $recentNewEnquiry->status }}</div>
        <div class="ltr:ml-auto rtl:mr-auto text-xs text-white-dark dark:text-gray-500">
            {{ \Carbon\Carbon::parse($recentNewEnquiry->createdAt)->diffForHumans() }}
        </div>
    </a>
@endforeach
                        </div>
                    </div>
                    <!-- <div class="border-t border-white-light dark:border-white/10">
                        <a href="javascript:;"
                            class=" font-semibold group hover:text-primary p-4 flex items-center justify-center group">
                            View All
                            <svg class="w-4 h-4 rtl:rotate-180 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition duration-300 ltr:ml-1 rtl:mr-1"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div> -->
                </div>

                <!-- <div class="panel h-full">
                    <div class="flex items-center justify-between dark:text-white-light mb-5">
                        <h5 class="font-semibold text-lg">Transactions</h5>
                      
                    </div>
                    <div>
                        <div class="space-y-6">
                            <div class="flex">
                                <span
                                    class="shrink-0 grid place-content-center text-base w-9 h-9 rounded-md bg-success-light dark:bg-success text-success dark:text-success-light">SP</span>
                                <div class="px-3 flex-1">
                                    <div>Shaun Park</div>
                                    <div class="text-xs text-white-dark dark:text-gray-500">10 Jan 1:00PM</div>
                                </div>
                                <span
                                    class="text-success text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre">+$36.11</span>
                            </div>
                            <div class="flex">
                                <span
                                    class="shrink-0 grid place-content-center w-9 h-9 rounded-md bg-warning-light dark:bg-warning text-warning dark:text-warning-light">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                                        <path
                                            d="M2 10C2 7.17157 2 5.75736 2.87868 4.87868C3.75736 4 5.17157 4 8 4H13C15.8284 4 17.2426 4 18.1213 4.87868C19 5.75736 19 7.17157 19 10C19 12.8284 19 14.2426 18.1213 15.1213C17.2426 16 15.8284 16 13 16H8C5.17157 16 3.75736 16 2.87868 15.1213C2 14.2426 2 12.8284 2 10Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <path opacity="0.5"
                                            d="M19.0003 7.07617C19.9754 7.17208 20.6317 7.38885 21.1216 7.87873C22.0003 8.75741 22.0003 10.1716 22.0003 13.0001C22.0003 15.8285 22.0003 17.2427 21.1216 18.1214C20.2429 19.0001 18.8287 19.0001 16.0003 19.0001H11.0003C8.17187 19.0001 6.75766 19.0001 5.87898 18.1214C5.38909 17.6315 5.17233 16.9751 5.07642 16"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <path
                                            d="M13 10C13 11.3807 11.8807 12.5 10.5 12.5C9.11929 12.5 8 11.3807 8 10C8 8.61929 9.11929 7.5 10.5 7.5C11.8807 7.5 13 8.61929 13 10Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <path opacity="0.5" d="M16 12L16 8" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" />
                                        <path opacity="0.5" d="M5 12L5 8" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" />
                                    </svg>
                                </span>
                                <div class="px-3 flex-1">
                                    <div>Cash withdrawal</div>
                                    <div class="text-xs text-white-dark dark:text-gray-500">04 Jan 1:00PM</div>
                                </div>
                                <span
                                    class="text-danger text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre">-$16.44</span>
                            </div>
                            <div class="flex">
                                <span
                                    class="shrink-0 grid place-content-center w-9 h-9 rounded-md bg-danger-light dark:bg-danger text-danger dark:text-danger-light">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="6" r="4" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <path opacity="0.5"
                                            d="M20 17.5C20 19.9853 20 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C16.4183 13 20 15.0147 20 17.5Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                    </svg>
                                </span>
                                <div class="px-3 flex-1">
                                    <div>Amy Diaz</div>
                                    <div class="text-xs text-white-dark dark:text-gray-500">10 Jan 1:00PM</div>
                                </div>
                                <span
                                    class="text-success text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre">+$66.44</span>
                            </div>
                            <div class="flex">
                                <span
                                    class="shrink-0 grid place-content-center w-9 h-9 rounded-md bg-secondary-light dark:bg-secondary text-secondary dark:text-secondary-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M5.398 0v.006c3.028 8.556 5.37 15.175 8.348 23.596c2.344.058 4.85.398 4.854.398c-2.8-7.924-5.923-16.747-8.487-24zm8.489 0v9.63L18.6 22.951c-.043-7.86-.004-15.913.002-22.95zM5.398 1.05V24c1.873-.225 2.81-.312 4.715-.398v-9.22z" />
                                    </svg>
                                </span>
                                <div class="px-3 flex-1">
                                    <div>Netflix</div>
                                    <div class="text-xs text-white-dark dark:text-gray-500">04 Jan 1:00PM</div>
                                </div>
                                <span
                                    class="text-danger text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre">-$32.00</span>
                            </div>
                            <div class="flex">
                                <span
                                    class="shrink-0 grid place-content-center text-base w-9 h-9 rounded-md bg-info-light dark:bg-info text-info dark:text-info-light">DA</span>
                                <div class="px-3 flex-1">
                                    <div>Daisy Anderson</div>
                                    <div class="text-xs text-white-dark dark:text-gray-500">10 Jan 1:00PM</div>
                                </div>
                                <span
                                    class="text-success text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre">+$10.08</span>
                            </div>
                            <div class="flex">
                                <span
                                    class="shrink-0 grid place-content-center w-9 h-9 rounded-md bg-primary-light dark:bg-primary text-primary dark:text-primary-light">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.926 9.70541C13.5474 9.33386 13.5474 8.74151 13.5474 7.55682V7.24712C13.5474 3.96249 13.5474 2.32018 12.6241 2.03721C11.7007 1.75425 10.711 3.09327 8.73167 5.77133L5.66953 9.91436C4.3848 11.6526 3.74244 12.5217 4.09639 13.205C4.10225 13.2164 4.10829 13.2276 4.1145 13.2387C4.48945 13.9117 5.59888 13.9117 7.81775 13.9117C9.05079 13.9117 9.6673 13.9117 10.054 14.2754"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <path opacity="0.5"
                                            d="M13.9259 9.70557L13.9459 9.72481C14.3326 10.0885 14.9492 10.0885 16.1822 10.0885C18.4011 10.0885 19.5105 10.0885 19.8854 10.7615C19.8917 10.7726 19.8977 10.7838 19.9036 10.7951C20.2575 11.4785 19.6151 12.3476 18.3304 14.0858L15.2682 18.2288C13.2888 20.9069 12.2991 22.2459 11.3758 21.9629C10.4524 21.68 10.4524 20.0376 10.4525 16.753L10.4525 16.4434C10.4525 15.2587 10.4525 14.6663 10.074 14.2948L10.054 14.2755"
                                            stroke="currentColor" stroke-width="1.5" />
                                    </svg>
                                </span>
                                <div class="px-3 flex-1">
                                    <div>Electricity Bill</div>
                                    <div class="text-xs text-white-dark dark:text-gray-500">04 Jan 1:00PM</div>
                                </div>
                                <span
                                    class="text-danger text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre">-$22.00</span>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="panel h-full p-0 border-0 overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-[#4361ee] to-[#160f6b] min-h-[190px]">
                        <div class="flex justify-between items-center mb-6">
                            <div class="bg-black/50 rounded-full p-1 ltr:pr-2 rtl:pl-2 flex items-center text-white font-semibold">
                               
                                @if(auth()->user())
                                    {{auth()->user()->firstName}} {{auth()->user()->lastName}}
                                @endif
                            </div>
                            <div class="text-white">
                                @if(auth()->user())
                                    {{auth()->user()->email}}
                                @endif
                            </div>
                           
                            <button type="button"
                                class="ltr:ml-auto rtl:mr-auto flex items-center justify-between w-9 h-9 bg-black text-white rounded-md hover:opacity-80">
                                <svg class="w-6 h-6 m-auto" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="1.5" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </button>
                        </div>
                        <div class="text-white flex justify-between items-center">
                            <p class="text-xl">Wallet Balance</p>
                            <h5 class="ltr:ml-auto rtl:mr-auto text-2xl">
                                <span class="text-white-light">$</span>2953
                            </h5>
                        </div>
                    </div>
                    <div class="-mt-12 px-8 grid grid-cols-2 gap-2">
                        <div class="bg-white rounded-md shadow px-4 py-2.5 dark:bg-[#060818]">
                            <span class="flex justify-between items-center mb-4 dark:text-white">Service Info
                                <svg class="w-4 h-4 text-success" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 15L12 9L5 15" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <div
                                class="btn w-full  py-1 text-base shadow-none border-0 bg-[#ebedf2] dark:bg-black text-[#515365] dark:text-[#bfc9d4]">
                                {{ $dashboardData['authUserCountData']['authUserServiceInfoCount']}}</div>
                        </div>
                        <div class="bg-white rounded-md shadow px-4 py-2.5 dark:bg-[#060818]">
                            <span class="flex justify-between items-center mb-4 dark:text-white">New Enquiry
                                <svg class="w-4 h-4 text-danger" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <div
                                class="btn w-full  py-1 text-base shadow-none border-0 bg-[#ebedf2] dark:bg-black text-[#515365] dark:text-[#bfc9d4]">
                                {{ $dashboardData['authUserCountData']['authUserNewEnquiryCount']}}</div>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="text-center md:px-2 flex space-x-2 my-2">
                            <a href="{{ route('serviceInfo') }}" class="md:w-full sm:w-auto">
                                <button type="button" class="btn btn-secondary md:w-full ">Service Info</button>
                            </a>
                            <a href="{{ route('newEnquiries') }}" class="md:w-full sm:w-auto">
                                <button type="button" class="btn btn-success md:w-full">New Enquiry</button>
                            </a>
                        </div>

                        <div class="text-center md:px-2 flex space-x-2">
                            <a href="{{ route('products') }}" class="md:w-full sm:w-auto">
                                <button type="button" class="btn btn-primary md:w-full ">Product</button>
                            </a>
                            <a href="{{ route('newEnquiries') }}" class="md:w-full sm:w-auto">
                                <button type="button" class="btn btn-info md:w-full ">Sub Category</button>
                            </a>
                        </div>
                    </div>
                </div> -->

                <div class="panel h-full xl:col-span-1">
                    <div class="flex items-center mb-5">
                     <h5 class="font-semibold text-lg dark:text-white">New Enquiry Status</h5>
                    </div>
                    <div class="overflow-hidden">
                        <div x-ref="newEnquiryStatus" class="bg-white dark:bg-black rounded-lg overflow-hidden"></div>
                    </div>
                </div>

            </div>
            
            <div class="grid xl:grid-cols-3 gap-6 mb-6">
            
                <div class="panel h-full xl:col-span-2">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white">Monthly Report</h5>
                    </div>
                    <div x-ref="monthlyReport" class="bg-white dark:bg-black rounded-lg overflow-hidden"></div>
                </div>

                <!-- Pie Chart -->
                <div class="panel h-full xl:col-span-1">
                    <div class="flex items-center mb-5">
                        <h5 class="font-semibold text-lg dark:text-white">Service Info Status</h5>
                    </div>
                    <div class="overflow-hidden">
                        <div x-ref="serviceInfoStatus" class="bg-white dark:bg-black rounded-lg overflow-hidden"></div>
                    </div>
                </div>
            </div>
            <!-- </div> -->

            <div class="grid xl:grid-cols-2 gap-6 mb-6">

                <!-- Bar Chart Service Location -->
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white">Service Info Location</h5>
                    </div>
                    <div x-ref="serviceInfoLocation" class="bg-white dark:bg-black rounded-lg overflow-hidden"></div>
                    
                </div>

                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white">New Enquiry Location</h5>
                    </div>
                    <div x-ref="newEnquiryLocation" class="bg-white dark:bg-black rounded-lg overflow-hidden"></div>
                    
                </div>
            </div>

            <!-- Donut Chart Zone Report -->

            <div class="grid xl:grid-cols-2 gap-6 mb-6">

                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white">Service Info Zone</h5>
                    </div>
                    <div x-ref="serviceInfoZone" class="bg-white dark:bg-black rounded-lg overflow-hidden">
                        
                    </div>
                </div>

                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white">New Enquiry Zone</h5>
                    </div>
                    <div x-ref="newEnquiryZone" class="bg-white dark:bg-black rounded-lg overflow-hidden">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var last7DaysData = @json($dashboardData['datesWithCount']);
        // console.log(last7DaysData);
        const dates = last7DaysData.map((entry) => entry.date);
        const serviceInfo = last7DaysData.map((serviceInfo) => serviceInfo.serviceInfo);
        const newEnquiry = last7DaysData.map((newEnquiry) => newEnquiry.newEnquiry);
        // console.log('dates', dates);
        // console.log('serviceInfo', serviceInfo);
        // console.log('newEnquiry', newEnquiry);

        var totalCountData = @json($dashboardData['totalCountData']);
        // console.log('totalCountData', totalCountData);
        const countData = Object.values(totalCountData);
        // console.log('countData', countData);

        var monthlyData = @json($dashboardData['monthlyData']);
        // console.log(monthlyData);
        const monthlyServiceInfo = monthlyData.map((serviceInfo) => serviceInfo.serviceInfo);
        const monthlyNewEnquiry = monthlyData.map((newEnquiry) => newEnquiry.newEnquiry);
        const months = monthlyData.map((month) => month.month);
        // console.log('monthlyServiceInfo', monthlyServiceInfo);

        const totalStatusCount = @json($dashboardData['statusCount']);
        // console.log(totalStatusCount);

        const serviceStatusCountArray = totalStatusCount.serviceStatusCount;
        const newEnquiryStatusCountArray = totalStatusCount.newEnquiryStatusCount;

        const serviceStatusCount = serviceStatusCountArray.map((statusCount) => statusCount['statusCount']);
        const newEnquiryStatusCount = newEnquiryStatusCountArray.map((statusCount) => statusCount['statusCount']);
        // var newWnquirySatusCount = totalStatusCount.map((statusCount) => statusCount.statusCount);

        const serviceStatusLabel = serviceStatusCountArray.map((statusCount) => statusCount.status);
        const newEnquiryStatusLabel = newEnquiryStatusCountArray.map((statusCount) => statusCount.status);
        // console.log(serviceStatusLabel);
        // console.log(newEnquiryStatusLabel);
        // console.log(serviceStatusCount);
        // console.log(newEnquiryStatusCount);

        const locationWiseData = @json($dashboardData['locationWiseData']);
        // console.log(locationWiseData);
        const locationWiseServiceInfoArray = locationWiseData.serviceInfo;
        const locationWiseNewEnquiryArray = locationWiseData.newEnquiry;
        // console.log(locationWiseServiceInfoArray);

        const serviceInfolocation = locationWiseServiceInfoArray.map( ( serviceInfo) => serviceInfo.locationName);
        const serviceInfoLocationCount = locationWiseServiceInfoArray.map( ( serviceInfo) => serviceInfo.serviceInfoCount);
        // console.log(serviceInfolocation);

        const newEnquiryLocation = locationWiseNewEnquiryArray.map( ( newEnquiry) => newEnquiry.locationName);
        const newEnquiryLocationCount = locationWiseNewEnquiryArray.map( (newEnquiry) => newEnquiry.newEnquiryCount);
        // console.log(newEnquiryLocation);
        // console.log(newEnquiryLocationCount);

        const zoneWiseData = @json($dashboardData['zoneWiseData']);
        // console.log(zoneWiseData);

        const zoneWiseServiceInfoArray = zoneWiseData.serviceInfo;
        const zoneWiseNewEnquiryArray = zoneWiseData.newEnquiry;

        const serviceInfoZone = zoneWiseServiceInfoArray.map( ( serviceInfo) => serviceInfo.regionName);
        const serviceInfoZoneCount = zoneWiseServiceInfoArray.map( (serviceInfo) => serviceInfo.serviceInfoCount);
        // console.log(serviceInfoZoneCount);

        const newEnquiryZone = zoneWiseNewEnquiryArray.map( (newEnquiry) => newEnquiry.regionName);
        const newEnquiryZoneCount = zoneWiseNewEnquiryArray.map((newEnquiry) => newEnquiry.newEnquiryCount);
        // console.log(newEnquiryZone);
        // console.log(newEnquiryZoneCount);
        
        // ---------- chart click navigation ----------
        const SERVICE_INFO_URL = "{{ route('serviceInfo') }}";
        const NEW_ENQUIRY_URL  = "{{ route('newEnquiries') }}";

        // ===== FILTER NAMES (match NewEnquiryController / ServiceInfoController@index) =====
        //   one month    -> ?date=2025-12
        //   custom range -> ?date=custom&from=2026-10-09&to=2026-10-09
        //   others       -> ?location=Chennai  ?region=South  ?status=CLOSED
        const FILTER_KEYS = {
            status:   'status',
            location: 'location',
            region:   'region',
            date:     'date',
            from:     'from',
            to:       'to',
        };

        // 'dd-mm-yyyy' (weekly chart label) -> 'yyyy-mm-dd'
        function toIsoDate(label) {
            const m = /^(\d{2})-(\d{2})-(\d{4})$/.exec(label || '');
            return m ? m[3] + '-' + m[2] + '-' + m[1] : label;
        }

        // Weekly chart: one clicked day = a custom range where From and To are that day
        function dayParams(index) {
            const day = toIsoDate(dates[index]);
            const params = {};
            params[FILTER_KEYS.date] = 'custom';
            params[FILTER_KEYS.from] = day;
            params[FILTER_KEYS.to]   = day;
            return params;
        }

        // Monthly chart: labels are only "Nov", "Dec" ... so the year is worked out from today.
        // The last bar is the current month, the one before it is last month, and so on.
        function monthParams(index) {
            const now = new Date();
            const stepsBack = months.length - 1 - index;
            const d = new Date(now.getFullYear(), now.getMonth() - stepsBack, 1);
            const params = {};
            params[FILTER_KEYS.date] = d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0');
            return params;
        }

        // open a list page; optional filters are sent as query-string values
        function goTo(baseUrl, params) {
            const query = new URLSearchParams();
            Object.keys(params || {}).forEach((key) => {
                if (params[key] !== undefined && params[key] !== null && params[key] !== '') {
                    query.append(key, params[key]);
                }
            });
            const qs = query.toString();
            window.location.href = qs ? baseUrl + (baseUrl.indexOf('?') > -1 ? '&' : '?') + qs : baseUrl;
        }

        // events for a chart that belongs to ONE page (labelFn gives the filter value of the clicked item)
        function pageEvents(baseUrl, filterKey, labelsFn) {
            return {
                dataPointSelection: function(event, chartContext, config) {
                    if (config.dataPointIndex < 0) return;
                    const labels = labelsFn();
                    const params = {};
                    params[FILTER_KEYS[filterKey]] = labels[config.dataPointIndex];
                    goTo(baseUrl, params);
                },
                legendClick: function(chartContext, seriesIndex) {
                    const labels = labelsFn();
                    if (seriesIndex < 0 || labels[seriesIndex] === undefined) { goTo(baseUrl); return; }
                    const params = {};
                    params[FILTER_KEYS[filterKey]] = labels[seriesIndex];
                    goTo(baseUrl, params);
                },
            };
        }

        // events for a chart with TWO series: series 0 = Service Info, series 1 = New Enquiry
        // hoverMode = true (line/area chart): a click anywhere on the chart uses the point
        // the tooltip is showing, so the user does not have to hit the thin line exactly
        function twoSeriesEvents(paramsFn, hoverMode) {
            const open = (seriesIndex, dataPointIndex) => {
                const baseUrl = seriesIndex === 0 ? SERVICE_INFO_URL : (seriesIndex === 1 ? NEW_ENQUIRY_URL : null);
                if (!baseUrl) return;
                goTo(baseUrl, dataPointIndex > -1 ? paramsFn(dataPointIndex) : {});
            };
            const events = {
                legendClick: function(chartContext, seriesIndex) {
                    open(seriesIndex, -1);
                },
            };
            if (hoverMode) {
                events.click = function(event, chartContext, config) {
                    const g = chartContext.w.globals;
                    const series = config.seriesIndex > -1 ? config.seriesIndex : g.capturedSeriesIndex;
                    const point  = config.dataPointIndex > -1 ? config.dataPointIndex : g.capturedDataPointIndex;
                    if (series > -1) open(series, point);
                };
            } else {
                events.dataPointSelection = function(event, chartContext, config) {
                    open(config.seriesIndex, config.dataPointIndex);
                };
            }
            return events;
        }

        const weeklyEvents          = () => twoSeriesEvents(dayParams, true);
        const monthlyEvents         = () => twoSeriesEvents(monthParams, false);
        const serviceStatusEvents   = () => pageEvents(SERVICE_INFO_URL, 'status',   () => serviceStatusLabel);
        const enquiryStatusEvents   = () => pageEvents(NEW_ENQUIRY_URL,  'status',   () => newEnquiryStatusLabel);
        const serviceLocationEvents = () => pageEvents(SERVICE_INFO_URL, 'location', () => serviceInfolocation);
        const enquiryLocationEvents = () => pageEvents(NEW_ENQUIRY_URL,  'location', () => newEnquiryLocation);
        const serviceZoneEvents     = () => pageEvents(SERVICE_INFO_URL, 'region',   () => serviceInfoZone);
        const enquiryZoneEvents     = () => pageEvents(NEW_ENQUIRY_URL,  'region',   () => newEnquiryZone);
        // ---------------------------------------------

        document.addEventListener("alpine:init", () => {
            Alpine.data("sales", () => ({
                init() {
                    isDark = this.$store.app.theme === "dark" || this.$store.app.isDarkMode ? true :
                        false;
                    isRtl = this.$store.app.rtlClass === "rtl" ? true : false;

                    const revenueChart = null;
                    const salesByCategory = null;
                    const dailySales = null;
                    const totalOrders = null;

                    // revenue
                    setTimeout(() => {
                        this.weeklyReport = new ApexCharts(this.$refs.weeklyReport, this
                            .weeklyReportOptions)
                        this.$refs.weeklyReport.innerHTML = "";
                        this.weeklyReport.render()

                        // sales by category
                        this.category = new ApexCharts(this.$refs.category, this
                            .categoryOptions)
                        this.$refs.category.innerHTML = "";
                        this.category.render()

                        this.monthlyReport = new ApexCharts(this.$refs.monthlyReport, this
                            .monthlyReportOptions);
                        this.monthlyReport.render();

                        this.serviceInfoStatus = new ApexCharts(this.$refs.serviceInfoStatus, this
                            .serviceInfoStatusOptions);
                        this.serviceInfoStatus.render();

                        this.newEnquiryStatus = new ApexCharts(this.$refs.newEnquiryStatus, this
                            .newEnquiryStatusOptions);
                        this.newEnquiryStatus.render();

                        this.serviceInfoLocation = new ApexCharts(this.$refs.serviceInfoLocation, this
                            .serviceInfoLocationOptions);
                        this.serviceInfoLocation.render();

                        this.newEnquiryLocation = new ApexCharts(this.$refs.newEnquiryLocation, this
                            .newEnquiryLocationOptions);
                        this.newEnquiryLocation.render();

                        this.serviceInfoZone = new ApexCharts(this.$refs.serviceInfoZone, this
                            .serviceInfoZoneOptions);
                        this.serviceInfoZone.render();

                        this.newEnquiryZone = new ApexCharts(this.$refs.newEnquiryZone, this
                            .newEnquiryZoneOptions);
                        this.newEnquiryZone.render();

                        

                        // daily sales
                        // this.dailySales = new ApexCharts(this.$refs.dailySales, this
                        //     .dailySalesOptions)
                        // this.$refs.dailySales.innerHTML = "";
                        // this.dailySales.render()

                        // total orders
                        // this.totalOrders = new ApexCharts(this.$refs.totalOrders, this
                        //     .totalOrdersOptions)
                        // this.$refs.totalOrders.innerHTML = "";
                        // this.totalOrders.render()
                    }, 300);

                    this.$watch('$store.app.theme', () => {
                        isDark = this.$store.app.theme === "dark" || this.$store.app
                            .isDarkMode ? true : false;
                        const map = {
                            weeklyReport: 'weeklyReportOptions',
                            category: 'categoryOptions',
                            monthlyReport: 'monthlyReportOptions',
                            serviceInfoStatus: 'serviceInfoStatusOptions',
                            newEnquiryStatus: 'newEnquiryStatusOptions',
                            serviceInfoLocation: 'serviceInfoLocationOptions',
                            newEnquiryLocation: 'newEnquiryLocationOptions',
                            serviceInfoZone: 'serviceInfoZoneOptions',
                            newEnquiryZone: 'newEnquiryZoneOptions',
                        };
                        Object.keys(map).forEach((chartName) => {
                            if (this[chartName] && typeof this[chartName].updateOptions === 'function') {
                                this[chartName].updateOptions(this[map[chartName]]);
                            }
                        });
                    });

                    this.$watch('$store.app.rtlClass', () => {
                        isRtl = this.$store.app.rtlClass === "rtl" ? true : false;
                    });

                },

                // last 7 days report
                get weeklyReportOptions() {
                    return {
                        series: [{
                                name: 'Service Info',
                                // data: [16800, 16800, 15500, 17800, 15500, 17000, 19000, 16000,
                                //     15000, 17000, 14000, 17000
                                // ]
                                data: serviceInfo
                            },
                            {
                                name: 'New Enquiry',
                                // data: [16500, 17500, 16200, 17300, 16000, 19500, 16000, 17000,
                                //     16000, 19000, 18000, 19000
                                // ]
                                data:newEnquiry
                            }
                        ],
                        chart: {
                            events: weeklyEvents(),
                            height: 325,
                            type: "area",
                            fontFamily: 'Nunito, sans-serif',
                            zoom: {
                                enabled: false
                            },
                            toolbar: {
                                show: false
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            curve: 'smooth',
                            width: 2,
                            lineCap: 'square'
                        },
                        dropShadow: {
                            enabled: true,
                            opacity: 0.2,
                            blur: 10,
                            left: -7,
                            top: 22
                        },
                        colors: isDark ? ['#2196f3', '#e7515a'] : ['#1b55e2', '#e7515a'],
                        markers: {
                            discrete: [{
                                    seriesIndex: 0,
                                    dataPointIndex: 4,
                                    fillColor: '#1b55e2',
                                    strokeColor: 'transparent',
                                    size: 7
                                },
                                {
                                    seriesIndex: 1,
                                    dataPointIndex: 5,
                                    fillColor: '#e7515a',
                                    strokeColor: 'transparent',
                                    size: 7
                                },
                            ],
                        },
                        // labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                        //     'Oct', 'Nov', 'Dec'
                        // ],
                        labels: dates,
                        xaxis: {
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            },
                            crosshairs: {
                                show: true
                            },
                            labels: {
                                offsetX: isRtl ? 2 : 0,
                                offsetY: 5,
                                style: {
                                    fontSize: '12px',
                                    cssClass: 'apexcharts-xaxis-title'
                                }
                            },
                        },
                        yaxis: {
                            tickAmount: 1,
                            labels: {
                                // formatter: (value) => {
                                //     return value / 1000 + 'K';
                                // },
                                offsetX: isRtl ? -30 : -10,
                                offsetY: 0,
                                style: {
                                    fontSize: '12px',
                                    cssClass: 'apexcharts-yaxis-title'
                                },
                            },
                            opposite: isRtl ? true : false,
                        },
                        grid: {
                            borderColor: isDark ? '#191e3a' : '#e0e6ed',
                            strokeDashArray: 5,
                            xaxis: {
                                lines: {
                                    show: true
                                }
                            },
                            yaxis: {
                                lines: {
                                    show: false
                                }
                            },
                            padding: {
                                top: 0,
                                right: 0,
                                bottom: 0,
                                left: 0
                            }
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'right',
                            fontSize: '16px',
                            markers: {
                                width: 10,
                                height: 10,
                                offsetX: -2,
                            },
                            itemMargin: {
                                horizontal: 10,
                                vertical: 5
                            },
                        },
                        tooltip: {
                            shared: true,
                            intersect: false,
                            marker: {
                                show: true
                            },
                            x: {
                                show: false
                            }
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shadeIntensity: 1,
                                inverseColors: !1,
                                opacityFrom: isDark ? 0.19 : 0.28,
                                opacityTo: 0.05,
                                stops: isDark ? [100, 100] : [45, 100],
                            },
                        },
                    }
                },

                // report by category
                get categoryOptions() {
                    return {
                        series: countData,
                        chart: {
                            type: 'donut',
                            height: 460,
                            fontFamily: 'Nunito, sans-serif',
                            events: {
                                // click on a coloured arc: 0 = Service Info, 1 = New Enquiry
                                dataPointSelection: function(event, chartContext, config) {
                                    if (config.dataPointIndex === 0) {
                                        window.location.href = "{{ route('serviceInfo') }}";
                                    } else if (config.dataPointIndex === 1) {
                                        window.location.href = "{{ route('newEnquiries') }}";
                                    }
                                },
                                // click on the legend name (Service Info / New Enquiry)
                                legendClick: function(chartContext, seriesIndex, config) {
                                    if (seriesIndex === 0) {
                                        window.location.href = "{{ route('serviceInfo') }}";
                                    } else if (seriesIndex === 1) {
                                        window.location.href = "{{ route('newEnquiries') }}";
                                    }
                                },
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 25,
                            colors: isDark ? '#0e1726' : '#fff'
                        },
                        colors: isDark ? ['#5c1ac3', '#e2a03f', '#e7515a', '#e2a03f'] : ['#e2a03f',
                            '#5c1ac3', '#e7515a'
                        ],
                        legend: {
                            position: 'bottom',
                            horizontalAlign: 'center',
                            fontSize: '14px',
                            onItemClick: {
                                toggleDataSeries: false
                            },
                            markers: {
                                width: 10,
                                height: 10,
                                offsetX: -2,
                            },
                            height: 50,
                            offsetY: 20,
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '65%',
                                    background: 'transparent',
                                    labels: {
                                        show: true,
                                        name: {
                                            show: true,
                                            fontSize: '29px',
                                            offsetY: -10
                                        },
                                        value: {
                                            show: true,
                                            fontSize: '26px',
                                            color: isDark ? '#bfc9d4' : undefined,
                                            offsetY: 16,
                                            formatter: (val) => {
                                                return val;
                                            },
                                        },
                                        total: {
                                            show: true,
                                            label: 'Total',
                                            color: '#888ea8',
                                            fontSize: '29px',
                                            formatter: (w) => {
                                                return w.globals.seriesTotals.reduce(function(a,
                                                    b) {
                                                    return a + b;
                                                }, 0);
                                            },
                                        },
                                    },
                                },
                            },
                        },
                        labels: ['Service Info', 'New Enquiry'],
                        states: {
                            hover: {
                                filter: {
                                    type: 'none',
                                    value: 0.15,
                                }
                            },
                            active: {
                                filter: {
                                    type: 'none',
                                    value: 0.15,
                                }
                            },
                        }
                    }
                },

                get monthlyReportOptions() {
                    return {
                        series: [{
                            name: 'Service Info',
                            data: monthlyServiceInfo
                        }, {
                            name: 'New Enquiry',
                            data: monthlyNewEnquiry
                        }],
                        chart: {
                            events: monthlyEvents(),
                            height: 300,
                            type: 'bar',
                            zoom: {
                                enabled: false
                            },
                            toolbar: {
                                show: false
                            }
                        },
                        colors: ['#805dca', '#e7515a'],
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '55%',
                                endingShape: 'rounded'
                            },
                        },
                        grid: {
                            borderColor: isDark ? '#191e3a' : '#e0e6ed'
                        },
                        xaxis: {
                            categories: months,
                            axisBorder: {
                                color: isDark ? '#191e3a' : '#e0e6ed'
                            },
                        },
                        yaxis: {
                            opposite: isRtl ? true : false,
                            labels: {
                                offsetX: isRtl ? -10 : 0,
                            }
                        },
                        tooltip: {
                            theme: isDark ? 'dark' : 'light',
                            y: {
                                formatter: function(val) {
                                    return val;
                                },
                            },
                        },
                    }
                },

                get serviceInfoStatusOptions() {
                    return {
                        series: serviceStatusCount,
                        chart: {
                            events: serviceStatusEvents(),
                            height: 300,
                            type: 'pie',
                            zoom: {
                                enabled: false
                            },
                            toolbar: {
                                show: false
                            }
                        },
                        labels: serviceStatusLabel,
                        colors: ['#4361ee', '#805dca', '#00ab55', '#e7515a', '#e2a03f'],
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 200
                                }
                            }
                        }],
                        stroke: {
                            show: false,
                        },
                        legend: {
                            position: 'bottom',
                        }
                    }
                },

                get newEnquiryStatusOptions() {
                    return {
                        series: newEnquiryStatusCount,
                        chart: {
                            events: enquiryStatusEvents(),
                            height: 300,
                            type: 'pie',
                            zoom: {
                                enabled: false
                            },
                            toolbar: {
                                show: false
                            }
                        },
                        labels: newEnquiryStatusLabel,
                        colors: ['#ee4361', '#a7ca5d', '#00ab55', '#ee858b', '#21618C'],
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 200
                                }
                            }
                        }],
                        stroke: {
                            show: false,
                        },
                        legend: {
                            position: 'bottom',
                        }
                    }
                },

                get serviceInfoLocationOptions() {
                    return {
                        series: [{
                            name: 'Service Info',
                            data: serviceInfoLocationCount,
                        }],
                        chart: {
                            events: serviceLocationEvents(),
                            height: 300,
                            type: 'bar',
                            zoom: {
                                enabled: false
                            },
                            toolbar: {
                                show: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 1
                        },
                        colors: ['#4361ee'],
                        xaxis: {
                            categories: serviceInfolocation,
                            axisBorder: {
                                color: isDark ? '#191e3a' : '#e0e6ed'
                            },
                        },
                        yaxis: {
                            opposite: isRtl ? true : false,
                            reversed: isRtl ? true : false,
                        },
                        grid: {
                            borderColor: isDark ? '#191e3a' : '#e0e6ed',
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                            }
                        },
                        fill: {
                            opacity: 0.8
                        }
                    }
                },

                get newEnquiryLocationOptions() {
                    return {
                        series: [{
                            name: 'New Enquiry',
                            data: newEnquiryLocationCount,
                        }],
                        chart: {
                            events: enquiryLocationEvents(),
                            height: 300,
                            type: 'bar',
                            zoom: {
                                enabled: false
                            },
                            toolbar: {
                                show: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 1
                        },
                        colors: ['#e7515a'],
                        xaxis: {
                            categories: newEnquiryLocation,
                            axisBorder: {
                                color: isDark ? '#191e3a' : '#e0e6ed'
                            },
                        },
                        yaxis: {
                            opposite: isRtl ? true : false,
                            reversed: isRtl ? true : false,
                        },
                        grid: {
                            borderColor: isDark ? '#191e3a' : '#e0e6ed',
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                            }
                        },
                        fill: {
                            opacity: 0.8
                        }
                    }
                },

                get serviceInfoZoneOptions() {
                    return {
                        series: serviceInfoZoneCount,
                        chart: {
                            events: serviceZoneEvents(),
                            height: 300,
                            type: 'donut',
                            zoom: {
                                enabled: false
                            },
                            toolbar: {
                                show: false
                            }
                        },
                        stroke: {
                            show: false,
                        },
                        labels: serviceInfoZone,
                        colors: ['#4361ee', '#805dca', '#e2a03f','#CD5C5C','#00ab55'],
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 200
                                }
                            }
                        }],
                        legend: {
                            position: 'bottom',
                        },
                    }
                },

                get newEnquiryZoneOptions() {
                    return {
                        series: newEnquiryZoneCount,
                        chart: {
                            events: enquiryZoneEvents(),
                            height: 300,
                            type: 'donut',
                            zoom: {
                                enabled: false
                            },
                            toolbar: {
                                show: false
                            }
                        },
                        stroke: {
                            show: false,
                        },
                        labels: newEnquiryZone,
                        colors: ['#899cf4', '#643cb7', '#e5ab55','#FA8072','#40E0D0'],
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 200
                                }
                            }
                        }],
                        legend: {
                            position: 'bottom',
                        },
                    }
                },

                
                // daily sales
                // get dailySalesOptions() {
                //     return {
                //         series: [{
                //                 name: 'Sales',
                //                 data: [44, 55, 41, 67, 22, 43, 21]
                //             },
                //             {
                //                 name: 'Last Week',
                //                 data: [13, 23, 20, 8, 13, 27, 33]
                //             },
                //         ],
                //         chart: {
                //             height: 160,
                //             type: 'bar',
                //             fontFamily: 'Nunito, sans-serif',
                //             toolbar: {
                //                 show: false
                //             },
                //             stacked: true,
                //             stackType: '100%'
                //         },
                //         dataLabels: {
                //             enabled: false
                //         },
                //         stroke: {
                //             show: true,
                //             width: 1
                //         },
                //         colors: ['#e2a03f', '#e0e6ed'],
                //         responsive: [{
                //             breakpoint: 480,
                //             options: {
                //                 legend: {
                //                     position: 'bottom',
                //                     offsetX: -10,
                //                     offsetY: 0
                //                 }
                //             }
                //         }],
                //         xaxis: {
                //             labels: {
                //                 show: false
                //             },
                //             categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat']
                //         },
                //         yaxis: {
                //             show: false
                //         },
                //         fill: {
                //             opacity: 1
                //         },
                //         plotOptions: {
                //             bar: {
                //                 horizontal: false,
                //                 columnWidth: '25%'
                //             }
                //         },
                //         legend: {
                //             show: false
                //         },
                //         grid: {
                //             show: false,
                //             xaxis: {
                //                 lines: {
                //                     show: false
                //                 }
                //             },
                //             padding: {
                //                 top: 10,
                //                 right: -20,
                //                 bottom: -20,
                //                 left: -20
                //             },
                //         },
                //     }
                // },

                // total orders
                // get totalOrdersOptions() {
                //     return {
                //         series: [{
                //             name: 'Sales',
                //             data: [28, 40, 36, 52, 38, 60, 38, 52, 36, 40]
                //         }],
                //         chart: {
                //             height: 290,
                //             type: "area",
                //             fontFamily: 'Nunito, sans-serif',
                //             sparkline: {
                //                 enabled: true
                //             }
                //         },
                //         stroke: {
                //             curve: 'smooth',
                //             width: 2
                //         },
                //         colors: isDark ? ['#00ab55'] : ['#00ab55'],
                //         labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                //         yaxis: {
                //             min: 0,
                //             show: false
                //         },
                //         grid: {
                //             padding: {
                //                 top: 125,
                //                 right: 0,
                //                 bottom: 0,
                //                 left: 0
                //             }
                //         },
                //         fill: {
                //             opacity: 1,
                //             type: 'gradient',
                //             gradient: {
                //                 type: 'vertical',
                //                 shadeIntensity: 1,
                //                 inverseColors: !1,
                //                 opacityFrom: 0.3,
                //                 opacityTo: 0.05,
                //                 stops: [100, 100],
                //             },
                //         },
                //         tooltip: {
                //             x: {
                //                 show: false
                //             },
                //         },
                //     }
                // }
            }));
        });
    </script>

    {{-- ===== Record popup: opens when a Recent Service Info / New Enquiry entry is clicked ===== --}}
    {{-- card look of the popup (kept inside this file so the popup never depends on another file) --}}
    <style>
        .rec-banner{background:#e8eefc;border-radius:8px;padding:16px 20px;display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap}
        .rec-code{font-size:22px;font-weight:600;color:#4361ee;margin-right:10px}
        .rec-badge{display:inline-block;border:1px solid #4361ee;color:#4361ee;border-radius:4px;padding:1px 8px;font-size:12px;background:#fff}
        .rec-raised{color:#7a7f9a;font-size:14px}
        .rec-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:20px}
        .rec-card{border:1px solid #e5e7ef;border-radius:8px;padding:18px 20px;margin-top:20px}
        .rec-grid .rec-card{margin-top:0}
        .rec-card h6{font-size:12px;letter-spacing:.6px;text-transform:uppercase;color:#7a7f9a;margin:0 0 12px;font-weight:600}
        .rec-row{display:flex;gap:16px;padding:4px 0;font-size:14px}
        .rec-label{width:110px;flex:none;color:#7a7f9a}
        .rec-value{word-break:break-word}
        .rec-link{color:#4361ee}
        .rec-text{font-size:14px;white-space:pre-line;word-break:break-word}
        .rec-muted{color:#7a7f9a;font-size:14px}
        .rec-files{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:12px}
        .rec-files img{width:100%;height:130px;object-fit:cover;border-radius:6px;border:1px solid #e5e7ef;display:block}
        .rec-files video{width:100%;max-height:220px;border-radius:6px;background:#000;display:block}
        .rec-tl-item{display:flex;gap:12px;padding:6px 0;font-size:13px}
        .rec-dot{width:9px;height:9px;border-radius:50%;background:#4361ee;margin-top:6px;flex:none}
        .rec-tl-meta{color:#7a7f9a;margin-left:6px}
        .rec-tl-remarks{margin-top:4px;font-size:13px;white-space:pre-line}
        @media(max-width:800px){.rec-grid{grid-template-columns:1fr}}
        .dark .rec-banner{background:#1b2e4b}
        .dark .rec-card{border-color:#253b5c}
    </style>

    <style>
        .rec-overlay { position:fixed; inset:0; background:rgba(14,23,38,.6); z-index:9999; display:none; align-items:flex-start; justify-content:center; padding:24px 12px; overflow-y:auto; }
        .rec-overlay.open { display:flex; }
        .rec-modal { background:#fff; border-radius:8px; width:100%; max-width:900px; box-shadow:0 10px 40px rgba(0,0,0,.3); }
        .rec-modal-head { display:flex; align-items:center; justify-content:space-between; gap:8px; padding:16px 20px; border-bottom:1px solid #ebedf2; }
        .rec-modal-head h3 { margin:0; font-size:18px; font-weight:600; }
        .rec-modal-actions { display:flex; align-items:center; gap:8px; }
        .rec-modal-body { padding:20px; max-height:calc(100vh - 190px); overflow-y:auto; }
        .rec-modal-foot { display:flex; justify-content:flex-end; padding:14px 20px; border-top:1px solid #ebedf2; }
        .rec-modal-loading { text-align:center; padding:60px 0; color:#7a7f9a; }
        .rec-modal .rec-banner { margin-top:0; }
        .rec-btn { display:inline-block; border-radius:4px; padding:6px 12px; font-size:12px; font-weight:600; line-height:18px; cursor:pointer; border:1px solid transparent; text-decoration:none; }
        .rec-btn-outline { border-color:#4361ee; color:#4361ee; background:transparent; }
        .rec-btn-edit { background:#e2a03f; color:#fff; }
        .rec-btn-close { border-color:#e7515a; color:#e7515a; background:transparent; padding:8px 22px; font-size:14px; }
        .rec-x { background:none; border:0; font-size:26px; line-height:1; color:#888ea8; cursor:pointer; padding:0 6px; }
        @media (max-width: 700px) { .rec-modal-head { flex-wrap:wrap; } }
        .dark .rec-modal { background:#0e1726; }
        .dark .rec-modal-head, .dark .rec-modal-foot { border-color:#1b2e4b; }
        .dark .rec-modal-head h3 { color:#e0e6ed; }
    </style>

    <div id="recordPopup" class="rec-overlay" aria-hidden="true">
        <div class="rec-modal" role="dialog" aria-modal="true" aria-labelledby="recordPopupTitle">
            <div class="rec-modal-head">
                <h3 id="recordPopupTitle">Loading...</h3>
                <div class="rec-modal-actions">
                    <a id="recordPopupDetails" href="#" target="_blank" rel="noopener" class="rec-btn rec-btn-outline" style="display:none;">Detailed View</a>
                    <a id="recordPopupEdit" href="#" target="_blank" rel="noopener" class="rec-btn rec-btn-edit" style="display:none;">Edit</a>
                    <button type="button" class="rec-x" data-record-close aria-label="Close">&times;</button>
                </div>
            </div>
            <div id="recordPopupBody" class="rec-modal-body"></div>
            <div class="rec-modal-foot">
                <button type="button" class="rec-btn rec-btn-close" data-record-close>Close</button>
            </div>
        </div>
    </div>

    <script>
        (function() {
            // site-relative paths (no host name), so the buttons always stay on the server you are using
            const BASE_URL     = "{{ parse_url(url('recordPopup'), PHP_URL_PATH) }}";     // /recordPopup/{type}/{id}
            const DETAILS_BASE = "{{ parse_url(url('recordDetails'), PHP_URL_PATH) }}";   // /recordDetails/{type}/{id}
            const EDIT_BASE    = {
                serviceInfo: "{{ parse_url(url('editServiceInfo'), PHP_URL_PATH) }}",     // /editServiceInfo/{id}
                newEnquiry:  "{{ parse_url(url('editNewEnquiry'), PHP_URL_PATH) }}"       // /editNewEnquiry/{id}
            };
            const overlay  = document.getElementById('recordPopup');
            const body     = document.getElementById('recordPopupBody');
            const title    = document.getElementById('recordPopupTitle');
            const btnView  = document.getElementById('recordPopupDetails');
            const btnEdit  = document.getElementById('recordPopupEdit');

            // everything that comes from the database is escaped before it goes into the page
            function esc(value) {
                return String(value === null || value === undefined ? '' : value)
                    .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;').replace(/'/g, '&#39;');
            }

            function row(label, valueHtml) {
                return '<div class="rec-row"><span class="rec-label">' + label + '</span><span class="rec-value">' + valueHtml + '</span></div>';
            }

            function render(r, type, id) {
                const c = r.customer, d = r.details;
                const email = c.email ? '<a class="rec-link" href="mailto:' + esc(c.email) + '">' + esc(c.email) + '</a>' : '-';
                const phone = c.phone ? '<a class="rec-link" href="tel:' + esc(c.phone) + '">' + esc(c.phone) + '</a>' : '-';
                const updated = esc(d.lastUpdated) + (d.updatedBy ? ' &middot; by ' + esc(d.updatedBy) : '');

                let html = '';

                html += '<div class="rec-banner"><div><span class="rec-code">' + esc(r.code) + '</span>' +
                        '<span class="rec-badge">' + esc(r.status) + '</span></div>' +
                        '<div class="rec-raised">Raised ' + esc(r.raisedAgo) + ' (' + esc(r.raisedAt) + ')</div></div>';

                html += '<div class="rec-grid">' +
                    '<div class="rec-card"><h6>Customer</h6>' +
                        row('Name', esc(c.name)) + row('Email', email) + row('Phone', phone) + row('IP Address', esc(c.ip)) + '</div>' +
                    '<div class="rec-card"><h6>' + esc(r.label) + '</h6>' +
                        row('Product', esc(d.product)) + row('Subcategory', esc(d.subcategory)) +
                        row('Location', esc(d.location)) + row('Region', esc(d.region)) +
                        row('Request Time', esc(d.requestTime)) + row('Last Updated', updated) + '</div>' +
                    '</div>';

                html += '<div class="rec-card"><h6>Issue description</h6>' +
                        (r.issue ? '<div class="rec-text">' + esc(r.issue) + '</div>' : '<div class="rec-muted">No description.</div>') + '</div>';

                if (r.remarks) {
                    html += '<div class="rec-card"><h6>Latest remarks</h6><div class="rec-text">' + esc(r.remarks) + '</div></div>';
                }

                html += '<div class="rec-card"><h6>Attachments (' + r.attachments.length + ')</h6>';
                if (r.attachments.length) {
                    html += '<div class="rec-files">';
                    r.attachments.forEach(function(f) {
                        html += f.type === 'video'
                            ? '<video controls preload="metadata" src="' + esc(f.url) + '"></video>'
                            : '<a href="' + esc(f.url) + '" target="_blank" rel="noopener"><img src="' + esc(f.url) + '" alt="' + esc(f.name) + '" loading="lazy"></a>';
                    });
                    html += '</div>';
                } else {
                    html += '<div class="rec-muted">No images or videos were attached.</div>';
                }
                html += '</div>';

                html += '<div class="rec-card"><h6>Status history (' + r.history.length + ')</h6>';
                if (r.history.length) {
                    r.history.forEach(function(h) {
                        html += '<div class="rec-tl-item"><span class="rec-dot"></span><div>' +
                                '<span class="rec-badge">' + esc(h.status) + '</span>' +
                                '<span class="rec-tl-meta">' + esc(h.at) + (h.by ? ' &middot; by ' + esc(h.by) : '') + (h.interval ? ' &middot; ' + esc(h.interval) : '') + '</span>' +
                                (h.remarks ? '<div class="rec-tl-remarks">' + esc(h.remarks) + '</div>' : '') + '</div></div>';
                    });
                } else {
                    html += '<div class="rec-muted">No status changes yet.</div>';
                }
                html += '</div>';

                title.textContent = r.title;
                btnView.href = DETAILS_BASE + '/' + type + '/' + id;   btnView.style.display = '';
                btnEdit.href = EDIT_BASE[type] + '/' + id;             btnEdit.style.display = '';
                body.innerHTML = html;
            }

            function openPopup(type, id) {
                title.textContent = 'Loading...';
                btnView.style.display = 'none';
                btnEdit.style.display = 'none';
                body.innerHTML = '<div class="rec-modal-loading">Loading record...</div>';
                overlay.classList.add('open');
                overlay.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';

                fetch(BASE_URL + '/' + type + '/' + id, { headers: { 'Accept': 'application/json' }, credentials: 'same-origin' })
                    .then(function(res) {
                        if (!res.ok) { throw new Error(res.status === 403 ? 'You cannot view this record.' : res.status === 404 ? 'Record not found.' : 'Could not load the record (error ' + res.status + ').'); }
                        return res.json();
                    })
                    .then(function(record) { render(record, type, id); })
                    .catch(function(err) {
                        title.textContent = 'Error';
                        body.innerHTML = '<div class="rec-modal-loading">' + esc(err.message) + '</div>';
                    });
            }

            function closePopup() {
                overlay.classList.remove('open');
                overlay.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
                body.innerHTML = '';
            }

            document.addEventListener('click', function(event) {
                const link = event.target.closest('.js-record-link');
                if (link) {                                   // a recent entry was clicked
                    event.preventDefault();
                    openPopup(link.dataset.recordType, link.dataset.recordId);
                    return;
                }
                // X button, bottom Close button, or a click on the dark background
                if (event.target.closest('[data-record-close]') || event.target === overlay) {
                    closePopup();
                }
            });       
            document.addEventListener('keydown', function(event) {   // Esc key
                if (event.key === 'Escape' && overlay.classList.contains('open')) {
                    closePopup();
                }
            });
        })();
    </script>
</x-layout.default>
