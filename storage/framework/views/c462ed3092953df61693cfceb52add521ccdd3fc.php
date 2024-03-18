<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your information has been <?php echo e($type_); ?></title>
</head>
<body>
  
    <p>Hello  <?php echo e($person->name); ?>,</p>
    <p>Your information has been <?php echo e($type_); ?> in the system, you'll be updated when your details are modified:</p>
    <p>Name: <?php echo e($person->name); ?></p>
    <p>Surname: <?php echo e($person->surname); ?></p>
    <p>South African ID Number: <?php echo e($person->sa_id_number); ?></p>
    <p>Mobile Number: <?php echo e($person->mobile_number); ?></p>
    <p>Email: <?php echo e($person->email); ?></p>
    <p>Birth Date: <?php echo e($person->birth_date); ?></p>
    <p>Language: <?php echo e($person->language); ?></p>
    <p>Interests:</p>
    <ul>
        <?php $__currentLoopData = $person->interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($interest['text']); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <p>Thank you.</p>
</body>
</html>
<?php /**PATH C:\xampp\SPA\lara9sanctum-auth-vite-vue3\resources\views/emails/captured/person_captured.blade.php ENDPATH**/ ?>