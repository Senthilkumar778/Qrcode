<div :class="{ 'dark text-white-dark': $store.app.semidark }">
    <nav x-data="sidebar"
        class="sidebar fixed min-h-screen h-full top-0 bottom-0 w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] z-50 transition-all duration-300">
        <div class="bg-white dark:bg-[#0e1726] h-full">
            <div class="flex justify-between items-center px-4 py-3">
                <a href="javascript:void(0);" class="main-logo flex items-center shrink-0">
                    <img class="w-52 ml-[5px] flex-none" src="{{ asset('assets/images/logo/logo.jpg')}}"
                        alt="image" />
                    <!-- <span
                        class="text-2xl ltr:ml-1.5 rtl:mr-1.5  font-semibold  align-middle lg:inline dark:text-white-light">Kewaunee
                    </span> -->
                </a>
                <a href="javascript:;"
                    class="collapse-icon w-8 h-8 rounded-full flex items-center hover:bg-gray-500/10 dark:hover:bg-dark-light/10 dark:text-white-light transition duration-300 rtl:rotate-180"
                    @click="$store.app.toggleSidebar()">
                    <svg class="w-5 h-5 m-auto" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
            <ul class="perfect-scrollbar relative font-semibold space-y-0.5 h-[calc(100vh-80px)] overflow-y-auto overflow-x-hidden  p-4 py-0"
                x-data="{ activeDropdown: null }">
                <li class="menu nav-item">
                    <button type="button" class="nav group">
                    <a href="{{route('index')}}">
                            <div class="flex items-center">
                                <svg class="group-hover:!text-primary shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.5" d="M3 22H21" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3 11C3 10.0572 3 9.58579 3.29289 9.29289C3.58579 9 4.05719 9 5 9C5.94281 9 6.41421 9 6.70711 9.29289C7 9.58579 7 10.0572 7 11V17C7 17.9428 7 18.4142 6.70711 18.7071C6.41421 19 5.94281 19 5 19C4.05719 19 3.58579 19 3.29289 18.7071C3 18.4142 3 17.9428 3 17V11Z" stroke="#1C274C" stroke-width="1.5"/>
                                    <path d="M10 7C10 6.05719 10 5.58579 10.2929 5.29289C10.5858 5 11.0572 5 12 5C12.9428 5 13.4142 5 13.7071 5.29289C14 5.58579 14 6.05719 14 7V17C14 17.9428 14 18.4142 13.7071 18.7071C13.4142 19 12.9428 19 12 19C11.0572 19 10.5858 19 10.2929 18.7071C10 18.4142 10 17.9428 10 17V7Z" stroke="#1C274C" stroke-width="1.5"/>
                                    <path d="M17 4C17 3.05719 17 2.58579 17.2929 2.29289C17.5858 2 18.0572 2 19 2C19.9428 2 20.4142 2 20.7071 2.29289C21 2.58579 21 3.05719 21 4V17C21 17.9428 21 18.4142 20.7071 18.7071C20.4142 19 19.9428 19 19 19C18.0572 19 17.5858 19 17.2929 18.7071C17 18.4142 17 17.9428 17 17V4Z" stroke="#1C274C" stroke-width="1.5"/>
                                </svg>
                                <span
                                    class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Dashboard
                                </span>
                            </div>
                    </a>
                        <!-- <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'dashboard' }">

                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div> -->
                    </button>
                </li>

                @if(Session::has('USER_ROLE'))
                    @if( (Session::get('USER_ROLE') == 'SystemSpecialist') || (Session::get('USER_ROLE') == 'SuperAdmin') )
                        <li class="menu nav-item">
                            <button type="button" class="nav-link group">
                                <div class="flex items-center">
                                    <svg class="group-hover:!text-primary shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="3" stroke="#1C274C" stroke-width="1.5"/>
                                        <path d="M3.66122 10.6392C4.13377 10.9361 4.43782 11.4419 4.43782 11.9999C4.43781 12.558 4.13376 13.0638 3.66122 13.3607C3.33966 13.5627 3.13248 13.7242 2.98508 13.9163C2.66217 14.3372 2.51966 14.869 2.5889 15.3949C2.64082 15.7893 2.87379 16.1928 3.33973 16.9999C3.80568 17.8069 4.03865 18.2104 4.35426 18.4526C4.77508 18.7755 5.30694 18.918 5.83284 18.8488C6.07287 18.8172 6.31628 18.7185 6.65196 18.5411C7.14544 18.2803 7.73558 18.2699 8.21895 18.549C8.70227 18.8281 8.98827 19.3443 9.00912 19.902C9.02332 20.2815 9.05958 20.5417 9.15224 20.7654C9.35523 21.2554 9.74458 21.6448 10.2346 21.8478C10.6022 22 11.0681 22 12 22C12.9319 22 13.3978 22 13.7654 21.8478C14.2554 21.6448 14.6448 21.2554 14.8478 20.7654C14.9404 20.5417 14.9767 20.2815 14.9909 19.9021C15.0117 19.3443 15.2977 18.8281 15.7811 18.549C16.2644 18.27 16.8545 18.2804 17.3479 18.5412C17.6837 18.7186 17.9271 18.8173 18.1671 18.8489C18.693 18.9182 19.2249 18.7756 19.6457 18.4527C19.9613 18.2106 20.1943 17.807 20.6603 17C20.8677 16.6407 21.029 16.3614 21.1486 16.1272M20.3387 13.3608C19.8662 13.0639 19.5622 12.5581 19.5621 12.0001C19.5621 11.442 19.8662 10.9361 20.3387 10.6392C20.6603 10.4372 20.8674 10.2757 21.0148 10.0836C21.3377 9.66278 21.4802 9.13092 21.411 8.60502C21.3591 8.2106 21.1261 7.80708 20.6601 7.00005C20.1942 6.19301 19.9612 5.7895 19.6456 5.54732C19.2248 5.22441 18.6929 5.0819 18.167 5.15113C17.927 5.18274 17.6836 5.2814 17.3479 5.45883C16.8544 5.71964 16.2643 5.73004 15.781 5.45096C15.2977 5.1719 15.0117 4.6557 14.9909 4.09803C14.9767 3.71852 14.9404 3.45835 14.8478 3.23463C14.6448 2.74458 14.2554 2.35523 13.7654 2.15224C13.3978 2 12.9319 2 12 2C11.0681 2 10.6022 2 10.2346 2.15224C9.74458 2.35523 9.35523 2.74458 9.15224 3.23463C9.05958 3.45833 9.02332 3.71848 9.00912 4.09794C8.98826 4.65566 8.70225 5.17191 8.21891 5.45096C7.73557 5.73002 7.14548 5.71959 6.65205 5.4588C6.31633 5.28136 6.0729 5.18269 5.83285 5.15108C5.30695 5.08185 4.77509 5.22436 4.35427 5.54727C4.03866 5.78945 3.80569 6.19297 3.33974 7C3.13231 7.35929 2.97105 7.63859 2.85138 7.87273" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                    <a href="javascript:void(0);">
                                        <span
                                            class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Config
                                        </span>
                                    </a>
                                </div>
                                <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'dashboard' }">

                                    <!-- <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg> -->
                                </div>
                            </button>

                        
                                <ul class="sub-menu text-gray-500">
                                    <li>
                                        <a href="{{route('users')}}">Users</a>
                                    </li>
                                    <li>
                                        <a href="{{route('products')}}">Products</a>
                                    </li>
                                    <li>
                                        <a href="{{route('subcategories')}}">Sub Category</a>
                                    </li>
                                    <li>
                                        <a href="{{route('regions')}}">Region</a>
                                    </li>
                                    <li>
                                        <a href="{{route('locations')}}">Location</a>
                                    </li>
                                    <li>
                                        <a href="{{route('emailConfig')}}">Email Config</a>
                                    </li>
                        
                                </ul>
                        </li>
                    @endif
                @endif

                @if(Session::has('USER_ROLE'))
                    @if( (Session::get('USER_ROLE') == 'SystemSpecialist') || (Session::get('USER_ROLE') == 'SuperAdmin') || (Session::get('USER_ROLE') == 'Manager') || (Session::get('USER_ROLE') == 'Admin')  || (Session::get('USER_ROLE') == 'User') )

                        <li class="menu nav-item">
                            <button type="button" class="nav-link group">
                                <div class="flex items-center">
                                    <svg class="group-hover:!text-primary shrink-0" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.5"
                                            d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z"
                                            fill="currentColor" />
                                        <path
                                            d="M9 17.25C8.58579 17.25 8.25 17.5858 8.25 18C8.25 18.4142 8.58579 18.75 9 18.75H15C15.4142 18.75 15.75 18.4142 15.75 18C15.75 17.5858 15.4142 17.25 15 17.25H9Z"
                                            fill="currentColor" />
                                    </svg>
                                    <a href="javascript:void(0);">
                                        <span
                                            class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Info / Enquiry
                                        </span>
                                    </a>
                                </div>
                                <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'dashboard' }">

                                    <!-- <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg> -->
                                </div>
                            </button>
                            <ul class="sub-menu text-gray-500">
                                
                                <li>
                                    <a href="{{route('serviceInfo')}}">Service Info</a>
                                </li>
                                <li>
                                    <a href="{{route('newEnquiries')}}">New Enquiry</a>
                                </li> 
                            </ul>
                        </li>

                    @endif
                @endif

                <li class="menu nav-item">

                {{-- <li class="menu nav-item">
                    <button
                        type="button"
                        class="nav-link group"
                        :class="{'active' : activeDropdown === 'invoice'}"
                        @click="activeDropdown === 'invoice' ? activeDropdown = null : activeDropdown = 'invoice'"
                    >
                        <div class="flex items-center">
                                <svg class="group-hover:!text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M10.553 13.447c-.424-.424-.95-.596-1.535-.675c-.553-.074-1.25-.074-2.086-.074H5.827c-.58 0-1.065 0-1.459.037c-.411.04-.795.124-1.146.34c-.345.21-.634.5-.845.844c-.216.352-.3.735-.34 1.147C2 15.459 2 15.944 2 16.525v.068c0 .884 0 1.597.055 2.17c.056.592.175 1.108.459 1.571c.288.47.682.864 1.152 1.152c.463.284.979.403 1.57.46C5.81 22 6.524 22 7.407 22h.07c.58 0 1.064 0 1.458-.037c.412-.04.795-.124 1.147-.34c.344-.21.633-.5.844-.844c.216-.352.3-.736.34-1.147c.037-.394.037-.879.037-1.46v-1.104c0-.836 0-1.533-.074-2.086c-.079-.584-.251-1.111-.675-1.535m-1.62-11.41c.412.04.795.124 1.147.34c.344.21.633.5.844.845c.216.351.3.735.34 1.146c.037.394.037.879.037 1.46v1.104c0 .836 0 1.533-.074 2.086c-.079.584-.251 1.111-.675 1.535c-.424.424-.95.596-1.535.675c-.553.074-1.25.074-2.086.074H5.827c-.58 0-1.065 0-1.459-.037c-.411-.04-.795-.124-1.146-.34a2.559 2.559 0 0 1-.845-.844c-.216-.352-.3-.735-.34-1.147C2 8.54 2 8.056 2 7.475v-.068c0-.884 0-1.597.055-2.17c.056-.592.175-1.108.459-1.571c.288-.47.682-.864 1.152-1.152c.463-.284.979-.403 1.57-.46C5.81 2 6.524 2 7.407 2h.07c.58 0 1.064 0 1.458.037M16.593 2h-.068c-.58 0-1.065 0-1.46.037c-.41.04-.794.124-1.146.34c-.344.21-.633.5-.844.845c-.216.351-.3.735-.34 1.146c-.037.394-.037.879-.037 1.46v1.104c0 .836 0 1.533.074 2.086c.079.584.251 1.111.675 1.535c.424.424.95.596 1.535.675c.553.074 1.25.074 2.086.074h1.105c.58 0 1.065 0 1.459-.037c.411-.04.795-.124 1.146-.34c.345-.21.634-.5.845-.844c.216-.352.3-.735.34-1.147C22 8.54 22 8.056 22 7.475v-.068c0-.884 0-1.597-.055-2.17c-.056-.592-.175-1.108-.459-1.571a3.489 3.489 0 0 0-1.152-1.152c-.463-.284-.979-.403-1.57-.46C18.19 2 17.477 2 16.594 2" opacity="0.5"/><path fill="currentColor" d="M14.093 21.302a.698.698 0 1 1-1.396 0v-2.79h1.396z" opacity="0.4"/><path fill="currentColor" d="M21.302 12.698a.698.698 0 0 0-.697.697v3.256H22v-3.256a.698.698 0 0 0-.698-.697" opacity="0.5"/><path fill="currentColor" d="M16.076 16.617c-.076.184-.076.417-.076.883s0 .699.076.883a1 1 0 0 0 .541.54c.184.077.417.077.883.077s.699 0 .883-.076a1 1 0 0 0 .54-.541c.077-.184.077-.417.077-.883s0-.699-.076-.883a1 1 0 0 0-.541-.54C18.199 16 17.966 16 17.5 16s-.699 0-.883.076a1 1 0 0 0-.54.541"/><path fill="currentColor" d="M22 18.535v-.023h-1.396c0 .443 0 .74-.016.97c-.015.224-.043.333-.073.405a1.163 1.163 0 0 1-.629.63c-.072.029-.18.056-.405.072c-.23.015-.527.016-.97.016h-1.86V22h1.883c.414 0 .759 0 1.042-.02a2.62 2.62 0 0 0 .844-.175a2.558 2.558 0 0 0 1.384-1.384c.112-.27.156-.549.176-.844c.02-.283.02-.628.02-1.042" opacity="0.7"/><path fill="currentColor" d="M12.697 16.616v.035h1.396c0-.668 0-1.116.035-1.458c.034-.33.093-.482.16-.583a1.16 1.16 0 0 1 .321-.32c.101-.068.254-.128.584-.161c.342-.035.79-.036 1.458-.036h1.86v-1.395h-1.896c-.623 0-1.142 0-1.563.043c-.44.044-.85.142-1.218.388c-.28.187-.519.426-.706.706c-.246.368-.343.777-.388 1.217c-.043.421-.043.94-.043 1.564" opacity="0.6"/><path fill="currentColor" d="M5.508 18.69c.219.155.528.155 1.146.155c.619 0 .928 0 1.146-.155a.842.842 0 0 0 .2-.199c.154-.218.154-.527.154-1.146c0-.618 0-.927-.155-1.146A.842.842 0 0 0 7.8 16c-.218-.155-.527-.155-1.146-.155c-.618 0-.927 0-1.146.155a.841.841 0 0 0-.199.2c-.155.218-.155.527-.155 1.145c0 .619 0 .928.155 1.146a.841.841 0 0 0 .2.2M6.654 8.155c-.618 0-.927 0-1.146-.155a.84.84 0 0 1-.199-.2c-.155-.217-.155-.527-.155-1.145c0-.619 0-.928.155-1.146a.84.84 0 0 1 .2-.2c.218-.154.527-.154 1.145-.154c.619 0 .928 0 1.146.155a.84.84 0 0 1 .2.199c.154.218.154.527.154 1.146c0 .618 0 .928-.155 1.146A.84.84 0 0 1 7.8 8c-.218.155-.527.155-1.146.155M16.2 8c.218.155.527.155 1.146.155c.618 0 .927 0 1.146-.155a.842.842 0 0 0 .199-.199c.155-.218.155-.528.155-1.146c0-.619 0-.928-.155-1.146a.842.842 0 0 0-.2-.2c-.218-.154-.527-.154-1.145-.154c-.619 0-.928 0-1.146.155a.842.842 0 0 0-.2.199c-.154.218-.154.527-.154 1.146c0 .618 0 .928.155 1.146A.842.842 0 0 0 16.2 8"/></svg>
                            <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">QR Code</span>
                        </div>
                        <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'invoice'}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9 5L15 12L9 19"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </div>
                    </button>
                    <ul x-cloak x-show="activeDropdown === 'invoice'" x-collapse class="sub-menu text-gray-500">
                        <li>
                            <a href="{{route('listQRCode',['live'])}}">List QR Code (Live)</a>
                        </li>
                        <li>
                            <a href="{{route('listQRCode',['test'])}}">List QR Code (Test)</a>
                        </li>
                        
                    </ul>
                </li> --}}


                 <li class="menu nav-item">
                    <button type="button" class="nav group">
                        <a href="{{route('listQRCode',['live'])}}">
                            <div class="flex items-center">
                                <svg class="group-hover:!text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M10.553 13.447c-.424-.424-.95-.596-1.535-.675c-.553-.074-1.25-.074-2.086-.074H5.827c-.58 0-1.065 0-1.459.037c-.411.04-.795.124-1.146.34c-.345.21-.634.5-.845.844c-.216.352-.3.735-.34 1.147C2 15.459 2 15.944 2 16.525v.068c0 .884 0 1.597.055 2.17c.056.592.175 1.108.459 1.571c.288.47.682.864 1.152 1.152c.463.284.979.403 1.57.46C5.81 22 6.524 22 7.407 22h.07c.58 0 1.064 0 1.458-.037c.412-.04.795-.124 1.147-.34c.344-.21.633-.5.844-.844c.216-.352.3-.736.34-1.147c.037-.394.037-.879.037-1.46v-1.104c0-.836 0-1.533-.074-2.086c-.079-.584-.251-1.111-.675-1.535m-1.62-11.41c.412.04.795.124 1.147.34c.344.21.633.5.844.845c.216.351.3.735.34 1.146c.037.394.037.879.037 1.46v1.104c0 .836 0 1.533-.074 2.086c-.079.584-.251 1.111-.675 1.535c-.424.424-.95.596-1.535.675c-.553.074-1.25.074-2.086.074H5.827c-.58 0-1.065 0-1.459-.037c-.411-.04-.795-.124-1.146-.34a2.559 2.559 0 0 1-.845-.844c-.216-.352-.3-.735-.34-1.147C2 8.54 2 8.056 2 7.475v-.068c0-.884 0-1.597.055-2.17c.056-.592.175-1.108.459-1.571c.288-.47.682-.864 1.152-1.152c.463-.284.979-.403 1.57-.46C5.81 2 6.524 2 7.407 2h.07c.58 0 1.064 0 1.458.037M16.593 2h-.068c-.58 0-1.065 0-1.46.037c-.41.04-.794.124-1.146.34c-.344.21-.633.5-.844.845c-.216.351-.3.735-.34 1.146c-.037.394-.037.879-.037 1.46v1.104c0 .836 0 1.533.074 2.086c.079.584.251 1.111.675 1.535c.424.424.95.596 1.535.675c.553.074 1.25.074 2.086.074h1.105c.58 0 1.065 0 1.459-.037c.411-.04.795-.124 1.146-.34c.345-.21.634-.5.845-.844c.216-.352.3-.735.34-1.147C22 8.54 22 8.056 22 7.475v-.068c0-.884 0-1.597-.055-2.17c-.056-.592-.175-1.108-.459-1.571a3.489 3.489 0 0 0-1.152-1.152c-.463-.284-.979-.403-1.57-.46C18.19 2 17.477 2 16.594 2" opacity="0.5"/><path fill="currentColor" d="M14.093 21.302a.698.698 0 1 1-1.396 0v-2.79h1.396z" opacity="0.4"/><path fill="currentColor" d="M21.302 12.698a.698.698 0 0 0-.697.697v3.256H22v-3.256a.698.698 0 0 0-.698-.697" opacity="0.5"/><path fill="currentColor" d="M16.076 16.617c-.076.184-.076.417-.076.883s0 .699.076.883a1 1 0 0 0 .541.54c.184.077.417.077.883.077s.699 0 .883-.076a1 1 0 0 0 .54-.541c.077-.184.077-.417.077-.883s0-.699-.076-.883a1 1 0 0 0-.541-.54C18.199 16 17.966 16 17.5 16s-.699 0-.883.076a1 1 0 0 0-.54.541"/><path fill="currentColor" d="M22 18.535v-.023h-1.396c0 .443 0 .74-.016.97c-.015.224-.043.333-.073.405a1.163 1.163 0 0 1-.629.63c-.072.029-.18.056-.405.072c-.23.015-.527.016-.97.016h-1.86V22h1.883c.414 0 .759 0 1.042-.02a2.62 2.62 0 0 0 .844-.175a2.558 2.558 0 0 0 1.384-1.384c.112-.27.156-.549.176-.844c.02-.283.02-.628.02-1.042" opacity="0.7"/><path fill="currentColor" d="M12.697 16.616v.035h1.396c0-.668 0-1.116.035-1.458c.034-.33.093-.482.16-.583a1.16 1.16 0 0 1 .321-.32c.101-.068.254-.128.584-.161c.342-.035.79-.036 1.458-.036h1.86v-1.395h-1.896c-.623 0-1.142 0-1.563.043c-.44.044-.85.142-1.218.388c-.28.187-.519.426-.706.706c-.246.368-.343.777-.388 1.217c-.043.421-.043.94-.043 1.564" opacity="0.6"/><path fill="currentColor" d="M5.508 18.69c.219.155.528.155 1.146.155c.619 0 .928 0 1.146-.155a.842.842 0 0 0 .2-.199c.154-.218.154-.527.154-1.146c0-.618 0-.927-.155-1.146A.842.842 0 0 0 7.8 16c-.218-.155-.527-.155-1.146-.155c-.618 0-.927 0-1.146.155a.841.841 0 0 0-.199.2c-.155.218-.155.527-.155 1.145c0 .619 0 .928.155 1.146a.841.841 0 0 0 .2.2M6.654 8.155c-.618 0-.927 0-1.146-.155a.84.84 0 0 1-.199-.2c-.155-.217-.155-.527-.155-1.145c0-.619 0-.928.155-1.146a.84.84 0 0 1 .2-.2c.218-.154.527-.154 1.145-.154c.619 0 .928 0 1.146.155a.84.84 0 0 1 .2.199c.154.218.154.527.154 1.146c0 .618 0 .928-.155 1.146A.84.84 0 0 1 7.8 8c-.218.155-.527.155-1.146.155M16.2 8c.218.155.527.155 1.146.155c.618 0 .927 0 1.146-.155a.842.842 0 0 0 .199-.199c.155-.218.155-.528.155-1.146c0-.619 0-.928-.155-1.146a.842.842 0 0 0-.2-.2c-.218-.154-.527-.154-1.145-.154c-.619 0-.928 0-1.146.155a.842.842 0 0 0-.2.199c-.154.218-.154.527-.154 1.146c0 .618 0 .928.155 1.146A.842.842 0 0 0 16.2 8"/></svg>
                                <span
                                    class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">QR Code
                                </span>
                            </div>
                        </a>
                    </button>
                </li>
                                    
           
                <li class="menu nav-item">
                    <button type="button" class="nav-link group">
                        <div class="flex items-center">
                            <svg class="group-hover:!text-primary shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16Z" stroke="#1C274C" stroke-width="1.5"/>
                                    <path d="M6 10V8C6 4.68629 8.68629 2 12 2C14.7958 2 17.1449 3.91216 17.811 6.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M12 14V18" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            <a href="{{ route('changePassword')}}">
                                <span
                                    class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Change Password
                                </span>
                            </a>
                        </div>
                </li>

                <li class="menu nav-item">
                    <button type="button" class="nav-link group logout" id="">
                        <div class="flex items-center">
                            <svg class="group-hover:!text-primary shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.5" d="M12 2V6" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M8.5 3.70605C5.26806 5.07157 3 8.27099 3 12.0001C3 16.9707 7.02944 21.0001 12 21.0001C16.9706 21.0001 21 16.9707 21 12.0001C21 8.27099 18.7319 5.07157 15.5 3.70605" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            <a href="javascript::void(0);">
                                <span
                                    class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Logout
                                </span>
                            </a>
                        </div>
                </li>

            </ul>
        </div>
    </nav>
</div>
<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("sidebar", () => ({
            activeDropdown: 'config',
            init() {
                const selector = document.querySelector('.sidebar ul a[href="' + window.location
                    .pathname + '"]');
                if (selector) {
                    selector.classList.add('active');
                    const ul = selector.closest('ul.sub-menu');
                    if (ul) {
                        let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                        if (ele) {
                            ele = ele[0];
                            setTimeout(() => {
                                ele.click();
                            });
                        }
                    }
                }
            },
        }));
    });
</script>
