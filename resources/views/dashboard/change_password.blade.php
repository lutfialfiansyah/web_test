@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/changePasswordUpdate/'.Auth::user()->id) }}" id="formchange">
                        @csrf
                @if(Session::has('Success'))
                    <div class="alert alert-dark"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    {{ Session::get('Success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif(Session::has('Warning'))
                    <div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    {{ Session::get('Warning') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                        <div class="form-group row">
                            <label for="oldpassword" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                            <div class="col-md-6">
                                <input id="oldpassword" type="password" class="form-control{{-- {{ $errors->has('password') ? ' is-invalid' : '' }} --}}" name="oldpassword" required>

                               {{--  @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                    <div class="input-group" name="frmCheckPassword" id="frmCheckPassword">
                                <input id="password" type="password" onkeyup="checkPasswordStrength()" class="form-control pwd{{-- {{ $errors->has('password') ? ' is-invalid' : '' }} --}}" name="password">
{{--                                 @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif --}}
                            </div>
                                 <div id="password-strength-status"></div>          
                        </div>
                    </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="newpassword">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="btnchange" class="btn btn-primary">
                                    {{ __('Change') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script>
     function checkPasswordStrength() {
        var number = /([0-9])/;
        var alphabets = /([a-zA-Z])/;
        var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
        if($('#password').val().length<8) {
        $('#password-strength-status').removeClass();
        $('#password-strength-status').addClass('weak-password');
        $('#password-strength-status').html("Weak (should be atleast 8 characters.)");
        } 
        else 
        { 
        if($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(special_characters)) { 
        $('#password-strength-status').removeClass();
        $('#password-strength-status').addClass('strong-password');
        $('#password-strength-status').html("Strong");
        } 
        else
        {
        $('#password-strength-status').removeClass();
        $('#password-strength-status').addClass('medium-password');
        $('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
        }}
    }
    // $(function(){
    jQuery(function ($) {
         var form = $('#formchange');
         $('#formchange').validate({
                rules: {
            oldpassword: {
                required: true,
            //     minlength: 8
            },
            newpassword: {
                required: true,
                minlength: 8,
                equalTo: "#password"
            }
            },
             messages: {
                oldpassword: {
                    required: "Enter your old password"
                 },
                newpassword: {
                    required: "Enter your confirm password",
                    equalTo: "Please same value with new password"
                }
            }
            });
    });
</script>

@endsection
