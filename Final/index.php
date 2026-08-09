<?php
// Student Technology Club Registration Form
// Server-side validation with PHP; sticky form values on error.

$errors = [];

// Values to redisplay in the form
$name = '';
$age = '';
$email = '';
$membership = '';
$department = '';
$contact = '';

$departments = ['CSE', 'EEE', 'BBA', 'English', 'Architecture'];
$memberships = ['Regular Member', 'Executive Member', 'Volunteer'];

$submitted = false;
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted = true;

    // ---------- 1. Student Name ----------
    $name = trim($_POST['name'] ?? '');
    if ($name === '') {
        $errors['name'] = 'Name is required.';
    } elseif (!preg_match('/^[A-Za-z ]+$/', $name)) {
        $errors['name'] = 'Only letters and spaces are allowed.';
    }

    // ---------- 2. Student Age ----------
    $ageRaw = trim($_POST['age'] ?? '');
    if ($ageRaw === '') {
        $errors['age'] = 'Age is required.';
    } elseif (!ctype_digit($ageRaw)) {
        $errors['age'] = 'Age must be between 18 and 30.';
    } else {
        $age = (int) $ageRaw;
        if ($age < 18 || $age > 30) {
            $errors['age'] = 'Age must be between 18 and 30.';
        }
    }
    if ($ageRaw !== '') {
        $age = $ageRaw; // keep original string for sticky redisplay
    }

    // ---------- 3. University Email ----------
    $email = trim($_POST['email'] ?? '');
    if ($email === '') {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format.';
    }

    // ---------- 4. Membership Type ----------
    $membership = $_POST['membership'] ?? '';
    if (!in_array($membership, $memberships, true)) {
        $errors['membership'] = 'Please select a membership type.';
    }

    // ---------- 5. Department ----------
    $department = $_POST['department'] ?? '';
    if ($department === '' || $department === '--Select Department--' || !in_array($department, $departments, true)) {
        $errors['department'] = 'Please select your department.';
    }

    // ---------- 6. Contact Number ----------
    $contact = trim($_POST['contact'] ?? '');
    if ($contact === '') {
        $errors['contact'] = 'Phone number is required.';
    } elseif (!ctype_digit($contact) || strlen($contact) !== 11) {
        $errors['contact'] = 'Phone number must contain exactly 11 digits.';
    }

    if (empty($errors)) {
        $success = true;
    }
}

function old(string $val): string
{
    return htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Technology Club Registration</title>
<style>
    body { font-family: Arial, Helvetica, sans-serif; background:#f4f6f8; margin:0; padding:30px; }
    .card { max-width:560px; margin:0 auto; background:#fff; padding:30px 35px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1); }
    h1 { font-size:22px; margin-top:0; color:#222; }
    .field { margin-bottom:18px; }
    label { display:block; font-weight:bold; margin-bottom:6px; color:#333; }
    input[type=text], input[type=number], input[type=email], select {
        width:100%; padding:8px 10px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box; font-size:14px;
    }
    .radio-group label, .radio-group span { font-weight:normal; display:inline-block; margin-right:15px; }
    .error { color:#c0392b; font-size:13px; margin-top:4px; }
    .invalid { border-color:#c0392b; }
    button { background:#2c7be5; color:#fff; border:none; padding:10px 22px; border-radius:4px; font-size:15px; cursor:pointer; }
    button:hover { background:#1a5fc1; }
    .success { background:#e6f7ec; border:1px solid #2ecc71; color:#1e7e34; padding:12px 16px; border-radius:4px; margin-bottom:20px; }
</style>
</head>
<body>
<div class="card">
    <h1>Student Technology Club Registration</h1>

    <?php if ($success): ?>
        <div class="success">
            Registration successful! Thank you, <?= old($name) ?>, for joining the Student Technology Club.
        </div>
    <?php endif; ?>

    <form action="" method="POST" novalidate>

        <div class="field">
            <label for="name">Student Name</label>
            <input type="text" id="name" name="name"
                   class="<?= isset($errors['name']) ? 'invalid' : '' ?>"
                   value="<?= old($name) ?>">
            <?php if (isset($errors['name'])): ?>
                <div class="error"><?= old($errors['name']) ?></div>
            <?php endif; ?>
        </div>

        <div class="field">
            <label for="age">Student Age</label>
            <input type="number" id="age" name="age"
                   class="<?= isset($errors['age']) ? 'invalid' : '' ?>"
                   value="<?= old((string) $age) ?>">
            <?php if (isset($errors['age'])): ?>
                <div class="error"><?= old($errors['age']) ?></div>
            <?php endif; ?>
        </div>

        <div class="field">
            <label for="email">University Email</label>
            <input type="email" id="email" name="email"
                   class="<?= isset($errors['email']) ? 'invalid' : '' ?>"
                   value="<?= old($email) ?>">
            <?php if (isset($errors['email'])): ?>
                <div class="error"><?= old($errors['email']) ?></div>
            <?php endif; ?>
        </div>

        <div class="field">
            <label>Membership Type</label>
            <div class="radio-group">
                <?php foreach ($memberships as $m): ?>
                    <label>
                        <input type="radio" name="membership" value="<?= old($m) ?>"
                               <?= $membership === $m ? 'checked' : '' ?>>
                        <?= old($m) ?>
                    </label>
                <?php endforeach; ?>
            </div>
            <?php if (isset($errors['membership'])): ?>
                <div class="error"><?= old($errors['membership']) ?></div>
            <?php endif; ?>
        </div>

        <div class="field">
            <label for="department">Department</label>
            <select id="department" name="department" class="<?= isset($errors['department']) ? 'invalid' : '' ?>">
                <option value="--Select Department--" <?= $department === '' ? 'selected' : '' ?>>-- Select Department --</option>
                <?php foreach ($departments as $d): ?>
                    <option value="<?= old($d) ?>" <?= $department === $d ? 'selected' : '' ?>><?= old($d) ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['department'])): ?>
                <div class="error"><?= old($errors['department']) ?></div>
            <?php endif; ?>
        </div>

        <div class="field">
            <label for="contact">Contact Number</label>
            <input type="text" id="contact" name="contact"
                   class="<?= isset($errors['contact']) ? 'invalid' : '' ?>"
                   value="<?= old($contact) ?>" placeholder="e.g. 01712345678">
            <?php if (isset($errors['contact'])): ?>
                <div class="error"><?= old($errors['contact']) ?></div>
            <?php endif; ?>
        </div>

        <button type="submit">Register</button>
    </form>
</div>
</body>
</html>
