@component('mail::message')
    <h1>Titolo del Post: {{ $post->title }}</h1>
    <p>Contenuto del Post: {{ $post->content }}</p>
    @if ($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
    @endif



    @component('mail::button', ['url' => ''])
        Vedi
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
