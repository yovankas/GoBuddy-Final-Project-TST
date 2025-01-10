<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<style>
    .form-container {
        position: relative;
        width: 100%;
        min-height: 100vh;
        background: #FFFFFF;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 120px;
    }

    .form-title {
        font-family: 'Inter', sans-serif;
        font-style: normal;
        font-weight: 600;
        font-size: 28px;
        line-height: 34px;
        text-align: center;
        color: #181818;
        margin-bottom: 40px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-family: 'Inter', sans-serif;
        font-style: normal;
        font-weight: 500;
        font-size: 14px;
        line-height: 140%;
        letter-spacing: 0.02em;
        color: #181818;
        margin-bottom: 4px;
    }

    .form-input {
        width: 400px;
        height: 44px;
        background: #F2F2F2;
        border-radius: 4px;
        border: none;
        padding: 11px 12px 12px;
        font-family: 'Inter', sans-serif;
        font-size: 15px;
        letter-spacing: 0.02em;
    }

    .form-input:focus {
        outline: 2px solid #2F80ED;
        background: #FFFFFF;
    }

    .submit-button {
        width: 400px;
        height: 44px;
        background: #2F80ED;
        border-radius: 6px;
        border: none;
        color: #FFFFFF;
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 15px;
        letter-spacing: 0.02em;
        cursor: pointer;
        margin-top: 20px;
    }

    .submit-button:hover {
        background: #2666BE;
    }

    .register-link {
        margin-top: 20px;
        font-family: 'Inter', sans-serif;
        font-weight: 400;
        font-size: 16px;
        line-height: 19px;
        text-align: center;
        letter-spacing: 0.02em;
        color: #4F4F4F;
    }

    .register-link a {
        color: #2F80ED;
        text-decoration: none;
    }

    .register-link a:hover {
        text-decoration: underline;
    }

    .alert {
        width: 400px;
        padding: 12px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .alert-error {
        background: #FEE2E2;
        border: 1px solid #EF4444;
        color: #B91C1C;
    }
</style>

<div class="form-container">
    <h2 class="form-title">Sign in</h2>
    
    <?php if(session()->getFlashdata('msg')): ?>
        <div class="alert alert-error" role="alert">
            <?= session()->getFlashdata('msg') ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo base_url(); ?>SigninController/loginAuth" method="post">
        <div class="form-group">
            <label class="form-label" for="email">Email address</label>
            <input 
                type="email" 
                id="email"
                name="email" 
                class="form-input"
                placeholder="Enter your email" 
                value="<?= set_value('email') ?>"
                required
            >
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input 
                type="password" 
                id="password"
                name="password" 
                class="form-input"
                placeholder="Enter your password"
                required
            >
        </div>

        <button type="submit" class="submit-button">
            Submit
        </button>
        
        <div class="register-link">
            Don't have an account? <a href="signup">Register</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>