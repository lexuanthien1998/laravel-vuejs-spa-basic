<!DOCTYPE html>
<html lang="vi VN">
    <head>
        <meta charset="utf-8">
        <title>NEWS.</title>

        <!-- Main styles for this application -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <meta id="csrf-token" name="csrf-token" value="{{ csrf_token() }}">
    </head>
    <body>
        <div id="app">
            {{-- <passport-clients></passport-clients>
            <passport-authorized-clients></passport-authorized-clients>
            <passport-personal-access-tokens></passport-personal-access-tokens> --}}
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>