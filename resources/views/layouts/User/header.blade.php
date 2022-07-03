 <!-- header section start -->
 <div class="header_section ">
    <div class="container-fluid header_main fixed-top">
       <nav class="navbar navbar-expand-lg navbar-light bg-light ">
          <a class="logo"><img src="images/mylogo.jpg">

          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                   <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="/aboutUs">About</a>
                </li>

                @auth

                <li class="nav-item">


                    <a
                        type="button"
                        class="nav-link"
                         data-bs-toggle="modal"
                         data-bs-target="#createPostModal"


                         >create Post


                </a>


                </li>

                @endauth


                <li class="nav-item">
                   <a class="nav-link" href="/contact">Contact Us</a>
                </li>

                <li class="nav-item">
                   @include('layouts.reg-login')
                </li>

             </ul>
          </div>
       </nav>
    </div>


