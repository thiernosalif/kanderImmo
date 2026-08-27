<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>KANDERIMMO</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('dist/assets/img/favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('dist/assets/img/favicon-32x32.png') }}" sizes="32x32">

    <!-- UIKIT -->
    <link rel="stylesheet" href="{{ asset('dist/bower_components/uikit/css/uikit.almost-flat.min.css') }}">

    <!-- Altair -->
    <link rel="stylesheet" href="{{ asset('dist/assets/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/css/themes/themes_combined.min.css') }}">

    <!-- DataTables UIKIT -->
    <link rel="stylesheet" href="{{ asset('dist/assets/css/custom/datatables/datatables.uikit.min.css') }}">

    <!-- Custom -->
    <link rel="stylesheet" href="{{ asset('css/custom-03.css') }}">

    @yield('styles')
</head>

<body class="disable_transitions sidebar_main_open sidebar_main_swipe">

@include('include.header')
@include('include.asside')

<div id="page_content">
    <div id="page_content_inner">
        @yield('content')
    </div>
</div>

@include('include.secondaryAside')

<!-- ================================================= -->
<!-- ================== SCRIPTS ===================== -->
<!-- ================================================= -->



    {{-- ✅ JQUERY EN PREMIER --}}
    {{-- ✅ JQUERY EN PREMIER --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- TEST IMMÉDIAT --}}
    <script>
        if (!window.jQuery) {
            alert('❌ JQUERY NON CHARGÉ');
        }
    </script>

    {{-- ✅ DATATABLES --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    {{-- ✅ SCRIPTS DES VUES --}}
<!-- 2️⃣ UIKIT & Altair core -->
<script src="{{ asset('dist/assets/js/common.min.js') }}"></script>
<script src="{{ asset('dist/assets/js/uikit_custom.min.js') }}"></script>
<script src="{{ asset('dist/assets/js/altair_admin_common.min.js') }}"></script>

<!-- 3️⃣ DataTables core -->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

<!-- 4️⃣ DataTables UIKIT integration -->
<script src="{{ asset('dist/assets/js/custom/datatables/datatables.uikit.min.js') }}"></script>

<!-- 5️⃣ DataTables Buttons -->
<script src="{{ asset('dist/bower_components/datatables-buttons/js/dataTables.buttons.js') }}"></script>
<script src="{{ asset('dist/assets/js/custom/datatables/buttons.uikit.js') }}"></script>
<script src="{{ asset('dist/bower_components/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('dist/bower_components/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('dist/bower_components/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('dist/bower_components/datatables-buttons/js/buttons.html5.js') }}"></script>
<script src="{{ asset('dist/bower_components/datatables-buttons/js/buttons.print.js') }}"></script>

<!-- 6️⃣ Initialisation Altair DataTables -->
{{-- <script src="{{ asset('dist/assets/js/pages/plugins_datatables.min.js') }}"></script> --}}

<!-- 7️⃣ JS spécifique aux pages -->
@yield('scripts')
<script>
console.log('JQUERY TEST:', typeof window.jQuery, typeof window.$);
</script>
</body>
</html>


