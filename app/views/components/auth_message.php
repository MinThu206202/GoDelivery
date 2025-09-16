<?php if (isset($_SESSION['success'])): ?>
<div class="text-center mb-4 rounded-xl border border-green-300 bg-green-100 px-4 py-3 text-green-700 font-semibold">
    <?= $_SESSION['success']; ?>
    <?php unsetMessage('success'); ?>
</div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
<div class="text-center mb-4 rounded-xl border border-red-300 bg-red-100 px-4 py-3 text-red-700 font-semibold">
    <?= $_SESSION['error']; ?>
    <?php unsetMessage('error'); ?>
</div>
<?php endif; ?>