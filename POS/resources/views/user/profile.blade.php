@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Profil Pengguna</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    {{-- Perbaikan path gambar --}}
                    <img id="profile-image"
                         src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profiles/profile_default.png') }}" 
                         class="img-circle elevation-2" 
                         alt="Foto Profil" 
                         style="width: 200px; height: 200px; object-fit: cover;">

                    {{-- Form Upload Foto --}}
                    <form action="{{ url('/user/update_picture') }}" method="POST" id="form-update-profile" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="profile_picture">Ubah Foto Profil</label>
                            <input type="file" class="form-control" name="profile_picture" id="profile_picture" accept="image/*" required>
                            <small class="form-text text-muted">Ukuran maksimal 2MB. Format: JPG, JPEG, PNG</small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan Foto Profil</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <h4>Data Pengguna</h4>
                    <table class="table">
                        <tr>
                            <th width="30%">Username</th>
                            <td>: {{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>: {{ $user->nama }}</td>
                        </tr>
                        <tr>
                            <th>Level</th>
                            <td>: {{ $user->level->level_nama ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Preview image saat file dipilih
    document.getElementById('profile_picture').addEventListener('change', function (event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById('profile-image').src = URL.createObjectURL(file);
        }
    });
</script>
@endpush
