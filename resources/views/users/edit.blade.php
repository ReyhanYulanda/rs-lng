<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="card mt-4">
				<div class="card-body p-4">
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul class="mb-0">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form action="{{ route('users.update', $user->id) }}" method="POST" class="mt-4">
						@csrf
						@method('PUT')
						<div class="mb-4">
							<label for="name" class="form-label">Nama</label>
							<input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control" maxlength="255" required>
						</div>
						<div class="mb-4">
							<label for="email" class="form-label">Email</label>
							<input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" maxlength="255" required>
						</div>
						<div class="mb-4">
							<label for="role" class="form-label">Role</label>
							<select id="role" name="role" class="form-select" required>
								<option value="karyawan" @selected(old('role', $user->role) === 'karyawan')>Karyawan</option>
								<option value="tenaga_medis" @selected(old('role', $user->role) === 'tenaga_medis')>Tenaga Medis</option>
								<option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
							</select>
						</div>
						<div class="mb-4">
							<label for="password" class="form-label">Password Baru <span class="text-muted">(opsional)</span></label>
							<input type="password" id="password" name="password" class="form-control" minlength="8" autocomplete="new-password">
							<div class="form-text">Kosongkan jika tidak ingin mengubah password.</div>
						</div>
						<div class="mb-4">
							<label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
							<input type="password" id="password_confirmation" name="password_confirmation" class="form-control" minlength="8" autocomplete="new-password">
						</div>
						<div class="d-flex justify-content-end gap-2">
							<a href="{{ route('users.index') }}" class="btn btn-light">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
