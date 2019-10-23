<template>
    <div class="card text-white bg-info">
        <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
                <i class="icon-people"></i>
            </div>
            <div class="text-value">{{posts}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Posts created.</small>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                posts: 0
            }
        },
        mounted () {
            this.getUsersCount()
        },
        methods: {
            getUsersCount () {
                axios.get(`/api/posts/count`)
                    .then(response => {
                        this.posts = response.data
                    })
            },
        }
    }
</script>
