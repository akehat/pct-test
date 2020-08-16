<?php require APP_ROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Create An Account</h2>
            <p>Please fill out this form to register with us</p>
            <form action="<?php echo URL_ROOT; ?>users/register" method="post">
                <div class="form-group">
                    <label for="first_name">First Name: <sup>*</sup></label>
                    <input required type="text" name="first_name" placeholder="First Name" class="form-control form-control-lg <?php echo (!empty($data['first_name_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['first_name']; ?>">
                    <span class="invalid-feedback"><?php echo $data['first_name_error']; ?></span>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name: <sup>*</sup></label>
                    <input required type="text" name="last_name" placeholder="Last Name" class="form-control form-control-lg <?php echo (!empty($data['last_name_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['last_name']; ?>">
                    <span class="invalid-feedback"><?php echo $data['last_name_error']; ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input required type="email" name="email" placeholder="Email" class="form-control form-control-lg <?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number: (Ex: 123-456-7890) </label>
                    <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone_number" placeholder="Phone Number" class="form-control form-control-lg <?php echo (!empty($data['phone_number_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone_number']; ?>">
                    <span class="invalid-feedback"><?php echo $data['phone_number_error']; ?></span>
                </div>
                <div class="form-group">
                    <label for="birth_year">Birth Year: </label>
                    <input type="number" min="<?php echo date('Y', strtotime('-120 years')); ?>" max="<?php echo date('Y'); ?>" step="1" name="birth_year" placeholder="Birth Year" class="form-control form-control-lg <?php echo (!empty($data['birth_year_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo (!empty($data['birth_year'])) ? $data['birth_year']: date('Y'); ?>">
                    <span class="invalid-feedback"><?php echo $data['birth_year_error']; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <input required type="password" name="password" placeholder="Password" class="form-control form-control-lg <?php echo (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                    <input required type="password" name="confirm_password" placeholder="Confirm Password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['confirm_password_error']; ?></span>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="Register" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?php echo URL_ROOT; ?>users/login" class="btn btn-light btn-block">Have an account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APP_ROOT . '/views/inc/footer.php'; ?>