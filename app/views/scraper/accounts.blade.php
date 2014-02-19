<?php foreach($accounts as $account): ?>
<div data-role="collapsible" data-inset="false">
    <h4 class="accountBar" data-id="<?=$account->id; ?>"><?=$account->name ?></h4>
    <div id="accountDiv<?=$account->id; ?>">Merchant Info</div>
</div>
<?php endforeach; ?>
