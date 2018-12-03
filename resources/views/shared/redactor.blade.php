@push('styles')
    <link href="{{ asset('redactor/redactor.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src={{ asset('redactor/redactor.min.js') }}></script>
    <script type="text/javascript">
        $R('textarea', { minHeight: '300px' })
    </script>
@endpush
