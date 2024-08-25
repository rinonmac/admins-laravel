<x-layout title="login">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h1 class="text-center">Login</h1>
            <form method="post">
                @csrf
                @if ($errors->any()) {
                @foreach ($errors->all() as $error)
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: '{{ $error }}',
                        });
                    </script>
                 @endforeach}
                @endif
                @if (session('success'))
                <script>
                Swal.fire({
                    icon:'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                });
                @endif
            <div class="mb-3">
                <div class="mb-3">
                    <label for="username" id="lbl_username" class="form-label">Username</label>
                    <input type="email" class="form-control" id="txt_username" placeholder="Username">
                </div>
                <div class="mb-3">
                    <label for="password" id="lbl_password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="txt_password" placeholder="Password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="chk_remember">
                    <label class="form-check-label" for="chk_remember">Remember Me</label>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" id="btn_submit">Login</button>
                </div>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</x-layout>
