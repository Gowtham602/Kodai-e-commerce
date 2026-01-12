<x-admin-layout>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Add Category</h4>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm rounded-4">
    <div class="card-body">

       <form id="createCategoryForm">
        @csrf


            <!-- Category Name -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Category Name</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       placeholder="Eg: Chocolates">

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category Image -->
            <!-- <div class="mb-3">
                <label class="form-label fw-semibold">Category Image</label>
                <input type="file"
                       name="cat_image"
                       class="form-control @error('cat_image') is-invalid @enderror">

                @error('cat_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> -->

            <!-- Submit -->
            <button class="btn btn-success rounded-pill px-4" id="saveBtn">
                Save Category
            </button>


        </form>

    </div>
</div>
<script>
document.getElementById('createCategoryForm').addEventListener('submit', async e => {
    e.preventDefault();

    const btn = document.getElementById('saveBtn');
    btn.disabled = true;

    const formData = new FormData(e.target);

    const res = await fetch("{{ route('admin.categories.store') }}", {
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

    showToast('Category added successfully');
    setTimeout(() => {
        window.location.href = "{{ route('admin.categories.index') }}";
    }, 800);
});
</script>

</x-admin-layout>
