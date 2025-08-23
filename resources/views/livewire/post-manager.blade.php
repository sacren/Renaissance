<div>
    <h2 class="text-2xl font-semibold mb-4">Create a New Post</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit="savePost" class="space-y-4">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" id="title" wire:model="title"
                class="mt-1 block w-full border-gray-300 rounded-md
                    shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter post title">
            @error('title')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea id="content" wire:model="content" rows="5"
                class="mt-1 block w-full border-gray-300 rounded-md
                    shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Write your post here..."></textarea>
            @error('content')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent
                    shadow-sm text-sm font-medium rounded-md text-white bg-blue-600
                    hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                    focus:ring-blue-500">
                Save Post
            </button>
        </div>
    </form>

    <hr class="my-6 border-gray-300"r
</div>
