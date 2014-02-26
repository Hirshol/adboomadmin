<span style="float: right;"> 
    <a href="#" class="ui-btn ui-btn-inline ui-mini btn-start-scrape" data-account-id="{{ $account->id }}">Start Scrape</a> 
    <a href="#" class="ui-btn ui-btn-inline ui-mini">Edit</a>
    <a href="#" class="ui-btn ui-btn-inline ui-mini">Delete</a>
</span>
<table>
    <tbody>
        <tr>
            <td class="ui-bold" style="text-align: right; ">Login</td>
            <td><?=$account->uid?></td>
        </tr>
        <tr>
            <td style="text-align: right; ">Password</td>
            <td><?=$account->password?></td>
        </tr>
        
        
        <tr>
            <td style="vertical-align: top; text-align: right;">Scrapes</td>
            <td>
                <?php foreach($scrapeFiles as $sf): ?>
                <a href="<?='/scraper/download-scrape/?file='.$filepath.'/'.$sf; ?>" target="_blank"><?=$sf?></a><br>
                <?php endforeach;?>
            </td>
            </tr>
    </tbody>
</table>

<script>
$(".btn-start-scrape").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: '/scraper/scrape',
        data: {id:$(this).attr('data-account-id')}
        }).success(function(data){
            data = $.parseJSON(data);
            alert('Request sent...');
        });

});
</script>