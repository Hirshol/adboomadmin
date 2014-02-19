
<h3 class="ui-bar ui-bar-a ui-corner-all">Scraper Administration</h3>
    <div class="ui-body">
        
        <span>
            <a href="/scraper/" class="ui-btn ui-btn-inline">Portal List</a>
            <a href="#" class="ui-btn ui-btn-inline">Add Portal</a>
            <a href="#" class="ui-btn ui-btn-inline">Scraper Logs</a>
        </span>
        
        <div>
            <?php foreach($portals as $portal): ?>
            <div data-role="collapsible" data-inset="true">
                <h4 class="portalBar" data-id="<?=$portal->id; ?>"><?=$portal->name ?><span style="font-size: .8em; float: right"><?='(' .$portal->url . ')'; ?></span></h4>
                <div id="portalDiv<?=$portal->id; ?>" style="padding-left: 10px; ">List of Portal Accounts</div>
            </div>
            <?php endforeach; ?>
        </div>
        
    </div>
        
    
        
<script type="text/javascript">
$(function(){
    $(".portalBar").click(function(){
        var id = $(this).attr('data-id');

        $.ajax({
              type: "GET",
              url: "/scraper/accounts",
              data: { id: id }
            }).success(function( data ) {
                $('#portalDiv' + id).html(data);
                $('#portalDiv' + id).enhanceWithin();
                
            });
    });
});
</script>
