<!doctype html>
<html lang="en">
<!--header start-->
@include('admin.layouts.meta_info')
<!--header end-->

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('admin.layouts.navbar')
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('admin.layouts.header')
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            @yield('content')
        </div>
        <!--end page wrapper -->
        @include('admin.layouts.footer')
    </div>
    <!--end wrapper-->
    @include('admin.layouts.footer_bottom')


    {{-- jQuery cdn --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        // console.log('hello');
        $(document).ready(function() {
            // Add hidden page input
            $('body').append('<input type="hidden" id="hidden_page" value="1">');


            const fetch_data = (page, keySearch, valueSearch) => {
                $.ajax({
                    // console.log('hello');
                    url: "{{ route('admin.system-settings.index') }}?page=" + page +
                        "&keySearch=" + encodeURIComponent(keySearch) +
                        "&valueSearch=" + encodeURIComponent(valueSearch),
                    success: function(data) {
                        $('tbody').html(data);
                        // Reset scroll position
                        $('html, body').animate({
                            scrollTop: $('#system_settings_list').offset().top
                        }, 0);
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                    }
                })
            }


            // Initial load
            fetch_data(1, '', '');


            // Search button
            $('body').on('click', '#search-button', function(e) {
                e.preventDefault();
                fetch_data(
                    1, // Always reset to page 1
                    $('#keySearch').val(),
                    $('#valueSearch').val()
                );
            });


            // Pagination
            $('body').on('click', '.pager a', function(event) {
                event.preventDefault();
                fetch_data(
                    $(this).attr('href').split('page=')[1],
                    $('#keySearch').val(),
                    $('#valueSearch').val()
                );
            });


            // Reset button
            $('#reset-button').on('click', function(e) {
                e.preventDefault();
                $('#keySearch').val('');
                $('#valueSearch').val('');
                fetch_data(1, '', '');
            });


            // Enter key in search
            $('#keySearch, #valueSearch').on('keyup', function(e) {
                if (e.key === 'Enter') $('#search-button').click();
            });
        });
    </script>
</body>

</html>
