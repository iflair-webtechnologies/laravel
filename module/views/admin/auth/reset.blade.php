@extends('admin.layouts.master')

@section('title', 'Change - Password - Villato')
@section('page-header', 'Change Password')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('global.account.update.password') }}" method="post" id="form-password-admin">
                    <div class="box-body">
                        <div class="form-group">
                         <input type="password" name="password_current" class="form-control" id="password_current"
                           placeholder="Huidig wachtwoord" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control"
                               placeholder="Nieuw wachtwoord" required minlength="8">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                               placeholder="Herhaal nieuw wachtwoord" required>
                    </div>                     
                    </div><!-- /.box- body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.index') }}" class="btn btn-default">Cancel</a>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <button type="submit" class="btn btn-info pull-right">Create</button>
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div>
    </div>
@stop
@section('script')
    <script>
        $(document).ready(function() {
                     $('#form-password-admin').submit(function(event) {
//alert("hi");return false;
        event.preventDefault();
        var form = this;
        var formData = new FormData($(form)[0]);

        $.ajax({
            type: 'post',
            contentType: false,
            dataType: 'json',
            url: $(form).attr('action'),
            data: formData,
            processData: false,
            success: function(data) {
                form.reset();
                
                    alert('Wachtwoord Bijgewerkt');    
                
                
            },
            error: function(xhr, error, errorThrown) {
                var data = $.parseJSON(xhr.responseText);
                form.reset();
                $.each(data, function(key, val) {
                    
                    alert(val);

                });
            }
        });
    });
             });
    </script>
@stop 
