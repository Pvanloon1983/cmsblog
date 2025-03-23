<h1>New Post Created</h1>
<p>Hello {{ $user->name }}</p>
<p>Title: {{ $post->title }}</p>
<p>Content: {{ $post->body }}</p>
<img width="200" src="{{ $message->embed('storage/' . $post->image) }}" alt="">
