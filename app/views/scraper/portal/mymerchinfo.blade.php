{{ Form::open(array('url'=>'scraper/portal-search-form/', 'class'=>'form-search')) }}

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
    
    {{ Form::hidden('id', '1', array('class'=>'input-block-level', 'placeholder'=>'Max Records')) }}
    
    <div class="ui-field-contain">
        {{ Form::label('max_records', 'Max Records') }}
        {{ Form::text('max_records', null, array('class'=>'input-block-level', 'placeholder'=>'Max Records')) }}
    </div>
    <div class="ui-field-contain">
        {{ Form::label('start_date', 'Start Date') }}
        {{ Form::text('start_date', null, array('class'=>'input-block-level', 'data-role'=>'date', 'placeholder'=>'Start Date')) }}
    </div>
    <div class="ui-field-contain">
        {{ Form::label('end_date', 'End Date') }}
        {{ Form::text('end_date', null, array('class'=>'input-block-level', 'data-role'=>'date', 'placeholder'=>'End Date')) }}
    </div>
    
    {{ Form::submit('Update', array('class'=>'btn btn-large btn-primary btn-block'))}}

{{ Form::close() }}
