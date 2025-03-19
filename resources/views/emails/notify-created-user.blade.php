<h4>Hello {{ $user->full_name }}</h4>
<hr>
<p>Your account is created using email {{ $user->email }}</p>
<p>Click button below to get started.</p>

<a href="{{ $url }}" class="btn btn-sm btn-pill btn-success">Get Started</a>

<hr>
<?= config('app.name') ?>
