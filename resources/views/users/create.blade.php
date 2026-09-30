<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah User</h2>
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

					<form action="{{ route('users.store') }}" method="POST" class="mt-4">
						@csrf
						<div class="mb-4">
							<label for="name" class="form-label">Nama</label>
							<input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" maxlength="255" required>
						</div>
						<div class="mb-4">
							<label for="email" class="form-label">Email</label>
							<input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" maxlength="255" required>
						</div>
						<div class="mb-4">
							<label for="role" class="form-label">Role</label>
							<select id="role" name="role" class="form-select" required>
								<option value="karyawan" @selected(old('role', 'karyawan') === 'karyawan')>Karyawan</option>
								<option value="tenaga_medis" @selected(old('role') === 'tenaga_medis')>Tenaga Medis</option>
								<option value="admin" @selected(old('role') === 'admin')>Admin</option>
							</select>
						</div>
						<div class="mb-4">
							<label for="password" class="form-label">Password</label>
							<input type="password" id="password" name="password" class="form-control" minlength="8" required autocomplete="new-password">
						</div>
						<div class="mb-4">
							<label for="password_confirmation" class="form-label">Konfirmasi Password</label>
							<input type="password" id="password_confirmation" name="password_confirmation" class="form-control" minlength="8" required autocomplete="new-password">
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
