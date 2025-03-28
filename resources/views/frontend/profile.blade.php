@extends('frontend.layouts.master')
@section('content')
<div class="login-box">
    <form action="{{route('user.profile.update')}}" method="POST">
        @csrf
        <div>
        <label for="">Nickname </label>
        <input
            type="text" name="nickname"
            placeholder="NickName" required
            value="{{auth()->user()->nickname}}"
        />
        @error('nickname')
            <small style="color: red;">{{ $message }}</small>
        @enderror
        </div>
        <div>
        <label for="">Email Address </label>
        <input
            type="email"
            name="email"
            id=""
            required
            placeholder=""
            value="{{auth()->user()->email}}"
        />
        @error('email')
            <small style="color: red;">{{ $message }}</small>
        @enderror
        </div>
        <div>
        <label for="">Old password </label>
        <input type="password"  name="old_password" id="" placeholder="******" />
         @error('old_password')
            <small style="color: red;">{{ $message }}</small>
        @enderror
        </div>
        <div>
        <label for="">New password </label>
        <input type="password"  name="password" id="password" placeholder="******" />
         @error('password')
            <small style="color: red;">{{ $message }}</small>
        @enderror
        </div>
        <div>
        <label for="">Password confirmation </label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="******" />
        </div>
        <div class="mt-5">
        <button class="btn-one w-100">Update</button>
        </div>
    </form>
</div>

@endsection

@push('script')
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (newPassword !== confirmPassword) {
                e.preventDefault();
                toastr.error("New Password and Confirm Password do not match.");
            }
        });
    </script>
@endpush