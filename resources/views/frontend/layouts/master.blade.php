<!DOCTYPE html>
<html lang="en">

  <head>

    <!-- head start -->
    @include('frontend.includes.head')
    <!-- head end -->

  </head>

  <body>

    <!-- Navbar start -->
    @include('frontend.includes.nav')
    <!-- Navbar end -->

    <!-- Banner start -->
    @yield('banner')
    <!-- Banner end -->

    <section class="blog-posts">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                    @yield('contents')
              </div>
            </div>
          </div>
          <!-- sidebar start -->
          @include('frontend.includes.sidebar')
          <!-- sidebar end -->  
        </div>
      </div>
    </section>

    <!-- Footer start -->
    @include('frontend.includes.footer') 
    <!-- Footer end -->

    <!-- Script start -->
    @include('frontend.includes.script') 
    <!-- Script end -->

  </body>
</html>