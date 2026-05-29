<?php
$alertClass = match ($flash['type'] ?? '') {
    'success' => 'bg-surface-container-low border-primary text-on-surface',
    'danger' => 'bg-error-container border-error text-on-error-container',
    default => 'bg-surface-container-low border-surface-variant text-on-surface',
};
?>
<div class="border-l-4 p-4 flex justify-between items-start gap-4 <?= $alertClass ?>">
    <p class="font-body-md text-body-md"><?= e($flash['message']) ?></p>
    <button type="button" onclick="this.parentElement.remove()" class="material-symbols-outlined text-lg opacity-60 hover:opacity-100">close</button>
</div>
