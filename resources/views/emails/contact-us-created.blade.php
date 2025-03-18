<h4>Hello <?= join(' ', [$contactUs->first_name, $contactUs->last_name]) ?></h4>
<hr>
<p>We have received your message regarding <?= $contactUs->subject ?></p>
<p>We keep in touch with you.</p>

<hr>
<?= config('app.name') ?>
