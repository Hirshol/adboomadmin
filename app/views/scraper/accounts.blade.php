<div class="ui-grid-a">
    <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px">Block A</div>
</div>
<div class="ui-block-b">
    <div class="ui-bar ui-bar-a" style="height:60px">Block B</div></div>
</div><!-- /grid-a -->



<?php foreach($accounts as $account): ?>
<div data-role="collapsible" data-inset="false">
    <h4 class="accountBar" data-id="<?=$account->id; ?>"><?=$account->name ?></h4>
    <div id="accountDiv<?=$account->id; ?>">
        <span class="ui-icon-loading"></span>
    </div>
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