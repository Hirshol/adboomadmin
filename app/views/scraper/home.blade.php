<style>
.scraper-active {color: green; }
</style>
<h3 class="ui-bar ui-bar-a ui-corner-all">Scraper Administration</h3>
<div class="ui-body">

    <div>
        <?php foreach($portals as $portal): ?>
        <?php 
            $active = ($portal->scraper_active == 1) ? ' scraper-active ' : '';
        ?>
        <div data-role="collapsible" data-inset="false">
        <h4 class="portalBar" data-id="<?=$portal->id; ?>"><?=$portal->name ?>
        <span class="<?=$active?>" style="font-size: .8em; float: right"><?='(' .$portal->website . ')'; ?></span>
        </h4>
        <div id="portalDiv<?=$portal->id; ?>"
            style="padding-left: 10px;">
            <span class="ui-icon-loading"></span>
        </div>
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
              url: "/scraper/portal-detail",
              data: { id: id }
            }).success(function( data ) {
                $('#portalDiv' + id).html(data);
                $('#portalDiv' + id).enhanceWithin();
            });
    });

});
</script>
