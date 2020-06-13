<header>
    <nav class="navbar">
        <div class="container-lg">
            <ul class="navRoot">
                <li class="navSection logo">
                    <a href="{{ route('index') }}" class="navbar-brand " data-dropdown="admin">
                    </a>
                </li>

                <li class="navSection primary">
                    <a class="rootLink hasDropdown colorize" data-dropdown="incoterms"> Incoterms </a>

                    <a class="rootLink hasDropdown colorize" data-dropdown="ports"> Ports </a>

                    <a class="rootLink hasDropdown colorize" data-dropdown="taxes_and_duties"> Taxes and duties </a>

                    <a class="rootLink hasDropdown colorize" data-dropdown="company"> Company </a>
                </li>

                <li class="navSection secondary">
                    <!-- <a class="rootLink colorize pricing" href="services/plans/index.html">Ports</a>  -->
                    @guest
                        <a class="rootLink item-dashboard colorize" href="{{ route('login') }}">Sign in
                    @else
                        <div id="nav-prof"> 
                            <a class="dropdown-toggle rootLink colorize" href="javascript:;" data-toggle="dropdown"> 
                                <!-- <i class="fa fa-user"></i>  -->
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-closer">
                                <div class="country-lang-pointer"></div>
                                <li class="clearfix dropdown-header dropdown-stop">
                                    <div class="user-mini-pic">
                                        <i class="fa fa-user"></i>
                                        <!-- <img src="/design/images/avatars/2.svg" alt="logo"> -->
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name"> {{ Auth::user()->name }} </div>
                                        <div class="user-company">{{ Auth::user()->role }}</div>
                                        <div class="user-id">Profile ID: {{ Auth::user()->id }}</div>
                                    </div>
                                </li>

                                <li> <a href="{{ route('user') }}"> <i class="fad fa-user"></i> Profile </a> </li>
                                <!-- <li> <a href="/user/inbox"> <i class="fad fa-inbox-in"></i> Inbox </a> </li> -->
                                <!-- <li> <a href="/user/profile#profile-about"> <i class="fas fa-cog"></i> Settings </a> -->
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fad fa-sign-out"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                        <!-- <i class="fal fa-sign-right"></i> -->
                    </a>
                </li>

                <!-- Mobile navbar -->
                <li class="navSection mobile">
                    <a class="rootLink item-mobileMenu colorize">
                        <h2>Menu</h2>
                    </a>

                    <div class="popup">
                        <div class="popupContainer"> <a class="popupCloseButton">Close</a>
                            <div class="mobileProducts"> <a class="collapsible" href="#">MENU</a>
                                <div class="collapse show in">
                                    <!-- <div class="mobileProductsList">

                                        <ul>
                                            <li>
                                            <a class="linkContainer item-atlas" href="#"> 
                                                <i class="fas fa-circle"></i>
                                                Mobile URL1
                                            </a>
                                            </li>
                                            <li>
                                                <a class="linkContainer item-atlas" href="#"> 
                                                    <i class="fas fa-circle"></i>
                                                    Mobile URL2
                                                </a>
                                            </li>
                                            <li>
                                                <a class="linkContainer item-atlas" href="#"> 
                                                    <i class="fas fa-circle"></i>
                                                    Mobile URL3
                                                </a>
                                            </li>

                                        </ul>
                                    </div> -->

                                    <!--                                     
                                    <div class="mobileSecondaryNav">
                                        <ul>
                                            <li><a href="#">Pricing</a></li>
                                        </ul>
                                        <ul>
                                            <li><a href="#">Find a tool</a></li>
                                        </ul>
                                    </div> -->

                                </div> <a class="collapsible" href="#">URL</a>
                            </div> <a class="collapsible" href="#">LRU</a>

                        </div>
                    </div>
        </div>
        </li>
        <!-- Mobile navbar -->
        </ul>
        </div>
        <div class="dropdownRoot">
            <div class="dropdownBackground" style="transform: translateX(452px) scaleX(0.707692) scaleY(1.1075);">
                <div class="alternateBackground" style="transform: translateY(255.53px);"></div>
            </div>

            <div class="dropdownArrow" style="transform: translateX(636px) rotate(45deg);"></div>

            <div class="dropdownContainer" style="transform: translateX(452px); width: 368px; height: 443px;">

                <div class="dropdownSection left" data-dropdown="incoterms">
                    <div class="dropdownContent">
                        <div class="linkGroup">
                            <ul class="productsGroup">
                                <li>
                                    <a class="linkContainer item-payments" href="#">
                                        <i class="fal fa-fan fa-2x"></i>
                                        <div class="productLinkContent">
                                            <h3 class="linkTitle">Link1</h3>
                                            <p class="linkSub">Link one description will go here</p>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a class="linkContainer item-payments" href="#">
                                        <i class="far fa-crosshairs fa-2x"></i>
                                        <div class="productLinkContent">
                                            <h3 class="linkTitle">Link2</h3>
                                            <p class="linkSub">Link two description will proceed here</p>
                                        </div>
                                    </a>
                                </li>

                                <!--

                                <li> 
                                    <a class="linkContainer item-subscriptions" href="container/tracking/index.html">
                                        <svg width="51" height="52" viewBox="0 0 51 52" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle class="hover-fillLight" cx="25.5566" cy="25.959" r="25"
                                                fill="#8DE1A8" />
                                            <mask id="mask04" mask-type="alpha" maskUnits="userSpaceOnUse" x="0" y="1"
                                                width="51" height="51">
                                                <circle class="hover-fillLight" cx="25.5" cy="26.0156" r="25"
                                                    fill="#3C8A69" />
                                            </mask>
                                            <g mask="url(#mask04)">
                                                <path class="hover-fillDark"
                                                    d="M26.3893 26.0549L22.4557 29.8697C21.9121 30.3969 21.0616 30.3687 20.5542 29.8068C20.0466 29.2448 20.0758 28.3635 20.6194 27.8364L24.5529 24.0215C25.0965 23.4944 25.947 23.5225 26.4545 24.0845C26.962 24.6464 26.9329 25.5277 26.3893 26.0549Z"
                                                    fill="#3C8A69" />
                                                <path class="hover-fillDark"
                                                    d="M28.1557 40.3974C22.7736 41.8625 17.0169 40.4164 13.0937 36.6303C9.17052 32.8441 7.67212 27.2884 9.19023 22.0943C9.40704 21.3903 10.176 20.9909 10.9252 21.1811C11.6546 21.3903 12.0882 22.1133 11.8911 22.8363C10.6293 27.0601 11.8516 31.6264 15.0652 34.7277C18.2787 37.829 23.0102 39.0086 27.3869 37.7908C28.136 37.6006 28.8852 38.0192 29.102 38.7231C29.2991 39.4461 28.8852 40.1882 28.1557 40.3974Z"
                                                    fill="#3C8A69" />
                                                <path class="hover-fillDark"
                                                    d="M22.5585 35.4916C20.449 35.2063 18.5368 34.2741 17.0384 32.828C15.5401 31.382 14.574 29.5366 14.2784 27.5007C14.1797 26.7587 14.712 26.0927 15.4612 25.9785C16.2299 25.8834 16.9399 26.378 17.0383 27.1201C17.2748 28.5661 17.9846 29.8978 19.0295 30.9063C20.0745 31.9148 21.4544 32.5997 22.9527 32.828C23.7019 32.942 24.2342 33.6081 24.1357 34.35C24.0173 35.073 23.3274 35.5868 22.5585 35.4916Z"
                                                    fill="#3C8A69" />
                                                <path class="hover-fillDark"
                                                    d="M54.4937 27.1191L51.5365 24.2652L50.25 23.25L49.565 22.3626L46.6078 19.5086C46.0629 18.9828 45.1811 18.9828 44.6363 19.5086L36.7505 27.1191C36.2056 27.645 36.2056 28.4959 36.7505 29.0217L39.7077 31.8756L40.875 33L41.6791 33.7782L44.6363 36.6321C45.1812 37.158 46.063 37.158 46.6078 36.6321L54.4937 29.0217C55.0386 28.4959 55.0386 27.645 54.4937 27.1191Z"
                                                    fill="#3C8A69" />
                                                <path class="hover-fillDark"
                                                    d="M30.8374 4.2852L27.8802 1.43127L25.1695 2.62038L25.9088 -0.471407L22.9515 -3.32534C22.4067 -3.85119 21.5249 -3.85119 20.9801 -3.32534L13.0942 4.28512C12.5493 4.81097 12.5493 5.66194 13.0942 6.18771L16.0514 9.04164L17.375 10.125L18.0229 10.9442L20.9801 13.7982C21.525 14.324 22.4067 14.324 22.9515 13.7982L30.8374 6.18771C31.3823 5.66194 31.3823 4.81106 30.8374 4.2852Z"
                                                    fill="#3C8A69" />
                                                <path class="hover-fillDark"
                                                    d="M22.5592 35.4876C20.4497 35.2023 18.5375 34.2701 17.0391 32.824L19.0303 30.9023C20.0753 31.9108 21.4552 32.5957 22.9535 32.824C23.7027 32.938 24.235 33.6042 24.1365 34.3461C24.018 35.0691 23.328 35.5828 22.5592 35.4876Z"
                                                    fill="#3C8A69" />
                                                <path class="hover-fillDark"
                                                    d="M28.1577 40.3953C22.7756 41.8604 17.0189 40.4143 13.0957 36.6282L15.0672 34.7256C18.2807 37.8269 23.0122 39.0065 27.3889 37.7888C28.138 37.5985 28.8872 38.0171 29.104 38.721C29.3011 39.444 28.8872 40.1861 28.1577 40.3953Z"
                                                    fill="#3C8A69" />
                                                <path
                                                    d="M37.7363 22.3607L36.7506 23.312C35.1143 24.8911 32.4725 24.8912 30.8361 23.312L26.8932 19.5069C25.2569 17.9277 25.257 15.3781 26.8932 13.799L27.879 12.8477H31.8219L37.7363 18.5555V22.3607Z"
                                                    fill="#F0F5F2" />
                                                <path
                                                    d="M30.8367 23.3136L28.8652 21.411L34.7797 15.7031L37.7369 18.5571V22.3622L36.7511 23.3136C35.1149 24.8927 32.4731 24.8927 30.8367 23.3136Z"
                                                    fill="#EAEBEA" />
                                                <path
                                                    d="M37.7366 22.3605L47.5938 12.8477L37.7366 3.33476L27.8794 12.8477L37.7366 22.3605Z"
                                                    fill="white" />
                                                <path
                                                    d="M37.7366 22.3625L47.5938 12.8496L42.6652 8.0932L32.808 17.6061L37.7366 22.3625Z"
                                                    fill="#F0F5F0" />
                                                <path
                                                    d="M30.8363 19.505C27.0314 15.833 20.841 15.833 17.0361 19.505C16.4841 20.0376 16.484 20.8748 17.0361 21.4076L28.8648 32.8232C29.4169 33.356 30.2843 33.3559 30.8363 32.8232C34.6413 29.1512 34.6413 23.177 30.8363 19.505Z"
                                                    fill="white" />
                                                <path
                                                    d="M30.8371 32.8242C30.2851 33.3568 29.4176 33.3569 28.8656 32.8242L22.9512 27.1163L30.8371 19.5059C34.642 23.1779 34.642 29.1522 30.8371 32.8242Z"
                                                    fill="#F0F5F0" />
                                            </g>
                                            <circle class="hover-strokeLight" cx="25.5566" cy="26" r="24"
                                                stroke="#8DE1A8" stroke-width="2" />
                                        </svg>
                                        <div class="productLinkContent">
                                            <h3 class="linkTitle">Container Tracking</h3>
                                            <p class="linkSub">See your cargo location on the map in real-time</p>
                                        </div>
                                    </a> 
                                </li>

                                <li> 
                                    <a class="linkContainer item-connect" href="shipping/cargo-wizard/index.html"> <svg
                                            viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle class="hover-fillLight" cx="25.2266" cy="25.6865" r="24.9717"
                                                fill="#80D1F6" />
                                            <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="51"
                                                height="51">
                                                <circle class="hover-fillLight" cx="25.2266" cy="25.6865" r="24.9717"
                                                    fill="#80D1F6" />
                                            </mask>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M25.3782 58.6986H9.93442C8.81678 58.6986 7.90234 57.7953 7.90234 56.6914V15.9457C7.90234 14.8417 8.81678 13.9385 9.93442 13.9385H25.3782V58.6986Z"
                                                        fill="#ffffff" />
                                                    <path
                                                        d="M25.0739 13.9381L40.5177 13.9381C41.6354 13.9381 42.5498 14.8414 42.5498 15.9453L42.5498 56.6911C42.5498 57.795 41.6354 58.6982 40.5177 58.6982L25.0739 58.6982L25.0739 13.9381Z"
                                                        fill="#F5F9FE" />
                                                    <rect class="hover-fillLight" x="15.21" y="28.3691" width="20.0013"
                                                        height="1.75896" rx="0.879479" fill="#80D1F6" />
                                                    <rect class="hover-fillLight" x="15.21" y="32.9316" width="20.0013"
                                                        height="1.75896" rx="0.879479" fill="#80D1F6" />
                                                    <rect class="hover-fillLight" x="15.21" y="37.2148" width="20.0013"
                                                        height="1.75896" rx="0.879479" fill="#80D1F6" />
                                                    <rect class="hover-fillLight" x="15.2061" y="42.1748"
                                                        width="20.0013" height="1.75896" rx="0.879479" fill="#80D1F6" />
                                                    <path class="hover-fillLight"
                                                        d="M32.0068 34.558L32.0069 37.4586L35.1044 38.5195L45.5972 27.5979L42.7245 24.3936L32.0068 34.558Z"
                                                        fill="#80D1F6" />
                                                    <path class="hover-fillDark"
                                                        d="M31.0403 34.4112L30.5197 37.0146C30.378 37.7233 31.0117 38.3436 31.7171 38.1869L33.9123 37.6993C34.098 37.6581 34.268 37.5647 34.4025 37.4302L44.0233 27.8095C44.3989 27.4339 44.4153 26.8303 44.0608 26.4348L42.5067 24.7013C42.1307 24.2819 41.4827 24.2556 41.074 24.6432L31.3328 33.8817C31.183 34.0238 31.0808 34.2087 31.0403 34.4112Z"
                                                        fill="#4081C2" />
                                                    <circle class="hover-strokeLight" cx="25.2266" cy="25.6875" r="24"
                                                        stroke="#80D1F6" stroke-width="2" />
                                                </g>
                                            </g>
                                            <defs>
                                                <clipPath>
                                                    <rect width="40.7432" height="44.7601" fill="#ffffff"
                                                        transform="translate(4.85449 12.6621)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <div class="productLinkContent">
                                            <h3 class="linkTitle">Cargo Wizard</h3>
                                            <p class="linkSub">For exporters to automate paperwork and sales</p>
                                        </div>
                                    </a> 
                                </li>

                                <li> 
                                    <a class="linkContainer item-atlas" href="services/distances-time/index.html"> <svg
                                            width="51" height="51" viewBox="0 0 51 51" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle class="hover-fillLight" cx="25.5566" cy="25.6816" r="25"
                                                fill="#F6D872" />
                                            <circle class="hover-strokeLight" cx="25.5566" cy="25.6816" r="24"
                                                stroke="#F6D872" stroke-width="2" />
                                            <rect class="hover-fillDark" x="12.6143" y="10.3008" width="25.8861"
                                                height="2.5725" rx="1" fill="#B57629" />
                                            <path class="hover-fillDark"
                                                d="M34.5508 38.4902L16.5621 38.4902L16.5621 32.7265C16.5621 27.7591 20.589 23.7322 25.5565 23.7322C30.5239 23.7322 34.5508 27.7591 34.5508 32.7265L34.5508 38.4902Z"
                                                fill="#B57629" />
                                            <path class="hover-fillDark"
                                                d="M16.5615 12.8721H34.5502V18.6358C34.5502 23.6032 30.5233 27.6301 25.5559 27.6301C20.5884 27.6301 16.5615 23.6032 16.5615 18.6358V12.8721Z"
                                                fill="#B57629" />
                                            <path
                                                d="M18.9756 18.418H32.138C32.138 22.0527 29.1915 25.0592 25.5568 25.0592C21.9221 25.0592 18.9756 22.0527 18.9756 18.418Z"
                                                fill="white" />
                                            <path
                                                d="M32.1367 38.4902L18.9743 38.4902C18.9743 34.8555 21.9208 31.849 25.5555 31.849C29.1902 31.849 32.1367 34.8555 32.1367 38.4902Z"
                                                fill="white" />
                                            <path d="M25.6162 28.9473L20.8955 33.8309H30.2189L25.6162 28.9473Z"
                                                fill="white" />
                                            <rect class="hover-fillDark" x="38.499" y="41.0615" width="25.8861"
                                                height="2.5725" rx="1" transform="rotate(-180 38.499 41.0615)"
                                                fill="#B57629" />
                                            <circle class="hover-strokeLight" cx="25.5" cy="25.6816" r="24"
                                                stroke="#F6D872" stroke-width="2" /></svg>
                                        <div class="productLinkContent">
                                            <h3 class="linkTitle">Distances & Time</h3>
                                            <p class="linkSub">Visual module with map, showing sea and land routings</p>
                                        </div>
                                    </a> 
                                </li>

                                <li> 
                                    <a class="linkContainer item-radar" href="route-planner/index.html"> <svg
                                            viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle class="hover-fillLight" cx="25.1416" cy="25.6816" r="25"
                                                fill="#ECA7E8" />
                                            <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="51"
                                                height="51">
                                                <circle class="hover-fillDark" cx="25.1416" cy="25.6816" r="25"
                                                    fill="#ECA7E8" />
                                            </mask>
                                            <g>
                                                <path
                                                    d="M10.2023 36.1104L10.2023 30.6322C10.2023 24.0048 15.5749 18.6322 22.2023 18.6322L25.5947 18.6322"
                                                    stroke="white" stroke-width="2" />
                                                <rect class="hover-fillDark" x="5.91211" y="28.4424" width="8.58253"
                                                    height="8.58253" rx="2" fill="#8C52AA" />
                                                <path
                                                    d="M41.2098 36.1104L41.2098 30.6322C41.2098 24.0048 35.8372 18.6322 29.2098 18.6322L25.8174 18.6322"
                                                    stroke="white" stroke-width="2" />
                                                <rect class="hover-fillDark" width="8.58253" height="8.58253" rx="2"
                                                    transform="matrix(-1 0 0 1 45.5 28.4424)" fill="#8C52AA" />
                                                <path class="hover-fillDark" d="M25.5771 18.6367H42.826" stroke="white"
                                                    stroke-width="2" />
                                                <path d="M8.36328 18.6367L24.2747 18.6367" stroke="white"
                                                    stroke-width="2" />
                                                <rect class="hover-fillDark" x="21.3047" y="14.3389" width="8.58253"
                                                    height="8.58253" rx="2" fill="#8C52AA" />
                                                <rect class="hover-fillLight" x="23.7549" y="16.7891" width="3.68214"
                                                    height="3.68214" rx="1" fill="white" />
                                                <circle class="hover-fillDark" cx="42.8262" cy="18.6309" r="2.45215"
                                                    fill="#8C52AA" />
                                                <circle class="hover-fillDark" cx="8.36426" cy="18.6309" r="2.45215"
                                                    fill="#8C52AA" />
                                            </g>
                                        </svg>
                                        <div class="productLinkContent">
                                            <h3 class="linkTitle">Route Planner</h3>
                                            <p class="linkSub">A tool for carriers to provide accurate tracking</p>
                                        </div>
                                    </a> 
                                </li>
                                
                                -->

                                <li>
                                    <a class="linkContainer item-payments" href="#">
                                        <i class="fal fa-wind-warning fa-2x"></i>
                                        <div class="productLinkContent">
                                            <h3 class="linkTitle">Link 3 <span class="new-badge">New</span></h3>
                                            <p class="linkSub"> It always contains dummy text </p>
                                        </div>
                                    </a>
                                </li>

                                <li>

                                </li>
                            </ul>
                        </div>
                        <ul class="linkGroup linkList prodsubGroup">
                            <li>
                                <a class="linkContainer item-pricing" href="#" data-action-source="nav">
                                    <h3 class="linkTitle linkIcon"> <i class="fad fa-tags"></i> URL1 </h3>
                                </a>
                            </li>

                            <li>
                                <a class="linkContainer item-workswith" href="#">
                                    <h3 class="linkTitle linkIcon"> <i class="fad fa-tools"></i> URL2 </h3>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="dropdownSection active" data-dropdown="ports">
                    <div class="dropdownContent">
                        <div class="linkGroup documentationGroup"> <a class="linkContainer withIcon item-documentation"
                                href="#">
                                <h3 class="linkTitle linkIcon"> <i class="fad fa-circle"></i> Whatever link
                                </h3> <span class="linkSub">subtitles.</span>
                            </a>
                            <a class="linkContainer withIcon item-documentation" href="#">
                                <h3 class="linkTitle linkIcon"> <i class="fad fa-map-marker-alt"></i> Font awesome
                                </h3>
                            </a>

                            <!--
                            <div class="documentationArticles">
                                <ul>
                                    <li>
                                        <h4>Services</h4>
                                    </li>
                                    <li><a
                                            href="about/fcl-full-container-load-international-freight-shipment/index.html">FCL
                                            Shipping</a></li>
                                    <li><a href="about/lcl-less-container-load-international-freight-shipment.html">LCL
                                            Shipping</a></li>
                                    <li><a href="about/breakbulk/index.html">Bulk & Break Bulk</a></li>
                                    <li><a href="about/dangerous-goods/index.html">Dangerous cargoes</a></li>
                                    <li><a href="about/cargo-insurance/index.html">Insurance</a></li>
                                    <li><a href="reference/quality-control/index.html">Inspection services</a></li>
                                </ul>
                                <ul>
                                    <li><a href="about/certification-services/index.html">Certification</a></li>
                                    <li><a href="about/project-cargo/index.html">Project Cargo</a></li>
                                    <li><a href="about/customs-clearance/index.html">Customs Clearance</a></li>
                                    <li><a href="about/survey-services/index.html">Survey Services</a></li>
                                    <li><a href="about/reefer-cargo/index.html">Reefer Cargoes</a></li>
                                    <li><a href="about/warehouse-services/index.html">Warehousing</a></li>
                                </ul>
                            </div>
                            !-->

                        </div>
                    </div>
                </div>

                <div class="dropdownSection" data-dropdown="taxes_and_duties">
                    <div class="dropdownContent">

                        <!--
                        <div class="linkGroup documentationGroup">
                            <div class="documentationArticles withoutIcon">
                                <ul>
                                    <li>
                                        <h4>Info</h4>
                                    </li>
                                    <li><a href="reference/incoterms2020/index.html">Incoterms</a></li>
                                    <li><a href="reference/imo/index.html">IMO classes</a></li>
                                    <li><a href="services/temperature/index.html">Reefer Cargo</a></li>
                                    <li><a href="reference/glossary/index.html">Glossary</a></li>
                                    <li><a href="reference/handling/index.html">Liner terms</a></li>
                                    <li><a href="reference/services-and-fees/index.html">Services & Fees</a></li>
                                </ul>
                                <ul>
                                    <li>
                                        <h4>Dimensions</h4>
                                    </li>
                                    <li><a href="reference/equipment/index.html">Container Dimensions</a></li>
                                    <li><a href="reference/pallets/index.html">Pallet Dimensions</a></li>
                                    <li><a href="reference/uld/index.html">ULD container types</a></li>
                                    <li><a href="reference/covered/index.html">Types of railway wagons</a></li>
                                </ul>
                            </div>
                        </div>
                        -->

                        <ul class="linkGroup linkList developersGroup">
                            <li>
                                <a class="linkContainer item-apiReference" href="#">
                                    <h3 class="linkTitle linkIcon"> <i class="fad fa-circle"></i> cobweb </h3>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="dropdownSection right" data-dropdown="company">
                    <div class="dropdownContent">
                        <div class="linkGroup documentationGroup">
                            <a class="linkContainer withIcon item-documentation" href="#">
                                <h3 class="linkTitle linkIcon"> <i class="fas fa-user-tie"></i> About Us
                                </h3>
                            </a>
                        </div>
                        <div class="linkGroup blogGroup">

                            <a class="linkContainer withIcon item-documentation" href="#">
                                <h3 class="linkTitle linkIcon"> <i class="fad fa-phone"></i> Contact us </h3>
                            </a>

                            <!--
                            <ul class="blogPosts">
                                <li><a
                                        href="blog/post/5-important-tips-for-a-quick-and-hassle-free-shipping-experience-393.html"><span
                                            class="title">5 Important tips for a quick and hassle-free shipping
                                            experience</span></a></li>
                                <li><a href="blog/post/searates-updates-week-23-2020.html"><span class="title">SeaRates
                                            Updates - Week 23, 2020</span></a></li>
                                <li><a
                                        href="blog/post/5-tips-for-improving-freight-forwarding-business-efficiency.html"><span
                                            class="title">5 Tips for Improving Freight Forwarding Business Efficiency
                                        </span></a></li>
                            </ul>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div id="message_container"></div>
</header>
