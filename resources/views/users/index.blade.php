<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Daftar User') }}</h2>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah User</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="table-responsive card p-4">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="GET" action="{{ route('users.index') }}" class="row g-2 mb-3">
                    <div class="col-sm-8 col-md-6 col-lg-4">
                        <label for="q" class="visually-hidden">Cari user</label>
                        <input type="search" name="q" id="q" class="form-control"
                               value="{{ $search }}" placeholder="Cari nama atau email">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        @if($search !== '')
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Reset</a>
                        @endif
                    </div>
                </form>

                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $users->firstItem() + $loop->index }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge {{ $user->role === 'admin' ? 'text-bg-primary' : 'text-bg-secondary' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at?->format('H:i d-m-Y') ?? '-' }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Tidak ada user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
        </div>
    </div>
</x-app-layout>