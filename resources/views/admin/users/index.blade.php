<x-admin-layout>
 <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<h4 class="mb-4">Users</h4>

<table class="table table-bordered align-middle">
    <thead>
        <tr>
            <th width="60">#</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Role</th>
            <th>Joined</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $index => $user)
        <tr>
            <td>{{ $users->firstItem() + $index }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->phone ?? '-' }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                    {{ ucfirst($user->role ?? 'user') }}
                </span>
            </td>
            <td>{{ $user->created_at->format('d M Y') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-muted">
                No users found
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $users->links() }}

</x-admin-layout>
