<?php $__env->startComponent('mail::message'); ?>
# Introduction

The body of your message.

<?php $__env->startComponent('mail::button', ['url' => '']); ?>
Button Text
<?php echo $__env->renderComponent(); ?>

Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH /opt/lampp/htdocs/Mailer/resources/views/mail/send/message.blade.php ENDPATH**/ ?>