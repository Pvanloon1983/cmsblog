<h1>Nieuw Bericht Aangemaakt</h1>
<p>Hallo {{ $user->name }}</p>
<p>Titel: {{ $post->title }}</p>
<p>Inhoud: {{ $post->body }}</p>
<img width="200" src="{{ $message->embed('storage/' . $post->image) }}" alt="">

