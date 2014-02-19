<?php foreach($accounts as $account): ?>
<div data-role="collapsible" data-inset="false">
    <h4 class="accountBar" data-id="<?=$account->id; ?>"><?=$account->name ?></h4>
    <div id="accountDiv<?=$account->id; ?>">Merchant Info</div>
</div>
<?php endforeach; ?>

<script type="text/javascript">
    $(".accountBar").click(function(){
        var id = $(this).attr('data-id');
    
        $.ajax({
            type: "GET",
            url: "/scraper/account",
            data: {id: id}
        }).success (function (data) {
            $('#accountDiv' + id).html(data);
            //$('#accountDiv' + id).enhanceWithin();
        });
    });
</script>