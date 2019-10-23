<div class="card">
    <div class="card-body">
        <h4 v-pre class="card-title">{{ link_to_route('posts.show', $post->title, $post) }}</h4>

        <p class="card-text"><small v-pre class="text-muted">{{ link_to_route('users.show', $post->author->fullname, $post->author) }}</small></p>

        <p class="card-text">
            <small class="text-muted">{{ humanize_date($post->posted_at) }}</small><br>
        </p>
    </div>
</div>
