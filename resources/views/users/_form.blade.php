<div class="mb-3">
    <label for="name" class="form-label">
        Nama
    </label>

```
<input
    type="text"
    id="name"
    name="name"
    class="form-control @error('name') is-invalid @enderror"
    value="{{ old('name', $user->name ?? '') }}"
    placeholder="Masukkan nama pengguna"
>

@error('name')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
```

</div>

<div class="mb-3">
    <label for="email" class="form-label">
        Email
    </label>

```
<input
    type="email"
    id="email"
    name="email"
    class="form-control @error('email') is-invalid @enderror"
    value="{{ old('email', $user->email ?? '') }}"
    placeholder="Masukkan email pengguna"
>

@error('email')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
```

</div>

<div class="mb-3">
    <label for="password" class="form-label">
        Password
    </label>

```
<input
    type="password"
    id="password"
    name="password"
    class="form-control @error('password') is-invalid @enderror"
    placeholder="{{ isset($user) ? 'Kosongkan jika tidak diubah' : 'Masukkan password' }}"
>

@if(isset($user))
    <small class="text-muted">
        Kosongkan jika tidak ingin mengubah password.
    </small>
@endif

@error('password')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
```

</div>

<div class="mb-3">
    <label for="role_id" class="form-label">
        Role
    </label>

```
<select
    id="role_id"
    name="role_id"
    class="form-select @error('role_id') is-invalid @enderror"
>
    <option value="">-- Pilih Role --</option>

    @foreach($roles as $role)
        <option
            value="{{ $role->id }}"
            @selected(old('role_id', $user->role_id ?? '') == $role->id)
        >
            {{ ucfirst($role->name) }}
        </option>
    @endforeach
</select>

@error('role_id')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
```

</div>
