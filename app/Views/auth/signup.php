<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="register-container">

    <div class="main-container">
        <div class="form-container">
            <div class="title-container">
                <h2 class="register-title">Register</h2>
            </div>

            <?php if(isset($validation)): ?>
                <div class="error-container">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>

            <form class="register-form" action="<?php echo base_url(); ?>SignupController/store" method="post">
                <div class="input-group">
                    <div class="form-field">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required
                            placeholder="Full name" value="<?= set_value('name') ?>">
                    </div>
                    <div class="form-field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required
                            placeholder="Email address" value="<?= set_value('email') ?>">
                    </div>
                    <div class="form-field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required
                            placeholder="Password">
                    </div>
                    <div class="form-field">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" id="confirmpassword" name="confirmpassword" required
                            placeholder="Confirm password">
                    </div>
                </div>

                <div class="button-container">
                    <button type="submit">Submit</button>
                </div>

                <div class="signin-link">
                    <a href="signin">Already have an account? Sign in</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');

/* Base styles */
body {
    font-family: 'Inter', sans-serif;
    margin: 0;
    padding: 0;
}

.register-container {
    position: relative;
    width: 1440px;
    height: 970px;
    background: #FFFFFF;
}

/* Logo section */
.logo {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: bold;
    font-size: 1.5rem;
    text-decoration: none;
    color: #1a73e8;
    }

.logo-img {
    width: 80px;
    height: auto;
    }

/* Main container */
.main-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px 16px;
}

.form-container {
    max-width: 400px;
    width: 100%;
    margin-top: -100px;
}

/* Title */
.register-title {
    font-weight: 600;
    font-size: 28px;
    line-height: 34px;
    text-align: center;
    color: #181818;
    margin-bottom: 32px;
}

/* Error container */
.error-container {
    background-color: #FEE2E2;
    border: 1px solid #F87171;
    color: #B91C1C;
    padding: 12px 16px;
    border-radius: 4px;
    margin-bottom: 24px;
}

/* Form styles */
.register-form {
    margin-top: 32px;
}

.input-group {
    display: flex;
    flex-direction: column;
    gap: 24px;
    margin-bottom: 24px;
}

.form-field {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-field label {
    font-weight: 500;
    font-size: 14px;
    line-height: 140%;
    letter-spacing: 0.02em;
    color: #181818;
}

.form-field input {
    width: 100%;
    height: 44px;
    padding: 11px 12px;
    background: #F2F2F2;
    border: 1px solid #E0E0E0;
    border-radius: 4px;
    font-size: 15px;
    line-height: 140%;
    color: #333333;
    box-sizing: border-box;
}

.form-field input:focus {
    outline: none;
    border-color: #2F80ED;
    box-shadow: 0 0 0 2px rgba(47, 128, 237, 0.2);
}

/* Button styles */
.button-container {
    margin-bottom: 20px;
}

button[type="submit"] {
    width: 100%;
    height: 44px;
    background: #2F80ED;
    border-radius: 6px;
    border: none;
    color: #FFFFFF;
    font-weight: 500;
    font-size: 15px;
    line-height: 20px;
    letter-spacing: 0.02em;
    cursor: pointer;
    transition: background-color 0.2s;
}

button[type="submit"]:hover {
    background: #1366D6;
}

/* Sign in link */
.signin-link {
    text-align: center;
}

.signin-link a {
    font-weight: 400;
    font-size: 16px;
    line-height: 19px;
    text-align: center;
    letter-spacing: 0.02em;
    color: #4F4F4F;
    text-decoration: none;
}

.signin-link a:hover {
    color: #2F80ED;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .register-container {
        width: 100%;
    }
    
    .logo-section {
        left: 20px;
    }
    
    .form-container {
        padding: 0 20px;
    }
}
</style>
<?= $this->endSection() ?>