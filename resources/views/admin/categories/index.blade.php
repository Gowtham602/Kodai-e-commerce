<x-admin-layout>
 <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<h4 class="mb-4">Categories</h4>

<a href="{{ route('admin.categories.create') }}"
   class="btn btn-success mb-3">+ Add Category</a>

<table class="table table-bordered align-middle">
    <thead>
        <tr>
            <th width="60">#</th>
            <th>Name</th>
            <th>Status</th>
            <th width="180">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $index => $category)
        <tr>
            <td>
                {{ $categories->firstItem() + $index }}
            </td>
            <td>{{ $category->name }}</td>
            <td>
                <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-secondary' }}">
                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                </span>
            </td>
            <td>
                <a href="{{ route('admin.categories.edit',$category) }}"
                   class="btn btn-sm btn-primary">Edit</a>

                <button class="btn btn-sm btn-danger"
                        onclick="deleteCategory({{ $category->id }})">
                    Delete
                </button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center text-muted">No categories found</td>
        </tr>
        @endforelse
    </tbody>
</table>


{{ $categories->links() }}
<script>
async function deleteCategory(id) {
    if (!confirm('Delete this category?')) return;

    try {
        const res = await fetch(`/admin/categories/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        });

        if (!res.ok) {
            throw new Error('Delete failed');
        }

        const data = await res.json();

        showToast(data.message || 'Category deleted');
        setTimeout(() => location.reload(), 500);

    } catch (err) {
        showToast('Server error while deleting', 'danger');
    }
}
</script>



</x-admin-layout>
