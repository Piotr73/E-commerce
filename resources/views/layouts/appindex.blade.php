<!DOCTYPE html>
<html lang="en">
@section('htmlheader')
    @include('layouts.partials_plantilla.htmlheader')
@show

<body>
@include('layouts.partials_plantilla.main-modal')
<div class="wrapper">
    @include('layouts.partials_plantilla.mainheader')
    @include('layouts.partials_plantilla.mainbanner')
    @include('layouts.partials_plantilla.mainwelcome')
    @include('layouts.partials_plantilla.mainproduct')
    @include('layouts.partials_plantilla.mainsoon')
    @include('layouts.partials_plantilla.maindeals')
    @include('layouts.partials_plantilla.mainmessage')
    @include('layouts.partials_plantilla.mainsuscribe')
    @include('layouts.partials_plantilla.footer')
</div>
@section('scripts')
    @include('layouts.partials_plantilla.scripts')
@show
</body>
</html>
