@extends('layouts.dashboard')

@section('switch_languages')
Session data:
<?php
	print_r($session_data);
?>

<form class="form form-horizontal" role="form" method="POST" action="{{ url('/postChangeLanguage') }}">
    {{ csrf_field() }}
    <div class="row">
    	<div class="form-group col-md-6 col-md-push-3">
            <label>Език</label>
            <?php
                if (Session::has('language')) {
                    $language = Session::get('language');
                }
            ?>
            <select name="lang" onchange="this.form.submit()">
            	<option value="bg" <?php echo ($language==='bg' ? 'selected' : '');?>> bg </option>
                <option value="en" <?php echo ($language==='en' ? 'selected' : '');?>> en </option>
            </select>
        </div>
    </div>
</form>
@endsection