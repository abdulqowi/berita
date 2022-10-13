<div class="row">
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="name">Nama <span class="text-danger">*</span></label>
            <input name="name" id="name" placeholder="Masukkan nama" type="name" class="form-control form-control-xs @error('name') is-invalid @enderror" value="{{ $user->name ?? old('name') }}">
            @error('name')
                <div class="invalid-feedback" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="position-relative form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input name="email" id="email" placeholder="Masukkan email" type="email" class="form-control form-control-xs @error('email') is-invalid @enderror" value="{{ $user->email ?? old('email') }}">
            @error('email')
                <div class="invalid-feedback" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="position-relative form-group">
            <label for="roles">Roles <span class="text-danger">*</span></label>
            <select name="roles[]" class="form-control form-control-xs select2 @error('roles') is-invalid @enderror" multiple>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
            @error('roles')
                <div class="invalid-feedback" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="password">Password <span class="text-danger">*</span></label>
            <input name="password" id="password" placeholder="Masukkan password" type="password" class="form-control form-control-xs @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="position-relative form-group">
            <label for="password_confirmation">Konfirmasi Password <span class="text-danger">*</span></label>
            <input name="password_confirmation" id="password_confirmation" placeholder="Masukkan konfirmasi password" type="password" class="form-control form-control-xs @error('password_confirmation') is-invalid @enderror">
            @error('password_confirmation')
                <div class="invalid-feedback" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
