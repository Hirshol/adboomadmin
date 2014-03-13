<div class="ui-grid-a">
    <div class="ui-block-a">
        <div class="ui-bar ui-bar-a" style="height:20px">Scrape Parameters</div>
        
        <div style="padding-top: 10px; ">
            <div>
                Scraper: <span style="color: green; font-weight: bold; ">Active</span>
            </div>
            <div style="padding: 10px; ">
                {{$searchForm}}
            </div>
        </div>
        
    </div>
    <div class="ui-block-b">
        <div class="ui-bar ui-bar-a" style="height:20px">Portal Accounts</div>
        <div>
            
            <?php foreach($accounts as $account): ?>
            <div data-role="collapsible" data-inset="true">
                <h4 class="accountBar" data-id="<?=$account->id; ?>"><?=$account->uid ?></h4>
                <div id="accountDiv<?=$account->id; ?>">Merchant Info</div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".accountBar").click(function(){
        var id = $(this).attr('data-id');
    
        $.ajax({
            type: "GET",
            url: "/scraper/account",
            data: {id: id}
        }).success (function (data) {
            $('#accountDiv' + id).html(data);
            $('#accountDiv' + id).enhanceWithin();
        });
    });
</script>