
@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => $url, 'color' => 'success'])
Welcome!!!
@endcomponent
@endslot{{-- Body --}}
Hello {{ $username }}{{-- Subcopy --}} .super excited to have you 
@component('mail::button', ['url' =>  $url , 'color' => 'success'])
Verify
@endcomponent

@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot

@endisset{{-- Footer --}}
@slot('footer')
@component('mail::footer')
Glad to add you to the team
@endcomponent
@endslot
@endcomponent