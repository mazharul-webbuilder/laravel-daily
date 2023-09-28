@component('mail::message')
    # Test Title

Some details about mail

@component('mail::button', ['url' => 'link'])
    More Details
@endcomponent

    Thanks, <br>
    Laravel

@endcomponent
