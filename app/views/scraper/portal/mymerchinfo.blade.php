{{ Form::open(array('url'=>'#', 'class'=>'form-search', 'name'=>'portalSearchParams')) }}

    <p>
    The following fields will be used for this portal's search parameters. 
    Whether you run a scrape for an individual account or all accounts, 
    these are the parameters that will be used.
    </p>
    
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    
    {{ Form::hidden('id', $id) }}
    
    <span id="formMessage" style="color: green; font-size: 1.2em; font-weight: bold; text-align: center;"></span>
    
    <div class="ui-field-contain">
        {{ Form::label('max_records', 'Max Records') }}
        {{ Form::text('max_records', $max_records, array('class'=>'input-block-level', 'placeholder'=>'Max Records')) }}
    </div>
    <div class="ui-field-contain">
        {{ Form::label('start_date', 'Start Date') }}
        {{ Form::text('start_date', $start_date, array('class'=>'input-block-level', 'data-role'=>'date', 'placeholder'=>'Start Date')) }}
    </div>
    <div class="ui-field-contain">
        {{ Form::label('end_date', 'End Date') }}
        {{ Form::text('end_date', $end_date, array('class'=>'input-block-level', 'data-role'=>'date', 'placeholder'=>'End Date')) }}
    </div>
    
    {{ Form::submit('Update', array('class'=>'btn btn-large btn-primary btn-block'))}}

{{ Form::close() }}

<script>
$(function () {
	$('form[name=portalSearchParams').submit(function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '/scraper/portal-search-form',
			data: $(this).serialize()
			}).success(function(data){
				var data = $.parseJSON(data);
				
				$('#formMessage').show().html(data.message).fadeOut(1000);
			});
		});
});
</script>