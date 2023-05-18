<!DOCTYPE html>
<html lang="en">

@include('includes.header')

<body class="antialiased">

   <!-- // loader -->
   <div id="loading" style="display:none">
        <div class="spinner-grow" role="status" style="position: fixed;">
        <span class="sr-only">Loading...</span>
        </div>
    </div> 

  
  
    <!-- Main wrapper  -->
    <div class="wrapper">
        <!-- header header  -->

        <!-- navigation top start here -->
        @include('includes.navbar')
        <!-- navigation top ending here -->
        <div class="main_body">
        <!-- navigation side start here -->
        @include('includes.side_nav')
        <!-- navigation side ending here -->
            
        <!--- Page Content start here--->
        @yield('content')
        </div>
        <!--- Page Content ending here--->

    </div>
    <!-- End Wrapper -->

    <!-- navigation start here -->
    @include('includes.footer')
    <!-- navigation ending here -->
    @include('includes.delete_modal')
    @yield('js')

</body>

</html>


