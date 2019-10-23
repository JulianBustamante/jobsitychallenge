<div class="card-columns">
    @each('posts.card', $posts, 'post', 'posts.empty')
</div>

<div class="d-flex justify-content-center">
    {{ $posts->links() }}
</div>
