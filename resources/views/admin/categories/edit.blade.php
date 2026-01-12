<x-admin-layout>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Edit Category</h4>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm rounded-4">
    <div class="card-body">

       <form id="updateCategoryForm">
        @csrf
        @method('PUT')

            <!-- Category Name -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Category Name</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $category->name) }}">

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Current Image -->
            @if($category->cat_image)
                <div class="mb-3">
                    <label class="form-label fw-semibold">Current Image</label><br>
                    <img src="{{ asset('storage/'.$category->cat_image) }}"
                         class="rounded border"
                         width="120">
                </div>
            @endif

            <!-- Upload New Image -->
            <!-- <div class="mb-3">
                <label class="form-label fw-semibold">Change Image</label>
                <input type="file"
                       name="cat_image"
                       class="form-control @error('cat_image') is-invalid @enderror">

                @error('cat_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> -->

            <!-- Submit -->
           <button class="btn btn-primary rounded-pill px-4" id="updateBtn">
            Update Category
        </button>


        </form>

    </div>
</div>
<script>
document.getElementById('updateCategoryForm').addEventListener('submit', async e => {
    e.preventDefault();

    const btn = document.getElementById('updateBtn');
    btn.disabled = true;

    const formData = new FormData(e.target);

    const res = await fetch("{{ route('admin.categories.update', $category) }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    });

    const data = await res.json();
    btn.disabled = false;

    if (!res.ok) {
        showToast(Object.values(data.errors)[0][0], 'danger');
        return;
    }

    showToast('Category updated successfully');
    setTimeout(() => {
        window.location.href = "{{ route('admin.categories.index') }}";
    }, 800);
});
</script>


</x-admin-layout>
