<?php require APP_ROOT . '/views/inc/header.php'; ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1><?php echo $data['title']; ?></h1>
    </div>
</div>
<?php foreach ($data['users'] as $users) : ?>
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $users->last_name . ', ' . $users->first_name; ?></h4>
        <p class="card-title">Email: <?php echo $users->email; ?></p>
        <p class="card-title">Phone: <?php echo $users->phone_number; ?></p>
        <p class="card-title">Year of Birth: <?php echo $users->birth_year; ?></p>
        <p class="card-title">Created: <?php echo $users->created_at; ?></p>
    </div>
<?php endforeach; ?>
<?php require APP_ROOT . '/views/inc/footer.php'; ?>