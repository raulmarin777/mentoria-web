<x-layout>
    @include('_posts-header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        <x-post-main :post="$posts[0]" />

        <div class="lg:grid lg:grid-cols-2">
            <x-post-card />
            <x-post-card />
        </div>

        <div class="lg:grid lg:grid-cols-3">
            @foreach ($posts->skip(1) as $post)
                <x-post-card />
            @endfor
        </div>
    </main>
</x-layout>