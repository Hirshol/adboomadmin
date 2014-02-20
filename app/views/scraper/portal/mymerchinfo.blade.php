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
    {{ Form::text('firstname', null, array('class'=>'input-block-level', 'placeholder'=>'Max Records')) }}
    {{ Form::text('lastname', null, array('class'=>'input-block-level', 'placeholder'=>'Start Date')) }}
    {{ Form::text('lastname', null, array('class'=>'input-block-level', 'placeholder'=>'End Date')) }}

    {{ Form::submit('Update', array('class'=>'btn btn-large btn-primary btn-block'))}}

{{ Form::close() }}
