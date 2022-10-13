<div class="row">
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="name">Nama <span class="text-danger">*</span></label>
            <input name="name" id="name" placeholder="Masukkan nama" type="text" class="form-control form-control-xs @error('name') is-invalid @enderror" value="{{ $role->name ?? old('name') }}">
            @error('name')
                <div class="invalid-feedback" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="customCheckbox1">Izin <span class="text-danger">*</span></label>
            @error('permission')
                <small class="text-danger" role="alert">
                    {{ $message }}
                </small>
            @enderror
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" id="check_all" type="checkbox" onClick="toggle(this)">
                <label for="check_all" class="custom-control-label">cek semua</label>
            </div>
            @foreach ($permissions as $permission)
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" id="{{ $permission->name }}" name="permission[]" type="checkbox" value="{{ $permission->id }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : ''}}>
                    <label for="{{ $permission->name }}" class="custom-control-label">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
<button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
