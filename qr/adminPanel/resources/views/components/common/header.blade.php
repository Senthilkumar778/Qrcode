<header class="z-40" :class="{ 'dark': $store.app.semidark && $store.app.menu === 'horizontal' }">
    
    <div class="shadow-sm">
        <div class="relative bg-white flex w-full items-center px-5 py-2.5 dark:bg-[#0e1726]">
            <div class="horizontal-logo flex lg:hidden justify-between items-center ltr:mr-2 rtl:ml-2">
                <a href="/" class="main-logo flex items-center shrink-0">
                    <img class="w-52 ltr:-ml-1 rtl:-mr-1 inline" src="{{ asset('assets/images/logo/logo.jpg')}}"
                        alt="image" />
                    <!-- <span
                        class="text-2xl ltr:ml-1.5 rtl:mr-1.5  font-semibold  align-middle hidden md:inline dark:text-white-light transition-all duration-300">VRISTO
                    </span> -->
                </a>

                <a href="javascript:;"
                    class="collapse-icon flex-none dark:text-[#d0d2d6] hover:text-primary dark:hover:text-primary flex lg:hidden ltr:ml-2 rtl:mr-2 p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:bg-white-light/90 dark:hover:bg-dark/60"
                    @click="$store.app.toggleSidebar()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 7L4 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path opacity="0.5" d="M20 12L4 12" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" />
                        <path d="M20 17L4 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </a>
            </div>
         
            <div x-data="header" class="sm:flex-1 ltr:sm:ml-0 ltr:ml-auto sm:rtl:mr-0 rtl:mr-auto flex justify-end items-center space-x-1.5 lg:space-x-2 rtl:space-x-reverse dark:text-[#d0d2d6]">
            
                <div class="dropdown flex-shrink-0" x-data="dropdown" @click.outside="open = false">
                    <a href="javascript:;" class="relative group" @click="toggle()">
                        <span>
                            <!-- <img class="w-9 h-9 rounded-full object-cover saturate-50 group-hover:saturate-100"
                                src="/assets/images/user-profile.jpeg" alt="image" /> -->
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle opacity="0.5" cx="15" cy="6" r="3" fill="currentColor"></circle><ellipse opacity="0.5" cx="16" cy="17" rx="5" ry="3" fill="currentColor"></ellipse><circle cx="9.00098" cy="6" r="4" fill="currentColor"></circle><ellipse cx="9.00098" cy="17.001" rx="7" ry="4" fill="currentColor"></ellipse></svg>
                        </span>
                    </a>
                    <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                        class="ltr:right-0 rtl:left-0 text-dark dark:text-white-dark top-11 !py-0 w-[230px] font-semibold dark:text-white-light/90">
                        <li>
                            <div class="flex items-center px-4 py-4">
                                <!-- <div class="flex-none">
                                    <img class="rounded-md w-10 h-10 object-cover"
                                        src="/assets/images/user-profile.jpeg"
                                        alt="image" />
                                </div> -->
                                <div class="ltr:pl-4 rtl:pr-4 truncate">
                                    <h4 class="text-base">
                                        @if(auth()->user())
                                            {{ auth()->user()->firstName }}  {{ auth()->user()->lastName }}
                                        @endif
                                        <!-- <span class="text-xs bg-success-light rounded text-success px-1 ltr:ml-2 rtl:ml-2">Pro</span> -->
                                    </h4>
                                    <a class="text-black text-balance break-normal  hover:text-primary dark:text-dark-light dark:hover:text-white"
                                        href="javascript:;">
                                        @if(auth()->user())
                                        {{ auth()->user()->email }}
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </li>
                       
                       
                        <li class="border-t border-white-light dark:border-white-light/10">
                            <a href="javascript:void(0);" id="logout" class="text-danger !py-3 logout" @click="toggle">
                                <svg class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2 shrink-0 rotate-90" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.5"
                                        d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <path d="M12 15L12 2M12 2L15 5.5M12 2L9 5.5" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Sign Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

       
    </div>
</header>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>

function showToastr(type, message) {
    toastr[type](message, null, {
        onclick: function() {
            toastr.clear();
        },
        timeOut: 3000,
        "closeButton": true,
        "progressBar": true,
    });
}
    
    document.addEventListener("alpine:init", () => {
        Alpine.data("header", () => ({
            init() {
                const selector = document.querySelector('ul.horizontal-menu a[href="' + window
                    .location.pathname + '"]');
                if (selector) {
                    selector.classList.add('active');
                    const ul = selector.closest('ul.sub-menu');
                    if (ul) {
                        let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                        if (ele) {
                            ele = ele[0];
                            setTimeout(() => {
                                ele.classList.add('active');
                            });
                        }
                    }
                }
            },
        }));
    });

    function logout(){
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url:"{{route('logout')}}",
            method:"POST",
            data:{_token:token},
            success:function(response){
                console.log(response);
                showToastr(response.status, response.message);
                if(response.status == 'success'){
                    localStorage.removeItem('access_token');
                    setTimeout(function () {
                        window.location.href= "{{ route('loginView')}}";
                    },2000);
                }
            }
        });  
    }

    $('.logout').click(function(){
        logout(); 
    });
</script>
